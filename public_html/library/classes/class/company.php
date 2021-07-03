<?php/* Add this on all pages on top. */set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 02 December 2013
 * Author: Mzimhle Mosiwe
 */
//custom enquiry item class as enquiry table abstraction
class class_company extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name		= 'company';	protected $_primary	= 'company_code';	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 
	 public function insert(array $data) {
        // add a timestamp
        $data['company_added']	= date('Y-m-d H:i:s');
		$data['company_code']		= $this->createReference();					$data['company_url']			= $this->toUrl(trim($data['company_name']));						return parent::insert($data);
    }	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where) {
        // add a timestamp
        $data['company_updated']	= date('Y-m-d H:i:s');
		if(isset($data['company_name'])) {			$data['company_url']		= $this->toUrl(trim($data['company_name']));					}		
        return parent::update($data, $where);	
    }	
	public function getByUrl($url) {
		$select = $this->_db->select() 
					   ->from(array('company' => 'company'))					   
					   ->joinLeft('participant', 'participant.participant_code = company.participant_code')							   ->joinLeft('areapost', 'areapost.areapost_code = company.areapost_code')					   ->where('company_deleted = 0 and participant_deleted = 0')
					   ->where('company_url = ?', $url)					   
					   ->limit(1);
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? false : $result = $result;
	}	 public function search($query) {		$select = $this->_db->select()						->from(array('company' => 'company'), array('company.company_code', 'company.company_name'))					   ->joinLeft('participant', 'participant.participant_code = company.participant_code')							   ->joinLeft('areapost', 'areapost.areapost_code = company.areapost_code')					   ->where('company_deleted = 0 and participant_deleted = 0')					   ->where("lower(company.company_name) like ?", "%$query%")					   ->order('company.company_name desc');	   $result = $this->_db->fetchAll($select);	        return ($result == false) ? false : $result = $result;						}		
	public function getAll($where = 'company_deleted = 0', $order = 'company_name') {
			$select = $this->_db->select() 
					   ->from(array('company' => 'company'))					   ->joinLeft('participant', 'participant.participant_code = company.participant_code')							   ->joinLeft('areapost', 'areapost.areapost_code = company.areapost_code')					   ->where('company_deleted = 0 and participant_deleted = 0')
					   ->where($where)
					   ->order($order);
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code) {	
			$select = $this->_db->select()	
							->from(array('company' => 'company'))							   ->joinLeft('participant', 'participant.participant_code = company.participant_code')								   ->joinLeft('areapost', 'areapost.areapost_code = company.areapost_code')						   ->where('company_deleted = 0 and participant_deleted = 0')					
							->where('company_code = ?', $code)
							->limit(1);		
		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('company' => 'company'))	
					   ->where('company_code = ?', $reference)
					   ->limit(1);
		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = '123456789';
		$count = strlen($codeAlphabet) - 1;
		for($i=0;$i<10;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($reference);
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}	
	
	public function toUrl($string) {
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
		$string = str_replace(';' , '' , $string);				$string = str_replace(',' , '_' , $string);		
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '' , $string);	
		return $string;
	}		public function validateEmail($string) {		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($string))) {			return trim($string);		} else {			return '';		}	}		public function validateCell($string) {		if(preg_match('/^0[0-9]{9}$/', $this->onlyCellNumber(trim($string)))) {			return $this->onlyCellNumber(trim($string));		} else {			return '';		}	}		public function validateDomain($string) {		/* Remove some weird charactors that windows dont like. */		$string = strtolower($string);		$string = str_replace('https://www.' , '' , $string);		$string = str_replace('http://www.' , '' , $string);		$string = str_replace('www.' , '' , $string);		if(preg_match('/([0-9a-z-]+\.)?[0-9a-z-]+\.[a-z]{2,7}/', trim($string))) {			return $string;		} else {			return '';		}			}			public function onlyCellNumber($string) {		/* Remove some weird charactors that windows dont like. */		$string = strtolower($string);		$string = str_replace(' ' , '' , $string);		$string = str_replace('__' , '' , $string);		$string = str_replace(' ' , '' , $string);		$string = str_replace("é", "", $string);		$string = str_replace("è", "", $string);		$string = str_replace("`", "", $string);		$string = str_replace("/", "", $string);		$string = str_replace("\\", "", $string);		$string = str_replace("'", "", $string);		$string = str_replace("(", "", $string);		$string = str_replace(")", "", $string);		$string = str_replace("-", "", $string);		$string = str_replace(".", "", $string);		$string = str_replace("ë", "", $string);			$string = str_replace('___' , '' , $string);		$string = str_replace('__' , '' , $string);			$string = str_replace(' ' , '' , $string);		$string = str_replace('__' , '' , $string);		$string = str_replace(' ' , '' , $string);		$string = str_replace("é", "", $string);		$string = str_replace("è", "", $string);		$string = str_replace("`", "", $string);		$string = str_replace("/", "", $string);		$string = str_replace("\\", "", $string);		$string = str_replace("'", "", $string);		$string = str_replace("(", "", $string);		$string = str_replace(")", "", $string);		$string = str_replace("-", "", $string);		$string = str_replace(".", "", $string);		$string = str_replace("ë", "", $string);			$string = str_replace("â€“", "", $string);			$string = str_replace("â", "", $string);			$string = str_replace("€", "", $string);			$string = str_replace("“", "", $string);			$string = str_replace("#", "", $string);			$string = str_replace("$", "", $string);			$string = str_replace("@", "", $string);			$string = str_replace("!", "", $string);			$string = str_replace("&", "", $string);			$string = str_replace(';' , '' , $string);				$string = str_replace(':' , '' , $string);				$string = str_replace('[' , '' , $string);				$string = str_replace(']' , '' , $string);				$string = str_replace('|' , '' , $string);				$string = str_replace('\\' , '' , $string);				$string = str_replace('%' , '' , $string);			$string = str_replace(';' , '' , $string);				$string = str_replace(' ' , '' , $string);		$string = str_replace('__' , '' , $string);		$string = str_replace(' ' , '' , $string);			$string = str_replace('-' , '' , $string);			$string = str_replace('+27' , '0' , $string);			$string = str_replace('(0)' , '' , $string);					$string = preg_replace('/^00/', '0', $string);		$string = preg_replace('/^27/', '0', $string);				$string = preg_replace('!\s+!',"", strip_tags($string));				return $string;					}	
}
?>