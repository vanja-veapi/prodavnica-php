<?php
    // session_start(); 
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include "../config/connection.php";
        include "functions.php";

        try
        {
            $error_message = "";

            $email = $_POST['mail'];
            $lozinka = $_POST['lozinka'];
            
            $sifrovanaLozinka = md5($lozinka);

            
            if(empty($email))
            {
                $error_message .= "Polje email je prazno<br/>";
            }
            if(empty($lozinka))
            {
                $error_message .= "Polje lozinka je prazno!<br/>";
            }

            if(strlen($error_message) > 0) 
            {
                $poruka = ["poruka" => $error_message, "kod" => false];
                echo json_encode($poruka);
                // echo $error_message;
                die();
            }
            $korisnikObj = proveraLogovanja($email, $sifrovanaLozinka);
            if($korisnikObj)
            {
                // var_dump($korisnikObj);
                $_SESSION['korisnik'] = $korisnikObj;
                $_SESSION['korisnik_ime'] = $korisnikObj->ime;
                $_SESSION['uloga'] = $korisnikObj->idUloga;
                

                $poruka = ["poruka" => "Uspesno ste se loginovali $korisnikObj->ime", "uloga" => "$korisnikObj->idUloga", "kod" => true];
                echo json_encode($poruka);
                http_response_code(200);
            }
            else
            {
                $odgovor = ["poruka" => "Niste ispravno napisali mail ili sifru", "kod" => false];
                echo json_encode($odgovor);
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