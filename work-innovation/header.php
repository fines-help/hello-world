<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="x-dns-prefetch-control" content="on">
  <link rel="preconnect dns-prefetch" href="//www.googletagmanager.com">
  <!-- <link rel="preconnect dns-prefetch" href="//www.google-analytics.com"> -->
  <link rel="preconnect dns-prefetch" href="//fonts.gstatic.com">
  <link rel="preconnect dns-prefetch" href="//ajax.googleapis.com">
  <link rel="preconnect dns-prefetch" href="//code.jquery.com">
  <!-- <link rel="preconnect dns-prefetch" href="//use.fontawesome.com"> -->
  <link rel="preconnect dns-prefetch" href="//maxst.icons8.com">

  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-MSXVKZC');
  </script>
  <!-- End Google Tag Manager -->

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="format-detection" content="telephone=no">
  <link rel="shortcut icon" type="image/vnd.microsoft.ico" href="/favicon.ico">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/swpm.common.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/swpm-form-builder.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jquery-ui-1.10.3.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/toc-screen.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/styles.css">
  <?php if(is_page('mypage')){ ;?>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/mypage.css">
  <?php } ?>

  <!-- [[ SCRIPTS ]] -->
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
  <script>
    // Google Font
    WebFont.load({
      google: {
        families: ['Noto Sans JP:400,500,700', 'Oswald:400,500,600']
      }
    });
  </script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/polyfill/picturefill.min.js" async></script>

  <!-- / [[ SCRIPTS ]] -->
  <?php wp_head(); ?>

  <style>
    .swpm-text-field{
      border-width: 1px;
      border-style: inset;
      border-color: rgb(118, 118, 118);
      border-image: initial;
    }
  </style>
</head>

<body id="top" class="<?php echo page_slug_class(); ?>">


  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MSXVKZC" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->


  <div class="l-page-container">

    <!-- [[ DRAWER-MENU-AREA ]] -->
    <?php get_template_part('inc/header', 'drawer'); ?>
    <!-- / [[ DRAWER-MENU-AREA ]] -->


    <!-- [[ HEADER-AREA ]] -->
    <header id="js-header" class="l-header">
      <div class="header">
        <div class="header-logo">

          <?php if (is_front_page()) : ?>
              <h1 class="sitename"><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/logo_hoikuinnovation_01.svg" alt="保育イノベーション" width="346" height="36"></a></h1>

          <?php else : ?>
            <p class="sitename"><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/logo_hoikuinnovation_01.svg" alt="保育イノベーション" width="346" height="36"></a></p>
          <?php endif; ?>

          <p class="companylogo">
            <a href="https://workinnovation.co.jp/" target="_blank"><span class="font-en">Powered by</span>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/logo_workinnovation_01.svg" alt="社会保険労務士法人 ワーク・イノベーション" width="231" height="21"></a>
          </p>
          <!-- / .header-logo -->
        </div>

        <nav class="header-nav">
          <ul class="header-nav-menu">
            <?php if (!(SwpmMemberUtils::is_member_logged_in())) : ?>
              <li><span class="has-child">初めての方へ</span>
                <ul class="header-nav-submenu">
                  <li><a href="<?php echo esc_url(home_url('/about/')); ?>">保育イノベーションとは</a></li>
                  <li><a href="<?php echo esc_url(home_url('/guide/')); ?>">ご利用方法</a></li>
                  <li><a href="<?php echo esc_url(home_url('/check/')); ?>">保育労務の課題チェック</a></li>
                  <li><a href="<?php echo esc_url(home_url('/operator/')); ?>">運営法人について</a></li>
                </ul>
              </li>
            <?php endif; ?>
            <li><a href="<?php echo esc_url(home_url('/plan/')); ?>">料金プラン</a></li>
            <li><span class="has-child">コンテンツ</span>
              <ul class="header-nav-submenu">
                <li><a href="<?php echo esc_url(home_url('/contents/column/')); ?>">コラム</a></li>
                <li><a href="<?php echo esc_url(home_url('/contents/qa/')); ?>">会員相談ひろば</a></li>
                <li><a href="<?php echo esc_url(home_url('/contents/doc/')); ?>">書式テンプレート</a></li>
                <li><a href="<?php echo esc_url(home_url('/contents/video/')); ?>">解説動画</a></li>
                <li><a href="<?php echo esc_url(home_url('/contents/seminar/')); ?>">オンラインセミナー/研修</a></li>
              </ul>
            </li>
            <li><a href="<?php echo esc_url(home_url('/news/')); ?>">お知らせ</a></li>
          </ul>
          <!-- / .header-nav -->
        </nav>
        <div class="header-search">
          <form role="search" method="get" action="/">
            <div class="header-search-inner">
              <label for="header-search-form" class="js-search-toggle"><i class="las la-search"></i><span class="screen-reader-text">サイト内検索</span></label>
              <input type="search" id="header-search-form" class="header-search-field" style="background-color: #FFF;" value="" name="s">
              <button type="submit" class="header-search-button"><i class="las la-search"></i><span class="screen-reader-text">検索</span></button>
            </div>
          </form>
          <!-- / .header-search -->
        </div>

        <div class="header-members">
          <ul class="header-members-menu">
            <?php if (SwpmMemberUtils::is_member_logged_in()) : ?>
              <?php
              $user = do_shortcode('[swpm_show_member_info column="user_name"]');
              ?>
              <li><span class="name-tag"><span class="msg">ようこそ</span><span class="name"><?php echo $user; ?><small>さん</small></span></span></li>
              <li>
                <ul class="header-nav-menu" style="width: 100%;">
                  <li class="header-nav-menu-content" style="width: 100%;">
                    <a href="<?php echo esc_url(home_url('/mypage/')); ?>" class="btn btn-mypage">マイページ</a>
                    <ul class="header-nav-submenu">
                      <li style="font-size:0.8vw;"><a href="<?php echo esc_url(home_url('/mypage/profile/')); ?>">プロフィールの変更</a></li>
                      <li style="font-size:0.8vw;"><a href="<?php echo esc_url(home_url('/login/forgot/')); ?>">パスワード変更</a></li>
                      <li style="font-size:0.8vw;" class="gray-out"><a href="" style="pointer-events: none;">有料プランのご利用</a></li>
                      <li style="font-size:0.8vw;"><a href="<?php echo esc_url(home_url('/mypage/payment/')); ?>">お支払い情報・契約内容確認</a></li>
                      <li style="font-size:0.8vw;"><a href="<?php echo esc_url(home_url('/mypage/cancellation/')); ?>">退会手続き</a></li>
                      <li style="font-size:0.8vw;"><a href="?swpm-logout=true">ログアウト</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <style>
                .l-header .header-nav-menu>.header-nav-menu-content>a:before {
                  font-weight: normal;
                }
                .l-header .header-nav-menu-content .header-nav-submenu {
                  left: -100%;
                }
              </style>

            <?php else : ?>
              <li><a href="<?php echo esc_url(home_url('/signup/')); ?>" class="btn btn-registration">会員登録</a></li>
              <li><a href="<?php echo esc_url(home_url('/login/')); ?>" class="btn btn-login">ログイン</a></li>
            <?php endif; ?>
          </ul>
          <!-- / .header-members -->
        </div>
        <button type="button" class="hamburger-button js-drawer-trigger" aria-expanded="false" aria-controls="drawer">
          <span class="hamburger-button-bar">
            <span class="hamburger-button-text">MENU</span>
          </span>
        </button>

        <!-- / .header -->
      </div>
      <!-- / .l-header -->
    </header>

    <!-- / [[ HEADER-AREA ]] -->


    <!-- [[ HEADER-AREA ]] -->
    <header class="siteHeader">


      <!-- / .siteHeader -->
    </header>