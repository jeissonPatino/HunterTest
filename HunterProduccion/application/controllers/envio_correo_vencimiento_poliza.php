<?php
	date_default_timezone_set('Etc/UTC');
	require 'PHPMailerAutoload.php';

	$dsn = "Driver={SQL Server};Server=ELECTRA;Database=DYALOGOPRB;Integrated Security=SSPI;Persist Security Info=False;";

	// Se realiza la conexón  con los datos correspondientes
	$connexion = odbc_connect( $dsn, 'DYALOGO', 'Abcd$1234');
	if (!$connexion)
	{
		exit( 'Error al establecer la conexion: ' . $connexion);
	}

    
	$LsqlAbogado = 	" SELECT * FROM vista_abogados_con_polizas_a_vencer";

	$rs = odbc_exec( $connexion, $LsqlAbogado );
	if ( !$rs )
	{
		exit( "Error en la consulta SQL" );
	}
	$enviados = 0;

	while ( odbc_fetch_row($rs) )
	{
		$abogado = odbc_result($rs, 'abogado');
		//echo $abogado."</br>";

		$Lsql = " SELECT * FROM vista_polizas_a_vencer WHERE abogado = ".$abogado;

		$Fallidos = odbc_exec( $connexion, $Lsql );
		if ( !$Fallidos )
		{
			exit( "Error en la consulta SQL" );
		}

		$usuarios = '';
		$i = 1;
		while ( odbc_fetch_row($Fallidos) )
		{
			
			$usuarios .= "<p>Deudor ".odbc_result($Fallidos, 'Deudor')." identificado con C.C. ". odbc_result($Fallidos, 'identificacion') ." titular de la obligación No. ". odbc_result($Fallidos, 'OBLIGACION').", Poliza No. ".odbc_result($Fallidos, 'NumeroPoliza').",  Fecha de vencimiento.  ".odbc_result($Fallidos, 'vencimiento')." .</p>";
			//echo $usuarios;
            $i++;
		}

		$abogadosCOrreo = "SELECT G723_C17099 as Nombre, G723_C17101 as correo ";
		$abogadosCOrreo .= "FROM G723 ";
		$abogadosCOrreo .= "WHERE G723_ConsInte__b = ".$abogado;

		$abo = odbc_exec( $connexion, $abogadosCOrreo );
		if ( !$abo )
		{
			exit( "Error en la consulta SQL" );
		}

		$nombre = '';
		$correo = NULL;
		while ( odbc_fetch_row($abo) )
		{
			$nombre = odbc_result($abo, 'Nombre');
			$correo = odbc_result($abo, 'correo');

			/*echo $nombre."</br>";
			echo $correo."</br>";*/
		}

		if(!is_null($correo)){
			$NewCorreo = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Alertas Hunter</title>
    </head>
    <body>
        <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 12px;text-align:justify;">
            <h4>Estimado(a) Dr.(a). '.$nombre.' </h4>
            
            <p> 
             El FNG le informa que la (s) póliza (s) de cumplimiento del proceso de él (los) cliente (s) que a continuación se relaciona (n) se vence (n) dentro del mes siguiente contado a partir de la fecha de envío del presente correo.
            </p>
            <p> 
             Recuerde que para el pago por parte del FNG de una factura por alguno de los conceptos de gestión judicial es requisito que esté vigente la póliza de cumplimiento.
            </p>
            <p style="text-align:center;"> 
                '.$usuarios.'
            </p>

            <p>
                Cordialmente,
            </p>
            </br>
            <p>
                Subdirección de Procesos Judiciales</br>
                <b>FONDO NACIONAL DE GARANTÍAS S.A - FNG</b></br>
                Calle 26 A No. 13-97 Piso 25</br>
                Bogotá D.C. - Colombia</br>
                www.fng.gov.co
            </p>
            </br>
            </br>
            <p  style="font-size:12px;text-align:justify;">
                MANEJO Y PROTECCIÓN DE DATOS PERSONALES - Este mensaje (incluyendo cualquier archivo adjunto) se dirige exclusivamente a su destinatario y contiene información personal confidencial y/o privilegiada que se encuentra protegida por la Ley. En consecuencia, la información aquí contenida sólo puede ser utilizada por la persona o compañía a la cual está dirigido. Si ha recibido este mensaje por error, por favor comuníquese inmediatamente con nosotros por esta misma vía y proceda a su eliminación. Recuerde que los datos personales aquí contenidos pertenecen a cada uno de sus Titulares y/o al Fondo Nacional de Garantías S.A. - FNG, y que su Tratamiento sólo se encuentra legitimado si se cuenta con autorización para un Responsable determinado y con unas finalidades previamente informadas a éste. En consecuencia queda prohibido su Tratamiento y cesión so pena de sanciones civiles, administrativas, e incluso penales. Finalmente, señalamos que es responsabilidad del destinatario protegerse de la existencia de posibles virus informáticos que pudiera llegar a tener el correo o cualquier anexo a él, razón por la cual el FNG no aceptará responsabilidad alguna por daños causados por cualquier virus transmitido en este correo.
            </p>
        </div>
    </body>
</html>';
  
            $Newmail = new PHPMailer;
            //Tell PHPMailer to use SMTP
            $Newmail->isSMTP();
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $Newmail->SMTPDebug = 0;
            //Newmail for HTML-friendly debug output
            $Newmail->Debugoutput = 'html';
            //Set the hostname of the mail server
            $Newmail->Host = "192.168.1.122";
            //Set the SMTP port number - likely to be 25, 465 or 587
            $Newmail->Port = 25;
            //Whether to use SMTP authentication
            $Newmail->SMTPAuth = false;
            //Username to use for SMTP authentication
            $Newmail->Username = "alertas.hunter@fng.gov.co";
            //Password to use for SMTP authentication
            $Newmail->Password = "abcd$1234";
            //Set who the message is to be sent from
            $Newmail->setFrom('alertas.hunter@fng.gov.co', 'Alertas Hunter');
            //Set an alternative reply-to address
           	// $Newmail->addReplyTo('angelica.agudelo@fng.gov.co', 'Angelica Agudelo');
            $Newmail->addReplyTo('josegiron@outlook.es', 'Jose Giron');
            //Set who the message is to be sent to
            $Newmail->addAddress($correo, $nombre);
            //Set the subject line
            

            $Newmail->Subject = 'ALERTAS HUNTER - VENCIMIENTO DE LA PÓLIZA';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $Newmail->msgHTML($NewCorreo);
            //Replace the plain text body with one created manually
            $Newmail->AltBody = '“Antes de imprimir este e-mail, evalúa si realmente es necesario hacerlo. ¡Cuidemos el ambiente!”';
            //Attach an image file
            //$mail->addAttachment('examples/images/phpmailer_mini.png');
            $Newmail->CharSet = 'UTF-8';
            //send the message, check for errors
            if (!$Newmail->send()) {
                echo "Mailer Error : " . $Newmail->ErrorInfo;
                
            }else{
            	$enviados++;
            }

        
		}

	}
	echo $enviados;
	odbc_close( $connexion );
?>
