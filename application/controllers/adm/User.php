<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function changePwd()
    {
        if (! empty($_POST)) {
            $password = $this->input->post('password');
            $newPassword = $this->input->post('new_password');
            $repassword = $this->input->post('new_repassword');

            if (empty($password) || empty($newPassword)) {
                return $this->_error('密码不能为空');
            }

            if (6 != strlen($newPassword)) {
                return $this->_error('请输入6位数密码');
            }

            if ($newPassword !== $repassword) {
                return $this->_error('两次密码不一致');
            }

            $this->load->model('AdminModel', 'admin');
            $adminId = $this->session->user_id;

            $userInfo = $this->admin->get_one("id = $adminId", 'password,encrypt');

            if (md5(md5($password) . $userInfo['encrypt']) !== $userInfo['password']) {
                return $this->_error('旧密码错误');
            }

            $password = md5(md5($newPassword) . $userInfo['encrypt']);

            $this->admin->update(['password' => $password], ['id' => $adminId]);

            return $this->_success();
        } else {
            $this->load->view('adm/user/changePwd');

        }
    }


}