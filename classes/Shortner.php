<?php
	/**
	* 
	*/
class Shortner {
		protected $db;


		
	public function __construct(){
		//for demo pruposes
		$this->db = new mysqli('localhost', 'root', '', 'mydatabase');
	}
	protected function generateCode($num){
		$string = "Mitosis.";
		$generated_code = base_convert($num, 10, 36);
		return $string .= $generated_code;

	}
	public function makeCode($url){
		$url = trim($url);

		if(!filter_var($url, FILTER_VALIDATE_URL)){
			return '';
		}

		$url = $this->db->escape_string($url);

		//check if the url already exists

		$exists = $this->db->query("SELECT code FROM url_shortner WHERE url = '{$url}'");

		if($exists->num_rows){
			return $exists->fetch_object()->code;
		}else {
			
			//insert a record without a code
			$this->db->query("INSERT INTO url_shortner (url, created) VALUES ('{$url}', NOW())");

			//generate and store
			$code = $this->generateCode($this->db->insert_id);

			//update the record with the generated code
			$this->db->query("UPDATE url_shortner SET code = '{$code}' WHERE url = '{$url}'");

			return $code;
		}

	}
	public function getUrl($code){

		$code = $this->db->escape_string($code);

		$code = $this->db->query("SELECT url FROM url_shortner WHERE code = '$code'");

		if ($code->num_rows) {
			return $code->fetch_object()->url;
			# code...
		}

		return '';

	}

}

?>