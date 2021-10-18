<div id="js-drawer" class="l-drawer">
<div class="drawer-wrapper">

<div class="drawer-inner">
<nav class="drawer-nav">

<div class="drawer-members">
<?php if(SwpmMemberUtils::is_member_logged_in()): ?>
<?php
  $user = do_shortcode('[swpm_show_member_info column="user_name"]');
?>
<ul class="drawer-members-menu is-login">
<li><span class="name-tag"><span class="msg">ようこそ</span><span class="name"><?php echo $user; ?> <small>さん</small></span></span></li>
<li><a href="<?php echo esc_url( home_url( '/mypage/' ) ); ?>" class="btn btn-mypage">マイページ</a></li>
</ul>
<?php else: ?>
<ul class="drawer-members-menu">
<li><a href="<?php echo esc_url( home_url( '/signup/' ) ); ?>" class="btn btn-registration">会員登録</a></li>
<li><a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="btn btn-login">ログイン</a></li>
</ul>
<?php endif; ?>
<!-- / .drawer-members --></div>

<div class="drawer-search">
<form role="search" method="get" action="/">
<div class="drawer-search-inner">
<input type="search" id="drawer-search-form" class="drawer-search-field" value="" name="s" placeholder="処遇改善">
<button type="submit" class="drawer-search-button"><i class="las la-search"></i><span class="screen-reader-text">検索</span></button>
</div>
</form>
<!-- / .drawer-search --></div>

<div class="drawer-menu">
<ul class="drawer-nav-menu">
<?php if(SwpmMemberUtils::is_member_logged_in()): ?>
<li><span class="has-child js-toggle">マイページ関連</span>
  <ul class="drawer-nav-submenu">
    <li><a href="<?php echo esc_url(home_url('/mypage/profile/')); ?>">プロフィールの変更</a></li>
    <li><a href="<?php echo esc_url(home_url('/login/forgot/')); ?>">パスワード変更</a></li>
    <li><a href="" style="pointer-events: none;">有料プランのご利用</a></li>
    <li><a href="<?php echo esc_url(home_url('/mypage/payment/')); ?>">お支払い情報・契約内容確認</a></li>
    <li><a href="<?php echo esc_url(home_url('/mypage/cancellation/')); ?>">退会手続き</a></li>
    <li><a href="?swpm-logout=true">ログアウト</a></li>
  </ul>
</li>
<?php else: ?>
<li><span class="has-child js-toggle">初めての方へ</span>
  <ul class="drawer-nav-submenu">
  <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">保育イノベーションとは</a></li>
  <li><a href="<?php echo esc_url( home_url( '/guide/' ) ); ?>">ご利用方法</a></li>
  <li><a href="<?php echo esc_url( home_url( '/check/' ) ); ?>">課題チェック</a></li>
  </ul>
</li>
<?php endif; ?>

<li><a href="<?php echo esc_url( home_url( '/plan/' ) ); ?>">料金プラン</a></li>
<li><span class="has-child js-toggle">情報を探す</span>
  <ul class="drawer-nav-submenu">
  <li><a href="<?php echo esc_url( home_url( '/contents/column/' ) ); ?>">コラム</a></li>
  <li><a href="<?php echo esc_url( home_url( '/contents/qa/' ) ); ?>">会員相談ひろば</a></li>
  <li><a href="<?php echo esc_url( home_url( '/contents/doc/' ) ); ?>">書式テンプレート</a></li>
  <li><a href="<?php echo esc_url( home_url( '/contents/video/' ) ); ?>">解説動画</a></li>
  <li><a href="<?php echo esc_url( home_url( '/contents/seminar/' ) ); ?>">オンラインセミナー/研修</a></li>
  </ul>
</li>
<li><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">お知らせ</a></li>
</ul>
<!-- / .drawer-menu --></div>

<div class="drawer-utility">
<p class="drawer-utility-title">運営について</p>
<ul class="drawer-utility-menu">
<li><a href="<?php echo esc_url( home_url( '/operator/' ) ); ?>">運営法人について</a></li>
<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問い合わせ</a></li>
<li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">利用規約</a></li>
<li><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">個人情報取扱方針</a></li>
<li><a href="<?php echo esc_url( home_url( '/law/' ) ); ?>">特定商取引法に基づく表記</a></li>
</ul>
<!-- / .drawer-utility --></div>

<!-- / .drawer-nav --></nav>

<div class="drawer-sns">
<p class="drawer-sns-title">労務管理にまつわる役立つ情報を配信中。</p>
<ul class="drawer-sns-list">
<li><a href="https://twitter.com/work_innov" target="_blank"><svg style="width: 23px; height: 23px;" viewBox="0 0 30 24.375" class="ico-twitter"><title>Twitter</title><use xlink:href="#ico-sns-twitter"></use></svg></a></li>
<li><a href="https://note.com/workinnovation" target="_blank"><svg style="width: 23px; height: 23px;" viewBox="0 0 21.652 24.375" class="ico-note"><title>note</title><use xlink:href="#ico-sns-note"></use></svg></a></li>
<li>
    <a href="https://www.facebook.com/hoikuinnovation">
      <img width="23px" style="margin-bottom:3px ;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/facebook.png" alt="">
    </a>
</li>
</ul>
<!-- / .drawer-sns --></div>

<button type="button" class="close-button js-drawer-trigger">
<span class="close-button-bar">
<span class="close-button-text">CLOSE</span>
</span>
</button>
<!-- / .drawer-inner --></div>
<!-- / .drawer-wrapper --></div>
<!-- / .l-drawer --></div>
