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
    @forelse ($avocats as $avocat)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="team-item">
            <div class="team-img">
                <img src="{{ $avocat->user->photo ? asset('storage/'.$avocat->user->photo) : asset('assets/img/default-avatar.png') }}" alt="{{ $avocat->user->prenom }}">
            </div>
            <div class="team-text">
                <h2>{{ $avocat->user->prenom }} {{ $avocat->user->nom }}</h2>
                <p>{{ $avocat->specialite ? $avocat->specialite->nom : ($avocat->domaine->nom ?? 'Spécialité indisponible') }}</p>
                <div class="team-social">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-center">Aucun avocat trouvé pour le moment.</p>
    @endforelse
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
<section id="infoContact" class="p-4 flex items-end min-h-screen">
    <!-- Contact Start -->
            <div class="contact">
                <div class="container">
                    <div class="section-header">
                        <h2>Contactez-nous</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fa fa-map-marker-alt"></i>
                                    <div class="contact-text">
                                        <h2>Emplacement</h2>
                                        <p>123 Rue, Guinée Conakry</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fa fa-phone-alt"></i>
                                    <div class="contact-text">
                                        <h2>Téléphone</h2>
                                        <p>+224 624 761 949</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fa fa-envelope"></i>
                                    <div class="contact-text">
                                        <h2>Messagerie électronique</h2>
                                        <p>jugecabinetavocat@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-form">
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Name" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Subject" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message" required="required" ></textarea>
                                    </div>
                                    <div>
                                        <button class="btn" type="submit">ENVOYER UN MESSAGE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Contact End -->
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
