<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ArticleModel extends Base_Model {

	public function __construct() {
		$this->table_name = 'articles';
		parent::__construct();
	}
	
}
