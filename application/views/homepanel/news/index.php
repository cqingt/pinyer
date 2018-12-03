<link rel="stylesheet" href="<?php echo SITE_STATIC ?>/css/homepanel/news-index.css">
<link rel="stylesheet" href="<?php echo SITE_STATIC ?>/layui/css/layui.css">
<style>
    a{text-decoration: none;}
    .pagination{margin: 50px 0;text-align: center;}
</style>
<div class="contain">
    <div class="contain_left">
        <div class="contain_left_top">
            <div class="contain_left_top_span">
                <span><?php echo $category['name']; ?>/</span>
                <span><?php echo $category['flag']; ?></span>
            </div>
            <div></div>
        </div>

        <div class="contain_left_content">
            <!--11111-->
            <?php if (! empty($articles)) { ?>
                <?php foreach ($articles as $article) { ?>
                    <div class="contain_left_content_line">
                        <div class="contain_left_content_line_left">
                            <img src="<?php echo $article['image'] ?  : $default; ?>" width="200px" height="150px" alt="">
                        </div>
                        <div class="contain_left_content_line_right" >
                            <div class="contain_left_content_line_right_top" >
                                <div><a href="<?php echo site_url('/news/detail?id=') . $article['id']; ?>"><?php echo $article['title']; ?></a></div>
                                <?php if ($article['category_id'] == 1) { ?>
                                <div class="like" data-key="<?php echo $article['id']; ?>">
                                    <img src="<?php echo SITE_STATIC ?>/images/homepanel/dianzan.png" width="20" alt="">
                                </div>
                                <div class="likes"><?php echo $article['likes']  ; ?></div>
                                <?php } ?>
                            </div>
                            <div class="contain_left_content_line_right_bottom">
                                <?php echo $article['abstract']; ?>
                            </div>
                            <a href="<?php echo site_url('/news/detail?id=') . $article['id']; ?>">
                                <div class="contain_left_content_line_right_detail">查看全文</div>
                            </a>
                        </div>
                    </div>
               <?php }
               } ?>
        </div>

        <div class="pagination">
            <div id="page"></div>
        </div>
    </div>

    <div class="contain_right">
        <div class="contain_right_top">
            <div>热门文章</div>
            <div>

            </div>
        </div>
        <div class="contain_right_content">
            <ol class="contain_right_content_ol">
                <?php if (! empty($hots)) { ?>
                <?php foreach ($hots as $hot) { ?>
                <li class="contain_right_content_ol_li"><a href="<?php echo site_url('/news/detail?id=') . $hot['id']; ?>"><?php echo $hot['title']; ?></a></li>
                <?php }
                } else { ?>
                    <li class="contain_right_content_ol_li">暂无数据</li>
                <?php } ?>
            </ol>
        </div>

    </div>
</div>
<script type="text/javascript" src="<?php echo SITE_STATIC; ?>/layui/layui.js"></script>
<script>
    layui.use(['form','layer','jquery', 'laypage'],function() {
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery;
        var laypage = layui.laypage;
        var curr = <?php echo $page; ?>;
        var c = <?php echo $_GET['c']; ?>

        laypage.render({
            elem: 'page' //注意，这里的 test1 是 ID，不用加 # 号
            ,count: <?php echo $total; ?> //数据总数，从服务端得到
            ,curr: curr//获取起始页
            ,theme: '#3193DE'
            // ,hash: 'page' //自定义hash值
            ,jump: function(obj, first){

                //首次不执行
                if(!first){
                    window.location.href = '/news/index?c='+ c +'&page=' + obj.curr;
                }
            }
        });

        var submit = false;

        $('.contain_left_content').on('click', '.like', function () {
            if (submit) {
                return false;
            }
            submit = true;
            var _id = $(this).data('key');
            var that = $(this);

            $.ajax({
                type: 'post',
                url: '/news/likes',
                data: {id: _id},
                dataType: 'json',
                success: function (result) {
                    submit = false;
                    if (result.code == 200) {
                        that.parent().find('.likes').text(result.data.likes);
                    }
                }
            })
        });
    });
</script>