<?php
class Contact extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->frontTpl('index', ['title' => '联系我们']);
    }
}