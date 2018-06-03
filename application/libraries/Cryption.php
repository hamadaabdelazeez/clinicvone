<?php
class Cryption{		
		
	private $key = "!X9*s4)-6%Q7#f3-01_z2/Y5\l8^P3r@";
	
	public function encrypt($string){
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
		MCRYPT_DEV_URANDOM);
		$encrypted = base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_128,
				hash('sha256', $this->key, true),$string,MCRYPT_MODE_CBC, $iv
			)
		);
		$encrypted = str_replace("/","slash",$encrypted);
		$encrypted = str_replace("+","plus",$encrypted);
		$encrypted = str_replace("=","equal",$encrypted);
		return $encrypted;
	}
	
	public function decrypt($encrypted){
		$encrypted = str_replace("slash","/",$encrypted);
		$encrypted = str_replace("plus","+",$encrypted);
		$encrypted = str_replace("equal","=",$encrypted);
		$data = base64_decode($encrypted);
		$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128,hash('sha256', $this->key, true),
			substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
			MCRYPT_MODE_CBC,$iv),"\0");
		}
	
}