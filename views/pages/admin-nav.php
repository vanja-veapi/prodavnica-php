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
                            echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='$nav->href'>$nav->naziv</a>
                            </li>";
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
            