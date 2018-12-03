<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Admin_Controller {

	public function index()
	{
        $this->load->model('AdminModel', 'admin');
        $dataInfo = $this->admin->get_one(array('id' => $this->userId, 'username' => $this->username), 'id,username,created');

        if ($dataInfo) {
            return redirect('/adm/index');
        }

	    $this->load->view('adm/login/index');
	}

    /**
     * 登录
     */
    public function enter()
    {
        $data = $this->input->post();

        $username = isset($data['username']) ? $data['username'] : '';
        $password = isset($data['password']) ? $data['password'] : '';
        $code     = isset($data['code']) ? $data['code'] : '';

        if (empty($username) || empty($password)) {
            return $this->_error('用户名或密码不能为空');
        }

        if (empty($code)) {
            return $this->_error('验证码不能为空');
        }

        // 校验 验证码
        if (strtolower($code) != strtolower($this->session->verify_code) ) {
            return $this->_error('验证码错误');
        } else {
            $this->session->set_tempdata('verify_code', '', 0);
        }

        // 校验 用户表
        $this->load->model('AdminModel', 'admin');

        $userInfo = $this->admin->get_one(['username' => $username], 'id,username,password,encrypt,is_lock,try_times');

        if (empty($userInfo)) {
            return $this->_error('用户名或密码错误');
        }

        if ($userInfo['is_lock']) {
            return $this->_error('账号被锁定，请联系管理员');
        }

        if (md5(md5($password) . $userInfo['encrypt']) !== $userInfo['password']) {
            $times = $userInfo['try_times'];

            if ($times == 4) {
                $isLock = 1;
            } else {
                $isLock = 0;
            }

            $this->admin->update(['try_times' => $times + 1, 'is_lock' => $isLock], ['username' => $username]);

            $limit = 4 - $times;
            return $this->_error("用户名或密码错误，还有{$limit}次机会");
        }

        // 更新用户信息
        $this->admin->update(['last_login_ip' => $this->input->ip_address(), 'last_login_time' => SYS_DATE], ['id' => $userInfo['id']]);

        // 设置session
        $ip = $this->input->ip_address();

        $this->admin->update(array('last_login_ip' => $ip, 'last_login_time' => SYS_DATE), array('id' => $userInfo['id']));

        $this->session->set_userdata('user_id', $userInfo['id']);
        $this->session->set_userdata('username', $username);

        return $this->_success();
	}

    /**
     * 验证码
     */
	public function captcha()
    {
        $code = new VerifyCode();

        $result = $code->create_captcha();

        if (! empty($result)) {
            $this->session->set_tempdata('verify_code', $result['word'], 300);
            echo $result['image'];
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/adm/login/index');
    }
	
}