<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/c26cd2166c.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.2.slim.js" integrity="sha256-OflJKW8Z8amEUuCaflBZJ4GOg4+JnNh9JdVfoV+6biw=" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <script src="script.js"></script>
    
    
    <title>Ray Tattoo</title>
</head>
<body>  
        <!-- section for big icon starts here -->

      <section class="main" id="deleted">
           <svg id="openingLogo" class="openingLogo" width="682" height="1024" viewBox="0 0 682 1024" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- R -->
                <path d="M85.5156 549V478.078H98.4062H120.312C130.5 478.078 138.719 481.094 144.969 487.125C151.219 493.156 154.344 500.531 154.344 509.25C154.344 515.531 152.844 521.281 149.844 526.5C146.844 531.719 142.594 535.781 137.094 538.688L156.844 549H140.344L122.094 539.25H98.6875V549H85.5156ZM98.6875 527.438H119.156C124.219 527.438 128.281 525.938 131.344 522.938C134.406 519.938 135.938 516.062 135.938 511.312C135.938 506.562 134.406 502.688 131.344 499.688C128.281 496.688 124.219 495.188 119.156 495.188H98.6875V527.438Z" stroke="rgb(36, 36, 28)" stroke-width="2"/>
                <!-- A -->
                <path d="M190.825 549L220.403 478.078H230.669L260.528 549H246.044L238.356 530.672H213.231L205.356 549H190.825ZM218.012 517.875H233.2L225.606 496.406L218.012 517.875Z" stroke="rgb(36, 36, 28)" stroke-width="2"/>
                <!-- Y -->
                <path d="M290.853 549V519.781L270.103 478.078H285.853L300.025 508.781L314.197 478.078H329.947L309.197 519.781V549H290.853Z" stroke="rgb(36, 36, 28)" stroke-width="2"/>
                </svg>
                <svg id="openingLogo2" class="openingLogo2" width="682" height="1024" viewBox="0 0 682 1024" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M424.244 -4.27825L435.348 0.272889L12.727 1031.35L1.6235 1026.8L424.244 -4.27825Z" stroke="rgb(36, 36, 28)" stroke-width="16" />
                </svg>
                
                
        
       
      </section> 
        
       

        <!-- section for big icon ends here -->

            <!-- navbar  starts here -->
      <nav id="navBar" class="navbar navbar-expand-lg sticky-top text-uppercase" data-aos="fade-up">
        <div class="container">
        
          <a class="navbar-brand" href="#">RAY TATTOO</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link  px-lg-4 rounded" aria-current="page" href="#section1">Nuestros Artistas</a>
              <a class="nav-link px-lg-4 rounded" href="#section2">Galería</a>
              <a class="nav-link px-lg-4 rounded" href="#section3">Preguntas Frecuentes</a>
              <a class="nav-link px-lg-4 rounded" href="#section4">Contáctanos</a>
              <a class="nav-link px-lg-4 rounded btn-login" href="/login">Iniciar Sesión</a>
            </div>
          </div>
        
       </div>
      </nav>
     <!-- navbar ends here -->

      <!-- main section starts here -->
      <section class="main py-5" id="main">
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-md-5 py-5 me-auto" data-aos="fade-right">
                    <h3 id="blacklinetext">RAY<br><small>Tattoo</small></h3>
                    <h6 class="pt-3">Tattoo & piercing</h6>
                   <a href="#section2"> <input type="button" value="Galería" class="bt1 mt-5 me-3" >  </a>
                   <a href="#section4"><input type="button" value="Contáctanos" class="bt2 mt-5 ">  </a> 
                </div>
                <div class="col-md-7 py-2 " data-aos="fade-left">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-interval="2000">
                        <div class="carousel-inner">
                          <div class="carousel-item  active">
                            <img src="images/dismekan1.jpg" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="images/dismekan2.jpg" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="images/dismekan3.jpg" class="d-block w-100" alt="...">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
            </div>
        </div>
      </section>
      <!-- main section ends here -->

  

      <!-- section for artists starts here -->
      <section id="section1" class="about py-5">
        <div class="container py-5">
            <div class="row">
                <h1 class="text-center py-5" data-aos="fade-down">Nuestros Artistas</h1>
                <div class="col-5 py-3 align-self-center ">

                    <img src="images/ozan.jpg" data-aos="fade-right" class="img-fluid rounded" alt="">
                </div>

                <div class="col-7 text-center align-self-center" data-aos="fade-left">
                    
                    <h5 class="text-center pt-4">Ozan</h5>
                    <p class="py-3 text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. <span class="font-weight-bold">Culpa et, ullam est voluptates </span> natus excepturi reiciendis, voluptate mollitia soluta fugit saepe nisi rerum rem ea, veniam reprehenderit aspernatur magnam modi.</p>    
                    <a  class="bi bi-instagram button"  href="https://www.instagram.com/ozansahinink/" target="_blank"> Instagram</a>

                
                        
                

                </div>
                
                
                <div class="col-7 text-center align-self-center" data-aos="fade-right">
                    
                    <h5 class="text-center pt-5">Betül</h5>
                    <p class="py-3 text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. <span class="font-weight-bold">Culpa et, ullam est voluptates </span> natus excepturi reiciendis, voluptate mollitia soluta fugit saepe nisi rerum rem ea, veniam reprehenderit aspernatur magnam modi.</p>
                    
                    
                    <a  class="bi bi-instagram button"  href="https://www.instagram.com/lutebec/" target="_blank"> Instagram</a>
                </div>
                <div class="col-5 py-4 align-self-center">

                    <img src="images/betul.jpg" data-aos="fade-left" class="img-fluid float-end rounded" alt="">
                </div>

                <div class="col-5 py-4 align-self-center">

                    <img src="images/ersin.jpg " data-aos="fade-right" class="img-fluid rounded" alt="">
                </div>

                <div class="col-7 text-center align-self-center" data-aos="fade-left">
                    

                    <h5 class="text-center pt-4">Ersin</h5>
                    <p class="py-3 text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. <span class="font-weight-bold">Culpa et, ullam est voluptates </span> natus excepturi reiciendis, voluptate mollitia soluta fugit saepe nisi rerum rem ea, veniam reprehenderit aspernatur magnam modi.</p>
                        <a  class="bi bi-instagram button"  href="https://www.instagram.com/lutebec/" target="_blank"> Instagram</a>

                </div>
                
                <div class="col-7 text-center align-self-center" data-aos="fade-right">
                    
                    
                    <h5 class="text-center pt-4">Eylem</h5>
                    <p class="py-3 text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. <span class="font-weight-bold">Culpa et, ullam est voluptates </span> natus excepturi reiciendis, voluptate mollitia soluta fugit saepe nisi rerum rem ea, veniam reprehenderit aspernatur magnam modi.</p>                                    <a  class="bi bi-instagram button"  href="https://www.instagram.com/artofeylem/" target="_blank"> Instagram</a>
                    
                </div>
                <div class="col-5 py-4 align-self-center">

                    <img src="images/eylem.jpg" data-aos="fade-left" class="img-fluid float-end rounded" alt="">
                </div>

                
            </div>
        </div>
      </section>
      <!-- section for artists ends here -->

      <!-- section for services starts here -->
      <section class="services py-5 ">
        <div class="container py-5 ">
            <h1 class="text-center pb-5" data-aos="fade-down">Servicios</h1>
            <div class="row pb-3">
                <div class="col-lg-4 mb-3 ">
                    <div class="card text-center py-3" data-aos="fade-right">
                        <div class="card-body">
                            <div class="circle ">
                                <span><img src="images/tattoo.png" alt="" height="50px" width="50px"></span>
                            </div>
                            <h4 class="pb-2">TATTOO</h4>
                            <p>¡Ten estilo en Ray Tattoo! Nuestros artistas experimentados trabajarán contigo para crear una pieza única que refleje tu personalidad y estilo.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-3">
                    <div class="card text-center py-3" data-aos="fade-up">
                        <div class="card-body">
                            <div class="circle">
                                <span><img src="images/piercing.png" alt="" height="50px" width="50px"></span>
                            </div>
                            <h4 class="pb-2">PIERCING</h4>
                            <p>Nuestros artistas experimentados utilizan las últimas técnicas y equipos para asegurar que tu piercing se realice de forma segura y con el mínimo dolor.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-3">
                    <div class="card text-center py-3" data-aos="fade-left">
                        <div class="card-body">
                            <div class="circle">
                                <span><img src="images/coverup.png" alt="" height="50px" width="50px"></span>
                            </div>
                            <h4 class="pb-2">COVER UP</h4>
                            <p>¡Cubre tu pasado con Ray Tattoo! Nuestros artistas especializados en cover-up transforman tatuajes antiguos en nuevas y hermosas obras de arte. Si quieres cambiar tu tatuaje, creemos un nuevo look.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
      <!-- section for services ends here -->

      <!-- section for galery starts here -->
      <section id="section2" class="portfolio py-5">
            <div class="container text-center py-5">
                    <h1 class="text-center pb-5" data-aos="fade-down">Galería</h1>
                    <div class="control dropdown">
                        <ul id="categories">
                            <li class="button list-item"  data-category="hepsi">Todos</li>
                            <li class="button list-item"  data-category="ozan"> Ozan </li>
                            <li class="button list-item"  data-category="ersin">Betül</li>
                            <li class="button list-item"  data-category="betül">Ersin</li>
                            <li class="button list-item"  data-category="elif"> Eylem</li>
                            
                        </ul>
                    </div>
                    <div id="photos">
                        <div class="row pt-5">
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/1.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="false" data-category-elif="false" data-category-ozan="true" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/2.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="false" data-category-elif="false" data-category-ozan="true" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal2"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/3.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="false" data-category-elif="false" data-category-ozan="true" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal3"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/4.jpg" class="img-fluid" data-category-ersin="true" data-category-betül="false" data-category-elif="false" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal4"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/5.jpg" class="img-fluid" data-category-ersin="true" data-category-betül="false" data-category-elif="false" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal5"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/6.jpg" class="img-fluid" data-category-ersin="true" data-category-betül="false" data-category-elif="false" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal6"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/7.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="true" data-category-elif="false" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal7"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/8.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="true" data-category-elif="false" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal8"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/9.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="true" data-category-elif="false" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal9"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/10.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="false" data-category-elif="true" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal10"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/11.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="false" data-category-elif="true" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal11"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="images/12.jpg" class="img-fluid" data-category-ersin="false" data-category-betül="false" data-category-elif="true" data-category-ozan="false" data-category-hepsi="true" alt="">
                                    <span><i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#portfoliomodal12"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
      </section>
      <!-- section for galery ends here -->
<!-- image pop up starts -->
<section>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/1.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal2" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/2.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal3" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/3.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal4" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/4.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal5" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/5.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal6" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/6.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal7" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/7.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal8" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/8.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal9" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/9.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal10" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/10.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal11" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/11.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="portfolio-modal modal fade mt-5" id="portfoliomodal12" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/12.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </section>
      <!-- image popup ends -->

      <!-- faq starts here -->
<section id="section3" class="faq-section py-5">
    <h3 class="text-center mb-5">Preguntas Frecuentes</h3>
      <div class="container">
        <div class="row py-3">
            <div class="col-6">
                <div class="accordion" id="accordionExamples">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-one">Pregunta 1</button>
                        </h2>
                        <div id="accordion-one" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-two">Pregunta 2</button>
                        </h2>
                        <div id="accordion-two" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-three">Pregunta 3</button>
                        </h2>
                        <div id="accordion-three" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-four">Pregunta 4</button>
                        </h2>
                        <div id="accordion-four" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-five">Pregunta 5</button>
                        </h2>
                        <div id="accordion-five" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    
                  </div>
            </div>
            <div class="col-6">
                <div class="accordion" id="accordionExamples">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-six">Pregunta 6</button>
                        </h2>
                        <div id="accordion-six" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-seven">Pregunta 7</button>
                        </h2>
                        <div id="accordion-seven" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-eight">Pregunta 8</button>
                        </h2>
                        <div id="accordion-eight" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-nine">Pregunta 9</button>
                        </h2>
                        <div id="accordion-nine" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-ten">Pregunta 10</button>
                        </h2>
                        <div id="accordion-ten" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
            
            </div>
        </div>
      </div>
</section>


      <!-- faq ends here -->

      
      <!-- section for form , map and contact us starts here  -->
      <section id="section4">
      <div class="container">
    <div class="row pb-3">
      <!-- form starts here -->

      <div class="col-md-6" >
        <h3 class="text-center pb-5 py-3 mt-2" data-aos="fade-up">Contáctanos</h3> 
      <form  id="contactForm" action="https://formsubmit.co/gokay.yigit1998@gmail.com" method="post" >
          <!-- Name input -->
    <div class="mb-3">
        <label class="form-label" for="name">Nombre</label>
        <input class="form-control" id="name" type="text" name="name" placeholder="Nombre" required />
        </div>
  
        <!-- phone number input -->
     <div class="mb-3">
      <label for="phone" class="form-label">Ingrese su Número de Teléfono</label>
     <input class="form-control" type="tel" id="phone" name="tel"  placeholder="09-555-555-555" pattern="[0]{1}[0-9]{1}[0-9]{8}" required>
     
  
     </div>
      <!-- Email address input -->
      <div class="mb-3">
        <label class="form-label" for="emailAddress">Ingrese su Dirección de Email</label>
        <input class="form-control" id="emailAddress" type="email"  name="e-mail" placeholder="Dirección de Email" required data-sb-validations="email" />
        
      </div>
  
       <!-- subject input -->
      <div class="mb-3">
          <label class="form-label" for="konu">Asunto</label>
          <input class="form-control" id="konu" type="text" name="konu" placeholder="Asunto" required />
          
        </div>
  
  
      <!-- Message input -->
      <div class="mb-3">
        <label class="form-label" for="message">Mensaje</label>
        <textarea class="form-control" id="message" type="text"  name="mesaj" placeholder="Su Mensaje" maxlength="500" style="height: 10rem;" required></textarea>
          </div>
     <!-- disable catptcha after sending mail -->
      <input type="hidden" name="_captcha" value="false">
        <!-- button -->
      <button class="btn btn-form" type="submit">Enviar</button>
       
        
      </form>
      </div>
      <!-- form ends here -->

      <!-- map and contact us part -->
      <div class="col-md-6">
        <div class="container">
            <div class="py-3">
            <h3 class="text-center pb-5 mt-2" data-aos="fade-up">Información de Contacto</h3> 
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.817267982733!2d-78.48675878550506!3d-0.1807466999493457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d59a107ca3c5bd%3A0x2b2461b8be4c3c14!2sQuito%2C%20Ecuador!5e0!3m2!1ses!2sec!4v1641999600000!5m2!1ses!2sec" class="w-100" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
       <div class="py-3">
        <ul>
            <li>Contacto: +593 99 123 4567</li>
            <li>Nuestra Dirección: Av. Amazonas y Naciones Unidas, Quito - Ecuador</li>
          </ul>
     </div>
      </div>
      </div>
      </div>
      </div>
</section>
     <!-- section for form , map and contact us ends here  -->
     
    <!-- footer  starts here-->
   
    <footer>
        <p class="text-center mb-0">Derechos Reservados &copy; 2022 Por Ray Tattoo Todos los Derechos Reservados</p>
      </footer>
    <!-- footer ends here -->

    <!-- scripts starts here -->
    
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init({
        delay: 0,
        once: true,
        duration: 400,
        offset: -475,
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  

    <!-- scripts ends here -->
</body>
</html>