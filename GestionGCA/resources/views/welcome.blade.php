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
                                 <a class="btn animated fadeInUp" href="#">OBTENEZ UNE CONSULTATION GRATUITE</a>
                             </div>
                         </div> 
     
                         <div class="carousel-item">
                         <img src="{{ asset('assets/img/carousel-2.jpg') }}" alt="Carousel Image">
                             <div class="carousel-caption">
                                 <h1 class="animated fadeInLeft">Nous nous battons pour votre privilège</h1>
                                 <p class="animated fadeInRight">Lorem ipsum dolor sit amet elit. Mauris odio mauris...</p>
                                 <a class="btn animated fadeInUp" href="#">OBTENEZ UNE CONSULTATION GRATUITE</a>
                             </div>
                         </div>
     
                         <div class="carousel-item">
                         <img src="{{ asset('assets/img/carousel-3.jpg') }}" alt="Carousel Image">
                             <div class="carousel-caption">
                                 <h1 class="animated fadeInLeft">Nous nous battons pour votre justice</h1>
                                 <p class="animated fadeInRight">Lorem ipsum dolor sit amet elit. Mauris odio mauris...</p>
                                 <a class="btn animated fadeInUp" href="#">OBTENEZ UNE CONSULTATION GRATUITE</a>
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
                                <h3>Droit civil</h3>
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
                                <h3>Droit de la famille</h3>
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
                                <h3>Droit des affaires</h3>
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
                                <h3>Droit de l’éducation</h3>
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
                                <h3>Droit pénal</h3>
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
                </div>
            </div>
        </section>
        <!-- Team End -->
    <section class="ftco-consultation ftco-section relative" style="background-image: url('{{ asset('assets/img/bg_2.jpg') }}'); background-size: cover; background-position: center;">
          <!-- Overlay sombre pour améliorer la lisibilité -->
              <div class="absolute inset-0 bg-black opacity-40"></div>
    
    <!-- Section contenant le formulaire avec effet de flou -->
    <div class="container mx-auto px-4 py-20 relative z-10">
        <div class="row flex md:justify-center">
            <div class="col-md-6 half p-8 bg-white bg-opacity-60 rounded-xl shadow-lg backdrop-blur-lg">
                <!-- Texte principal : "Prise de rendez-vous" -->
                <span class="subheading text-blue-600 block text-xl mb-2">Prise de rendez-vous</span>
                
                <!-- Titre de la section -->
                <h2 class="mb-6 text-3xl text-gray-800 font-semibold">Consultation gratuite</h2>

                <!-- Formulaire -->
                <form action="#" method="POST" class="consultation space-y-6" enctype="multipart/form-data">
                    @csrf
                    <!-- Nom -->
                    <div class="form-group">
                        <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Votre nom" required>
                    </div>
                    
                    <!-- Email -->
                    <div class="form-group">
                        <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Votre email" required>
                    </div>

                    <!-- Sujet -->
                    <div class="form-group">
                        <input type="text" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Objet" required>
                    </div>

                    <!-- Message -->
                    <div class="form-group">
                        <textarea name="message" id="message" cols="30" rows="7" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Message" required></textarea>
                    </div>

                    <!-- Champ pour le fichier PDF -->
                    <div class="form-group">
                        <label for="pdf_file" class="text-white">Joindre un fichier PDF</label>
                        <input type="file" name="pdf_file" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" accept=".pdf" required>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="form-group">
                        <input type="submit" value="Envoyer le message" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
  
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
                            <img src="{{ asset('img/testimonial-2.jpg') }}" alt="Testimonial Image">
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
    </main>
        @include('partials.footer')

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        
        <!-- Preloader -->
        <div id="preloader"></div>
        
        @include('partials.javascript_section')
   </div>
 
   </footer> 
</body>

</html>
