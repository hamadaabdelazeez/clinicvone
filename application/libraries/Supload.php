<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supload {	
	private $final_file;	
	private $thumb_width = "200";
	private $thumb_height = "200";	
	public function __construct(){
		
	}
		
	private function _directory($_dir,$dir_root="media"){
		if (!is_dir(FCPATH.$dir_root.'/'.$_dir)) {
			 return mkdir(FCPATH.$dir_root.'/'.$_dir, 0777, true);
		}else return true;
	}
	
	private function generateRandomString($length = 16) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	private function onlymainpath($file_name=''){
		$output = array();
		$file_name = explode("/",$file_name);
		$_tmp = array_pop($file_name);
		array_unshift($output,$_tmp);
		return implode("/",$output);
	}
	
	private function encrypt_file_name($file_name){
		$file_name = explode("/",$file_name);
		$file_dir = $file_name;
		array_pop($file_dir);
		$file_dir = implode("/",$file_dir);
		$file_name = array_pop($file_name);
		$file_name = explode(".",$file_name);
		$_extension = array_pop($file_name);
		return $file_dir."/".$this->generateRandomString().".".$_extension;
	}
	
	private function add_number_filename($file_name0,$i){
		if($i == 0)return $file_name0;
		$file_name_tmp = explode('.',$file_name0);
		$file_name_tmp[count($file_name_tmp)-2] .= '_'.$i;
		return implode('.',$file_name_tmp);
	}
	
	public function file_title($final_file='',$index=NULL,$file=''){
		if($index===NULL){
			$final_file = !empty($final_file)?$final_file:$this->final_file;
			$file_title = explode('.',$final_file);
			array_pop($file_title);
			$file_title = count($file_title) > 1?implode('.',$file_title):array_pop($file_title);
		}else{
			$file_title = $_FILES[$file][$index];
		}
		return $file_title;
	}
	
	public function upload($file_upload = 'upload_file',$encrypted=false,$index=NULL,$m_dir="media"){
		$valid = false;
		if($index===NULL)$allowed_extensions = array('pjpg','pjpeg','jpg','jpeg','gif','png');
		else $allowed_extensions = research_allowed_file_types();
		$allowed_types= array('image/pjpg','image/pjpeg','image/jpg','image/jpeg','image/gif','image/png');
		$upload_path = FCPATH.$m_dir.'/';
		$max_size	= file_upload_max_size();
		$files_file_name = ($index===NULL)?$_FILES[$file_upload]['name']:$_FILES[$file_upload]['name'][$index];
		$file_name = !empty($_POST['file_name'])?$_POST['file_name']:$files_file_name;
		$_extension = explode('.',$file_name);
		$_extension = array_pop($_extension);
		$fleis_type = ($index===NULL)?$_FILES[$file_upload]['type']:$_FILES[$file_upload]['type'][$index];
		$files_size = ($index===NULL)?$_FILES[$file_upload]['size']:$_FILES[$file_upload]['size'][$index];
	   $files_error = ($index===NULL)?$_FILES[$file_upload]['error']:$_FILES[$file_upload]['error'][$index];
	   	$files_tmp = ($index===NULL)?$_FILES[$file_upload]['tmp_name']:$_FILES[$file_upload]['tmp_name'][$index];
		$valid = in_array(strtolower($_extension),$allowed_extensions) && $files_size < 1024*$max_size &&
		$files_error == UPLOAD_ERR_OK;
		if ($valid)
		{
			if($this->_directory(date("Y"),$m_dir) && $this->_directory(date("Y").'/'.date("m"),$m_dir) && 
			$this->_directory(date("Y").'/'.date("m").'/'.date("d"),$m_dir)){
					require_once("I18N_Arabic.php");
					$Arabic = new I18N_Arabic('Transliteration');
					$file_name = str_replace(" ","-",trim($Arabic->ar2en($file_name)));
					$final_file = $file_name;
					$file_name = $upload_path.date("Y").'/'.date("m").'/'.date("d").'/'.$file_name;
					$original_file_name = $upload_path.date("Y").'/'.date("m").'/'.date("d").'/'.$final_file;
					$i=0;
					while(file_exists($file_name)){
						$i++;
						$file_name = $this->add_number_filename($original_file_name,$i);
					}
					if($encrypted)$file_name = $this->encrypt_file_name($file_name);
					$valid = move_uploaded_file($files_tmp,$file_name);
					$this->upload_thumb($file_name);
					if($valid){
						$final_file = $this->add_number_filename($final_file,$i);
					}
				}else $valid = false;
			}
			@unlink($files_tmp);
			if($valid){
				$this->final_file = $final_file;
				return $this->onlymainpath($file_name);
			}
			else return false;
		}
		private function upload_thumb($uploaded_file_name){	
				$m_dir="media/thumbs";			
				$filename_err = explode(".",$uploaded_file_name);
				$filename_err_count = count($filename_err);
				$file_ext = $filename_err[$filename_err_count-1];				
				$filename_arr = explode("/",$uploaded_file_name);
				if($this->_directory(date("Y"),$m_dir) && $this->_directory(date("Y").'/'.date("m"),$m_dir) && 
			$this->_directory(date("Y").'/'.date("m").'/'.date("d"),$m_dir)){				
					$thumb_path = FCPATH.'media/thumbs/'.date("Y").'/'.date("m").'/'.date("d").'/';
					$thumbnail = $thumb_path.end($filename_arr);				
					$imagesize = getimagesize($uploaded_file_name);
					$width = $imagesize[0];
					$height = $imagesize[1];				
					$thumb_create = imagecreatetruecolor($this->thumb_width,$this->thumb_height);				
					switch($file_ext){
						case 'jpg':
							$source = imagecreatefromjpeg($uploaded_file_name);
							break;
						case 'jpeg':
							$source = imagecreatefromjpeg($uploaded_file_name);
							break;
		
						case 'png':
							$source = imagecreatefrompng($uploaded_file_name);
							break;
						case 'gif':
							$source = imagecreatefromgif($uploaded_file_name);
							break;
						default:
							$source = imagecreatefromjpeg($uploaded_file_name);
					}
					imagecopyresized($thumb_create,$source,0,0,0,0,$this->thumb_width,$this->thumb_height,$width,$height);
					switch($file_ext){
						case 'jpg' || 'jpeg':
							$result = imagejpeg($thumb_create,$thumbnail,100);
							break;
						case 'png':
							$result = imagepng($thumb_create,$thumbnail,100);
							break;	
						case 'gif':
							$result = imagegif($thumb_create,$thumbnail,100);
							break;
						default:
							$result = imagejpeg($thumb_create,$thumbnail,100);
					}	
				}
		}
		public function upload_base64($imgdata){
		$valid = true;
		$m_dir="media";
		$upload_path = FCPATH.$m_dir.'/';
		if($valid){
			$valid = false;
			if($this->_directory(date("Y"),$m_dir) && $this->_directory(date("Y").'/'.date("m"),$m_dir) && 
			$this->_directory(date("Y").'/'.date("m").'/'.date("d"),$m_dir)){
					$new_file_name = time();
					$file_name = $upload_path.date("Y").'/'.date("m").'/'.date("d").'/'.$new_file_name;
					$file_name = $this->encrypt_file_name($file_name);
					/*$data = 'data:image/png;base64,AAAFBfj42Pj4';
					
					list($type, $imgdata) = explode(';', $imgdata);
					list(, $imgdata)      = explode(',', $imgdata);
					$imgdata = base64_decode($imgdata);*/
					$imgdata = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
					$file_name .= ".png";
					$valid = file_put_contents($file_name, $imgdata);				
				}
			}
			if($valid){
				$this->final_file = $file_name;
				$this->upload_thumb($file_name);
				return $this->onlymainpath($file_name);
			}
			else return false;
		}
}