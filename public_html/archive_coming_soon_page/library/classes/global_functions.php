<?php

/* Setup twitter.*/
if($_SERVER['HTTP_HOST'] == 'bizlounge.dev') {

	/* Twitter. 
	define('CONSUMER_KEY', 'Ho8wsicwY7wiy5oLCysoA'); 
	define('CONSUMER_SECRET', 'MlVtFCckqhXUGTyEuQhgDwSihiclUdVfiPSFfngQ');
	define('OAUTH_CALLBACK', 'http://bizlounge.dev/test/twitter/callback.php');
	*/
	/* Facebook */
	define('APP_ID', '641947882494460'); 
	define('APP_SECRET', '3c36b69524eab7421c12cd091cb3d520');
	
	/* LinkedIn */
    define('LNK_APP_KEY', '93fpa27s8dqs');
    define('LNK_APP_SECRET', 'ItL0XROy1NtQJdce');
    define('LNK_CALL_BACK_URL', 'http://bizlounge.dev/test/linkedin/');
  
} else {
	
	/* Facebook */
	define('APP_ID', '249837845174010'); 
	define('APP_SECRET', '4fbca66797b938ff2fed3d88ab24233b');
	
	/* LinkedIn */
    define('LNK_APP_KEY', 'alrwbjfpz8gc');
    define('LNK_APP_SECRET', 'NFre9TOvqIszKKCS');
    define('LNK_CALL_BACK_URL', 'http://bizlounge.co.za/');	
}

function randomAlphabet($number = 1) {
	/* New reference. */
	$reference = "";
	$codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
	
	$count = strlen($codeAlphabet) - 1;
	
	for($i=0;$i<$number;$i++){
		$reference .= $codeAlphabet[rand(0,$count)];
	}
	
	return $reference;
	
}	

function validateDomain($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace('https://www.' , '' , $string);
	$string = str_replace('http://www.' , '' , $string);
	$string = str_replace('www.' , '' , $string);

	if(preg_match('/([0-9a-z-]+\.)?[0-9a-z-]+\.[a-z]{2,7}/', trim($string))) {
		return $string;
	} else {
		return '';
	}		
}

function StringToFilename($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace('___' , '_' , $string);
	$string = str_replace('__' , '_' , $string);	
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace("â€“", "ae", $string);	
	$string = str_replace("â", "a", $string);	
	$string = str_replace("€", "e", $string);	
	$string = str_replace("“", "", $string);	
	$string = str_replace("#", "", $string);	
	$string = str_replace("$", "", $string);	
	$string = str_replace("@", "", $string);	
	$string = str_replace("!", "", $string);	
	$string = str_replace("&", "", $string);	
	$string = str_replace(';' , '_' , $string);		
	$string = str_replace(':' , '_' , $string);		
	$string = str_replace('[' , '_' , $string);		
	$string = str_replace(']' , '_' , $string);		
	$string = str_replace('|' , '_' , $string);		
	$string = str_replace('\\' , '_' , $string);		
	$string = str_replace('%' , '_' , $string);	
	$string = str_replace(';' , '' , $string);		
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '' , $string);	
	return $string;
			
}

function onlyAlphaNumeric($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace(' ' , '' , $string);
	$string = str_replace('__' , '' , $string);
	$string = str_replace(' ' , '' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "", $string);
	$string = str_replace("\\", "", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "", $string);
	$string = str_replace(".", "", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace('___' , '' , $string);
	$string = str_replace('__' , '' , $string);	
	$string = str_replace(' ' , '' , $string);
	$string = str_replace('__' , '' , $string);
	$string = str_replace(' ' , '' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "", $string);
	$string = str_replace("\\", "", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "", $string);
	$string = str_replace(".", "", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace("â€“", "ae", $string);	
	$string = str_replace("â", "a", $string);	
	$string = str_replace("€", "e", $string);	
	$string = str_replace("“", "", $string);	
	$string = str_replace("#", "", $string);	
	$string = str_replace("$", "", $string);	
	$string = str_replace("@", "", $string);	
	$string = str_replace("!", "", $string);	
	$string = str_replace("&", "", $string);	
	$string = str_replace(';' , '' , $string);		
	$string = str_replace(':' , '' , $string);		
	$string = str_replace('[' , '' , $string);		
	$string = str_replace(']' , '' , $string);		
	$string = str_replace('|' , '' , $string);		
	$string = str_replace('\\' , '' , $string);		
	$string = str_replace('%' , '' , $string);	
	$string = str_replace(';' , '' , $string);		
	$string = str_replace(' ' , '' , $string);
	$string = str_replace('__' , '' , $string);
	$string = str_replace(' ' , '' , $string);	
	$string = str_replace('+27' , '0' , $string);	
	$string = str_replace('(0)' , '' , $string);	
	
	$string = preg_replace('/^00/', '0', $string);
	$string = preg_replace('/^27/', '0', $string);
	
	return $string;
			
}

function createReference($connObject, $recruiter) {
	/* New reference. */
	$reference = substr(md5(rand(123, 98745)), 1, 10);
	
	/* First check if it exists or not. */
	$itemCheck = $connObject->getByReference($recruiter, $reference);
	
	if(count($itemCheck) > 0) {
		/* It exists. check again. */
		createReference($connObject, $recruiter);
	} else {
		return $reference;
	}
}

/* Convert word or text to simple text. */
function parseWord($userDoc) {
	$fileHandle = fopen($userDoc, "r");
	$line = @fread($fileHandle, filesize($userDoc));   
	$lines = explode(chr(0x0D),$line);
	$outtext = "";
	foreach($lines as $thisline)
	  {
		$pos = strpos($thisline, chr(0x00));
		if (($pos !== FALSE)||(strlen($thisline)==0))
		  {
		  } else {
			$outtext .= $thisline." ";
		  }
	  }
	 $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
	return $outtext;
} 

?>