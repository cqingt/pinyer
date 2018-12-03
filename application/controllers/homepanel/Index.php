<?php
/**
 * Created by PhpStorm.
 * User: PINYER Co ltd
 * Date: 2018/11/29
 * Time: 10:06
 */
class Index extends Front_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->frontTpl('index');
    }

    public function help()
    {
        
    }
}