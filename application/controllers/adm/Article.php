<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();

        $this->load->model('ArticleModel', 'article');

    }
	
	public function index()
	{
        $this->load->model('CategoryModel', 'category');
        $categories = $this->category->select('', 'id,name');

        $this->load->view('adm/article/index', ['categories' => $categories]);
	}

	// 列表
    public function record()
    {
        $page = $this->input->get('page');
        $limit = $this->input->get('limit');
        $keyword = $this->input->get('key');
        $categoryId = $this->input->get('category_id');
        $offset = ($page - 1) * $limit;
        $where = "";

        if ($keyword) {
            $where = "title like '%{$keyword}%'";
        }

        if ($categoryId) {
            $type = $where ? ' and ' : '';
            $where .= $type . ' category_id = ' . (int)$categoryId;
        }

        $articles = $this->article->select($where, 'id,title,description,image,is_hot,position,recommend,likes,created_at,category_id,views', "$offset,$limit", 'set_top desc, id desc');
        $this->load->model('CategoryModel', 'category');
        $categories = $this->category->select('', 'id,name');

        $categories = array_column($categories, 'name', 'id');

        foreach ($articles as $key => $article) {
            $articles[$key]['category'] = isset($categories[$article['category_id']]) ? $categories[$article['category_id']] : '-';
        }

        $count = $this->article->count($where);

        $result = [
            'code'  =>  0,
            'msg'   =>  '',
            'count' => $count,
            'data'  => $articles
        ];

        return $this->_json($result);
    }

    // 创建
	public function create()
    {
        if (! empty($_POST)) {
            $title = $this->input->post('title');
            $keywords = $this->input->post('keywords');
            $description = $this->input->post('description');
            $abstract = $this->input->post('abstract');
            $image = $this->input->post('image');
            $content = $this->input->post('content');
            $position = $this->input->post('position');
            $isHot = $this->input->post('is_hot');
            $recommend = $this->input->post('recommend');
            $categoryId = $this->input->post('category_id');
            $likes = $this->input->post('likes');

            if (empty($title) || empty($content)) {
                return $this->_error('标题和内容不能为空');
            }

            if (empty($categoryId)) {
                return $this->_error('请选择分类');
            }

            $data = [
                'title'       => $title,
                'keywords'    => $keywords,
                'description' => $description,
                'abstract'    => $abstract,
                'image'       => $image,
                'content'     => $content,
                'position'    => (int)$position,
                'is_hot'      => (int)$isHot,
                'likes'       => (int)$likes,
                'recommend'   => (int)$recommend,
                'category_id' => (int)$categoryId
            ];

            $this->article->insert($data);

            return $this->_success();
        }

        $this->load->model('CategoryModel', 'category');
        $categories = $this->category->select('', 'id,name');

        $this->load->view('adm/article/create', ['categories' => $categories]);
    }

    // 编辑
    public function edit()
    {
        if (empty($_POST)) {
            $id = $this->input->get('id');

            $article = $this->article->get_one("id={$id}", 'id,title,keywords,abstract,description,content,image,position,is_hot,recommend,category_id,likes');

            $this->load->model('CategoryModel', 'category');
            $categories = $this->category->select('', 'id,name');

            $this->load->view('adm/article/edit', ['article' => $article, 'categories' => $categories]);
        } else {
            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $keywords = $this->input->post('keywords');
            $description = $this->input->post('description');
            $abstract = $this->input->post('abstract');
            $image = $this->input->post('image');
            $content = $this->input->post('content');
			$position = $this->input->post('position');
			$isHot = $this->input->post('is_hot');
			$recommend = $this->input->post('recommend');
            $categoryId = $this->input->post('category_id');
            $likes = $this->input->post('likes');

            if (empty($id)) {
                return $this->_error('id不存在');
            }

            if (empty($title) || empty($content)) {
                return $this->_error('标题和内容不能为空');
            }

            if (empty($categoryId)) {
                return $this->_error('请选择分类');
            }

            $data = [
                'title'       => $title,
                'keywords'    => $keywords,
                'description' => $description,
                'abstract'    => $abstract,
                'image'       => $image,
                'content'     => $content,
				'position'    => (int)$position,
				'is_hot'      => (int)$isHot,
                'likes'       => (int)$likes,
				'recommend'   => (int)$recommend,
                'category_id' => (int)$categoryId
            ];

            $this->article->update($data, "id = {$id}");

            return $this->_success();
        }
    }

    // 更新置顶
    public function setHot()
    {
        $id = $this->input->post('id');
        $isHot = $this->input->post('is_hot');

        if (empty($id)) {
            return $this->_error('id不存在');
        }

        $this->article->update(['is_hot' => (int)$isHot], "id = {$id}");

        return $this->_success();
    }

    public function setRecommend()
	{
		$id = $this->input->post('id');
		$recommend = $this->input->post('recommend');

		if (empty($id)) {
			return $this->_error('id不存在');
		}

		$this->article->update(['recommend' => (int)$recommend], "id = {$id}");

		return $this->_success();
	}

    public function delete()
    {
        $ids = $this->input->get('ids');

        if (is_array($ids)) {
            $idstr = implode(',', $ids);
        } else {
            $idstr = $ids;
        }

        $this->article->delete("id in ({$idstr})");

        return $this->_success();
    }

    // 预支付
    public function preview()
    {
        $title = $this->input->post('title');
        $categoryId = $this->input->post('category_id');
        $content = $this->input->post('content');

        if (empty($title) || empty($content)) {
            return $this->_error('标题和内容不能为空');
        }

        if (empty($categoryId)) {
            return $this->_error('请选择分类');
        }

        $this->session->set_tempdata(['article_title' => $title, 'article_content' => $content]);

        return $this->_success(['url' => '/homepanel/news/preview']);
    }
}
