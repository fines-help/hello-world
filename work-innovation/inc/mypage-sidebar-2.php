<div class="l-sub">

  <aside class="sub-section" style="margin-left: 2.4rem; margin-top:0;">
    <div class="history" style="border: solid 2px #f3e2e3;">
      <h3 class="ttl-e" style="text-align: center; background-color: #f3e2e3;">ご利用情報</h3>
      <p style="text-align: center;">現在の会員プラン</p>
      <p class="ttl-a bg-b" style="border-left:none;text-align: center; background-color: #fff;">
        <?php echo do_shortcode('[swpm_show_member_info column = "membership_level_name"]'); ?></p>
    </div>

    <h2 class="ttl-h" style="margin-bottom: 0; font-size: 2.3rem;">おすすめのキーワード<small class="font-en" style="font-size: 1.3rem">KEYWORDS</small></h2>
    <h3 class="ttl-e ttl-side-1" style="margin-top: 1.15385em; font-size: 2.5rem;">会員相談ひろば</h3>
    <ul class="list-tags"></ul>

    <h3 class="ttl-e ttl-side-2" style="margin-top: 1.15385em;">コラム</h3>
    <ul class="list-tags">
      <li><a href="<?php echo home_url(); ?>/contents/column_tag/career-path/">キャリアパス</a></li>
      <li><a href="<?php echo home_url(); ?>/contents/column_tag/harassment/">ハラスメント</a></li>
      <li><a href="<?php echo home_url(); ?>/contents/column_tag/%e4%bc%91%e6%86%a9%e6%99%82%e9%96%93/">休憩時間</a></li>
    </ul>

    <h3 class="ttl-e ttl-side-3" style="margin-top: 1.15385em;">解説動画</h3>
    <ul class="list-tags list-tags-movie">
      <li><a class="red" href="<?php echo home_url(); ?>/contents/video_tag/%e4%bc%81%e6%a5%ad%e4%b8%bb%e5%b0%8e%e5%9e%8b/">企業主導型</a></li>
      <li><a class="brown" href="<?php echo home_url(); ?>/contents/video_tag/%e4%bf%9d%e8%82%b2%e5%a3%ab/">保育士</a></li>
      <li><a href="<?php echo home_url(); ?>/contents/video_tag/%e5%a6%8a%e5%a8%a0%e3%83%bb%e7%94%a3%e8%82%b2%e4%bc%91/">妊娠・産育休</a></li>
      <li><a href="<?php echo home_url(); ?>/contents/video_tag/%e5%b9%b4%e5%ba%a6%e6%9b%b4%e6%96%b0/">年度更新</a></li>
      <li><a href="<?php echo home_url(); ?>/contents/video_tag/%e7%b5%a6%e4%b8%8e%e3%83%bb%e8%b3%9e%e4%b8%8e/">給与・賞与</a></li>
      <li><a href="<?php echo home_url(); ?>/contents/video_tag/%e8%a6%8f%e5%89%87%e3%83%bb%e8%a6%8f%e7%a8%8b/">規則・規程</a></li>
    </ul>
    <style>
      .list-tags-movie .red {
        border: 1px solid #BA4153;
        background-color: #fff;
        color: #BA4153;
      }

      .list-tags-movie .red:hover {
        border: 1px solid #fff;
        background-color: #BA4153;
        color: #fff;
      }

      .list-tags-movie .brown {
        border: 1px solid #D09F44;
        background-color: #fff;
        color: #D09F44;
      }

      .list-tags-movie .brown:hover {
        border: 1px solid #fff;
        background-color: #D09F44;
        color: #fff;
      }
    </style>

    <h3 class="ttl-e ttl-side-4" style="margin-top: 1.15385em;">書式テンプレート</h3>
    <ul class="list-tags">
      <li><a href="/contents/doc_tag/%e4%ba%8b%e6%95%85/">事故</a></li>
      <li><a href="/contents/doc_tag/%e7%81%bd%e5%ae%b3/">災害</a></li>
    </ul>

    <!-- / .sub-section -->
    <div class="history" style="border: solid 2px #f3e2e3; margin-top: 2.15385em;">
      <h2 class="ttl-e" style="background-color: #f3e2e3; text-align: center;">リンク</h2>
      <p style="margin: 1em; text-align: center;">労働管理にまつわる<br>役立つ情報を配信中</p>
      <div style="display: flex; flex-wrap:wrap; justify-content: space-between;">
        <div style="width: 47%; margin: 1%;"><a href="https://www.facebook.com/hoikuinnovation"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/bnr_facebook.png" alt=""></a></div>
        <div style="width: 47%; margin: 1%;"><a href="https://note.com/workinnovation"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/bnr_Note.png" alt=""></a></div>
        <div style="width: 47%; margin: 1%;"><a href="https://twitter.com/work_innov"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/bnr_Twitter.png" alt=""></a></div>
      </div>

    </div>
  </aside>
  <!-- /.l-sub -->
</div>
<style>
  aside {
    margin: 2%;
  }

  @media only screen and (max-width: 959px) {
    .l-sub {

      display: none;
    }
    .l-contents .l-main {
      max-width: 95%;
    }
  }

  .ttl-e {
    padding-left: 0.5em;
  }

  .ttl-e::before {
    background: none;
    top: 0;
    left: 0;
    transform: none;
    position: relative;
  }

  .ttl-side-1::before {
    content: '';
    display: inline-block;
    width: 40px;
    height: 40px;
    background: url(/wp/wp-content/themes/work-innovation/assets/img/home/ico_contents_02.svg);
    background-size: contain;
    vertical-align: middle;
  }

  .ttl-side-2::before {
    content: '';
    display: inline-block;
    width: 40px;
    height: 40px;
    background: url(/wp/wp-content/themes/work-innovation/assets/img/home/ico_contents_01.svg);
    background-size: contain;
    vertical-align: middle;
  }

  .ttl-side-3::before {
    content: '';
    display: inline-block;
    width: 40px;
    height: 40px;
    background: url(/wp/wp-content/themes/work-innovation/assets/img/home/ico_contents_04.svg);
    background-size: contain;
    vertical-align: middle;
  }

  .ttl-side-4::before {
    content: '';
    display: inline-block;
    width: 40px;
    height: 40px;
    background: url(/wp/wp-content/themes/work-innovation/assets/img/home/ico_contents_03.svg);
    background-size: contain;
    vertical-align: middle;
  }
</style>