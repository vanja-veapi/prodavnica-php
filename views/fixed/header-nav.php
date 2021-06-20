<?php
    if(isset($_SESSION))
    {   
        @$korisnik = $_SESSION['korisnik']; //Stavio sam @ da ne izlazi greska
    }
?>
<header>
    <!-- header inner -->
    <div  class="head_top">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                <a href="index.php"><img src="assets/images/logo.png" alt="logo" /></a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                            <ul class="navbar-nav mr-auto d-flex align-items-center">
                                <?php
                                    if($conn)
                                    {
                                        $navs = vratiSve("navs");
                                        foreach($navs as $nav)
                                        {
                                            if($korisnik)
                                            {
                                                if($nav->naziv == "Register")
                                                {
                                                    echo "
                                                    <li class='nav-item sign_btn'>
                                                        <a href='models/logout.php'>Odjava</a>
                                                    </li>";
                                                }
                                                else if($nav->naziv == "Login")
                                                {
                                                    if($korisnik->naziv == "Korisnik")
                                                    {
                                                        echo "<li class='nav-item'>
                                                            <a class='nav-link' href='index.php?page=korisnik'>Profil</a>
                                                        </li>";
                                                    }
                                                    else
                                                    {
                                                        echo "<li class='nav-item'>
                                                            <a class='nav-link' href='index.php?page=admin'>Admin Panel</a>
                                                        </li><li class='nav-item'>
                                                        <a class='nav-link' href='index.php?page=korisnik'>Profil</a>
                                                    </li>";
                                                    }
                                                }
                                                else
                                                {
                                                    echo "
                                                    <li class='nav-item'>
                                                        <a class='nav-link' href='$nav->href'>$nav->naziv</a>
                                                    </li>";
                                                }
                                            }
                                            else
                                            {
                                                if($nav->naziv == "Register")
                                                {
                                                    echo "
                                                    <li class='nav-item sign_btn'>
                                                        <a href='$nav->href'>$nav->naziv</a>
                                                    </li>";
                                                }
                                                else
                                                {
                                                    echo "
                                                    <li class='nav-item'>
                                                        <a class='nav-link' href='$nav->href'>$nav->naziv</a>
                                                    </li>";
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <!-- <li class='nav-item'>
                                <a class='nav-link' href='index.html'> Home  </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#about">About</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact us</a>
                                </li>
                                <li class="nav-item sign_btn">
                                    <a href="#">Sign in</a>
                                </li> -->
                            </ul>
                        </div>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header inner -->
        <!-- end header -->
        <!-- banner -->
        <section class="banner_main">
            <div class="container-fluid">
                <div class="row d_flex">
                    <div class="col-md-5">
                    <div class="text-bg">
                        <h1>Computer and <br>laptop shop</h1>
                        <strong>Free Multipurpose Responsive</strong>
                        <span>Landing Page 2019</span>
                        <a href="dokumentacija.pdf">Dokumentacija</a>
                    </div>
                    </div>
                    <div class="col-md-7 padding_right1">
                    <div class="text-img">
                        <figure><img src="assets/images/top_img.png" alt="#"/></figure>
                        <h3>01</h3>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</header>