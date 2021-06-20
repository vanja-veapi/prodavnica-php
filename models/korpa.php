<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include "../config/connection.php";
        include "functions.php";
        if($conn)
        {
            if(isset($_POST['idProizvod']))
            {
                $idProizvod = $_POST['idProizvod'];
                // $idUser = $_POST['idKorisnikPHP'];

                @$korisnik = $_SESSION['korisnik'];
                $idKorisnik = $korisnik->idKorisnik;

                $izvrseno = 0;
                $kolicina =  1;
                $poslato = "Ne";

                $resenje = executeQuery("SELECT * FROM korpa WHERE idKorisnik = $idKorisnik AND izvrseno = 0");
                if(empty($resenje))
                {
                    $upit = $conn->prepare("INSERT INTO korpa (idKorisnik, izvrseno) VALUES(?,?)");
                    $upit->execute([$idKorisnik, $izvrseno]);
                    $idKorpa = $conn->lastInsertId();
                }
                else
                {
                    foreach($resenje as $r)
                    {
                        $idKorpa = $r->idKorpa;
                    }
                }
                
                try
                {
                    $resenja2 = executeQuery("SELECT * FROM narudzbina WHERE idKorpa=$idKorpa AND idProizvod=$idProizvod");
                    $conn->beginTransaction();
                    // var_dump($resenja2);
                    if(count($resenja2) == 0)
                    {
                        $upit2 = $conn->prepare("INSERT INTO narudzbina (idKorpa, idProizvod, kolicina, poslato) VALUES(?,?,?,?)");
                        $upit2->execute([$idKorpa, $idProizvod, $kolicina, $poslato]);

                        $key = 1;
                    }
                    else
                    {
                        $key = 2;
                        $upit3 = executeQuery("SELECT kolicina FROM narudzbina WHERE idKorpa = $idKorpa AND idProizvod = $idProizvod");
                        
                        foreach($upit3 as $u3)
                        {
                            $kolicinaIzKorpe = $u3->kolicina;
                        }
                        $kolicina += (int)$kolicinaIzKorpe;

                        $upit2 = $conn->prepare("UPDATE narudzbina SET kolicina=?, poslato=? WHERE idKorpa=$idKorpa AND idProizvod=$idProizvod");
                        $upit2->execute([$kolicina, $poslato]);
                    }
                    $conn->commit();
                    $odgovor = ["poruka" => "$korisnik->ime, uspešno ste stavili proizvod u korpu. Korpa se nalazi u sekciji PROFIL.", "key" => $key];
                    echo json_encode($odgovor);
                    http_response_code(201);
                }
                catch(Excepction $ex)
                {
                    http_response_code(500);
                }
            }
            else
            {
                $odgovor = ["poruka" => "Morate biti ulogovani da biste stavili proizvod u korpu."]; 
                echo json_encode($odgovor);
                http_response_code(404);
                die();
            }
        }
        else
        {
            http_response_code(404);
        }
    }
?>