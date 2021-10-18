<!-- [[ FOOTER-AREA ]] -->

<footer class="l-footer">
  <div class="footer">
    <p class="footer-gotop"><a href="#top" class="js-scroll"><span class="screen-reader-text">このページの先頭へ</span></a></p>

    <div class="footer-top">
      <div class="l-row">

        <div class="l-col-lg-3 l-col-md-3 l-col-sm-6">
          <h2 class="footer-nav-title">初めての方へ</h2>
          <ul class="footer-nav-menu">
            <li><a href="<?php echo esc_url(home_url('/news/')); ?>">お知らせ</a></li>
            <li><a href="<?php echo esc_url(home_url('/about/')); ?>">保育イノベーションとは</a></li>
            <li><a href="<?php echo esc_url(home_url('/guide/')); ?>">ご利用方法</a></li>
            <li><a href="<?php echo esc_url(home_url('/plan/')); ?>">料金プラン</a></li>
            <li><a href="<?php echo esc_url(home_url('/check/')); ?>">保育労務の課題チェック</a></li>
          </ul>
        </div>

        <div class="l-col-lg-3 l-col-md-3 l-col-sm-6">
          <h2 class="footer-nav-title">情報を探す</h2>
          <ul class="footer-nav-menu">
            <li><a href="<?php echo esc_url(home_url('/contents/column/')); ?>">コラム</a></li>
            <li><a href="<?php echo esc_url(home_url('/contents/qa/')); ?>">会員相談ひろば</a></li>
            <li><a href="<?php echo esc_url(home_url('/contents/doc/')); ?>">書式テンプレート</a></li>
            <li><a href="<?php echo esc_url(home_url('/contents/video/')); ?>">解説動画</a></li>
            <li><a href="<?php echo esc_url(home_url('/contents/seminar/')); ?>">オンラインセミナー/研修</a></li>
          </ul>
        </div>

        <div class="l-col-lg-3 l-col-md-3 l-col-sm-6">
          <h2 class="footer-nav-title">運営について</h2>
          <ul class="footer-nav-menu">
            <li><a href="<?php echo esc_url(home_url('/operator/')); ?>">運営法人について</a></li>
            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">お問い合わせ</a></li>
            <li><a href="<?php echo esc_url(home_url('/terms/')); ?>">利用規約</a></li>
            <li><a href="<?php echo esc_url(home_url('/privacy/')); ?>">個人情報取扱方針</a></li>
            <li><a href="<?php echo esc_url(home_url('/law/')); ?>">特定商取引法に基づく表記</a></li>
          </ul>
        </div>

        <div class="l-col-lg-3 l-col-md-3 l-col-sm-6">
          <h2 class="footer-nav-title">サイト内検索</h2>
          <div class="footer-search">
            <form role="search" method="get" action="/">
              <div class="footer-search-inner">
                <input type="search" id="footer-search-form" class="footer-search-field" value="" name="s" placeholder="処遇改善">
                <button type="submit" class="footer-search-button"><i class="las la-search"></i><span class="screen-reader-text">検索</span></button>
              </div>
            </form>
            <!-- / .footer-search -->
          </div>

          <?php if (!SwpmMemberUtils::is_member_logged_in()) : ?>
            <div class="footer-members">
              <ul class="footer-members-menu">
                <li><a href="<?php echo esc_url(home_url('/signup/')); ?>" class="btn btn-registration">会員登録</a></li>
                <li><a href="<?php echo esc_url(home_url('/login/')); ?>" class="btn btn-login">ログイン</a></li>
              </ul>
              <!-- / .footer-members -->
            </div>
          <?php endif; ?>
            
　　　　　　<div class="drawer-sns">
<p class="drawer-sns-title">労務管理にまつわる役立つ情報を配信中。</p>
<ul class="drawer-sns-list">
<li><a href="https://twitter.com/work_innov" target="_blank"><svg style="width: 23px; height: 23px;" viewBox="0 0 30 24.375" class="ico-twitter"><title>Twitter</title><use xlink:href="#ico-sns-twitter"></use></svg></a></li>
<li><a href="https://note.com/workinnovation" target="_blank"><svg style="width: 23px; height: 23px;" viewBox="0 0 21.652 24.375" class="ico-note"><title>note</title><use xlink:href="#ico-sns-note"></use></svg></a></li>
<li>
    <a href="https://www.facebook.com/hoikuinnovation" target="_blank">
      <img width="23px" style="margin-bottom:3px ;" src="https://hoiku-innovation.com/wp/wp-content/themes/work-innovation/assets/img/common/facebook.png" alt="">
    </a>
</li>
</ul>
<!-- / .drawer-sns --></div>
        </div>

      </div>
      <!-- / .footer-top -->
    </div>

    <div class="footer-bottom">
      <div class="l-container">

        <p class="companylogo">
          <a href="https://workinnovation.co.jp/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/logo_workinnovation_01.svg" alt="社会保険労務士法人 ワーク・イノベーション" width="345" height="31"></a>
        </p>

        <dl class="address">
          <dt>社会保険労務士法人ワーク・イノベーション</dt>
          <dd>〒224-0041　<br class="br-sp">横浜市都筑区仲町台1丁目2-20フロンティアビル6F</dd>
        </dl>

        <p class="footer-copyright"><small>Copyright &copy; Work Innovation. All Rights Reserved.</small></p>

      </div>
      <!-- / .footer-bottom -->
    </div>

    <!-- / .footer -->
  </div>
  <!-- / .l-footer -->
</footer>

<!-- / [[ FOOTER-AREA ]] -->
<!-- / .l-page-container -->
</div>


<!-- [[ SVGs ]] -->
<svg display="none" class="svg-symbols" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
  <defs>

    <symbol id="ico-sns-twitter" viewBox="0 0 30 24.375">
      <path d="M35-24.3a12.6,12.6,0,0,1-3.516.977,6.5,6.5,0,0,0,1.641-1.465,6.134,6.134,0,0,0,1.055-1.973,12.576,12.576,0,0,1-3.906,1.523,5.915,5.915,0,0,0-2.031-1.445,6.124,6.124,0,0,0-2.461-.508,6.015,6.015,0,0,0-3.086.82,6.192,6.192,0,0,0-2.246,2.246,5.939,5.939,0,0,0-.84,3.066,6.124,6.124,0,0,0,.156,1.406,16.652,16.652,0,0,1-7.109-1.914A17.24,17.24,0,0,1,7.07-26.055a6.015,6.015,0,0,0-.82,3.086,6.047,6.047,0,0,0,.742,2.93,5.978,5.978,0,0,0,1.992,2.188,5.78,5.78,0,0,1-2.773-.781v.078a5.978,5.978,0,0,0,1.406,3.926A6.005,6.005,0,0,0,11.133-12.5a6.578,6.578,0,0,1-1.6.2,8.857,8.857,0,0,1-1.172-.078,6,6,0,0,0,2.168,3.027A5.994,5.994,0,0,0,14.1-8.125a12.763,12.763,0,0,1-3.555,1.953,11.9,11.9,0,0,1-4.062.7Q5.742-5.508,5-5.586A17.24,17.24,0,0,0,9.453-3.555a16.838,16.838,0,0,0,4.961.742,17.63,17.63,0,0,0,7.539-1.6,16.433,16.433,0,0,0,5.469-4.1,18.153,18.153,0,0,0,3.4-5.625,17.8,17.8,0,0,0,1.133-6.172l-.039-.82A11.891,11.891,0,0,0,35-24.3Z" transform="translate(-5 27.188)" fill="currentColor" />
    </symbol>

    <symbol id="ico-sns-note" viewBox="0 0 21.648 24.37">
      <g transform="translate(-116.5 -106)">
        <path d="M124.782,114.257v-1.864a1.836,1.836,0,0,1,.07-.627,1.238,1.238,0,0,1,2.341,0,1.831,1.831,0,0,1,.07.627v2.874a2.371,2.371,0,0,1-.035.505,1.275,1.275,0,0,1-.926.923,2.4,2.4,0,0,1-.507.035h-2.883a1.848,1.848,0,0,1-.629-.07,1.231,1.231,0,0,1,0-2.334,1.848,1.848,0,0,1,.629-.07Zm10.274,13.03H119.593V113.708a.6.6,0,0,1,.183-.444l4.01-4a.608.608,0,0,1,.446-.183h10.824Zm1.756-21.269a3.282,3.282,0,0,0-.384-.017H123.821c-.14,0-.279.009-.376.017a2.439,2.439,0,0,0-1.5.732l-4.691,4.677a2.426,2.426,0,0,0-.734,1.5c-.009.1-.018.235-.018.374v15.355a3.206,3.206,0,0,0,.018.383,1.554,1.554,0,0,0,1.319,1.315,3.237,3.237,0,0,0,.384.018h18.206a3.234,3.234,0,0,0,.384-.018,1.554,1.554,0,0,0,1.319-1.315,3.287,3.287,0,0,0,.017-.383V107.716a3.287,3.287,0,0,0-.017-.383A1.554,1.554,0,0,0,136.811,106.017Z" fill="currentColor" fill-rule="evenodd" />
      </g>
    </symbol>

    <symbol id="ico-arrow-right" viewBox="0 0 22.002 21.998">
      <g transform="translate(-1387 -609.614)">
        <path d="M22102,8137a10.962,10.962,0,1,1,4.281-.864A10.935,10.935,0,0,1,22102,8137Zm0-21.387a10.388,10.388,0,1,0,7.348,3.042A10.332,10.332,0,0,0,22102,8115.613Z" transform="translate(-20704 -7505.388)" fill="currentColor" />
        <g transform="translate(1390.057 620.604) rotate(-45)">
          <path d="M0,7.944v-.61H7.331V0h.613V7.944Z" fill="currentColor" />
        </g>
      </g>
    </symbol>

    <symbol id="ico-arrow-left" viewBox="0 0 21.928 21.925">
      <path d="M22102.039,8137a10.96,10.96,0,1,0-4.283-.863A10.96,10.96,0,0,0,22102.039,8137Zm0-21.387a10.389,10.389,0,1,1-7.346,3.044,10.389,10.389,0,0,1,7.346-3.044Z" transform="translate(-22091.057 -8115.075)" fill="currentColor" />
      <g transform="translate(13.308 16.534) rotate(-135)">
        <path d="M0,0V.61H7.331V7.944h.613V0Z" fill="currentColor" />
      </g>
    </symbol>

  </defs>
</svg>

<!-- / [[ SVGs ]] -->


<!-- [[ SCRIPTS ]] -->
<?php wp_footer(); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/libs/jquery-3.5.1.min.js"><\/script>')
</script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js"></script>

<!-- / [[ SCRIPTS ]] -->

</body>

</html>