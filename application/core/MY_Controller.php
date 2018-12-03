<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $page_data = array(
        'module_name' => '',
        'controller_name' => '',
        'method_name' => '',
    );

    protected $adminInfo;

    public function __construct()
    {
        parent::__construct();
        $this->load->driver('cache', array('adapter' => 'file'));
        $this->load->helper(array('url', 'string', 'text', 'language'));

        $this->page_data['folder_name'] = trim(substr($this->router->directory, 0, -1));
        $this->page_data['controller_name'] = trim($this->router->class);
        $this->page_data['method_name'] = trim($this->router->method);
        $this->page_data['controller_info'] = $this->config->item($this->page_data['controller_name'], 'module');

        $_pageseo = $this->config->item($this->router->class, 'seo');
        $_default_pageseo = $this->config->item('default', 'seo');
        $this->page_data['title'] = isset($_pageseo['title']) ? $_pageseo['title'] : $_default_pageseo['title'];
        $this->page_data['keyword'] = isset($_pageseo['keywords']) ? $_pageseo['keywords'] : $_default_pageseo['keywords'];
        $this->page_data['description'] = isset($_pageseo['decriptions']) ? $_pageseo['decriptions'] : $_default_pageseo['decriptions'];
        unset($_pageseo);
        unset($_default_pageseo);

        $this->load->vars($this->page_data);
    }

    protected function showMessage($msg, $urlForward = '', $ms = 500, $dialog = '')
    {
        if ($urlForward == '') {
            $urlForward = $_SERVER['HTTP_REFERER'];
        }
        $dataInfo = array("msg" => $msg, "urlForward" => $urlForward, "ms" => $ms, "dialog" => $dialog);

        exit(json_encode($dataInfo));
    }

    protected function view($view_file, $sub_page_data = NULL, $autoload_header_footer_view = true)
    {
        $view_file = $this->page_data['folder_name'] . DIRECTORY_SEPARATOR . $this->page_data['controller_name'] . DIRECTORY_SEPARATOR . $view_file;

        $this->load->view(reduce_double_slashes($view_file), $sub_page_data);
    }

    protected function _success($data = [], $code = 200, $msg = '操作成功')
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        exit(json_encode($response));
    }

    protected function _json($data) {
        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        exit(json_encode($data));
    }

    protected function _error($msg = '操作失败', $code = 400, $data= '')
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        exit(json_encode($response));
    }

}

class Front_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 自动模板调用
     *
     * @param $module
     * @param $template
     * @param $istag
     * @return unknown_type
     */
    protected function frontTpl($viewFile, $pageData = array(), $cache = false)
    {
        $viewFile = $this->page_data['folder_name'] . DIRECTORY_SEPARATOR . $this->page_data['controller_name'] . DIRECTORY_SEPARATOR . $viewFile;

        $this->load->model('CategoryModel', 'category');
        $pageData['categories'] =  $this->category->select('', 'id, name');

        $this->load->view('homepanel/header', $pageData);
        $this->load->view(reduce_double_slashes($viewFile), $pageData);
        $this->load->view('homepanel/footer', $pageData);
    }

    /**
     * 自动模板调用
     *
     * @param $module
     * @param $template
     * @param $istag
     * @return unknown_type
     */
    protected function homeTpl($viewFile, $pageData = array(), $cache = false)
    {
        $viewFile = 'homepanel' . DIRECTORY_SEPARATOR . $this->page_data['controller_name'] . DIRECTORY_SEPARATOR . $viewFile;

        $this->load->model('CategoryModel', 'category');
        $pageData['categories'] =  $this->category->select('', 'id, name');

        $this->load->view('homepanel/header', $pageData);
        $this->load->view(reduce_double_slashes($viewFile), $pageData);
        $this->load->view('homepanel/footer', $pageData);
    }

    /**
     * 自动模板调用
     *
     * @param $module
     * @param $template
     * @param $istag
     * @return unknown_type
     */
    protected function error404($viewFile, $pageData = array(), $cache = false)
    {
        $viewFile = 'homepanel' . DIRECTORY_SEPARATOR . $viewFile;

        $this->load->model('CategoryModel', 'category');
        $pageData['categories'] =  $this->category->select('', 'id, name');

        $this->load->view('homepanel/header', $pageData);
        $this->load->view(reduce_double_slashes($viewFile), $pageData);
        $this->load->view('homepanel/footer', $pageData);
    }
}

class Admin_Controller extends MY_Controller
{
    protected $userId;
    protected $username;

    public function __construct()
    {
        define("IN_ADMIN", TRUE);
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('cookie');
        $this->load->library('session');
        $this->load->library('verifyCode');


        $this->userId = intval($this->session->userdata('user_id'));
        $this->username = $this->security->xss_clean($this->session->userdata('username'));
    }

    protected function showMessage($msg, $urlForward = '', $ms = 500, $dialog = '')
    {
        if ($urlForward == '') {
            $urlForward = $_SERVER['HTTP_REFERER'];
        }

        $dataInfo = array("msg" => $msg, "urlForward" => $urlForward, "ms" => $ms,  "dialog" => $dialog);

        echo $this->load->view('adminpanel/header', NULL, true);
        echo $this->load->view('adminpanel/message', $dataInfo, true);
        echo $this->load->view('adminpanel/footer', NULL, true);

        exit;
    }

    /**
     * 判断用户是否已经登陆
     */
    protected function checkLogin()
    {
        if (!$this->userId && !($this->page_data['folder_name'] == 'adm' && $this->page_data['controller_name'] == 'login' && $this->page_data['method_name'] == 'index')) {
            redirect(site_url('adm/login/index'));
            exit(0);
        }

        $this->load->model('AdminModel', 'admin');
        $dataInfo = $this->admin->get_one(array('id' => $this->userId, 'username' => $this->username), 'id,username,created');

        if (! ($this->page_data['folder_name'] == 'adm' && $this->page_data['controller_name'] == 'login' && $this->page_data['method_name'] == 'index') && ! $dataInfo) {
            redirect(site_url('adm/login/index'));
            exit(0);
        } else if ($dataInfo) {

            $this->adminInfo = $dataInfo;
        }
    }

    /**
     * 自动模板调用
     * @param $viewFile
     * @param bool $pageData
     */
    protected function adminTpl($viewFile, $pageData = false)
    {
        $viewFile = $this->page_data['folder_name'] . DIRECTORY_SEPARATOR . $this->page_data['controller_name'] . DIRECTORY_SEPARATOR . $viewFile;

        $this->load->view('adminpanel/public/header', $pageData);
        $this->load->view(reduce_double_slashes($viewFile), $pageData);
        $this->load->view('adminpanel/public/footer', $pageData);
    }
}