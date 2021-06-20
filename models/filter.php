<?php
    // header("Content-type: application/json");
    if(isset($_GET['kategorijaPhp']))
    {
        include "../config/connection.php";
        include "functions.php";

        if($conn)
        {
            try
            {
                $kategorija = $_GET['kategorijaPhp'];
                $sortType = $_GET['sortPhp'];
                if($sortType != "ASC" && $sortType != "DESC")
                {
                    $poruka = ["poruka" => "Pokusali ste da izmenite tip sortiranja"];
                    echo json_encode($poruka);

                    http_response_code(404);
                    die("Pokusali ste da izmenite tip sortiranja");
                }
                if($kategorija == "selected")
                {
                    // echo "true true true true true";
                    $filtriraniProizvodi = sortirajProizvod($sortType);
                }
                else
                {
                    // $filtriraniProizvodi = filtrirajProizvode($kategorija); Ovo radi
                    $filtriraniProizvodi = filterSortProizvod($sortType, $kategorija);
                }
                echo json_encode($filtriraniProizvodi);
                http_response_code(201);
            }
            catch(Excepction $ex)
            {
                http_response_code(501);
            }
        }
        else
        {
            http_response_code(404);
        }
    }
    else
    {
        http_response_code(404);
        die("Greska");
    }
?>