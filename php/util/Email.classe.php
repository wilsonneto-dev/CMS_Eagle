<?php 

/*classe email*/

if( file_exists("../php/third_party/phpmailer/class.phpmailer.php") )
	require_once( "../php/third_party/phpmailer/class.phpmailer.php" );
else if(file_exists("php/third_party/phpmailer/class.phpmailer.php"))
	require_once("php/third_party/phpmailer/class.phpmailer.php");


class Email extends PHPMailer{
	
	public $emailPara;

	function __construct(){
		//echo $this->emailPara;
		$this->IsSMTP();
		$this->Host = "";
		$this->SMTPAuth = true;
		$this->Username = "";
		$this->Password = "";
		$this->IsHTML(true);
		$this->CharSet = 'utf-8';
		$this->From = "";  
		$this->FromName = ""; 
		// $this->AddAddress($this->emailPara);
		$this->Subject = "";
		$this->Body = "";
		// $this->AddReplyTo("","");
	}
	
	function limpa(){
		$this->ClearAllRecipients();
		$this->ClearAttachments();
	}
	
	static function enviaNota( $msg, $assunto = null, $to = null){
		$smtp = EmailConfig::_get();
		$info = Info::get();

		if($to == null)
			$to = $info->email;

		if($assunto == null)
			$assunto = "Aviso - \"".$info->dominio."\"";

		$e = new Email();

		$e->Subject = $assunto; 
		$e->Username = $smtp->email;  
		$e->Password = $smtp->senha;  
		$e->Host = $smtp->smtp;  
		$e->From = $smtp->email;  
		$e->FromName = $smtp->email;
		$e->AddAddress( "contato@wilsonneto.com.br" );
		$e->AddAddress( $to );
		$e->Body = nl2br('Ol&aacute;, aviso do sistema em <a href="http://'.$info->dominio.'">'.$info->dominio.'</a><br />
'.$msg
		);
		if ($e->Send())
			return true;
		else{
			echo ($e->ErrorInfo);
			return false;
		}
	}

	static function enviaContato($de, $de_email, $msg, $info = null, $to = null){
		$smtp = EmailConfig::_get();

		if($info == null)
			$info = Info::get();

		if($to == null)
			$to = $info->email;

		$e = new Email();

		$e->Subject = "Contato no Site \"".$info->dominio."\"";
		$e->Username = $smtp->email;  
		$e->Password = $smtp->senha;  
		$e->Host = $smtp->smtp;  
		$e->From = $smtp->email;  
		$e->FromName = $de;
		$e->AddAddress( "contato@wilsonneto.com.br" );
		$e->AddAddress( $to );
		$e->Body = nl2br('Ol&aacute; foi enviado um novo contato pelo site <a href="http://'.$info->dominio.'">'.$info->dominio.'</a>
			<br /><br /><b>Contato de</b>: '.$de.' ('.$de_email.')'."<br />".$msg
		);
		if ($e->Send())
			return true;
		else{
			echo ($e->ErrorInfo);
			return false;
		}
	}
	
	static function enviaErro( $msg ){
		$e = new Email();
		$e->Subject = "Erro no site \"".DOMINIO."\"";
		$e->Username = "erros@wnbr.com.br";  
		$e->Password = "erros2014";  
		$e->Host = "rlin50.hpwoc.com";  
		$e->From = "erros@wnbr.com.br";  
		$e->FromName = "Erros Sistema";
		$e->AddAddress("wn_br@hotmail.com");
		$e->Body = nl2br( $msg );
		if ($e->Send())
			return true;
		else{
			// echo ($e->ErrorInfo);
			return false;
		}
	}
	
	static function enviaAlerta( $msg ){
		$e = new Email();
		$e->Subject = "Aviso do site \"".DOMINIO."\"";
		$e->Username = "erros@wnbr.com.br";  
		$e->Password = "erros2014";  
		$e->Host = "mail.wnbr.com.br";  
		$e->From = "erros@wnbr.com.br";  
		$e->FromName = "Alerta Ze Do Ingresso";
		$e->AddAddress("wn_br@hotmail.com");
		$e->Body = nl2br( $msg );
		if ($e->Send())
			return true;
		else{
			// echo ($e->ErrorInfo);
			return false;
		}
	}

	static function EnviaPedido( $msg, $assunto, $email ){
		$e = new Email();
		$e->Subject = $assunto;
		$e->Username = "noreply@zedoingresso.com.br";  
		$e->Password = "021120141644";  
		$e->Host = "mail.zedoingresso.com.br";  
		$e->From = "noreply@zedoingresso.com.br";  
		$e->FromName = "Ze do Ingresso";
		$e->AddAddress($email);
		$e->Body = nl2br( $msg );
		if ($e->Send())
			return true;
		else{
			// echo ($e->ErrorInfo);
			return false;
		}
	}


}

?>
