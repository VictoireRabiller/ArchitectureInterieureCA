
<?php
include 'bootstrap.php';

/* D'abord on fixe la valeur par défaut des messages d'erreur et des variables des inputs */
$erreurnom = $erreuremail = $erreurtel = $erreurmessageCA = $messageenvoi = $civility = $nom = $prenom =$tel = $email = $messageCA =  '';
/* Ensuite on vérifie si le formulaire a été soumis et on valide les valeurs récupérées */
if (!empty($_POST['submit'])) {
  if (
    (($_POST[‘test1’] != ‘hello’)

    || ($_POST[‘comment2’] != ‘hello’))

    || ($_POST[‘email2’] != ‘’) 

    ){
  
    // On récupère les données envoyées par le formulaire
    $civility = (isset($_POST['civility'])) ? Rec($_POST['civility'])     : '';
    $nom = (isset($_POST['lastname'])) ? Rec($_POST['lastname'])     : '';
    $prenom = (isset($_POST['firstname'])) ? Rec($_POST['firstname'])     : '';
    $tel = (isset($_POST['tel']))? Rec($_POST['tel'])     : '';
    $email = (isset($_POST['email'])) ? Rec($_POST['email'])   : '';
    $messageCA = (isset($_POST['messageCA'])) ? Rec($_POST['messageCA']) : '';
    
    
    $valid = true;
    $envoi = false;
    // test du nom    
    if (empty($nom)) {
      $valid = false;
      $erreurnom = '<br><span class="error">Vous n\'avez pas mis votre nom</span><br>';
    }

    if (empty($tel)) {
      $valid = false;
      $erreurtel = '<br><span class="error">Vous n\'avez pas noté votre numéro de téléphone</span><br>';
    }
    // Test format e-mail    
    if (!preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i", $email)) {
      $valid = false;    
      $erreuremail = '<br><span class="error">Email non valide</span><br>';
    }
    // Test message
    if (empty($messageCA)) {
          $valid = false;
          $erreurmessageCA = '<br><span class="error">Vous n\'avez pas mis votre message</span><br>';
      }
    


  // $mail = 'victoirecretal@hotmail.com';
  // if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)){

  //     $passage_ligne = "\r\n";

  // }else{

  //     $passage_ligne = "\n";

  // }


  //   /* Si tout est ok, on envoie le courriel */
  if ($valid) {

  //   //=====Déclaration des messages au format texte et au format HTML.
  //   $message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
  //   $message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
  //   //==========
     
  //   //=====Création de la boundary
  //   $boundary = "-----=".md5(rand());
  //   //==========
     
  //   //=====Définition du sujet.
  //   $sujet = "Message de ton site web";
  //   //=========
     
  //   //=====Création du header de l'e-mail.
  //   $header = "From: \"Charlotte\"<victoirecretal@hotmail.com>".$passage_ligne;
  //   $header.= "Reply-to: \"Charlotte\" <victoirecretal@hotmail.com>".$passage_ligne;
  //   $header.= "MIME-Version: 1.0".$passage_ligne;
  //   $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
  //   //==========
     
  //   //=====Création du message.
  //   $message = $passage_ligne."--".$boundary.$passage_ligne;
  //   //=====Ajout du message au format texte.
  //   $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
  //   $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
  //   $message.= $passage_ligne.$message_txt.$passage_ligne;
  //   //==========
  //   $message.= $passage_ligne."--".$boundary.$passage_ligne;
  //   //=====Ajout du message au format HTML
  //   $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
  //   $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
  //   $message.= $passage_ligne.$message_html.$passage_ligne;
  //   //==========
  //   $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
  //   $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
  //   //==========
     
  //   //=====Envoi de l'e-mail.
  //   mail($mail,$sujet,$message,$header);
  //   //==========


    $messageenvoi =  'Votre message a bien été envoyé, merci !<br>';
    $messagenonenvoi =  'Désolé, une erreur est survenue lors de l\'envoi du message ! Veuillez essayer de nouveau.<br>';
   
    $contact['civility'] = $civility;
    $contact['lastname'] = $nom;
    $contact['firstname'] = $prenom;
    $contact['tel'] = $tel;
    $contact['email'] = $email;
    $contact['messageCA'] = $messageCA;
        // On va vérifier les variables et l'email ...
    $contact['email'] = (IsEmail($contact['email'])) ? $contact['email'] : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
    createContact($contact);  
    // pre($contact);
    // exit;
    }
  }
}
 
include "../views/contact.phtml";