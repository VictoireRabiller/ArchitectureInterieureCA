<?php
include 'bootstrap.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {

	$destinataire = 'victoirecretal@hotmail.com';
	 
	$copie = 'oui'; 
	 
	$message_envoye = "Votre message nous est bien parvenu !";
	$message_non_envoye = "L'envoi de la demande de contact a échoué, veuillez réessayer SVP.";
	 
	$message_erreur_formulaire = "Vous devez d'abord <a href=\"contact.php\">envoyer le formulaire</a>.";
	$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";
	 

// $contact = [];

// $contact['civility'] = $_POST['civility'];
// $contact['lastname'] = $_POST['lastname'];
// $contact['firstname'] = $_POST['firstname'];
// $contact['tel'] = $_POST['tel'];
// $contact['email'] = $_POST['email'];
// $contact['message'] = $_POST['message'];

// $headers = 'MIME-Version: 1.0'."\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
 



// if(isset($_POST["message"])){
// 	$positionArobase=strpos($_POST['email'],"@");
// 	if($positionArobase==false){
// 			echo"votre email est faux";
// 		}else{ $retour=mail('victoirecretal@hotmail.com', 'Envoi depuis site web CA', $contact, "From:".$_POST['email']);
// 			if($retour){
// 				echo "Votre message a bien été envoyé";
// 			}else echo "erreur";

// 		}

// @mail($destinataire, $sujet, $contenu, $headers); 
//   echo '<h2>Message envoyé!</h2>';

// }




// $option = isset($_POST['civility']) ? $_POST['civility'] : false;
//    if ($option) {
//       echo htmlentities($_POST['civility'], ENT_QUOTES, "UTF-8");
//    } else {
//      echo "civilité demandée";
//      exit; 
//    }
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
 





	// formulaire envoyé, on récupère tous les champs.
$contact['civility']     = (isset($_POST['civility']))     ? Rec($_POST['civility'])     : '';
$contact['lastname']     = (isset($_POST['lastname']))     ? Rec($_POST['lastname'])     : '';
$contact['firstname']     = (isset($_POST['firstname']))     ? Rec($_POST['firstname'])     : '';
$contact['tel']     = (isset($_POST['tel']))     ? Rec($_POST['tel'])     : '';
$contact['email']   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
$contact['message'] = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

	// On va vérifier les variables et l'email ...
	$contact['email'] = (IsEmail($contact['email'])) ? $contact['email'] : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
 
	if (($contact['lastname'] != '') && ($contact['email'] != '') && ($contact['message'] != ''))
	{
		// les 4 variables sont remplies, on génère puis envoie le mail
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From:'.$contact['lastname'].' <'.$contact['email'].'>' . "\r\n" .
				'Reply-To:'.$contact['email']. "\r\n" .
				'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
				'Content-Disposition: inline'. "\r\n" .
				'Content-Transfer-Encoding: 7bit'." \r\n" .
				'X-Mailer:PHP/'.phpversion();
 
		// envoyer une copie au visiteur ?
		if ($copie == 'oui')
		{
			$cible = $destinataire.';'.$contact['email'];
		}
		else
		{
			$cible = $destinataire;
		};
 
		// Remplacement de certains caractères spéciaux
		$caracteres_speciaux     = array('&#039;', '&#8217;', '&quot;', '<br>', '<br />', '&lt;', '&gt;', '&amp;', '…',   '&rsquo;', '&lsquo;');
		$caracteres_remplacement = array("'",      "'",        '"',      '',    '',       '<',    '>',    '&',     '...', '>>',      '<<'     );
 
		// $objet = html_entity_decode($objet);
		// $objet = str_replace($caracteres_speciaux, $caracteres_remplacement, $objet);
 
		$contact['message']= html_entity_decode($contact['message']);
		$contact['message'] = str_replace($caracteres_speciaux, $caracteres_remplacement, $contact['message']);
 
		// Envoi du mail
		$num_emails = 0;
		$tmp = explode(';', $cible);
		foreach($tmp as $email_destinataire)
		{
			if (mail($email_destinataire, $contact['message'], $headers))
				$num_emails++;
		}
 
		if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
		{
			echo '<p>'.$message_envoye.'</p>';
		}
		else
		{
			echo '<p>'.$message_non_envoye.'</p>';
		};
	}
	else
	{
		// une des 3 variables (ou plus) est vide ...
		echo '<p>'.$message_formulaire_invalide.' <a href="contact.html">Retour au formulaire</a></p>'."\n";
	};
}; // fin du if (!isset($_POST['envoi']))






createContact($contact);
pre($contact);
exit;

header('Location: contact.php');

