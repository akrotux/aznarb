<?php


if(empty($_POST['name']) ||
empty($_POST['email']) ||
empty($_POST['object']) ||
empty($_POST['message'])	||
!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
echo "No arguments Provided!";
return false;
}

$name = $_POST['name'];
$mail = $_POST['email'];
$object=$_POST['object'];
$message_body = $_POST['message'];



if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.

{

    $passage_ligne = "\r\n";

}

else

{

    $passage_ligne = "\n";

}

//=====Déclaration des messages au format texte et au format HTML.

$message_html = "<html><head></head><body>".$message_body."</body></html>";

//==========

 

//=====Création de la boundary

$boundary = "-----=".md5(rand());

//==========

 

//=====Définition du sujet.

$sujet = $object;

//=========

 

//=====Création du header de l'e-mail.


$header = "From:".$name."<".$mail.">".$passage_ligne;

$header.= "Reply-to:".$name."<".$mail.">".$passage_ligne;


$header.= "MIME-Version: 1.0".$passage_ligne;

$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

//==========

 

//=====Création du message.

$message = $passage_ligne."--".$boundary.$passage_ligne;


//=====Ajout du message au format HTML

$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message.= $passage_ligne.$message_html.$passage_ligne;

//==========

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;


//==========

 

//=====Envoi de l'e-mail.

mail("Your Email here ",$sujet,$message,$header); // <-- Change here

//==========



return true;	
