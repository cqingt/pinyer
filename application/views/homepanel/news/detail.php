<link rel="stylesheet" href="<?php echo SITE_STATIC ?>/css/homepanel/news-detail.css">
<div id="con" class="con">
    <div class="con_left">
        <div  class="con_left_first"><?php echo $article['title']; ?></div>
        <div class="con_left_information" style="display: none">
            <div>小道消息:</div>
            <div>中朝传统友谊是两党两国老一辈领导人亲自缔造和精心培育;</div>
        </div>
        <div class="con_company">
            <div>泉州品悦</div>
            <div class="con_company_time"> <?php echo $article['created_at']; ?></div>
            <div>浏览量： <?php echo $article['views']; ?></div>
        </div>
        <div class="con_left_title">
            <?php echo $article['content']; ?>
        </div>
    </div>
    <div class="con_right">
        <div class="con_right_title">
            <div class="con_right_title_hr"></div>
            <div class="con_right_title_recommend">推荐</div>
            <div class="con_right_title_img">
                <div><img src="<?php echo SITE_STATIC ?>/images/homepanel/refresh.png" width="20" alt=""></div>
                <div class="random">换一批</div>
            </div>
        </div>

        <div class="recommend">
        <?php if (! empty($recommends)) { ?>
            <?php foreach ($recommends as $recommend) { ?>
                <div class="con_right_detail" data-href="<?php echo site_url('/news/detail?id=') . $recommend['id']; ?>">
                    <img src="<?php echo $recommend['image'] ? : $default; ?>" alt="" style="height: 100px;">
                    <div class="con_right_text">
                        <?php echo $recommend['title']; ?>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="empty">暂无数据</div>
        <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo SITE_STATIC; ?>/layui/layui.js"></script>
<script>
    //$(document).ready(function () {
    layui.use(['form','layer','jquery'],function(){
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery;
        var _page = 2;
        var categoryId = "<?php echo $categoryId; ?>";

        $('.random').on('click', function () {
            var _id = <?php echo $article['id']; ?>

            $.ajax({
                type: 'post',
                url: '/news/random',
                dataType: 'json',
                data: {page: _page, id: _id, category: categoryId},
                success: function (result) {
                    if (result.code == 200) {
                        var data = result.data.recommends;
                        var html = '';

                        for (var i = 0, len = data.length; i < len; i++) {
                            html += '<div class="con_right_detail" data-href="/news/detail?id=' + data[i].id + '">\n'+
                                    '<img src="' + data[i].image + '" alt="" style="height: 100px;">\n'+
                                    '<div class="con_right_text">' + data[i].title +'</div>\n'+
                                    '</div>';
                        }

                        if (html) {
                            $('.recommend').html(html);
                        }

                        if (result.data.over) {
                            _page = 1;
                        } else {
                            _page ++;
                        }
                    }
                }
            })
        });

        $('.con_right').on('click', '.con_right_detail', function () {
            window.location.href = $(this).data('href');
        })
    })
</script>