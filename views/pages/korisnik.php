<?php
    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        // session_start();
        @$korisnik = $_SESSION['korisnik']; //Stavio sam @ ako izadje greska
        if($korisnik)
        {
            $idKorisnik = $korisnik->idKorisnik;
            // var_dump($korisnik);
    
            echo "<h1 class='ml-4'>Pozdrav $korisnik->ime, dobrodošli nazad.</h1>
            <input type='hidden' id='idKorisnik' value='$korisnik->idKorisnik'/>";
            $prikaziKorpu = prikaziKorpu($idKorisnik);
            // var_dump($prikaziKorpu);
            foreach($prikaziKorpu as $korpa1){}
            if($prikaziKorpu && $korpa1->izvrseno == 0)
            {
                echo "<h2 class='ml-4'>Korpa</h2>";
?>
<div class="container">
<table class='table table-striped text-center'>
                <tr>
                    <th>Slika</th>
                    <th>Naziv</th>
                    <th>Cena</th>
                    <th>Količina</th>
                    <th>Ukupna cena</th>
                </tr>
<?php
                foreach($prikaziKorpu as $korpa)
                {
                    if($korisnik->naziv == "Korisnik")
                    {
                        echo "<tr><td><img src='assets/images/shop/$korpa->src' alt='$korpa->alt' width='100'/></td>
                        <td>$korpa->naziv</td><td>$korpa->cena &euro;</td><td>$korpa->kolicina</td><td>".$korpa->cena*$korpa->kolicina." &euro;</td></tr>";
                    }
                    else
                    {
                        echo "<tr>
                        <td><img src='assets/images/shop/$korpa->src' alt='$korpa->alt' width='100'/></td>
                        <td>$korpa->naziv</td>
                        <td>$korpa->cena &euro;</td>
                        <td>$korpa->kolicina</td><td>".(($korpa->cena*$korpa->kolicina)*0.5)." &euro;</td></tr>";
                    }
                }
                echo "</table><input type='hidden' id='idKorpa' value='$korpa->idKorpa'/>";
                echo "<div class='d-flex justify-content-end'><button type='button' id='btnPorudzbina' class='btn btn-success mt-4 mb-4'>Pošalji porudžbinu</button></div></div>"; //Drugi div je kraj containera, prvi je kraj flex-a
            }
            else
            {
                echo "<p class='h3'>Vaša korpa je prazna!</p>";
            }
        }
        else
        {
            die("<h3>Pokušali ste da pristupite, a niste se log-inovali. Srrrrram Vas bilo!</h3><br/>
            <video width='320' height='240' controls autoplay>
            <source src='assets/video/radule3.mp4' type='video/mp4'>
            <source src='assets/video/radule3.ogg' type='video/ogg'>
          Your browser does not support the video tag.
          </video>");
        }
    }
    else
    {
        die("Greska");
    }
?>