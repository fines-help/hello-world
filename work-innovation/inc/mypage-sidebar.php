<div class="l-sub">

  <aside class="sub-section" style="margin-left: 2.4rem; margin-top:0;">

    <div class="search-result-page" style="margin-bottom: 0;">
      <h2 class="ttl-e" style="margin-bottom: 0; text-align: center;">コンテンツ検索</h2>
      <form method="get" id="refine-search-form" action="<?php echo esc_url(home_url('/')); ?>" style="border: solid 2px #f3e2e3;">
        <div class="refine-search" style="width: 100%; margin-bottom: 0; background-color: #fff;">
          <label for=" refine-search-selector">カテゴリー</label>
          <div class="refine-search-select" style="margin-right: 0;">
            <select id="refine-search-selector" name="post_type" class="mod-select" style="width: 26rem;">
              <option value="">すべてのカテゴリー</option>
              <option value="column" <?php if (!empty($post_type) && $post_type === 'column') {
                                        echo 'selected';
                                      } ?>>コラム</option>
              <option value="qa" <?php if (!empty($post_type) && $post_type === 'qa') {
                                    echo 'selected';
                                  } ?>>会員相談ひろば</option>
              <option value="doc" <?php if (!empty($post_type) && $post_type === 'doc') {
                                    echo 'selected';
                                  } ?>>書式テンプレート</option>
              <option value="video" <?php if (!empty($post_type) && $post_type === 'video') {
                                      echo 'selected';
                                    } ?>>解説動画</option>
              <option value="seminar" <?php if (!empty($post_type) && $post_type === 'seminar') {
                                        echo 'selected';
                                      } ?>>オンラインセミナー</option>
            </select>
          </div>
          <label for="refine-search-form">キーワード</label><br>
          <div class="mypage-search">
            <input type="search" id="refine-search-form" class="search-form" style="border: 1px solid #BABABA;" value="<?php echo get_search_query(); ?>" name="s">
            <button type="submit" class="search-button"><i class="las la-search"></i><span class="screen-reader-text">検索</span></button>
          </div>

          <!-- / .refine-search -->
        </div>
      </form>
    </div>



    <h2 class="ttl-h" style="margin-top: 20px; margin-bottom: 15px; font-size: 2.3rem;">コンテンツ一覧<small class="font-en" style="font-size: 1.3rem">CONTENTS</small></h2>

    <div class="mypage-block" style="border: solid 2px #D17DA2;">
      <a href="<?php echo esc_url(home_url('/mypage/qa-form/')); ?>" style="padding: 3rem;">
        会員相談ひろばへ投稿
      </a>
    </div>
    <h3 class="ttl-e ttl-side-1" style="margin-top: 1.15385em; margin-bottom: 0;">会員相談ひろば</h3>
    <div class="cat-item cat-item-46" style="text-align: center; padding: 0.55556em 1.11111em 0.61111em 1.11111em; background-color: #F5F5F5;">↓回答はコチラ↓</div>
    <ul id="js-wp-toggle" class="list-categories">
      <?php // タームの一覧を表示
      $catlist = wp_list_categories(array(
        'taxonomy' => 'qa_cat',
        'title_li' => '',
      ));
      echo $catlist; // タームの一覧を表示
      ?>
    </ul>
    <h3 class="ttl-e ttl-side-2" style="margin-top: 1.15385em; margin-bottom: 0;">コラム</h3>
    <ul id="js-wp-toggle" class="list-categories">
      <?php // タームの一覧を表示
      $catlist = wp_list_categories(array(
        'taxonomy' => 'column_cat',
        'title_li' => '',
      ));
      echo $catlist; // タームの一覧を表示
      ?>
    </ul>
    <h3 class="ttl-e ttl-side-3" style="margin-top: 1.15385em; margin-bottom: 0;">解説動画</h3>
    <ul id="js-wp-toggle" class="list-categories">
      <?php // タームの一覧を表示
      $catlist = wp_list_categories(array(
        'taxonomy' => 'video_cat',
        'title_li' => '',
      ));
      echo $catlist; // タームの一覧を表示
      ?>
    </ul>
    <h3 class="ttl-e ttl-side-4" style="margin-top: 1.15385em; margin-bottom: 0;">書式テンプレート</h3>
    <ul id="js-wp-toggle" class="list-categories">
      <!--
!!! 開発者確認用コメント !!!
wp_list_categories での実装を想定
-->
      <?php // タームの一覧を表示
      $catlist = wp_list_categories(array(
        'taxonomy' => 'doc_cat',
        'title_li' => '',
      ));
      echo $catlist; // タームの一覧を表示
      ?>
    </ul>
    <!-- / .sub-section -->
  </aside>
  <!-- /.l-sub -->
</div>
<style>
  .mypage-search {
    display: flex;
    align-items: center;
    width: 100%;
  }

  .mypage-search .search-form {
    width: calc(100% - 4rem);
    height: 4rem;
    padding: 0.55556em;
    border: none;
    border-radius: .5rem 0 0 .5rem;
    background-color: #fff;
    font-size: 1.8rem;
    line-height: 1;
    outline: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }

  .mypage-search .search-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 4rem;
    height: 4rem;
    padding: 0;
    border: none;
    border-radius: 0 .5rem .5rem 0;
    background-color: #D17DA2;
    color: #fff;
    font-size: 2.4rem;
    line-height: 1;
    transition: 0.4s ease 0s;
  }
</style>