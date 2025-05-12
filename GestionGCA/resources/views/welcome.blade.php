@include('partials.head')

<body class="index-page">
    <div class="wrapper">
        <div id="preloader-active">
                <div class="preloader d-flex align-items-center justify-content-center">
                    <div class="preloader-inner position-relative">
                        <div class="preloader-circle"></div>
                        <div class="preloader-img pere-text">
                            <img src="assets/img/loder.jpg" alt="Logo">
                        </div>
                    </div>
                </div>
            </div>
        <div class="colorlib-loader"></div>
      <!-- Header -->
      @include('partials.header')

         <main class="main">
     
            <!-- Carousel Start -->
            <div id="carousel" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                         <li data-target="#carousel" data-slide-to="0" class="active"></li>
                         <li data-target="#carousel" data-slide-to="1"></li>
                         <li data-target="#carousel" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                         <div class="carousel-item active">
                         <img src="{{ asset('assets/img/carousel-1.jpg') }}" alt="Carousel Image">
                             <div class="carousel-caption">
                                 <h1 class="animated fadeInLeft">Nous sommes prêts à nous opposer pour vous</h1>
                                 <p class="animated fadeInRight">Lorem ipsum dolor sit amet elit. Mauris odio mauris...</p>
                                 <a class="btn animated fadeInUp" href="infoClient">OBTENEZ UNE CONSULTATION GRATUITE</a>
                             </div>
                         </div> 
     
                         <div class="carousel-item">
                         <img src="{{ asset('assets/img/carousel-2.jpg') }}" alt="Carousel Image">
                             <div class="carousel-caption">
                                 <h1 class="animated fadeInLeft">Nous nous battons pour votre privilège</h1>
                                 <p class="animated fadeInRight">Lorem ipsum dolor sit amet elit. Mauris odio mauris...</p>
                                 <a class="btn animated fadeInUp" href="infoClient">OBTENEZ UNE CONSULTATION GRATUITE</a>
                             </div>
                         </div>
     
                         <div class="carousel-item">
                         <img src="{{ asset('assets/img/carousel-3.jpg') }}" alt="Carousel Image">
                             <div class="carousel-caption">
                                 <h1 class="animated fadeInLeft">Nous nous battons pour votre justice</h1>
                                 <p class="animated fadeInRight">Lorem ipsum dolor sit amet elit. Mauris odio mauris...</p>
                                 <a class="btn animated fadeInUp" href="#infoClient">OBTENEZ UNE CONSULTATION GRATUITE</a>
                             </div>
                         </div>
                     </div>
     
                     <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                         <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                         <span class="carousel-control-next-icon" aria-hidden="true"></span>
                         <span class="sr-only">Next</span>
                     </a>
                 </div>
                 <!-- Carousel End -->
                 
                 
                 <!-- Top Feature Start-->
                   <div class="feature-top">
                     <div class="container-fluid">
                         <div class="row align-items-center">
                             <div class="col-md-3 col-sm-6">
                                 <div class="feature-item">
                                     <i class="far fa-check-circle"></i>
                                     <h3>Légal</h3>
                                     <p>Approuvé par le gouvernement</p>
                                 </div>
                             </div>
                             <div class="col-md-3 col-sm-6">
                                 <div class="feature-item">
                                     <i class="fa fa-user-tie"></i>
                                     <h3>Avocats</h3>
                                     <p>Avocats experts</p>
                                 </div>
                             </div>
                             <div class="col-md-3 col-sm-6">
                                 <div class="feature-item">
                                     <i class="far fa-thumbs-up"></i>
                                     <h3>Succèss</h3>
                                     <p>99.99% Affaire gagnée</p>
                                 </div>
                             </div>
                             <div class="col-md-3 col-sm-6">
                                 <div class="feature-item">
                                     <i class="far fa-handshake"></i>
                                     <h3>Soutien</h3>
                                     <p>Assistance rapide</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                   </div>
                 <!-- Top Feature End-->
       <section class="ftco-section ftco-no-pt ftco-no-pb" id="bienvenue">
           <div class="container">
               <div class="row d-flex align-items-center">
                   <!-- Colonne Image -->
                   <div class="col-md-6 d-flex">
                       <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end" style="background-image:url(images/about.jpg);">
                           <img src="{{ asset('assets/img/about.jpg') }}" alt="Image de présentation">
                       </div>
                   </div>
       
                   <!-- Colonne Texte -->
                   <div class="col-md-6 px-5 py-5">
                       <div class="row justify-content-start pt-3 pb-3">
                           <div class="col-md-12 heading-section ftco-animate">
                               <span class="subheading">Bienvenue chez Judge</span>
                               <h2 class="mb-4">Nous nous battons toujours pour que votre justice gagne</h2>
                               <p>Loin très loin, derrière le mot montagnes, loin des pays Vokalia et Consonantia</p>
                               <p>Une petite rivière nommée Duden coule près de chez eux et lui fournit les regelialia nécessaires. C’est un pays paradisiaque, dans lequel des parties torréfiées de phrases volent dans votre bouche.</p>
                               <p>Même le tout-puissant Pointage n’a aucun contrôle sur les textes aveugles, c’est une vie presque non orthographique Un jour, cependant, une petite ligne de texte aveugle du nom de Lorem Ipsum a décidé de partir pour le monde lointain de la grammaire.</p>
                               <div class="years d-flex">
                                   <h4 class="number mr-2" data-number="40">0</h4>
                                   <h4>Années d’expérience</h4>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </section>
             <!-- Service Start -->
        <section class="ftco-section" id="services">
                <div class="service">
                <div class="container">
                <div class="container">
    	     	<div class="row no-gutters justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
               	<span class="subheading">Domaines d’intervention</span>
                   <h2 class="mb-4">Domaines d’intervention</h2>
               </div>
             </div>
                 <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-landmark"></i>
                                </div>
                                <h3>Affaires civiles</h3>
                                <p>
                                    Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                                </p>
                                <a class="btn" href="">POUR EN SAVOIR PLUS</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <h3>Affaires pénales</h3>
                                <p>
                                    Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                                </p>
                                <a class="btn" href="">POUR EN SAVOIR PLUS</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-hand-holding-usd"></i>
                                </div>
                                <h3>Affaires administratives</h3>
                                <p>
                                    Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                                </p>
                                <a class="btn" href="">POUR EN SAVOIR PLUS</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <h3>Affaires commerciales </h3>
                                <p>
                                    Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                                </p>
                                <a class="btn" href="">POUR EN SAVOIR PLUS</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-gavel"></i>
                                </div>
                                <h3>Elaboration d’un contrat </h3>
                                <p>
                                    Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                                </p>
                                <a class="btn" href="">POUR EN SAVOIR PLUS</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <h3>Cyber Droit</h3>
                                <p>
                                    Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                                </p>
                                <a class="btn" href="">POUR EN SAVOIR PLUS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <!-- Service End -->

             <!-- Team Start -->
        <section class="ftco-section ftco-no-pt" id="equipe">
            <div class="team">
                <div class="container">
                <div class="container">
    	      	<div class="row justify-content-center mb-5 pb-3">
               <div class="col-md-7 text-center heading-section ftco-animate">
               	<span class="subheading">Notre avocat</span>
                 <h2 class="mb-4">Rencontrez nos avocats experts</h2>
               </div>
             </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="{{ asset('assets/img/team-1.jpg') }}" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Adam Phillips</h2>
                                    <p>Avocat civil</p>
                                    <div class="team-social">
                                        <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="{{ asset('assets/img/team-2.jpg') }}" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Dylan Adams</h2>
                                    <p>Avocat d’affaires</p>
                                    <div class="team-social">
                                        <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="{{ asset('assets/img/team-3.jpg') }}" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Gloria Edwards</h2>
                                    <p>Défense pénale</p>
                                    <div class="team-social">
                                        <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="{{ asset('assets/img/team-4.jpg') }}" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Josh Dunn</h2>
                                    <p>Avocat en assurance</p>
                                    <div class="team-social">
                                        <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2 mb-4">
                         <div class="col-auto">
                            <button id="voir-plus" class="btn btn-outline-dark rounded-pill px-4 py-2">
                             <i class="fas fa-plus mr-2"></i> Voir plus
                            </button>
                         </div>
                     </div>
                </div>
            </div>
        </section>
<!-- informations du client au cabinet -->
<section id="infoClient" class="p-4 flex items-end min-h-screen" style="background-image: url('{{ asset('assets/img/single.jpg') }}');">
    <div class="container col-md-8 p-3" style="background-color: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
          <!-- <h2 class="mb-4">Prise de rendez-vous</h2> -->
           <div class="text-center p-8">
                      <!-- Texte principal : "Prise de rendez-vous" -->
                      <span class="subheading text-indigo-500 mb-4 text-lg font-semibold">Prise de rendez-vous</span>
                             
                      <!-- Titre de la section -->
                      <h2 class="text-4xl text-gray-500 font-bold leading-tight">Consultation gratuite</h2>
           </div>
   <!-- Section contenant le texte avant le formulaire -->
        <div class="p-8 bg-white/30 rounded-xl shadow-2xl backdrop-blur-lg mb-8 w-full max-w-4xl">
               
            <form id="clientForm" action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data" class="text-dark fw-bold">
                      @csrf
        
                <!-- ÉTAPE 1: Infos personnelles -->
                <div class="step active">
                    <h4>1. Informations personnelles</h4>
                    <div class="mb-3">
                        <label>Nom complet</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Adresse</label>
                        <input type="text" name="adresse" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Pièce d'identité</label>
                        <input type="file" name="piece_identite" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                </div>
        
                <!-- ÉTAPE 2: Choix du service -->
                <div class="step">
                    <h4>2. Service souhaité</h4>
                    <div class="mb-3">
                        <label>Type de service</label>
                        <select name="type_service" class="form-control" required>
                            <option value="">-- Choisir un service --</option>
                            <option value="conseil">Conseiller juridique</option>
                            <option value="avocat">Avocat (défense, assigné...)</option>
                            <option value="juriste">Jeune juriste (entreprises)</option>
                            <option value="collaborateur">Collaborateur</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Choisir un avocat</label>
                        <select name="avocat_choisi" id="avocat_choisi" class="form-control" disabled>
                            <option value="">-- Sélectionnez un avocat --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Description du problème</label>
                        <textarea name="probleme" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
        
                <!-- ÉTAPE 3: Détails supplémentaires -->
                <div class="step">
                    <h4>3. Détails supplémentaires</h4>
                    <div class="mb-3">
                        <label>Documents (PDF/PNG/JPEG)</label>
                        <input type="file" name="documents[]" class="form-control" multiple accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                    <div class="mb-3">
                        <label>Informations sur la partie adverse</label>
                        <input type="text" name="adverse_info" class="form-control" required>
                    </div>
                </div>
        
                <!-- Navigation -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" id="prevBtn" class="btn btn-secondary" onclick="nextStep(-1)">Précédent</button>
                    <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextStep(1)">Suivant</button>
                    <button type="submit" id="submitBtn" class="btn btn-success d-none">Soumettre</button>
                </div>
            </form>
        </div>
    </div>
</section>
  <!-- fin information client -->
<section id="avisClient">
    <!-- Testimonial Start -->
    <div class="testimonial">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Attestation</span>
                    <h2 class="mb-4">Des clients satisfaits</h2>
                </div>
            </div>
            <div class="owl-carousel testimonials-carousel">
                <div class="testimonial-item">
                    <i class="fa fa-quote-right"></i>
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{ asset('img/testimonial-2.jpg') }}" alt="Testimonial Image">
                        </div>
                        <div class="col-9">
                            <h2>Client 1</h2>
                            <p>Profession 1</p>
                        </div>
                        <div class="col-12">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item">
                    <i class="fa fa-quote-right"></i>
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{ asset('img/testimonial-2.jpg') }}" alt="Testimonial Image">
                        </div>
                        <div class="col-9">
                            <h2>Client 2</h2>
                            <p>Profession 2</p>
                        </div>
                        <div class="col-12">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item">
                    <i class="fa fa-quote-right"></i>
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{ asset('img/testimonial-2.jpg') }}" alt="Testimonial Image">
                        </div>
                        <div class="col-9">
                            <h2>Client 3</h2>
                            <p>Profession 3</p>
                        </div>
                        <div class="col-12">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item">
                    <i class="fa fa-quote-right"></i>
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{ asset('img/testimonial-1.JPG') }}" alt="Testimonial Image">
                        </div>
                        <div class="col-9">
                            <h2>Client 4</h2>
                            <p>Profession 4</p>
                        </div>
                        <div class="col-12">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Vous pouvez ajouter encore plus d'éléments si nécessaire -->
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
</section> 
  <!-- Newsletter Start -->
  <div class="newsletter">
                <div class="container">
                    <div class="section-header">
                        <h2>JUGE CABINET D'AVOCAT</h2>
                        <P>Rejoignez nous pour plus d'info</P>
                    </div>
                    <div class="form">
                        <input class="form-control" placeholder="Email here">
                        <button class="btn">Submit</button>
                    </div>
                </div>
            </div>
     <!-- Newsletter End --> 
    </main>
        @include('partials.footer')

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        
        <!-- Preloader -->
        <div id="preloader"></div>
        
        @include('partials.javascript_section')
   </div>
</body>

</html>
