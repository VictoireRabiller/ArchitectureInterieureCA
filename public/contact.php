
<?php
include 'bootstrap.php';

$messageenvoi =  '<p>Votre message a bien été envoyé, merci !</p>';
$messagenonenvoi =  '<p>Une erreur est survenue lors de l\'envoi du message ! Veuillez essayer de nouveau.</p>';

if (isset($_POST['submit'])) {


  if (($_POST["test1"] == "hello") && ($_POST["test2"] == " ") && ($_POST["email2"] == " ")){

    $civility = (isset($_POST['civility'])) ? Rec($_POST['civility'])     : '';
    $nom = (isset($_POST['lastname'])) ? Rec($_POST['lastname'])     : '';
    $prenom = (isset($_POST['firstname'])) ? Rec($_POST['firstname'])     : '';
    $tel = (isset($_POST['tel']))? Rec($_POST['tel'])     : '';
    $email = (isset($_POST['email'])) ? Rec($_POST['email'])   : '';
    $messageCA = (isset($_POST['messageCA'])) ? Rec($_POST['messageCA']) : '';
    
    $valid = true;
  
    if (empty($nom)) {
      $valid = false;
      $erreurnom = '<p><span class="error">Vous n\'avez pas inscrit votre nom</span></p>';
    }

    if (empty($tel)) {
      $valid = false;
      $erreurtel = '<p><span class="error">Vous n\'avez pas inscrit votre numéro de téléphone</span></p>';
    }
    // Test format e-mail    
    if (empty($email)) {
      $valid = false;
      $erreuremailempty = '<p><span class="error">Vous n\'avez pas inscrit votre email</span></p>';
    }
    if (!preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i", $email)) {
      $valid = false;    
      $erreuremail = '<p><span class="error">Email non valide</span></p>';
    }
    // Test message
    if (empty($messageCA)) {
      $valid = false;
      $erreurmessageCA = '<p><span class="error">Vous n\'avez pas inscrit votre message</span></p>';
    }
  
    if ($valid) {
    	
    	$to = "victoirecretal@hotmail.com";

    	$header = "MIME-Version: 1.0"."\r\n";
    	$header .= "Content-type: text/html; charset=utf-8"."\r\n";
    	$header .= "To : vic < ".$to.">"."\r\n";
    	$header .= "From : ". $prenom.$nom." <".$email.">"."\r\n";


    	$subject = "site Charlotte";
    	$message = "<html>
	        			<head>
	    					<title>Contact</title>
	    				</head>
	    				<body>
	    					<p>".$civility." ".$prenom." ".$nom."; tel : ".$tel."; email :".$email."; message : ".$messageCA."</p>
	    				</body>
    				</html>";
    	

		mail($to, $subject, $message, $header);

  
      
     
		$contact['civility'] = $civility;
		$contact['lastname'] = $nom;
     	$contact['firstname'] = $prenom;
      	$contact['tel'] = $tel;
		$contact['email'] = (IsEmail($contact['email'])) ? $contact['email'] : '';       
		$contact['messageCA'] = $messageCA;
	    createContact($contact);  
      // pre($contact);
      // exit;
        
    }

}  

}

  
include "../views/contact.phtml";