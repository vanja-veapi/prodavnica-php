<?php
    if(isset($_GET['sort']))
    {
        include "../config/connection.php";
        include "functions.php";

        if($conn)
        {
            try
            {
                $sortType = $_GET['sort'];
                $kategorije = $_GET['kategorija'];
                // var_dump($sort, $kategorije);
                if($sortType != "ASC" && $sortType != "DESC")
                {
                    $poruka = ["poruka" => "Pokusali ste da izmenite tip sortiranja"];
                    echo json_encode($poruka);

                    http_response_code(404);
                    die("Pokusali ste da izmenite tip sortiranja");
                }
                if($kategorije == "selected")
                {
                    $sortProduct = sortirajProizvod($sortType);
                }
                else
                {
                    $sortProduct = filterSortProizvod($sortType, $kategorije);
                }
                // var_dump($sortProduct);

                echo json_encode($sortProduct);
                http_response_code(201);
            }
            catch(Excepction $ex)
            {
                http_response_code(500);
            }
        }
    }
    else
    {
        http_response_code(404);
    }
?>