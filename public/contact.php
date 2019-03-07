
<?php
include 'bootstrap.php';

/* D'abord on fixe la valeur par défaut des messages d'erreur et des variables des inputs */
$erreurnom = $erreuremail = $erreurmessage = $messageenvoi = $civility = $nom = $prenom =$tel = $email = $message =  '';
/* Ensuite on vérifie si le formulaire a été soumis et on valide les valeurs récupérées */
if (!empty($_POST['submit'])) {
  
  // On récupère les données envoyées par le formulaire
  $civility = (isset($_POST['civility'])) ? Rec($_POST['civility'])     : '';
  $nom = (isset($_POST['lastname'])) ? Rec($_POST['lastname'])     : '';
  $prenom = (isset($_POST['firstname'])) ? Rec($_POST['firstname'])     : '';
  $tel = (isset($_POST['tel']))? Rec($_POST['tel'])     : '';
  $email = (isset($_POST['email'])) ? Rec($_POST['email'])   : '';
  $message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';
  
  
  $valid = true;
  $envoi = false;
  // test du nom    
  if (empty($nom)) {
    $valid = false;
    $erreurnom = '<br><span class="error">Vous n\'avez pas mis votre nom</span><br>';
  }
  // Test format e-mail    
  if (!preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i", $email)) {
    $valid = false;    
    $erreuremail = '<br><span class="error">Email non valide</span><br>';
  }
  // Test message
  if (empty($message)) {
        $valid = false;
        $erreurmessage = '<br><span class="error">Vous n\'avez pas mis votre message</span><br>';
    }
  
 
  /* Si tout est ok, on envoie le courriel */
  if ($valid) {
    $to = "victoirecretal@hotmail.com";
    $sujet = "Demande de contact";
    $texte = "Nom : $nom\n
    Email : $email\n
    Message : $message";
    $headers = 'From: victoirecretal@hotmail.com' . "\r\n" .
     'Reply-To:$email ' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
    // Envoi du courriel - on vérifie si le mail est envoyé en mettant la fonction mail() dans un if pour voir si la valeur retournée est bien true (valeur envoyée par cette fonction si le mail a été envoyé)
  $mail = mail($to,$sujet,$texte,$headers) ;
  $messageenvoi =  'Votre message a bien été envoyé, merci !<br>';
  $messagenonenvoi =  'Désolé, une erreur est survenue lors de l\'envoi du message ! Veuillez essayer de nouveau.<br>';
 
  $contact['civility'] = $civility;
  $contact['lastname'] = $nom;
  $contact['firstname'] = $prenom;
  $contact['tel'] = $tel;
  $contact['email'] = $email;
  $contact['message'] = $message;
      // On va vérifier les variables et l'email ...
  $contact['email'] = (IsEmail($contact['email'])) ? $contact['email'] : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
  createContact($contact);  
  }
}
 
include "../views/contact.phtml";