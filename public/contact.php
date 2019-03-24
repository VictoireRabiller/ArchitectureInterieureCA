
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
    
  if ($valid) {


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