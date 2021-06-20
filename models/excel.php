<?php
    include "../config/connection.php";
    include "functions.php";

    if($conn)
    {
        @$korisnik = $_SESSION['korisnik'];
        if(@$korisnik->naziv == "Admin")
        {

            $filename = "Podaci o korisnicima - Excel";

            $prikazKorisnika = prikazKorisnika();
            header("Content-Type: application/xls; charset=UTF-8");    
            header("Content-Disposition: attachment; filename=$filename.xls");  
            header("Pragma: no-cache"); 
            header("Expires: 0");
            
            echo pack("CCC",0xef,0xbb,0xbf);

            echo "ID Korisnika\tIme\tPrezime\tMail\tUloga\tPol\n";
            foreach($prikazKorisnika as $korisnik)
            {
                echo "$korisnik->idKorisnik\t$korisnik->ime\t$korisnik->prezime\t$korisnik->mail\t$korisnik->ulogaNaziv\t$korisnik->polNaziv\n";
            }
        }
        else
        {
            die("<h3>Pokušali ste da skinete excel fajl, a niste Admin! Srrrrram Vas bilo!</h3><br/>
            <video width='320' height='240' controls autoplay>
            <source src='../assets/video/radule3.mp4' type='video/mp4'>
            <source src='../assets/video/radule3.ogg' type='video/ogg'>
          Your browser does not support the video tag.
          </video>");
        }
    }
    else
    {
        die("Nema konekcije s bazom");
    }
?>