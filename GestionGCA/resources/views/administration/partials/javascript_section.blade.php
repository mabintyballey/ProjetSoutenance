<!-- Core JS Files -->
<script src="{{ asset('administration/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/kaiadmin.min.js') }}"></script>

<!-- CSRF Token Setup -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function() {
        // Configurer le token CSRF pour toutes les requêtes AJAX
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // 1. Gestion des départements et des classes
        $('#departement-selector').change(function() {
            let departementId = $(this).val();
            if (departementId) {
                let departementName = $("#departement-selector option:selected").text();
                $('#departement-name').text('Département : ' + departementName).show();
               
            } else {
                $('#departement-name').hide();
                $('#classe-table').hide();
            }
        });

        // Charger les classes pour un département
        // Clic sur le bouton "Afficher ses Classes"
       $('#show-classes-btn').click(function() {
        let departementId = $('#departement-selector').val();
        
        if (departementId) {
            // Afficher le nom du département sélectionné
            let departementName = $("#departement-selector option:selected").text();
            $('#departement-name').text('Département : ' + departementName).show();

            // Requête AJAX pour récupérer les classes du département
            $.ajax({
                url: '/departement/' + departementId + '/classes',
                type: 'GET',
                success: function(response) {
                if (Array.isArray(response.classes) && response.classes.length > 0) {
                // Afficher les classes dans le tableau
                    $('#classe-table tbody').empty();
                    response.classes.forEach(function(classe) {
                    let row = `
                        <tr id="classe-${classe.id}">
                            <td>${classe.id}</td>
                            <td>${classe.niveau}</td>
                            <td>
                                <button class="btn btn-info btn-sm view-matieres" data-id="${classe.id}">Voir Matières</button>
                                <button class="btn btn-danger btn-sm delete-classe" data-id="${classe.id}">Supprimer</button>
                            </td>
                        </tr>
                    `;
                   $('#classe-table tbody').append(row);
                   });
                   $('#classe-table').show();
                } else {
                 $('#classe-table').hide();
                $('#departement-name').text('Aucune classe disponible').show();
                }
            },
          error: function(xhr, status, error) {
          $.notify({ message: 'Erreur lors du chargement des classes' }, { type: 'danger', delay: 3000 });
        }
       });

        } else {
            $('#departement-name').hide();
            $('#classe-table').hide();
        }
      });

       // Afficher les matières d'une classe
      $(document).on('click', '.view-matieres', function() {
             let classeId = $(this).data('id');
        $.ajax({
            url: '/classe/' + classeId + '/matieres',
            type: 'GET',
            success: function(response) {
                $('#classe-nom').text(response.niveau || 'Nom de la classe');
                
                // Vérifier que 'matieres' existe et est un tableau
                if (response.matieres && response.matieres.length > 0) {
                    $('#matiere-list').empty();
                    response.matieres.forEach(function(matiere) {
                        $('#matiere-list').append('<li>' + matiere.nom + '</li>');
                    });
                    $('#matiere-container .card').show();
                } else {
                    $('#matiere-list').empty().append('<li>Aucune matière disponible</li>');
                    $('#matiere-container .card').show();
                }
            },    

            error: function(xhr, status, error) {
                $.notify({ message: 'Erreur lors du chargement des matières' }, { type: 'danger', delay: 3000 });
            }
        });
      });

        // Clic sur le bouton "Ajouter une Classe"
        $('#addClassForm').submit(function(event) {
            event.preventDefault();  
            let departementId = $('#departement-selector').val();
           let classeNom = $('#classe-nom').val();

           console.log("Département ID:", departementId);
          console.log("Nom de la classe:", classeNom);
           
            if (!departementId || !classeNom) {
                alert('Veuillez remplir tous les champs.');
                return; 
            }
        
            // Envoi des données via AJAX
            $.ajax({
                url: '/add-classe', 
                method: 'POST',
                data: {
                    departement_id: departementId,
                    nom: classeNom,
                    _token: '{{ csrf_token() }}' 
                },
                success: function(response) {
                    
                    if (response.success) {
                        alert('Classe ajoutée avec succès !');
                    } else {
                        alert('Erreur lors de l\'ajout de la classe');
                    }
                },
                error: function(xhr) {
                    if (xhr.status == 400) {
                        var errors = xhr.responseJSON.error;
                        $('#error-message').show();
                        $('#error-list').html('<li>' + errors + '</li>');
                    } else {
                        alert('Une erreur est survenue. Veuillez réessayer.');
                    }
                }
            });
        });

       //ouverture de la fenetre modak
       $('#add-class-btn').click(function() {
            $('#addClassModal').modal('show');
         });
        //  fermer la fenetre modal
         $('#addClassModal .close, #cancel-btn').click(function() {
             $('#addClassModal').modal('hide');
         });

        $('#show-classes-btn').click(function() {
         let departementId = $('#departement-selector').val();
          if (departementId) {
            loadClasses(departementId);
          }
        });
        $('#addClassModal').on('show.bs.modal', function() {
            $('#addClassForm')[0].reset();  
        });
        // Supprimer une classe
        $(document).on('click', '.delete-classe', function() {
            let classeId = $(this).data('id');
            $.ajax({
                url: '/classes/' + classeId,
                type: 'DELETE',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function() {
                    $('#classe-' + classeId).remove();
                    $.notify({ message: 'Classe supprimée avec succès' }, { type: 'success', delay: 3000 });
                },
                error: function() {
                    $.notify({ message: 'Erreur lors de la suppression de la classe' }, { type: 'danger', delay: 3000 });
                }
            });
        });
          // Annuler l'ajout de la matière
          $('#annuler-ajout').click(function() {
          $('#matiere-nom').val('');
          $('#classe-id').val('');
          $('#departement-id').val('')
        });
        // 2. Ajout d'une matière
        $('#ajouter-matiere').click(function() {
            let storeUrl = $(this).data('url');
            let nom = $('#matiere-nom').val();
            let classeId = $('#classe-id').val();

            if (nom.length < 3) {
                alert('Le nom doit contenir au moins 3 caractères.');
                return;
            }
            if (!nom || !classeId) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            $.ajax({
                url: storeUrl,
                type: 'POST',
                data: { nom: nom, classe_id: classeId, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.error) {
                        $.notify({ message: response.error }, { type: 'danger', delay: 3000 });
                    } else if (response.matiere && response.matiere.id && response.matiere.nom) {
                        $('#matiere-table tbody').append(`
                            <tr id="matiere-${response.matiere.id}">
                                <td>${response.matiere.id}</td>
                                <td>${response.matiere.nom}</td>
                                <td><button class="btn btn-danger btn-sm delete-matiere" data-id="${response.matiere.id}">🗑️ Supprimer</button></td>
                            </tr>
                        `);
                        updateTotalMatieres();
                        $('#matiere-nom').val('');
                        $('#classe-id').val('');
                        $.notify({ message: 'Matière ajoutée avec succès !' }, { type: 'success', delay: 2000 });
                    }
                },
                error: function() {
                    $.notify({ message: 'Erreur lors de l\'ajout de la matière !' }, { type: 'danger', delay: 2000 });
                }
            });
        });
        // Quand un département est sélectionné
         document.getElementById('departement-id').addEventListener('change', function() {
        let departementId = this.value;
        let classeSelect = document.getElementById('classe-id');
        let matiereNomInput = document.getElementById('matiere-nom');
        let ajouterMatiereButton = document.getElementById('ajouter-matiere');

        // Réinitialiser les classes
        classeSelect.innerHTML = '<option value="">Choisir une classe</option>';
        classeSelect.disabled = true;
        matiereNomInput.disabled = true;
        ajouterMatiereButton.disabled = true;

        if (departementId) {
            classeSelect.disabled = false;
            fetch(`/get-classes-by-departement/${departementId}`)
                .then(response => response.json())
                .then(data => {
                    data.classes.forEach(classe => {
                        let option = document.createElement('option');
                        option.value = classe.id;
                        option.textContent = classe.niveau;
                        classeSelect.appendChild(option);
                    });
                });
        }
    });

   document.getElementById('classe-id').addEventListener('change', function() {
        let matiereNomInput = document.getElementById('matiere-nom');
        let ajouterMatiereButton = document.getElementById('ajouter-matiere');

        if (this.value) {
            matiereNomInput.disabled = false;
            ajouterMatiereButton.disabled = false;
        } else {
            matiereNomInput.disabled = true;
            ajouterMatiereButton.disabled = true;
        }
    });

        // Mettre à jour le total des matières
        function updateTotalMatieres() {
            let total = $('#matiere-table tbody tr').length;
            $('#total-count').text(total);
        }

        // Supprimer une matière
        $(document).on('click', '.delete-matiere', function() {
            let matiereId = $(this).data('id');
            $.ajax({
                url: "/matieres/" + matiereId,
                type: "POST",
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    $('#matiere-' + matiereId).remove();
                    updateTotalMatieres();
                    $.notify({ message: 'Matière supprimée avec succès !' }, { type: 'success', delay: 2000 });
                },
                error: function() {
                    $.notify({ message: 'Erreur lors de la suppression de la matière !' }, { type: 'danger', delay: 2000 });
                }
            });
        });
    });
   
    //message d'erreur au cas ou les role se repete
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 5000); 
   


    
</script>

@stack('scripts')
