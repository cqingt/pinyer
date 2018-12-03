<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends Base_Model {

	public function __construct() {
		$this->table_name = 'admin';
		parent::__construct();
	}
	
}
