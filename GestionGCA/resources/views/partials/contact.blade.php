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
          <!-- Page Header Start -->
          <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Contactez-nous</h2>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('accueil') }}">Accueil</a>
                            <a href="">Contactez-nous</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


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