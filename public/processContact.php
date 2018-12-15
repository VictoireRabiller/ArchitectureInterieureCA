<?php
include 'bootstrap.php';


$contact = [];

$contact['civility'] = $_POST['civility'];
$contact['lastname'] = $_POST['lastname'];
$contact['firstname'] = $_POST['firstname'];
$contact['tel'] = $_POST['tel'];
$contact['email'] = $_POST['email'];
$contact['message'] = $_POST['message'];


if(isset($_POST["message"])){
	$positionArobase=strpos($_POST['email'],"@");
	if($positionArobase==false){
			echo"votre email est faux";
		}else{ $retour=mail('victoirecretal@hotmail.com', 'Envoi depuis site web CA', $contact, "From:".$_POST['email']);
			if($retour){
				echo "Votre message a bien été envoyé";
			}else echo "erreur";

		}
}

// $option = isset($_POST['civility']) ? $_POST['civility'] : false;
//    if ($option) {
//       echo htmlentities($_POST['civility'], ENT_QUOTES, "UTF-8");
//    } else {
//      echo "civilité demandée";
//      exit; 
//    }

createContact($contact);

// pre($contact);
// exit;

header('Location: contact.php');

