<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    //Se debe verificar que los archivos que se requieren a continuación se encuentren en las rutas indicadas
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    //Se instancia un objeto de la clase PHPMailer
    $mail = new PHPMailer(true);

try {

    //Recuperar los datos del formulario
    $f_name = $_POST['nombre'];
    $f_email = $_POST['email'];
    $f_message = $_POST['mensaje'];
    

    //Configuración del servidor
    $mail->SMTPDebug = 0;
    $mail->isSMTP();       //Se utiliza el protocolo SMTP
    $mail->Host       = 'smtp.gmail.com';  //Colocar aquí el servidor de correo a utilizar, en el ejemplo smtp de gmail
    $mail->SMTPAuth   = true;     //Se habilita la autenticación smtp
    $mail->Username   = 'phpmailer79@gmail.com'; //Colocar aquí una dirección de correo valida, debe pertenecer al servidor indicado arriba
    $mail->Password   = 'lucasjorge22'; //Colocar aquí la contraseña
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Habilita el cifrado TLS; se recomienda `PHPMailer::ENCRYPTION_SMTPS` 
    $mail->Port       = 587;                                    //Número del puerto utilizado

 
    $mail->setFrom('phpmailer79@gmail.com', 'Nombre_usuario'); //Desde donde se envía el mail, el nombre es opcional
    $mail->addAddress('juamj9592@gmail.com', 'Nombre_usuario');     //A quién se le envía el mail, el nombre es opcional
    //$mail->addAddress('ellen@example.com');  //información opcional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Las siguiente líneas se utilizan si se desea enviar archivos
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Agrega archivos adjuntos
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

    //Contenido
    $mail->isHTML(true);                     //Si se envía con formato HTML
    $mail->Subject = 'Contacto desde mi sitio web';
    $mail->Body    = 'De: '.$f_email."<br>".
                     'Nombre: '.$f_name."<br>".
                     'Mensaje: '.$f_message;
 

    $mail->send(); //Se envía el mail
    echo "Gracias por contactarnos, responderemos a la brevedad"; //Fin del try
    echo "<br><input type=\"button\" onclick=\"location.href='".(isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']."'\" value=\"Volver\"></button>";
} catch (Exception $e) {
    echo "Error, el mensaje no se envió: {$mail->ErrorInfo}"; //Si hay algún error
}

?>