<?php
include 'bootstrap.php';



// // Ma clé privée
//  $secret = "6LckIJQUAAAAAEnA_iZCwm6eX21MrCzz467BZuUm";
//  // Paramètre renvoyé par le recaptcha
//  $response = $_POST['g-recaptcha-response'];
//  // On récupère l'IP de l'utilisateur
//  $remoteip = $_SERVER['REMOTE_ADDR'];
  
//  $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
//      . $secret
//      . "&response=" . $response
//      . "&remoteip=" . $remoteip ;
  
//  $decode = json_decode(file_get_contents($api_url), true);
  
//  if ($decode['success'] == true) {
//    // C'est un humain
//  }
  
//  else {
//    // C'est un robot ou le code de vérification est incorrecte
//  }


$destinataire = 'victoirecretal@hotmail.com';
	 

$message_envoye = "Votre message nous est bien parvenu. Merci et à bientôt ! ";
$message_non_envoye = "L'envoi de la demande de contact a échoué, veuillez réessayer SVP.";
	 
$message_erreur_formulaire = "Vous devez d'abord <a href=\"contact.php\">envoyer le formulaire</a>.";
$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";


$contact['civility'] = (isset($_POST['civility'])) ? Rec($_POST['civility'])     : '';
$contact['lastname'] = (isset($_POST['lastname'])) ? Rec($_POST['lastname'])     : '';
$contact['firstname'] = (isset($_POST['firstname'])) ? Rec($_POST['firstname'])     : '';
$contact['tel'] = (isset($_POST['tel']))? Rec($_POST['tel'])     : '';
$contact['email'] = (isset($_POST['email'])) ? Rec($_POST['email'])   : '';
$contact['message'] = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

$contact['email'] = (IsEmail($contact['email'])) ? $contact['email'] : ''; 

 $addition = (isset($_POST['addition'])) ? Rec($_POST['addition']) : '';

	 
createContact($contact);
// pre($contact);
// exit;


$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin
	



if (isset($_POST['Envoyer'])){
	if (($contact['lastname'] != '') && ($contact['email'] != '') && ($contact['message'] != '')){
		// les 4 variables sont remplies, on génère puis envoie le mail
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From:'.$contact['lastname'].' <'.$contact['email'].'>' . "\r\n" .
				'Reply-To:'.$contact['email']. "\r\n" .
				'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
				'Content-Disposition: inline'. "\r\n" .
				'Content-Transfer-Encoding: 7bit'." \r\n" .
				'X-Mailer:PHP/'.phpversion();

		

		
	 
		// Remplacement de certains caractères spéciaux
		$caracteres_speciaux     = array('&#039;', '&#8217;', '&quot;', '<br>', '<br />', '&lt;', '&gt;', '&amp;', '…',   '&rsquo;', '&lsquo;');
		$caracteres_remplacement = array("'",      "'",        '"',      '',    '',       '<',    '>',    '&',     '...', '>>',      '<<'     );
 
		// $objet = html_entity_decode($objet);
		// $objet = str_replace($caracteres_speciaux, $caracteres_remplacement, $objet);
 
		$contact['message']= html_entity_decode($contact['message']);
		$contact['message'] = str_replace($caracteres_speciaux, $caracteres_remplacement, $contact['message']);
 
		// Envoi du mail
		$num_emails = 0;
		$tmp = explode(';', $destinataire);
		foreach($tmp as $destinataire)
		{
			if (mail($destinataire, $contact['message'], $headers))
				$num_emails++;
		}
 
	
	}
	else
	{
		// une des 3 variables (ou plus) est vide ...
		echo '<p>'.$message_formulaire_invalide.' <a href="contact.php">Retour au formulaire</a></p>'."\n";
	};
}; 



header('Location: contact.php');


