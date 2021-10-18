<div class="l-bread-crumbs">
<ul class="bread-crumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList">
<?php 
    if( '/news/' == $_SERVER['REQUEST_URI']){
        echo '<li class="home" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
<a itemprop="item" href="/"><span itemprop="name">トップ</span></a>
<meta itemprop="position" content="1">
</li>
<li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
<span itemprop="name">お知らせ</span>
<meta itemprop="position" content="2">
</li>';
    }elseif(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</ul>
<!-- /.l-bread-crumbs --></div>
