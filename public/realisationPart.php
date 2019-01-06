<?php
include 'bootstrap.php';



$realisationPart = getOneReaPart( $_GET['id'] ); 
// pre($realisationPart);




include "../views/realisationPart.phtml";