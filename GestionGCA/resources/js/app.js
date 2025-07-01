import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
window.Echo.private('user.' + window.Laravel.userId)
    .listen('NouveauMessage', (e) => {
        let content = `✉️ Message de ${e.message.expediteur.prenom} : ${e.message.contenu}`;

        document.getElementById('toast-body-content').innerText = content;
        let toast = new bootstrap.Toast(document.getElementById('toast-message'));
        toast.show();
    });
