<?php

session_start();
logActionOrError("Upis u log fajl", false);
// $_SESSION["user"] = ["id" => 1, "username" => "Korisnik"];

require_once "config.php";
try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query){
    global $conn;
    return $conn->query($query)->fetchAll();
}

function logActionOrError($message, $error = false){
	
	if($error){
		$file = fopen(dirname(__DIR__, 1) . '/data/error.txt', "a+");
	} else {
		$file = fopen(dirname(__DIR__, 1) . '/data/log.txt', "a+");
	}
	
	if(isset($_GET['page']))
	{
		$stranica = $_GET["page"];
	}
	else
	{
		$stranica = "index";
	}
	// var_dump($korisnik->ime);
	$ip = $_SERVER['REMOTE_ADDR'];
	$datum = date('d-m-Y H:i:s');

	if(isset($_SESSION['korisnik']))
	{
		$korisnik = $_SESSION["korisnik"];
		if($korisnik->naziv == "Korisnik" && $stranica == "admin")
		{
			$upis = "$korisnik->ime\t$korisnik->prezime\t$korisnik->naziv\t$stranica\t$ip\t$datum\tNeautorizovan korisnik je pokušao da pristupi admin panelu\n";
		}
		else
		{
			$upis = "$korisnik->ime\t$korisnik->prezime\t$korisnik->naziv\t$stranica\t$ip\t$datum\t$message\n";
		}
	}
	else
	{
		$korisnik = "Gost";
		if(isset($_GET['page']))
		{
			if($_GET['page'] == "admin")
			{
				$upis = "$korisnik\t/\tGost\t$stranica\t$ip\t$datum\tNeautorizovan korisnik je pokušao da pristupi admin panelu\n";
			}
			else
			{
				$upis = "$korisnik\t/\tGost\t$stranica\t$ip\t$datum\t$message\n";
			}
		}
		else
		{
			$upis = "$korisnik\t/\tGost\t$stranica\t$ip\t$datum\t$message\n";
		}
	}
	
	
	fwrite($file, $upis);
	fclose($file);
}

