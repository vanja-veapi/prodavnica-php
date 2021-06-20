<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include "../config/connection.php";

        $korisnik = $_SESSION['korisnik'];
        $idKorisnik = $_POST['idKorisnik'];
        $idKorpa = $_POST['idKorpa'];

        $izvrseno = 1;
        // var_dump($idKorisnik);

        if($korisnik->idKorisnik == $idKorisnik)
        {
            try
            {
                $upit=$conn->prepare("UPDATE korpa set  izvrseno=?, idKorisnik=? WHERE idKorpa=?");
                $upit->execute([$izvrseno,$idKorisnik,$idKorpa]);

                header("Content-type: application/json");

                $message = 'Uspesno ste narucili proizvod.';
                echo json_encode($message);
                http_response_code(200);
            }   
            catch(PDOExcepction $ex)
            {
                header("Content-type: application/json");

                $message = 'Vasa porudzbina nije poslata';
                echo json_encode($message);
                http_response_code(500);
            } 
        }
        else
        {
            die("Pokušali ste da izmenite id! sram Vas bilo");
        }
    }
    else
    {
        http_response_code(404);
    }
?>