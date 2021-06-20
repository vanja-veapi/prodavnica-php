<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include "../config/connection.php";
        include "functions.php";

        try
        {
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $mail = $_POST['mail'];
            $lozinka = $_POST['lozinka'];
            $idPol = $_POST['pol'];
            $idUloga = $_POST['uloga'];

            $sifrovanaLozinka = md5($lozinka);

            $unosKorisnika = unosKorisnika($ime, $prezime, $mail, $sifrovanaLozinka, $idUloga, $idPol);
            if($unosKorisnika)
            {
                $odgovor = ["poruka" => "Uspesno ste se dodali korisnika u bazu", "kod" => true];
                echo json_encode($odgovor);
                http_response_code(201);
            }

        }
        catch(PDOExcepction $ex)
        {
            http_response_code(500);
        }
    }
    else
    {
        http_response_code(404);
    }
?>