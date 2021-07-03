<?php/* Add this on all pages on top. */set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 02 December 2013
 * Author: Mzimhle Mosiwe
 */
//custom enquiry item class as enquiry table abstraction
class class_event extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name		= 'event';	protected $_primary	= 'event_code';	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 
	 public function insert(array $data) {
        // add a timestamp
        $data['event_added']	= date('Y-m-d H:i:s');
		$data['event_code']		= $this->createReference();					$data['event_url']			= $this->toUrl(trim($data['event_name']));						return parent::insert($data);
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
        $data['event_updated']	= date('Y-m-d H:i:s');
		if(isset($data['event_name'])) {			$data['event_url']		= $this->toUrl(trim($data['event_name']));					}		
        return parent::update($data, $where);	
    }	
	public function getByUrl($url) {
		$select = $this->_db->select() 
					   ->from(array('event' => 'event'))					   					   ->where('event_deleted = 0')
					   ->where('event_url = ?', $url)					   
					   ->limit(1);
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? false : $result = $result;
	}	
	public function getAll($where = 'event_deleted = 0', $order = 'event_name') {
			$select = $this->_db->select() 
					   ->from(array('event' => 'event'))					   					   ->where('event_deleted = 0')
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
						->from(array('event' => 'event'))					   						->where('event_deleted = 0')			
						->where('event_code = ?', $code)
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
						->from(array('event' => 'event'))	
					   ->where('event_code = ?', $reference)
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
	}
}
?>