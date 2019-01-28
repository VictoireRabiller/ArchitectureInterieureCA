<?php

function getDb (){
	$user = 'root';
	$password = 'antony';
	$db =new PDO(
		'mysql:host=localhost;dbname=CA', 
		$user, 
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
		);
	$db->exec('SET NAMES UTF8');
	return $db;
}



function Rec($text){
		$text = htmlspecialchars(trim($text), ENT_QUOTES);
		if (1 === get_magic_quotes_gpc())
		{
			$text = stripslashes($text);
		}
 
		$text = nl2br($text);
		return $text;
};

function IsEmail($email){
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}
 

function createContact($contact){

	$db=getDb();
	

	$sql = "
			INSERT INTO contact
			(id, civility, lastname, firstname,  tel, email, message)
			VALUES (NULL, :civility, :lastname, :firstname, :tel, :email, :message)
			";
	
	

	$statement = $db->prepare($sql);

	$statement->execute($contact);
}


function getReaListPro(){
	$db=getDb();
	$sql = "SELECT * FROM realisationsPro";
	$statement = $db->prepare($sql);
	$statement->execute();
	$reaListPro = $statement->fetchAll(\PDO::FETCH_ASSOC);

	return $reaListPro;
}

function getOneReaPro($id){
	$db=getDb();

	$sql = "SELECT * FROM `realisationsPro` WHERE id = '$id' ";
	$statement = $db->prepare($sql);
	$statement->execute();
	$realisationPro = $statement->fetch(\PDO::FETCH_ASSOC);

	return $realisationPro;
}

function getReaListPart(){
	$db=getDb();
	$sql = "SELECT * FROM realisationsPart";
	$statement = $db->prepare($sql);
	$statement->execute();
	$reaListPart = $statement->fetchAll(\PDO::FETCH_ASSOC);

	return $reaListPart;
}

function getOneReaPart($id){
	$db=getDb();

	$sql = "SELECT * FROM `realisationsPart` WHERE id = '$id' ";
	$statement = $db->prepare($sql);
	$statement->execute();
	$realisationPart = $statement->fetch(\PDO::FETCH_ASSOC);

	return $realisationPart;
}


