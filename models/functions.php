<?php
    function vratiSve($tabela)
    {
        global $conn;
        $upit = "SELECT * FROM $tabela";
        $result = $conn->query($upit)->fetchAll();
        return $result;
    }
    function prikaziSveProizvode()
    {
        global $conn;
        $upit = "SELECT p.*, pb.*, s.*, b.*
        FROM proizvodi AS p 
        INNER JOIN proizvodi_boje AS `pb` ON pb.idProizvod = p.idProizvod 
        INNER JOIN slike AS s ON p.idSlika = s.idSlika
        INNER JOIN boje AS b ON pb.idBoja = b.idBoja";
        $result = $conn->query($upit)->fetchAll();
        return $result;
    }
    function ispisiSveProizvode($products)
    {
        foreach($products as $proizvod)
        {
            if($proizvod->opis == null)
            {
                echo "<div class='col-lg-4 border shadow rounded pt-3 pb-3 '>
                <div class='img border shadow mb-3 d-flex justify-content-center'>
                    <img src='assets/images/shop/$proizvod->src' alt='$proizvod->alt' class='img-fluid'/>
                </div>
                <p class='mb-2'><b class='h6'>Naziv</b>: $proizvod->naziv</p>
                <p class='mb-2'><b class='h6'>Cena</b>: $proizvod->cena &euro;</p>
                <p class='mb-2'><b class='h6'>Boja</b>: $proizvod->boja</p>
                <p class='mb-4 mt-4'>Proizvod nema opis</p>
                <input id='$proizvod->idProizvod' type='button' value='Add to cart' class='btn btn_cart btnCart'/></div>";
            }
            else
            {
                echo "<div class='col-lg-4 border shadow rounded pt-3 pb-3 '>
                <div class='img border shadow mb-3 d-flex justify-content-center'>
                    <img src='assets/images/shop/$proizvod->src' alt='$proizvod->alt' class='img-fluid'/>
                </div>
                <p class='mb-2'><b class='h6'>Naziv</b>: $proizvod->naziv</p>
                <p class='mb-2'><b class='h6'>Cena</b>: $proizvod->cena &euro;</p>
                <p class='mb-2'><b class='h6'>Boja</b>: $proizvod->boja</p>
                <p class='mb-4 mt-4'><b class='h6'>Opis</b>: $proizvod->opis</p>
                <input id='$proizvod->idProizvod' type='button' value='Add to cart' class='btn btn_cart btnCart'/></div>";
            }
        }
    }


    /**
     * Funkcija kojom prosledjujem idKategorije koji se nalazi u selectu
     * 
     */
    function filtrirajProizvode($idKategorije)
    {
        global $conn;
        $upit = "SELECT k.*, kp.*, p.*, s.*, b.* FROM 
        kategorije AS k INNER JOIN kategorije_proizvodi AS kp ON kp.idKategorije = k.idKategorije
        INNER JOIN proizvodi AS p ON kp.idProizvod = p.idProizvod
        INNER JOIN slike AS s ON s.idSlika = p.idSlika
        INNER JOIN proizvodi_boje AS pb ON pb.idProizvod = p.idProizvod
        INNER JOIN boje AS b ON pb.idBoja = b.idBoja
        WHERE k.idKategorije = $idKategorije";

        // $priprema = $conn->prepare($upit);
        // $priprema->bindParam(":idKategorije", $idKategorije);

        // $rezultat = $priprema->execute();
        
        $result = $conn->query($upit)->fetchAll();
        return $result;
    }

    function sortirajProizvod($vrstaSortiranja)
    {
        global $conn;
        $upit = "SELECT p.*, pb.*, s.*, b.*
        FROM proizvodi AS p 
        INNER JOIN proizvodi_boje AS `pb` ON pb.idProizvod = p.idProizvod 
        INNER JOIN slike AS s ON p.idSlika = s.idSlika
        INNER JOIN boje AS b ON pb.idBoja = b.idBoja
        ORDER BY p.cena $vrstaSortiranja";
        $result = $conn->query($upit)->fetchAll();
        return $result;
    }

    function pretragaProzivod($pretraga)
    {
        global $conn;

        $upit = "SELECT p.*, pb.*, s.*, b.*
        FROM proizvodi AS p 
        INNER JOIN proizvodi_boje AS `pb` ON pb.idProizvod = p.idProizvod 
        INNER JOIN slike AS s ON p.idSlika = s.idSlika
        INNER JOIN boje AS b ON pb.idBoja = b.idBoja
        WHERE p.naziv LIKE LOWER('%".$pretraga."%')";
        
        $proizvodi = $conn->query($upit)->fetchAll();
        return $proizvodi;
    }
    function pretragaSort($vrstaSortiranja, $pretraga)
    {
        global $conn;
        
        $upit = "SELECT k.*, kp.*, p.*, s.*, b.* FROM 
        kategorije AS k INNER JOIN kategorije_proizvodi AS kp ON kp.idKategorije = k.idKategorije
        INNER JOIN proizvodi AS p ON kp.idProizvod = p.idProizvod
        INNER JOIN slike AS s ON s.idSlika = p.idSlika
        INNER JOIN proizvodi_boje AS pb ON pb.idProizvod = p.idProizvod
        INNER JOIN boje AS b ON pb.idBoja = b.idBoja
        WHERE p.naziv LIKE LOWER('%".$pretraga."%')
        ORDER BY p.cena $vrstaSortiranja";
        
        // $priprema = $conn->prepare($upit);
        // $priprema->bindParam(":idKategorije", $idKategorije);

        // $rezultat = $priprema->execute();
        
        $result = $conn->query($upit)->fetchAll();
        return $result;
    }
    /**
     * Kada imam upareno filtriranje i sortiranje koristi se ova funkcija
     */
    function filterSortProizvod($vrstaSortiranja, $idKategorije, $pretraga = null)
    {
        global $conn;
        $upit = "SELECT k.*, kp.*, p.*, s.*, b.* FROM 
        kategorije AS k INNER JOIN kategorije_proizvodi AS kp ON kp.idKategorije = k.idKategorije
        INNER JOIN proizvodi AS p ON kp.idProizvod = p.idProizvod
        INNER JOIN slike AS s ON s.idSlika = p.idSlika
        INNER JOIN proizvodi_boje AS pb ON pb.idProizvod = p.idProizvod
        INNER JOIN boje AS b ON pb.idBoja = b.idBoja
        WHERE k.idKategorije = $idKategorije
        ORDER BY p.cena $vrstaSortiranja";
        
        // $priprema = $conn->prepare($upit);
        // $priprema->bindParam(":idKategorije", $idKategorije);

        // $rezultat = $priprema->execute();
        
        $result = $conn->query($upit)->fetchAll();
        return $result;
    }
    function unosProizvodaUKorpu($kolicina, $idKorisnik, $idProizvod)
    {
        global $conn;
    }
   
    function prikaziKorpu($idKorisnik)
    {
        global $conn;

        $upit = "SELECT k.*, p.*, s.*, n.kolicina FROM korpa k INNER JOIN narudzbina n ON n.idKorpa = k.idKorpa, 
        proizvodi p INNER JOIN slike s ON s.idSlika = p.idSlika 
        WHERE idKorisnik = :idKorisnik AND n.idProizvod = p.idProizvod AND k.izvrseno = 0";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idKorisnik", $idKorisnik);
        $priprema->execute();

        $rezultat = $priprema->fetchAll();
        return $rezultat;
    }
    function prikaziPorudzbine()
    {
        global $conn;

        $upit = "SELECT k.*, p.*, s.*, ko.ime, ko.prezime, u.naziv AS ulogaNaziv, n.kolicina FROM proizvodi p 
        INNER JOIN slike s ON p.idSlika = s.idSlika, korpa k INNER JOIN 
        korisnici ko ON k.idKorisnik = ko.idKorisnik 
        INNER JOIN narudzbina n ON n.idKorpa = k.idKorpa 
        INNER JOIN uloge u ON ko.idUloga = u.idUloga 
        WHERE n.idProizvod = p.idProizvod AND k.izvrseno = 1";

        $rezultat = $conn->query($upit)->fetchAll();
        return $rezultat;   
    }
    function unosKorisnika($ime, $prezime, $mail, $sifrovanaLozinka, $idUloga, $idPol)
    {
        global $conn;

        $upit = "INSERT INTO korisnici (ime, prezime, mail, lozinka, idUloga, idPol)
                 VALUES (:ime, :prezime, :mail, :lozinka, :idUloga, :idPol)";

        $priprema = $conn->prepare($upit);
        $priprema->bindParam(':ime', $ime);
        $priprema->bindParam(':prezime', $prezime);
        $priprema->bindParam(':mail', $mail);
        $priprema->bindParam(':lozinka', $sifrovanaLozinka);
        $priprema->bindParam(':idUloga', $idUloga);
        $priprema->bindParam(':idPol', $idPol);
        
        $rezultat = $priprema->execute();
        return $rezultat;
    }
    function proveraLogovanja($email, $sifrovanaLozinka)
    {
        global $conn;

        $upit = "SELECT * FROM korisnici k INNER JOIN uloge u ON k.idUloga = u.idUloga
        WHERE k.mail = :email AND k.lozinka = :lozinka";

        $priprema = $conn->prepare($upit);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':lozinka', $sifrovanaLozinka);
        $priprema->execute();

        $rezultat = $priprema->fetch();
        return $rezultat;
    }

    function ukupnoKorisnika()
    {
        global $conn;
        $upit = "SELECT COUNT(*) AS brojKorisnika FROM korisnici";

        $rezultat = $conn->query($upit)->fetch();
        return $rezultat;
    }

    function prikazKorisnika()
    {
        global $conn;

        $upit = "SELECT k.*, u.*, p.*, p.naziv AS polNaziv, u.naziv AS ulogaNaziv FROM korisnici k 
        INNER JOIN uloge u ON k.idUloga = u.idUloga
        INNER JOIN pol p ON k.idPol = p.idPol";

        $rezultat = $conn->query($upit)->fetchAll();
        return $rezultat;
    }
    function brisanjeKorisnika($nazivTabele, $kolona, $id)
    {
        global $conn;

        $upit = "DELETE FROM $nazivTabele WHERE $kolona = :id";

        $delete = $conn->prepare($upit);
        $delete->bindParam(":id", $id);
        $rezultat = $delete->execute();
        
        return $rezultat;
    }
?>