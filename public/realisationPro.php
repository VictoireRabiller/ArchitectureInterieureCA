<?php
include 'bootstrap.php';



$realisationPro = getOneReaPro( $_GET['id'] ); 
// pre($realisationPro);




include "../views/realisationPro.phtml";