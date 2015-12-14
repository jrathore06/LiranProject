<?php 
class Verification{
	var $googleVer = '';
	var $errorInvalidUrl = 'Please input a correct url';
	var $noGoogleVer = 'There is no Google Verification tag for this url';
	var $googleTokenString = '<meta name=google-site-verification content=.?(.*?).?>/is';
	//find google verification token in file
	public function getMetaData($url){
		//open the file for reading
		$fp = fopen($url, 'r');
		$content ="";
		if(!$fp){
			echo $this->errorInvalidUrl;
			exit();
		}
		while(!feof($fp)) {
			$buffer = trim(fgets($fp, 4096));
			$content .= $buffer;
		}
		//check if there is a google verification tag in the string
		if(stripos($content, $this->googleTokenString)!== false){
			$this->googleVer = stripos($content, $googleTokenString);
			return true;
		}
		fclose($fp);
		return false;
	}
	
	//get google verification token
    public function getGoogleVer($url){
		//if there is a google verification tag then return the tag
		if ($this->getMetaData($url)){
				return $this->googleVer;
			}
		else{
			   return $this->noGoogleVer;
			}
	}
        
	//update google verification token
	public function updateGoogleVer($url, $keyword){
		//if there is a google verification tag then change its contents to the keyword provided
		if (getMetaData($url)){
			$fp = fopen($url, 'w+');
			$lines = file($fp);
			$allLines = implode("", $lines);
			$entry = str_replace($googleTokenString, '<meta name=google-site-verification content='.$keyword, $allLines);
			fclose($fp);
			return true;
		}
		else{
			return false;
		}
		
	}
	//delete google verification token
	public function deleteGoogleVer($url){
		//if there is a google verification tag then replace it with empty space
		if (getMetaData($url)){
			$fp = fopen($url, 'w+');
			$lines = file($fp);
			$allLines = implode("", $lines);
			$entry = str_replace($googleTokenString,'', $allLines);
			fclose($fp);
			return true;
		}
		else{
			return false;
		}
	}
}