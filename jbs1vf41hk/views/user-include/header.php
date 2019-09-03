<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Helium - Bootstrap 4 Onepage Template</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/bootstrap.min.css" >
    <!-- Font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/font-awesome.min.css">
    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/slicknav.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/owl.theme.css">
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/animate.css">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/main.css">
    <!-- Extras Style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/extras.css">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()."assets/helium-opl/" ?>css/responsive.css">

  </head>
  <body>

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
      <!-- Navbar Start --> 
      <?php
      $this->load->view('user-include/menu'); ?>
      <!-- Navbar End -->

      <!-- sliders -->
      <div id="sliders">
        <div class="full-width">
          <!-- light slider -->
          <div id="light-slider" class="carousel slide">
            <div id="carousel-area">
              <div id="carousel-slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-slider" data-slide-to="1"></li>
                  <li data-target="#carousel-slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <img src="<?= base_url()."assets/helium-opl/" ?>img/slider/11.jpg" alt="">
                    <div class="carousel-caption">
                      <h3 class="slide-title animated fadeInDown"><span>Solusi</span> Cerdas</h3>
                      <h5 class="slide-text animated fadeIn">Lorem ipsum dolor sit amet, consectetuer adipiscing elit<br> Curabitur ultricies nisi Nam eget dui. Etiam rhoncus</h5> 
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="<?= base_url()."assets/helium-opl/" ?>img/slider/22.jpg" alt="">
                    <div class="carousel-caption">
                      <h3 class="slide-title animated fadeInDown"><span>Perusahaan</span> Terpercaya</h3>
                      <h5 class="slide-text animated fadeIn">Lorem ipsum dolor sit amet, consectetuer adipiscing elit<br> Curabitur ultricies nisi Nam eget dui. Etiam rhoncus</h5> 
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="<?= base_url()."assets/helium-opl/" ?>img/slider/33.jpg" alt="">
                    <div class="carousel-caption">
                      <h3 class="slide-title animated fadeInDown"><span>Telah Bekerja sama </span> Dengan isntansi pemerintahan maupun swasta</h3>
                      <h5 class="slide-text animated fadeIn">Lorem ipsum dolor sit amet, consectetuer adipiscing elit<br> Curabitur ultricies nisi Nam eget dui. Etiam rhoncus</h5>
                      <!-- <a href="#" class="btn btn-lg btn-border animated fadeInUp">Get Started</a>
                      <a href="#" class="btn btn-lg btn-common animated fadeInUp">Download</a> -->
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
                  <i class="fa fa-chevron-left"></i>
                </a>
                <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
                  <i class="fa fa-chevron-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End sliders -->

    </header>