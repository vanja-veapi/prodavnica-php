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
            $pol = $_POST['pol'];

            // var_dump($pol);
            
            $sifrovanaLozinka = md5($lozinka);
            // var_dump($ime, $prezime, $mail, $lozinka, $pol);

            $reFirstLastName = "/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/";
            $rePassword="/^(?=.[A-Za-z])(?=.\d)(?=.[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
            $reMail="/^[a-z][a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/";
            $rePassword = "/^[A-z]{4,20}[0-9]{1}/";

            $error_message = "";

            if(!preg_match($reFirstLastName, $ime))
            {
                $error_message.= "Polje ime nije u dobrom formatu<br/>";
            }
            if(!preg_match($reFirstLastName, $prezime))
            {
                $error_message.= "Polje prezime nije u dobrom formatu<br/>";
            }
            if(!preg_match($reMail, $mail))
            {
                $error_message.= "Polje email nije u dobrom formatu<br/>";
            }
            if(!preg_match($rePassword, $lozinka))
            {
                $error_message.= "Polje lozinka nije u dobrom formatu<br/>";
            }
            if($pol != "1" && $pol != "2")
            {
                $error_message.= "Ne mozete izmeniti pol!<br/>";
            }
            if($pol == "undefined")
            {
                $error_message.= "Polje pol je obavezno<br/>";
            }
            if(strlen($error_message) > 0) 
            {
                $odgovor = ["poruka" => $error_message, "kod" => false];
                echo json_encode($odgovor);
                // echo $error_message;
                die();
            }

            //Unos korisnika
            $unosKorisnika = unosKorisnika($ime, $prezime, $mail, $sifrovanaLozinka, 2, $pol);
            if($unosKorisnika)
            {
                $odgovor = ["poruka" => "Uspesno ste se registrovali", "kod" => true];
                echo json_encode($odgovor);
                http_response_code(201);

                header('Location:index.php?page=login.php');
                exit;
            }
        }
        catch(Excepction $ex)
        {
            http_response_code(500);
        }
    }
    else
    {
        http_response_code(404);
    }
?>