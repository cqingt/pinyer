<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($title) ? $title . '_泉州品悦科技有限公司' : '泉州品悦科技有限公司'; ?></title>
    <meta name="keywords" content="<?php echo isset($keywords) ? $keywords : '泉州品悦科技,实验室,数据价值探索,网页开发,微信开发,PHP网站,智能医疗设备,大数据,软件'; ?>">
    <meta name="Description" content="<?php echo isset($description) ? $description : '泉州品悦科技有限公司是一家以网页端和数据价值探索分析类为主的科技公司。公司员工年轻气盛，朝气蓬勃，不断学习探索新鲜事物，跟随着时代的步伐，力争从某一点开启全新的未来。'; ?>">
</head>
<body>
<div class="nav">
    <div class="nav_logo">
        泉州品悦科技有限公司
    </div>
    <ul class="nav_content">
        <li>
            <a href="/">
                首页
            </a>
        </li>
        <li>
            <a href="/#business">
                业务范围
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('hr/index'); ?>">
                人才招聘
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('contact/index'); ?>">
                联系我们
            </a>
        </li>
        <?php
            foreach ($categories as $category) { ?>
            <li>
                <a href="<?php echo site_url('news/index?c='  . $category['id']); ?>">
                    <?php echo $category['name']; ?>
                </a>
            </li>
        <?php }
        ?>

    </ul>
</div>