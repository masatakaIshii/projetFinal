<?php 
function sendMail($addrSource,$addrDest,$topic,$msg,$pseudoSender)
{
	$endLine = PHP_EOL; // evite les pb /r/n ou /n
	$boundary = "-----=".md5(rand()); //definit une separation entre les parties du mail

	$header = "From: \"$pseudoSender\"<$addrSource>".$endLine;//de qui part le msg
	$header.= "Reply-to: \"$pseudoSender\"<$addrSource>".$endLine;//à qui sera renvoyé le msg
	$header.= "MIME-Version: 1.0".$endLine; //se renseigner sur mime
	$header.= "Content-Type: multipart/mixed;".$endLine." boundary=\"$boundary\"".$endLine;
	//on sépare
	$message = $endLine."--".$boundary.$endLine;//ouverture boundary pour separer header du message
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$endLine;
	$message.= "Content-Transfer-Encoding: 8bit".$endLine;
	$message.= $endLine.$msg.$endLine;
	//on ferme la separation
	$message.= $endLine."--".$boundary."--".$endLine;//fermeture boundary
	//envoi
	mail($addrDest,$topic,$message,$header);
}
