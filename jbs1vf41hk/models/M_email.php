<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_email extends CI_Model {

    public function send_emailMaster($email, $password)
    {
        date_default_timezone_set('Etc/UTC'); 
        require_once('PHPmailer/PHPMailerAutoload.php');
 
        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        $mail->SMTPOptions = array (
            'ssl' => array (
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'mail.bankntbsyariah.co.id';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;


        //sekarang ini username nya ganti sama email mu 
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'no-reply@bankntbsyariah.co.id';

        //Password to use for SMTP authentication
        $mail->Password = 'bankNTB$2019';

        //ini buat email siapa yg kirim
        //Set who the message is to be sent from
        $mail->setFrom('no-reply@bankntbsyariah.co.id', 'PT. BANK NTB SYARIAH');

        //Set an alternative reply-to address
        // $mail->addReplyTo('nyamungsoan@gmail.com', 'First Last');

        //ini buat ke email mana mau dikirim
        //Set who the message is to be sent to
        $mail->addAddress($email, '');

        //Set the subject line
        $mail->Subject = 'INFORMASI RAHASIA PT. BANK NTB SYARIAH';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body  
        $mail->msgHTML(file_get_contents('PHPmailer/examples/contents.php'), dirname(__FILE__));

        //Replace the plain text body with one created manually
        $mail->AltBody = '';

        //generate pdf  
        $arr = explode("@", $email, 2);
        $emailTMP = $arr[0];  

        $this->generate_pdf($emailTMP, $email, $password); 

        //ini nanti taro file pdf mu disni
        //Attach an image file
        $mail->addAttachment('./assets/user/'.$emailTMP.'.pdf');

        //send the message, check for errors

         /*Get error on screen*/
        ob_start();
        $kirim_email = $mail->send();
        $error = ob_get_contents();
        ob_end_clean();

        return $kirim_email;
    }

    function generate_pdf($emailTMP, $email, $password)
    {
        $pdf = new FPDF('P','mm','A4'); //L = lanscape P= potrait
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        $ya = 44;
        // mencetak string 
        $pdf->Cell(190,7,'PT. BANK NTB SYARIAH',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'INFORMASI RAHASIA',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10); 

        $pdf->Cell(0,10,'Username : '.$email,0,1);
        $pdf->Cell(0,10,'Password : '.$password,0,1);
        $pdf->Cell(0,10,'Password SOP : 809521-ejkjakajo098420KH9ih889221#$#@',0,1);

        $pdf->Output("./assets/user/".$emailTMP.".pdf",'F');
    }

}