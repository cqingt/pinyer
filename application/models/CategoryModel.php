<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoryModel extends Base_Model {

	public function __construct() {
		$this->table_name = 'category';
		parent::__construct();
	}
	
}
