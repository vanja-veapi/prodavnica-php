<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
 <div class="container">
    <div class="row">
        <div id="login" class="col-6 mx-auto py-5">
            <h1>Login</h1>
            <form action="" method="POST">
                <label for="">Email</label>
                <input type="text" id="mail" name="mail" class="form-control" placeholder="Email"/>

                <label for="" class="mt-3">Lozinka</label>
                <input type="password" id="lozinka" name="lozinka" class="form-control" placeholder="Lozinka"/>

                <input type="button" value="Uloguj se" id="btnLogin" name="btnLogin" class="btn btn-success mt-4"/>
            </form>
            <div id="odgovor"></div>
            <?php
                if(isset($_SESSION['korisnik']))
                {   

                    $korisnik = $_SESSION['korisnik'];
                    // var_dump($korisnik);
                    // var_dump($_SESSION['korisnik']);
                    if($korisnik->naziv == "Admin")
                    {
                        // header_remove();
                        // header("location:index.php?pages=admin-panel");
                        echo "<a href='index.php?page=admin'>Stranica za admina</a>";
                    }
                    if($korisnik->naziv == "Korisnik")
                    {
                        // header("Location:index.php?page=korisnik");
                        echo "<a href='index.php?page=korisnik'>Stranica za korisnika</a>";
                    }
                }
            ?>
        </div>
    </div>
</div>