<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $slika = $_FILES['slika'];
        $boja = $_POST['boja'];
       

        var_dump($boja);
    }
?>