<?php
    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        // session_start();
        @$korisnik = $_SESSION['korisnik'];
        if($korisnik)
        {

        
        // var_dump($korisnik);
            if($korisnik->naziv == "Admin")
            {//Pocetak
        ?>

        <!-- HTML KOD ADMIN PANEL -->
        <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Admin Panel</a>
            <ul class="navbar-nav mr-auto d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li> -->
                        <?php
                            $navs = vratiSve("navs");

                            foreach($navs as $nav)
                            {
                                if($nav->naziv == "Login")
                                {
                                    continue;
                                }
                                if($nav->naziv == "Register")
                                {
                                    echo "<li><hr class=dropdown-divider/></li><li><a class='dropdown-item' href='models/logout.php'>Odjava</a></li>";
                                }
                                else
                                {
                                    echo "<li><a class='dropdown-item' href='$nav->href'>$nav->naziv</a></li>";
                                }
                            }
                        ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body h5">Ukupno registrovanih članova</div>
                                    <div class="card-footer d-flex align-items-center justify-content-end">
                                        <?php
                                            if($conn)
                                            {
                                                $ukupanBrojKorisnika = ukupnoKorisnika();
                                                // echo $ukupanBrojKorisnika;
                                                
                                                echo "<p class='h3'>$ukupanBrojKorisnika->brojKorisnika</p>";
                                            }
                                        ?>
                                       <!-- <p class="h4">30</p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body h5">Ukupno poseta stranice<?php echo " ".date("d.m.y")?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-end">
                                        <?php
                                            require_once "models/posecenost.php";
                                            if($datum == date("d-m-Y"))
                                            {
                                                echo "<p class='h3'>$ukupnaPoseta</p>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 align-items-center">
                                <div class="col-xl-12">
                                    <div class="card bg-info text-white mb-4">
                                        <a href="models/word.php" class="text-white"><div class="card-body">Download Word - Podaci o autoru</div></a>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="card bg-success text-white mb-4">
                                        <a href="models/excel.php" class="text-white"><div class="card-body">Export excel - Podaci o korisnicima</div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Posećenost
                                    </div></button><!--Ceo card-header je klikabilan-->
                                    <div class="collapse" id="collapseExample">
                                        <div class="card-body">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Stranica</th>
                                                <th>Ukupno poseta stranice</th>
                                                <th>Dnevno poseta</th>
                                                <th>Poseta izražena u procentima</th>
                                            </tr>
                                            <?php
                                                echo "<tr><td>Index</td><td>$indexPosecenost</td><td>$dnevnaPosetaIndexStr</td><td>$indexProcenat %</td></tr>";
                                                echo "<tr><td>Shop</td><td>$shopPosecenost</td><td>$dnevnaPosetaShopStr</td><td>$shopProcenat %</td></tr>";
                                                echo "<tr><td>About</td><td>$aboutPosecenost</td><td>$dnevnaPosetaAboutStr</td><td>$aboutProcenat %</td></tr>";
                                                echo "<tr><td>Register</td><td>$registerPosecenost</td><td>$dnevnaPosetaRegisterStr</td><td>$registerProcenat %</td></tr>";
                                                echo "<tr><td>Login</td><td>$loginPosecenost</td><td>$dnevnaPosetaLoginStr</td><td>$loginProcenat %</td></tr>";
                                                echo "<tr><td>Contact</td><td>$contactPosecenost</td><td>$dnevnaPosetaContactStr</td><td>$contactProcenat %</td></tr>";
                                                echo "<tr><td>Korisnik</td><td>$korisnikPosecenost</td><td>$dnevnaPosetaKorisnikStr</td><td>$korisnikProcenat %</td></tr>";
                                                echo "<tr><td>Admin</td><td>$adminPosecenost</td><td>$dnevnaPosetaAdminStr</td><td>$adminProcenat %</td></tr>";
                                            ?>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#porudzbine" aria-expanded="false" aria-controls="porudzbine">
                                        <div class="card-header">
                                            <i class="fas fa-chart-area me-1"></i>
                                            Porudžbine
                                        </div>
                                    </button><!--Ceo card-header je klikabilan-->
                                    <div class="collapse" id="porudzbine">
                                        <div class="card-body">
<table class="table table-striped">
<tr>
    <th>Ime Prezime</th>
    <th>Naziv proizvoda</th>
    <th>Cena</th>
</tr>
<?php
    $prikaziKorpu = prikaziPorudzbine();
    if($prikaziKorpu)
    {
        foreach($prikaziKorpu as $korpa)
        {
            echo "<tr>
                <td>$korpa->ime $korpa->prezime</td>
                <td>$korpa->naziv</td>";
            if($korpa->ulogaNaziv == "Admin")
            {
                echo "<td>".($korpa->cena*0.5)."</td>";
            }
            else if($korpa->ulogaNaziv == "Korisnik")
            {
                echo "<td>".($korpa->cena)."</td>";
            }
            "</tr>";
        }
    }
?>
</table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#prikazKorisnika" aria-expanded="false" aria-controls="prikazKorisnika">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Prikaz korisnika
                                        </div> 
                                    </button>   
                                    <div class="collapse" id="prikazKorisnika">       
                                        <div class="card-body">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Ime</th>
                                                    <th scope="col">Prezime</th>
                                                    <th scope="col">Mail</th>
                                                    <th scope="col">Pol</th>
                                                    <th scope="col">Uloga</th>
                                                    <th scope="col">Obriši korisnika</th>
                                                </tr>
                                                <?php
                                                    $korisnici = prikazKorisnika();

                                                    foreach($korisnici as $korisnik)
                                                    {
                                                        echo "<tr>
                                                        <td>$korisnik->idKorisnik</td>
                                                        <td>$korisnik->ime</td>
                                                        <td>$korisnik->prezime</td>
                                                        <td>$korisnik->mail</td>
                                                        <td>$korisnik->polNaziv</td>
                                                        <td>$korisnik->ulogaNaziv</td>
                                                        <td><input type='button' class='btn btn-success btnDelete' name='$korisnik->idKorisnik' value='Obriši korisnika'/></td>
                                                        </tr>";
                                                        
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">                             
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Dodaj Korisnika
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <input type="text" name="ime" id="ime" class="form-control mb-3" placeholder="Ime korisnika..."/>
                                            <input type="text" name="prezime" id="prezime" class="form-control mb-3" placeholder="Prezme korisnika..."/>
                                            <input type="password" name="lozinka" id="lozinka" class="form-control mb-3" placeholder="Sifra korisnika..."/>
                                            <input type="text" name="mail" id="mail" class="form-control mb-3" placeholder="Mail korisnika..."/>
                                            <select name="pol" id="pol" class="custom-select mb-3">
                                                <option value="1">Muški</option>
                                                <option value="2">Ženski</option>
                                            </select>
                                            <select name="uloga" id="uloga" class="custom-select">
                                                <option value="1">Admin</option>
                                                <option value="2">Korisnik</option>
                                            </select>
                                            <input type="button" id="btnDodaj" value="Dodaj korisnika" class="btn btn-success mt-3 mb-3"/>
                                        </form>
                                        <div id="odgovor"></div>
                                    </div>
                                
                                </div>
                            </div>   

                            <div class="col-xl-12">                    
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Proizvodi
                                    </div>
                                    <div class="card-body">
                                        <div id="podaci-prodavnica" class="w-100 m-auto">
                                            <table class='table table-striped border'>
                                                <tr>           
                                                    <th class="col w-25">Naziv proizvoda</th>
                                                    <th class="col">Opis</th>
                                                    <th class="col">Cena</th>
                                                    <th class="col">Updateuj</th>
                                                </tr>
                                            <?php
                                                $proizvodi = vratiSve("proizvodi");
                                                foreach($proizvodi as $proizvod)
                                                {
                                                    echo "<tr><td clasx='w-25'><p>$proizvod->naziv</p></td>";
                                                            if($proizvod->opis == null)
                                                            {
                                                                echo "<td>Proizvod nema opis</td>";
                                                            }
                                                            else
                                                            {
                                                                echo "<td><p>$proizvod->opis</p></td>";
                                                            }
                                                            echo "<td><input type='text' value='$proizvod->cena'/></td>
                                                            <td><input type='button' class='btn btn-success btnUpdate' name='$proizvod->idProizvod' value='Update'/>
                                                        </tr>";
                                                }
                                            ?>
                                            </table>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>

                            <div class="col-xl-12">      
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Dodaj proizvod
                                    </div>
                                    <div class="card-body">
                                        <form action="models/dodajProizvod.php" method="POST" enctype="multipart/form-data" name="uploadform">
                                            <input type="text" name="naziv" id="naziv" class="form-control mb-3" placeholder="Naziv proizvoda">
                                            <input type="text" name="cena" id="cena" class="form-control mb-3" placeholder="Cena">
                                            <textarea name="opis" id="opis" cols="60" class="form-control" rows="4" placeholder="Opis"></textarea>
                                            <div class="row">
                                            <?php
                                                if($conn)
                                                {
                                                    $boje = vratiSve("boje");
                                                    echo "<div class='w-50'><table>";
                                                    foreach($boje as $boja)
                                                    {
                                                        echo "<tr><td><label class='ml-3 mr-1'>$boja->boja</label></td><td><input type='checkbox' id='$boja->idBoja' name='boja[]' class='boja mr-3' value='$boja->idBoja'></td></tr>";
                                                    }
                                                    echo "</table>";
                                                    echo "</div>";
                                                    echo "<br/>";
                                                    $kategorije = vratiSve("kategorije");
                                                    echo "<div class='w-50'><table>";
                                                    foreach($kategorije as $kategorija)
                                                    {
                                                        echo "<tr><td><label class='mr-1'>$kategorija->naziv</label></td><td><input type='checkbox' id='$kategorija->idKategorije' name='$kategorija->naziv' class='kategorija mr-3' value='$kategorija->idKategorije'/></td></tr>";
                                                    }
                                                    echo "</table>";
                                                    echo "</div>";
                                                    echo "<br/>";
                                                }
                                            ?>
                                            </div>
                                            <input type="file" id="slika" name="slika"/>
                                            <input type="submit" id="btnDodajProizvod1" value="Dodaj proizvod" class="btn btn-success mt-3 mb-3">
                                        </form>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>

        <!-- KRAJ ADMIN PANELA -->

        <?php
            }//Kraj if-a za naziv
        }
        else
        {
            die("<h3>Pokušali ste da pristupite, a niste admin. Srrrrram Vas bilo!</h3><br/>
            <video width='320' height='240' controls autoplay>
            <source src='assets/video/radule3.mp4' type='video/mp4'>
            <source src='assets/video/radule3.ogg' type='video/ogg'>
            <source src='../../assets/video/radule3.mp4' type='video/mp4'>
            <source src='../../assets/video/radule3.ogg' type='video/ogg'>
          Your browser does not support the video tag.
          </video>");
        }
    }
?>