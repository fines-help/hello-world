<?php get_header(); ?>

<!-- [[ BREAD-CRUMBS-AREA ]] -->
<?php get_template_part('inc/bread','crumbs'); ?>
<!-- / [[ BREAD-CRUMBS-AREA ]] -->

<!-- [[ CONTENT-AREA ]] -->
<div class="l-contents">
<!-- [ MAIN ] -->
<div class="l-main">
<article>
<h1 class="ttl-a">退会手続き</h1>
<p class="ttl-c">有料プランのご解約につきまして</p>
<p class="text">※アカウント削除されません。<br>※ご解約後は、フリープランで引き続きご利用いただけます。</p>

<?php //無料会員かの判定
$member_level = SwpmMemberUtils::get_logged_in_members_level();
if ( $member_level == 5 ):?>
<div class="cancel_sub member-rank">
<button type="" name="swpm_do_cancel_sub">有料プランを解約する</button>
<?php else: ?>

<?php
$active = 1;

$member_id = SwpmMemberUtils::get_logged_in_members_id();

$subs = new SWPM_Member_Subscriptions( $member_id );

if ( empty( $subs->get_active_subs_count() ) ) {
  //定期購読判定
  $active = 2;
}

if( $active == 1 ){
  //定期購読ある時
  echo '<div class="cancel_sub">';
  echo do_shortcode('[swpm_stripe_subscription_cancel_link]');

}else{
  //定期購読ない時
  echo '<div class="cancel_sub member-rank"><button type="" name="swpm_do_cancel_sub">有料プランを解約する</button>';

  if( $member_level != 5 ){
    echo '<div style="position: absolute; visibility: hidden; z-index: -9999;">'.do_shortcode('[swpm_update_level_to level="5" button_text="フリープランに変更"]').'</div>';
  }
}

endif;
?>
</div>

<p class="ttl-c">退会手続きにつきまして</p>
<p class="text">※アカウントが削除になります。<br>※会員コンテンツが見れなくなります。<br>※有料会員様は、有料プラン解約後に退会可能となります。</p>

<?php //無料会員かの判定
$member_level = SwpmMemberUtils::get_logged_in_members_level();
if ( $member_level == 5 || $active == 2 ):?>
<div class="cancel_sub">
<?php else: ?>
<div class="cancel_sub member-rank">
<?php 
endif;
echo do_shortcode('[swpm_profile_form]');
?>
</div>

</article>
<!-- / .l-main --></div>
<!-- / .l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->



<?php get_footer(); ?>




