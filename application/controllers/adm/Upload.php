<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
        $config['upload_path']      = UPLOAD_PATH;
        $config['allowed_types']    = 'gif|jpg|png|jpeg';
        $config['max_size']         = 5000;
        $config['max_width']        = 1024;
        $config['max_height']       = 1024;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());

            return $this->_error($error['error']);
        } else {
            $data = $this->upload->data();

            $filename = '/upload/' . $data['file_name'];

            return $this->_success(['filename' => $filename, 'src' => $filename], 0);
        }
	}

    /**
     * 百度编辑器 图片上传
     */
    public function uediter()
    {
        $config['upload_path']      = UPLOAD_PATH;
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = 5000;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('upfile'))
        {
            $error = array('error' => $this->upload->display_errors());

            return $this->_error($error['error']);
        } else {
            $data = $this->upload->data();

            $filename = '/' . $data['file_name'];

            $data = array(
                "originalName" => $data['orig_name'] ,
                "name" => $data['file_name'] ,
                "url" => $filename ,
                "size" => $data['file_size'] ,
                "type" => $data['image_type'] ,
                "state" => 'SUCCESS',
                'code' => 0
            );

            return $this->_json($data);
        }
    }
}