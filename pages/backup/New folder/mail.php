<?php 
	if(isset($_POST['lamar']))
	{
		$namasiswa = $_POST['namonyo'];
		$emailnyo = $_POST['emailnyo'];
		$isi = $_POST['isinyo'];
	}
 ?>



<?php
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; 
$mail->SMTPAuth = true;
$mail->Username = "muhammadyusuf931@gmail.com";
$mail->Password = "malangke06";
$mail->setFrom($emailnyo, $namasiswa);
$mail->addAddress('yusuf.9149@students.amikom.ac.id', 'Uncup');
$mail->Subject = "LAMARAN";
$mail->msgHTML($isi);
if (!$mail->send()) {
    echo "Email gagal dikirim";
} else {
    echo "Email terkirim";
}
?>