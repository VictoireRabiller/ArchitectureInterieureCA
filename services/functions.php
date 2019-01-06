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

function createContact($contact){

	$db=getDb();

	if (empty($contact['email'])) {
			throw new Exception("Email empty");
		}

	if (empty($contact['lastname'])) {
			throw new Exception("lastname empty");
	}


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
