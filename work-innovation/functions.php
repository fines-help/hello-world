<?php
//********************************************************
// wp_head 出力設定
//********************************************************

// title を出力
add_theme_support( 'title-tag' );

// title 出力のセパレータ
function my_document_title_separator( $sep ) {
  $sep = '|';
  return $sep;
}
add_filter( 'document_title_separator', 'my_document_title_separator' );

// ログイン中の管理バーを非表示
add_filter( 'show_admin_bar', '__return_false' );

// WordPress バージョン出力削除
remove_action('wp_head', 'wp_generator');

// CSS出力削除
remove_action('wp_head', 'wp_print_styles', 8);

// コメント、カテゴリー フィード出力削除
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// 絵文字機能出力削除
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// ブログ投稿ツール出力削除
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// JSON等の Embed に関するコード出力削除
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');

// wp_head()でのjQuery取得を停止 　※プラグインによっては動作しなくなる恐れもある為、注意
function my_delete_local_jquery() {
  $post_name = get_post()->post_name;
  if( $post_name === 'contact'){
  //   // yubinbango
  wp_deregister_script('jquery');
  }

}

add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );

function dp_deregister_styles() {
  wp_dequeue_style('swpm-form-builder-css');
  wp_dequeue_style('swpm.common');
  wp_dequeue_style('toc-screen');
  wp_dequeue_style('swpm-jqueryui-css');
}
// アクションフック
add_action( 'wp_enqueue_scripts', 'dp_deregister_styles');

//********************************************************
// 関数独自拡張
//********************************************************

//--------------------------------------------------------
// クエリ取得件数を pre_get_posts アクションから変更
//--------------------------------------------------------
function change_posts_per_page($query) {
  // 管理画面以外かつメインクエリーを対象とする
  if ( ! is_admin() && $query->is_main_query() ) {
    // フロントページまたはホーム
    if ( $query->is_front_page() || $query->is_home() ) {
      $query->set( 'posts_per_page', '5');
    }
    // 年度・月別アーカイブまたはカテゴリーアーカイブ
    if ( $query->is_archive() || $query->is_category() ) {
      $query->set( 'posts_per_page', '10' );
    }
    // カスタム投稿タイプ - hogehoge アーカイブの時
    if ( $query->is_post_type_archive('hogehoge') ) {
      $query->set( 'posts_per_page', '10' );
    }
  }
}
add_action( 'pre_get_posts', 'change_posts_per_page' );


//--------------------------------------------------------
// 投稿記事内の相対パスを絶対パスに変換して出力（子テーマ参照）
//--------------------------------------------------------
function replaceImagePath($arg) {
$content = str_replace('"/assets/', '"' . get_stylesheet_directory_uri() . '/assets/', $arg);
return $content;
}
add_action('the_content', 'replaceImagePath');


//--------------------------------------------------------
// 投稿記事内の子テーマ内画像参照パスをショートコード化（[img]で書けるように）
//--------------------------------------------------------
// function shortcode_images() {
//   ob_start();
//   echo get_stylesheet_directory_uri();
//   $td = ob_get_clean();
//   return $td;
// }
// add_shortcode('img', 'shortcode_images');


//--------------------------------------------------------
// 全てのウィジェットのタイトルを非表示に
//--------------------------------------------------------
add_filter( 'widget_title', 'remove_widget_title_all' );
function remove_widget_title_all( $widget_title ) {
    return;
}


//--------------------------------------------------------
// メニューウィジェット
//--------------------------------------------------------
 register_nav_menu('menu', 'メニュー');

//--------------------------------------------------------
// ユーザープロフィールの項目のカスタマイズ
//--------------------------------------------------------
function my_user_meta($wb)
{
//項目の追加
$wb['user_history'] = '閲覧履歴';
return $wb;
}
add_filter('user_contactmethods', 'my_user_meta', 10, 1);

//--------------------------------------------------------
// 閲覧履歴を取得
//--------------------------------------------------------
add_action( 'get_header', 'set_hitory');
function set_hitory() {
  global $history;
  global $postid;
  $history = null;
  $set_this_ID = null;
  $userID = get_current_user_id();
  $postid = get_the_ID();
  // 呼び出し
  $history = get_the_author_meta('user_history', $userID);
}
//--------------------------------------------------------
// 閲覧履歴の書き込み
//--------------------------------------------------------

function db_history(){
  global $history;
  global $postid;
  $history = null;
  $set_this_ID = null;
  $userID = get_current_user_id(); //自身のユーザーID取得
  $postid = get_the_ID();
 
  //記事投稿ページならページID取得＆DB書き込み
  if(is_singular( array('doc', 'seminar','column','qa','video') )) { //もしカスタム投稿ならis_singular('カスタム投稿名')
    // 存在する場合DBお気に入りの値を呼び出し
    $history = explode(',', get_the_author_meta('user_history', $userID));
    // IDの登録が6個以上あったら5個までになるよう削除
    if(count($history) >= 6 ){
      $set_history = array_slice($history , 0, 5);
    } else {
      $set_history = $history;
    }
    // 既に投稿IDがお気に入りに存在しない場合は追加
    if (in_array($postid, $history)) {
   } else {
      // DBにある現在の記事IDを削除（順番整理＆表示除外用）
      $history = array_diff($history, array($postid));
      $history = array_values($history);
      $set_this_ID_history = $postid.','.implode(',', $set_history);
      update_user_meta( $userID, 'user_history', $set_this_ID_history);
    }
    // 呼び出し
    $history = get_the_author_meta('user_history', $userID);
  } else {
    // 呼び出し
    $history = get_the_author_meta('user_history', $userID);
  }
}

//--------------------------------------------------------
//membersShip のカスタムフィールドのCSS
//--------------------------------------------------------
function my_admin_style() {
	global $pagenow;
  if ( 'admin.php' === $pagenow ) {
        echo '<style>
  #swpm-16{
  width: 500px;
  height: 300px;
  }
  </style>';
  }
}
add_action('admin_print_styles', 'my_admin_style');

/* --------------------------------------------------
  yubinbango自動入力の設定
-------------------------------------------------- */

//応募フォームページなら
function my_scripts() {
  // $post_name = get_post()->post_name;
  // if( $post_name === 'career' || $post_name === 'partner' || $post_name === 'contact'){
  //   // yubinbango
    wp_enqueue_script( 'yubinbango', '//yubinbango.github.io/yubinbango/yubinbango.js', array(), null, true );
  // }
}
add_action( 'wp_enqueue_scripts', 'my_scripts');

//--------------------------------------------------------
// ページのスラッグを取得してclassに出力
//--------------------------------------------------------
function page_slug_class() {
  $slug = null;
  
  if ( is_page() ) {
    $page = get_post( get_the_ID() );
    $classes[] = $page->post_name;

    $parent_id = $page->post_parent;
    // if ( $parent_id ) {
    //   $classes[] = get_post( $parent_id )->post_name;
    // }
    $slug = implode( "", $classes );
    $slug = 'page-'.$slug;
  }

  if ( is_post_type_archive( 'member' ) || is_tax( 'member_cat' ) ) {
    $slug = 'member';
  } elseif ( is_archive() ) {
    $slug = 'news';
  }

  if ( is_singular( 'member' ) ) {
    $slug = 'member';
  } elseif ( is_singular( 'post' ) ) {
    $slug = 'news';
  }

  if ( is_404() ) {
    $slug =  'error-404';
  }

  if ( isset( $slug ) ){
    return $slug_class = $slug;
  }
}

//--------------------------------------------------------
// titleのセパレータを変更する
//--------------------------------------------------------
function change_separator() {
  return "|"; // ここに変更したい区切り文字を書く
}
add_filter('document_title_separator', 'change_separator');


//--------------------------------------------------------
// 退会ページの分岐 定期購読 /  ショートコード
//--------------------------------------------------------

function stripe_cancel( ) {
  if ( ! SwpmMemberUtils::is_member_logged_in() ) {
    //ログインしてない時
    return;
  }
  $member_id = SwpmMemberUtils::get_logged_in_members_id();

  $subs = new SWPM_Member_Subscriptions( $member_id );

  if ( empty( $subs->get_active_subs_count() ) ) {
    //なに定期購入していない時
    echo '<div class="cancel_sub member-rank">';
  }else{
    echo '<div class="cancel_sub">';
  }
}
add_shortcode('subsc', 'stripe_cancel');


//--------------------------------------------------------
// 退会ページの分岐 アカウント削除 ショートコード
//--------------------------------------------------------

// function subscription_func() {
  
//   $member_level = SwpmMemberUtils :: get_logged_in_members_level(); //会員レベルの取得

//   if( $member_level == '2'){

//   }
// }
// add_shortcode('subsc', 'subscription_func');


//--------------------------------------------------------
// カスタム投稿 メインループの制御
//--------------------------------------------------------


function my_query( $query ) {

  if ( is_post_type_archive( ) ) {
    $query->set( 'posts_per_page', 10 );
  }
  return $query;
}
add_filter( 'pre_get_posts', 'my_query' );


//--------------------------------------------------------
// アイキャッチ画像サイズ
//--------------------------------------------------------

add_theme_support('post-thumbnails');
add_image_size('thumbnailseminer',1074, 525, true);
add_image_size('thumbnailcolumn',680, 450, true);
add_image_size('thumbnailsquare',365, 365, true);

//--------------------------------------------------------
// 日付フォーマット
//--------------------------------------------------------

function dateformat($field_name, $format_status = 'default')
{ $week = array('日', '月', '火', '水', '木', '金', '土');

  if ($format_status === 'jp') {
    $format = 'Y年n月j日';
  } else {
    $format = 'Y/n/j';
  }

  if (date_create($field_name)) {
    $date = date_create($field_name);
  } else { //カスタムフィールドだったらfalseが帰ってくる
    $date = date_create(get_field($field_name));
  }

  echo date_format($date, $format) . '（' . $week[(int) date_format($date, 'w')] . '）';
}


function dateonly($field_name)
{ 
  $format = 'Y.n.j';

  if (date_create($field_name)) {
    $date = date_create($field_name);
  } else { //カスタムフィールドだったらfalseが帰ってくる
    $date = date_create(get_field($field_name));
  }

  echo date_format($date, $format);
}

function weekformat($field_name)
{ $week = array('日', '月', '火', '水', '木', '金', '土');


  if (date_create($field_name)) {
    $date = date_create($field_name);
  } else { //カスタムフィールドだったらfalseが帰ってくる
    $date = date_create(get_field($field_name));
  }

  echo '（' . $week[(int) date_format($date, 'w')] . '）';
}

//--------------------------------------------------------
// 文字数制限
//--------------------------------------------------------

//カスタム投稿アーカイブ本文テキスト
function mb_text_restriction($text,$num){
  if(mb_strlen($text,'UTF-8')> $num){
    $content= str_replace('\n', '', mb_substr(strip_tags($text), 0, $num,'UTF-8'));
    echo $content.'…';
  }else{
    echo str_replace('\n', '', strip_tags($text));
  }
}


//--------------------------------------------------------
// テンプレートパーツをショートコードで呼び出し
// ex) [myphp file='my-template']
//--------------------------------------------------------
function my_php_Include( $params = array() ) {
  extract( shortcode_atts( array( 'file' => 'default' ), $params ) );
  ob_start();
  include( STYLESHEETPATH . "/$file.php" );
  return ob_get_clean();
}
add_shortcode( 'myphp', 'my_php_Include' );

//--------------------------------------------------------
// CSS読み込み順番
//--------------------------------------------------------

// function my_style (){
//   wp_enqueue_style( 'my_css', get_theme_file_uri().'/assets/css/styles.css', array( 'swpm-form-builder-css' ) );
//   wp_enqueue_style( 'swpm-form-builder-css', 'https://hoiku-innovation.com/wp/wp-content/plugins/swpm-form-builder/css/swpm-form-builder.css' );
//   wp_enqueue_style( 'swpm.common', 'https://hoiku-innovation.com/wp/wp-content/plugins/swpm-form-builder/css/swpm-form-builder.css' );
// };

// add_action( 'wp_enqueue_scripts', 'my_style' );


//--------------------------------------------------------
// 投稿アーカイブス
//--------------------------------------------------------

function post_has_archive( $args, $post_type ) {
 
    if ( 'post' == $post_type ) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'news'; //任意のスラッグ名
    }
    return $args;
 
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

//--------------------------------------------------------
// wp_die画面のカスタマイズ
//--------------------------------------------------------

function my_wp_die_handler($function){ 
    if(function_exists("get_bloginfo") && "" != get_bloginfo("template_directory")){ 
        return "my_wp_die"; 
    }else{ 
        return $function; 
    } 
} 
add_filter("wp_die_handler", "my_wp_die_handler", 1000);


function my_wp_die( $message, $title = '', $args = array() ) {
	list( $message, $title, $parsed_args ) = _wp_die_process_input( $message, $title, $args );

	if ( is_string( $message ) ) {
		if ( ! empty( $parsed_args['additional_errors'] ) ) {
			$message = array_merge(
				array( $message ),
				wp_list_pluck( $parsed_args['additional_errors'], 'message' )
			);
			$message = "<ul>\n\t\t<li>" . implode( "</li>\n\t\t<li>", $message ) . "</li>\n\t</ul>";
		}

		$message = sprintf(
			'<div class="wp-die-message">%s</div>',
			$message
		);
	}

	$have_gettext = function_exists( '__' );

	if ( ! empty( $parsed_args['link_url'] ) && ! empty( $parsed_args['link_text'] ) ) {
		$link_url = $parsed_args['link_url'];
		if ( function_exists( 'esc_url' ) ) {
			$link_url = esc_url( $link_url );
		}
		$link_text = $parsed_args['link_text'];
		$message  .= "\n<p><a href='{$link_url}'>{$link_text}</a></p>";
	}

	if ( isset( $parsed_args['back_link'] ) && $parsed_args['back_link'] ) {
		$back_text = $have_gettext ? __( '&laquo; Back' ) : '&laquo; Back';
		$message  .= "\n<p><a href='javascript:history.back()'>$back_text</a></p>";
	}

	if ( ! did_action( 'admin_head' ) ) :
		if ( ! headers_sent() ) {
			header( "Content-Type: text/html; charset={$parsed_args['charset']}" );
			status_header( $parsed_args['response'] );
			nocache_headers();
		}

		$text_direction = $parsed_args['text_direction'];
		$dir_attr       = "dir='$text_direction'";

		// If `text_direction` was not explicitly passed,
		// use get_language_attributes() if available.
		if ( empty( $args['text_direction'] )
			&& function_exists( 'language_attributes' ) && function_exists( 'is_rtl' )
		) {
			$dir_attr = get_language_attributes();
		}
		?>
<!DOCTYPE html>
<html <?php echo $dir_attr; ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $parsed_args['charset']; ?>" />
	<meta name="viewport" content="width=device-width">
		<?php
		if ( function_exists( 'wp_robots' ) && function_exists( 'wp_robots_no_robots' ) && function_exists( 'add_filter' ) ) {
			add_filter( 'wp_robots', 'wp_robots_no_robots' );
			wp_robots();
		}
		?>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/styles.css">

	<title><?php echo $title; ?></title>
	<style type="text/css">
		html {
			background: #f1f1f1;
      visibility: visible;
		}

		<?php
		if ( 'rtl' === $text_direction ) {
			echo 'body { font-family: Tahoma, Arial; }';
		}
		?>
	</style>
</head>
<body id="error-page">
<?php endif; // ! did_action( 'admin_head' ) ?>
	<?php echo $message; ?>
</body>
</html>
	<?php
	if ( $parsed_args['exit'] ) {
		die();
	}
}

//--------------------
//Start Stripe process
//----------------
include_once('inc/stripe-shortcodes.php');

function ctf_striper_enqueue_styles() {
  //wp_enqueue_style('style', get_stylesheet_directory_uri() .'/style.css');
  if( is_page('mypage/payment/change/') ) {
    if ( SwpmMemberUtils::is_member_logged_in() ) {
      $member_id = SwpmMemberUtils::get_logged_in_members_id();
      $subscr_id = SwpmMemberUtils::get_member_field_by_id( $member_id, 'subscr_id' );
      if ( $subscr_id ) {
        $payment_button = ctf_stripe_customer_getPaymentButton($member_id,$subscr_id);
        if ($payment_button) {    
          $api_keys = SwpmMiscUtils::get_stripe_api_keys_from_payment_button( $payment_button['payment_button_id'], $payment_button['is_live'] );
          //echo "<pre>api_keys: "; print_r($api_keys); echo "</pre>";
          wp_enqueue_script('stripe-core', 'https://js.stripe.com/v3/', [], '1.0.0', true);
          wp_enqueue_script('stripe-payjs', get_stylesheet_directory_uri() . '/assets/js/stripe-element.js', [], '1.0.0', true);
          wp_localize_script( 'stripe-payjs', 'ctf_striper', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'stipeapi_public'=>$api_keys['public'] ) );
        }
      }
    }
  }
}

add_action('wp_enqueue_scripts', 'ctf_striper_enqueue_styles',101);
//--------------------
//End Stripe process
//----------------

//--------------------------------------------------------
// 書式テンプレート ダッシュボードカスタマイズ
//--------------------------------------------------------

function add_custom_column( $defaults ) {
    global $post_type;
    if ( 'doc' == $post_type ) {
      $defaults['doc_cat'] = 'カテゴリ';
      $defaults['doc_tag'] = 'タグ';
    }
    elseif ( 'column' == $post_type ) {
      $defaults['column_cat'] = 'カテゴリ';
      $defaults['column_tag'] = 'タグ';
    }
    elseif ( 'video' == $post_type ) {
      $defaults['video_cat'] = 'カテゴリ';
      $defaults['video_tag'] = 'タグ';
    }
    elseif ( 'qa' == $post_type ) {
      $defaults['qa_cat'] = 'カテゴリ';
      $defaults['qa_tag'] = 'タグ';
    }
    elseif ( 'seminar' == $post_type ) {
      $defaults['seminar_cat'] = 'カテゴリ';
      $defaults['seminar_tag'] = 'タグ';
    }
    return $defaults;
}
add_filter('manage_posts_columns', 'add_custom_column');

function add_custom_column_id($column_name, $id) {
  if( $column_name == 'doc_cat' ) {
  echo get_the_term_list($id, 'doc_cat', '', ', ');
  }
  elseif( $column_name == 'doc_tag' ) {
  echo get_the_term_list($id, 'doc_tag', '', ', ');
  }
  elseif( $column_name == 'column_cat' ) {
  echo get_the_term_list($id, 'column_cat', '', ', ');
  }
  elseif( $column_name == 'column_tag' ) {
  echo get_the_term_list($id, 'column_tag', '', ', ');
  }
  elseif( $column_name == 'video_cat' ) {
  echo get_the_term_list($id, 'video_cat', '', ', ');
  }
  elseif( $column_name == 'video_tag' ) {
  echo get_the_term_list($id, 'video_tag', '', ', ');
  }
  elseif( $column_name == 'qa_cat' ) {
  echo get_the_term_list($id, 'qa_cat', '', ', ');
  }
  elseif( $column_name == 'qa_tag' ) {
  echo get_the_term_list($id, 'qa_tag', '', ', ');
  }
  elseif( $column_name == 'seminar_cat' ) {
  echo get_the_term_list($id, 'seminar_cat', '', ', ');
  }
  elseif( $column_name == 'seminar_tag' ) {
  echo get_the_term_list($id, 'seminar_tag', '', ', ');
  }
}

add_action('manage_doc_posts_custom_column', 'add_custom_column_id', 10, 2);
add_action('manage_column_posts_custom_column', 'add_custom_column_id', 10, 2);
add_action('manage_video_posts_custom_column', 'add_custom_column_id', 10, 2);
add_action('manage_qa_posts_custom_column', 'add_custom_column_id', 10, 2);
add_action('manage_seminar_posts_custom_column', 'add_custom_column_id', 10, 2);

function sort_custom_columns( $columns ) {
    global $post_type;
    if ( 'doc' == $post_type ) {
      $columns = array(
        'cb'     => '<input type="checkbox" />',
        'title'  => 'タイトル',
        'doc_cat' => 'カテゴリー',
        'doc_tag'   => 'タグ',
        'date'   => '日時'
      );
    }
    elseif( 'video' == $post_type ){
      $columns = array(
        'cb'     => '<input type="checkbox" />',
        'title'  => 'タイトル',
        'video_cat' => 'カテゴリー',
        'video_tag'   => 'タグ',
        'date'   => '日時'
      );
    }
    elseif( 'column' == $post_type ){
      $columns = array(
        'cb'     => '<input type="checkbox" />',
        'title'  => 'タイトル',
        'column_cat' => 'カテゴリー',
        'column_tag'   => 'タグ',
        'date'   => '日時'
      );
    }
    elseif( 'qa' == $post_type ){
      $columns = array(
        'cb'     => '<input type="checkbox" />',
        'title'  => 'タイトル',
        'qa_cat' => 'カテゴリー',
        'qa_tag'   => 'タグ',
        'date'   => '日時'
      );
    }
    elseif( 'seminar' == $post_type ){
      $columns = array(
        'cb'     => '<input type="checkbox" />',
        'title'  => 'タイトル',
        'seminar_cat' => 'カテゴリー',
        'seminar_tag'   => 'タグ',
        'date'   => '日時'
      );
    }
  return $columns;
}
add_filter( 'manage_doc_posts_columns', 'sort_custom_columns' );
add_filter( 'manage_column_posts_columns', 'sort_custom_columns' );
add_filter( 'manage_video_posts_columns', 'sort_custom_columns' );
add_filter( 'manage_qa_posts_columns', 'sort_custom_columns' );
add_filter( 'manage_seminar_posts_columns', 'sort_custom_columns' );


function add_post_taxonomy_restrict_filter() {
    global $post_type;
    if ( 'doc' == $post_type ) {
        ?>
        <select name="doc_cat">
            <option value="">カテゴリー指定なし</option>
            <?php
            $terms = get_terms('doc_cat');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <select name="doc_tag">
            <option value="">タグ指定なし</option>
            <?php
            $terms = get_terms('doc_tag');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <?php
    }
    elseif ( 'column' == $post_type ) {
        ?>
        <select name="column_cat">
            <option value="">カテゴリー指定なし</option>
            <?php
            $terms = get_terms('column_cat');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <select name="column_tag">
            <option value="">タグ指定なし</option>
            <?php
            $terms = get_terms('column_tag');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <?php
    }
    elseif ( 'video' == $post_type ) {
        ?>
        <select name="video_cat">
            <option value="">カテゴリー指定なし</option>
            <?php
            $terms = get_terms('video_cat');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <select name="video_tag">
            <option value="">タグ指定なし</option>
            <?php
            $terms = get_terms('video_tag');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <?php
    }
    elseif ( 'qa' == $post_type ) {
        ?>
        <select name="qa_cat">
            <option value="">カテゴリー指定なし</option>
            <?php
            $terms = get_terms('qa_cat');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <select name="qa_tag">
            <option value="">タグ指定なし</option>
            <?php
            $terms = get_terms('qa_tag');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <?php
    }
    elseif ( 'seminar' == $post_type ) {
        ?>
        <select name="seminar_cat">
            <option value="">カテゴリー指定なし</option>
            <?php
            $terms = get_terms('seminar_cat');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <select name="seminar_tag">
            <option value="">タグ指定なし</option>
            <?php
            $terms = get_terms('seminar_tag');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <?php
    }
    
}
add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter' );

//--------------------
// マイページリダイレクト処理
//----------------


add_action( 'wp_head', 'add_login_to_head',1);
function add_login_to_head() {
	if (SwpmMemberUtils::is_member_logged_in()) {
			//ログインしてたら

    if (strpos($_SERVER['REQUEST_URI'], '/login/forgot/') !== false ) {
      //何もしない
		}elseif(strpos($_SERVER['REQUEST_URI'], '/login/') !== false ) {
      return
      $url = site_url('/mypage/', 'https');
      wp_safe_redirect( $url, 301 );
		}

    if (strpos($_SERVER['REQUEST_URI'], '/signup/') !== false ) {
      $url = site_url('/mypage/', 'https');
      wp_safe_redirect( $url, 301 );
		}

	} else {
    //ログインしていない時

    if (strpos($_SERVER['REQUEST_URI'], '/mypage/qa-form/') !== false ) {
      //何もしない
		}elseif(strpos($_SERVER['REQUEST_URI'], '/mypage/') !== false ) {
      $url = site_url('/login/', 'https');
      wp_safe_redirect( $url, 301 );
		}
	}
}

//--------------------
// authorページの無効
//----------------

add_filter( 'author_rewrite_rules', '__return_empty_array' );
function disable_author_archive() {
	if( $_GET['author'] || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
		wp_redirect( home_url( '/404.php' ) );
		exit;
	}
}
add_action('init', 'disable_author_archive');

//--------------------
// 相談ひろばの時限設定 ショートコード
//----------------

function rankTimeFunc( $atts, $content = null ) {

  $member = "

<div class='membership-info'>
<h2 class='membership-info-heading'>会員相談ひろばを利用するには<br class='br-sp'>会員登録が必要です。</h2>

<!--
<h2 class='membership-info-heading'>保育イノベーション<br class='br-sp'>会員になると…</h2>
<ol class='membership-info-feature'>
<li>すべての<em>書式テンプレート</em>を<em>ダウンロードし放題！</em></li>
<li>すべての<em>解説動画</em>が<em>見放題！</em><small class='note'>＊1</small></li>
<li>すべての<em>会員相談ひろば</em>が読み放題！</li>
<li><em>オンラインセミナー</em>を<em>無料</em>または<em>会員価格にて視聴可能！</em><small class='note'>＊2</small></li>
</ol>

<ol class='membership-info-note'>
<li>フリープランでも一部閲覧可能な動画がございます。</li>
<li>プランによって変動します。プレミアムプラン…無料、スタンダードプラン…会員価格、ライトプラン…一部のみ視聴可能、会員価格、フリープラン…一部のみ視聴可能、一般価格</li>
</ol>
-->

<div class='membership-info-button'>
<!-- <a href='/plan/' class='btn btn-c'>料金プラン<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a> -->
<!-- <a href='/maypage/rank/' class='btn btn-c'>有料プランご利用<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a> -->
<a href='/signup/' class='btn btn-c'>無料会員登録<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a>
<a href='/login/' class='btn btn-c'>ログイン<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a>
</div>
<!-- /.membership-info --></div>";


  if (date_i18n('Y-m-d H:i') >= '2022-01-01 00:00') {
    return do_shortcode('[swpm_protected for="2-3-4-6" custom_msg="'.$member.'"]' . $content . '[/swpm_protected]');
  }else{
    return do_shortcode('[swpm_protected custom_msg="'.$member.'"]' . $content . '[/swpm_protected]');
  }

}
add_shortcode('ranktime', 'rankTimeFunc');


//--------------------------------------------------------
// サイト内検索をカスタマイズ
//--------------------------------------------------------
function custom_search($search, $wp_query) {
  global $wpdb;

  //検索ページ以外だったら終了
  if (!$wp_query->is_search)
  return $search;

  if (!isset($wp_query->query_vars))
  return $search;

  // タグ名・カテゴリ名・カスタムフィールド も検索対象にする
  $search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
  if ( count($search_words) > 0 ) {
    $search = '';
    foreach ( $search_words as $word ) {
      if ( !empty($word) ) {
        $search_word = $wpdb->escape("%{$word}%");
        $search .= " AND (
            {$wpdb->posts}.post_title LIKE '{$search_word}'
            OR {$wpdb->posts}.post_content LIKE '{$search_word}'
            OR {$wpdb->posts}.ID IN (
              SELECT distinct r.object_id
              FROM {$wpdb->term_relationships} AS r
              INNER JOIN {$wpdb->term_taxonomy} AS tt ON r.term_taxonomy_id = tt.term_taxonomy_id
              INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
              WHERE t.name LIKE '{$search_word}'
            OR t.slug LIKE '{$search_word}'
            OR tt.description LIKE '{$search_word}'
            )
            OR {$wpdb->posts}.ID IN (
              SELECT distinct p.post_id
              FROM {$wpdb->postmeta} AS p
              WHERE p.meta_value LIKE '{$search_word}'
            )
        ) ";
      }
    }
  }

  return $search;
}
add_filter('posts_search','custom_search', 10, 2);

/*-----------------------------------------------------
	購読者のダッシュボードへのアクセス禁止
----------------------------------------------------- */
add_action( 'auth_redirect', 'subscriber_go_to_home' );
function subscriber_go_to_home( $user_id ) {
$user = get_userdata( $user_id );
if ( !$user->has_cap( 'edit_posts' ) ) {
wp_redirect( get_home_url() );
exit();
}
}

/*-----------------------------------------------------
	クライアント用ダッシュボード制限
----------------------------------------------------- */

function custom_admin_style() {

  global $current_user;
  get_currentuserinfo();
	if ($current_user->ID == "13" ){
	?><style>
		#two-factor-options,
    #application-passwords-section,
    #security-keys-section,
    #wpbody .yoast.yoast-settings,
    #wpbody #password,
    #wpbody .user-email-wrap,
    #wpbody .user-url-wrap,
    #wpbody .user-facebook-wrap,
    #wpbody .user-instagram-wrap,
    #wpbody .user-linkedin-wrap,
    #wpbody .user-myspace-wrap,
    #wpbody .user-pinterest-wrap,
    #wpbody .user-soundcloud-wrap,
    #wpbody .user-tumblr-wrap,
    #wpbody .user-twitter-wrap,
    #wpbody .user-youtube-wrap,
    #wpbody .user-wikipedia-wrap,
    #wpbody .user-soundcloud-wrap,
    #wpbody .user-sessions-wrap.hide-if-no-js,
    #wpbody .user-generate-reset-link-wrap.hide-if-no-js,
    #wpbody .user-display-name-wrap,
    #wpbody #security-keys-section,
    #your-profile .form-table:nth-of-type(1),
    #your-profile .form-table:nth-of-type(2) + h2,
    #your-profile .form-table:nth-of-type(3) + h2,
    #your-profile .form-table:nth-of-type(4) + h2
    
     {
			display: none;
		}
	</style>
  <?php
  }
}
add_action( 'admin_head', 'custom_admin_style' );

/*-----------------------------------------------------
	MW WP FORM ビジュアルエディタ無効
----------------------------------------------------- */

function my_off_ve_in_page(){
    global $typenow;
    if( in_array( $typenow, array( 'page' ,'mw-wp-form' ) ) ){
        add_filter('user_can_richedit', 'my_off_ve_filter');
    }
}
function my_off_ve_filter(){
    return false;
}
add_action( 'load-post.php', 'my_off_ve_in_page' );
add_action( 'load-post-new.php', 'my_off_ve_in_page' );

