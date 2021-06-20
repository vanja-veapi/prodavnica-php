<?php

    $logovi = file("data/log.txt");
    $countLog = count($logovi);
    $ukupnaPoseta = 0;

    //============[Ukupna posecenost]==================//
    $korisnikPosecenost = 0; //1
    $adminPosecenost = 0; //2
    $registerPosecenost = 0; //3
    $loginPosecenost = 0; //4
    $shopPosecenost = 0; //5
    $indexPosecenost = 0; //6
    $contactPosecenost = 0; //7
    $aboutPosecenost = 0; //8
    //============[Ukupna posecenost KRAJ]=============//

   

    //============[Dnevna posecenost]==================//
    $dnevnaPosetaKorisnikStr = 0; //1
    $dnevnaPosetaAdminStr = 0; //2
    $dnevnaPosetaRegisterStr = 0; //3
    $dnevnaPosetaLoginStr = 0; //4
    $dnevnaPosetaShopStr = 0; //5
    $dnevnaPosetaIndexStr = 0; //6
    $dnevnaPosetaContactStr = 0; //7
    $dnevnaPosetaAboutStr = 0; //8
    //============[Ukupna posecenost KRAJ]=============//

    for($i = 0; $i < $countLog; $i++)
    {
        $pocepan = explode("\t", $logovi[$i]);
        $stranica = $pocepan[3];

        $datumIvreme = $pocepan[5];
        $datumIvremePocepano = explode(" ", $datumIvreme);
        $datum = $datumIvremePocepano[0];

        if($datum == date("d-m-Y"))
        {
            $ukupnaPoseta++;
        }
        if($stranica == "index")
        {
            $indexPosecenost++;
            if($datum == date("d-m-Y")){
                $dnevnaPosetaIndexStr++;
            }
        }
        else if($stranica == "admin")
        {
            $adminPosecenost++;
            if($datum == date("d-m-Y")){
                $dnevnaPosetaAdminStr++;
            }    
        }
        else if($stranica == "korisnik")
        {
            $korisnikPosecenost++;
            if($datum == date("d-m-Y")){
                $dnevnaPosetaKorisnikStr++;
            }
        }
        else if($stranica == "login")
        {
            $loginPosecenost++;
            if($datum == date("d-m-Y")){
                $dnevnaPosetaLoginStr++;
            }
        }
        else if($stranica == "shop")
        {
            $shopPosecenost++;
            if($datum == date("d-m-Y")){
                $dnevnaPosetaShopStr++;
            }
        }
        else if($stranica == "contact")
        {
            $contactPosecenost++;
            if($datum == date("d-m-Y")){
                $dnevnaPosetaContactStr++;
            }
        }
        else if($stranica == "about")
        {
            $aboutPosecenost++;
            if($datum == date("d-m-Y")){
                $dnevnaPosetaAboutStr++;
            }
        }
        else if($stranica == "register")
        {
            $registerPosecenost++;
            if($datum == date("d-m-Y")){
                $dnevnaPosetaRegisterStr++;
            }
        }
        $indexProcenat = round($indexPosecenost / $countLog * 100, 2);
        $shopProcenat = round($shopPosecenost / $countLog * 100, 2);
        $aboutProcenat = round($aboutPosecenost / $countLog * 100, 2);
        $registerProcenat = round($registerPosecenost / $countLog * 100, 2);
        $loginProcenat = round($loginPosecenost / $countLog * 100, 2);
        $contactProcenat = round($contactPosecenost / $countLog * 100, 2);
        $korisnikProcenat = round($korisnikPosecenost / $countLog * 100, 2);
        $adminProcenat = round($adminPosecenost / $countLog * 100, 2);

        // echo "<br/>$datum<br/>";
        // // var_dump($pocepan);
        // echo "<p>Uloga:".strtoupper($pocepan[2])." $pocepan[0] Stranica:$stranica $pocepan[4]</p>";
    }
?>