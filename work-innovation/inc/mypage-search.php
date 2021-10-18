<!-- [[ CONTENT-AREA ]] -->
<div class="search-result-page">
  <form method="get" id="refine-search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="refine-search">
      <div class="refine-search-select">
        <label for="refine-search-selector">カテゴリー</label>
        <select id="refine-search-selector" name="post_type" class="mod-select">
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
      <div class="refine-search-keyword">
        <label for="refine-search-form">キーワード</label>
        <input type="search" id="refine-search-form" class="mod-input-text" value="<?php echo get_search_query(); ?>" name="s">
        <button type="submit" class="btn btn-a">検索<i class="las la-search"></i></button>
      </div>
      <!-- / .refine-search -->
    </div>
  </form>
</div>