<?php

class News extends Front_Controller
{
    protected $defaultImg = 'http://pic.58pic.com/58pic/12/17/86/90958PICvpr.jpg';

    protected $categoryId;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('ArticleModel', 'article');
    }

    public function index()
    {
        $this->categoryId = (int)$this->input->get('c');
        $where = ['category_id' => $this->categoryId];

        $page = (int)$this->input->get('page');
        $total = $this->article->count($where);
        $limit = 10;
        $page = $page ? : 1;
        $maxPage = ceil($total/$limit);

        if ($page > $maxPage && $total) {
            $page = $maxPage;
        } else if ($page < 1) {
            $page = 1;
        }

        $offset = ($page - 1) * $limit;

        $this->load->model('CategoryModel', 'category');

        $category = $this->category->get_one(['id' => $this->categoryId], 'name,flag');

        if (empty($category)) {
            return $this->error404('404', ['message' => '文章类别不存在，请点击<a href="#" onclick="window.history.go(-1)"> 返回 </a>']);
        }

        // 热点
        $hots = $this->article->select(['category_id' => $this->categoryId, 'is_hot' => 1], 'id,title,image,description,position,created_at', 6, 'position desc');

        $articles = $this->article->select(['category_id' => $this->categoryId], 'id,title,category_id,image,abstract,position,likes,created_at', "$offset, $limit" , 'position desc');

        $title = ! empty($category) ? $category['name'] : '行业新闻';

        $this->homeTpl('index', [
            'articles' => $articles,
            'hots' => $hots,
            'default' => $this->defaultImg,
            'title' => $title,
            'total' => $total,
            'page' => $page,
            'category' => $category
        ]);
    }

    public function detail()
    {
        $id = $this->input->get('id');

        if (empty($id)) {
            return $this->_error('文章ID不存在');
        }

        $article = $this->article->get_one('id=' . $id,  'id,title,category_id,image,keywords,description,abstract,position,content,views,author,created_at');

        if (empty($article)) {
            return $this->error404('404', ['message' => '文章不存在，请点击<a href="#" onclick="window.history.go(-1)"> 返回 </a>']);
        }

        $categoryId = $article['category_id'];

        $recommends = $this->article->select(
            ['category_id' => $categoryId, 'recommend' => 1,'id !=' => $id],
            'id,title,image,description,position,created_at',
            3,
            'position desc'
        );

        $this->article->update(["views" => "+=1"], "id = {$id}");

        $this->homeTpl('detail', [
            'article' => $article,
            'recommends' => $recommends,
            'default' => $this->defaultImg,
            'title' => $article['title'],
            'categoryId' => $categoryId,
            'keywords' => $article['keywords'],
            'description' => $article['description']
        ]);
    }

    // 推荐 随机
    public function random()
    {
        $page = $this->input->post('page');
        $id = $this->input->post('id');

        $article = $this->article->get_one('id=' . $id,  'id,title,category_id');

        if (empty($article)) {
            return $this->_error('文章不存在');
        }

        $this->categoryId = $article['category_id'];

        $limit = 3;
        $offset = ($page - 1) * $limit;
        $over = 0;
        $where = ['category_id' => $this->categoryId, 'recommend' => 1, 'id !=' => $id];

        $recommends = $this->article->select($where, 'id,title,image,description,position,created_at', "$offset,$limit", 'position desc');

        $total = $this->article->count($where);

        if (count($recommends) + $offset == $total) {
            $over = 1;
        }

        foreach ($recommends as $k => $recommend) {
            $recommends[$k]['image'] = $recommend['image'] ? : $this->defaultImg;
        }

        return $this->_success(['over' => $over, 'recommends' => $recommends]);
    }

    // 点赞
    public function likes()
    {
        $id = $this->input->post('id');

        if (empty($article)) {
            return $this->_error('文章不存在');
        }

        $article = $this->article->get_one(['id' => $id], ['likes']);

        $likes = $article['likes'] + 1;

        $this->article->update(['likes' => $likes], "id = {$id}");

        return $this->_success(['likes' => $likes]);
    }

    // 预览
    public function preview()
    {
        $this->load->library('session');
        $title = $this->session->article_title;
        $content = $this->session->article_content;
        $created = date('Y-m-d H:i:s');

        if (empty($content)) {
            return $this->error404('404', ['message' => '文章预览不存在，请点击<a href="#" onclick="window.history.go(-1)"> 返回 </a>']);
        }

        $this->homeTpl('preview', ['title' => $title, 'content' => $content, 'created' => $created]);
    }
}
