<?php

function ctf_stripe_customer_getPaymentButton($member_id,$subscr_id){
	$query_args = array(
		'post_type'  => 'swpm_transactions',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'relation' => 'OR',
				array(
					'key'     => 'member_id',
					'value'   => $member_id,
					'compare' => '=',
				),
				array(
					'key'     => 'subscr_id',
					'value'   => $subscr_id,
					'compare' => '=',
				),
			),
			array(
				'key'     => 'gateway',
				'value'   => 'stripe-sca-subs',
				'compare' => '=',
			),
		),
	);
	$found_subs = new WP_Query( $query_args );
	if ($found_subs->have_posts()) {
	  	$first_sub = $found_subs->posts[0];
	  	$post_id = $first_sub->ID;

	  	$is_live        = get_post_meta( $post_id, 'is_live', true );
		$is_live        = empty( $is_live ) ? false : true;
		$payment_button_id = get_post_meta( $post_id, 'payment_button_id', true );

	  	return ['payment_button_id'=>$payment_button_id,'is_live'=>$is_live];
	}
	return 0;
}
function ctf_striper_customer_retrive_customer(){

	if ( ! SwpmMemberUtils::is_member_logged_in() ) {
		return 0;
	}
	$member_id = SwpmMemberUtils::get_logged_in_members_id();
	$subscr_id = SwpmMemberUtils::get_member_field_by_id( $member_id, 'subscr_id' );
	if ( ! $subscr_id ) {
		return 0;
	}

	$payment_button = ctf_stripe_customer_getPaymentButton($member_id,$subscr_id);
	if ($payment_button) {	  

		$api_keys = SwpmMiscUtils::get_stripe_api_keys_from_payment_button( $payment_button['payment_button_id'], $payment_button['is_live'] );
		
		SwpmMiscUtils::load_stripe_lib();
		\Stripe\Stripe::setApiKey( $api_keys['secret'] );

		$stripe_sub = \Stripe\Subscription::retrieve( 
							[
							  'id' => $subscr_id,
							  'expand' => ['customer','customer.sources'],
							]
					 );
		
		if(isset($stripe_sub->customer)) {
			$customer = $stripe_sub->customer;
			if(!isset($customer->active_card) && empty($customer->default_source) && empty($customer->sources->data) ){
				$default_payment_method = \Stripe\PaymentMethod::retrieve(
				  $stripe_sub->default_payment_method,
				  []
				);
				if($default_payment_method->card)
					$customer->payment_method_card = $default_payment_method->card;				
			}
			return $customer;
		}
	}
	return 0;
}

function ctf_stripe_customer_get_card_image($brand){
	//brand: Can be American Express, Diners Club, Discover, JCB, MasterCard, UnionPay, Visa, or Unknown
	//card hash (paymentmethod): amex, diners, discover, jcb, mastercard, unionpay, visa, or unknown
	$img_name = '';
	switch ( strtolower($brand) ) {
		case 'visa':
			$img_name = 'ico_card_visa.png';
			break;    		
		case 'mastercard':
			$img_name = 'ico_card_master.png';
			break;
		case 'jcb':
			$img_name = 'ico_card_jcb.png';
			break;
		case 'american express':
		case 'amex':
			$img_name = 'ico_card_amex.png';
			break;
		case 'diners club':
		case 'diners':
			$img_name = 'ico_card_diners.png';
			break;
	}
	return $img_name;
}

add_shortcode( 'ctf-stripe-customer-card-info', 'ctf_stripe_customer_card_info' );
function ctf_stripe_customer_card_info($atts, $content = NULL){
	extract (
		shortcode_atts( 
			array(
		        'title' => 'カード情報の確認',
	    	), 
    		$atts 
   		)
	);
    global $wpdb, $user_ID;	
    if(! SwpmMemberUtils::is_member_logged_in()){
    	echo '<script>window.location.href = "'.home_url().'";</script>';
    }
    $customer = ctf_striper_customer_retrive_customer();
    //echo "<pre>Customer: "; print_r($customer); echo "</pre>";
    $card='';
    if(isset($customer->active_card)){
    	$card = $customer->active_card;
    }elseif(!empty($customer->default_source) && !empty($customer->sources->data) ){
    	foreach ($customer->sources->data as $scard) {
    		if($scard->id == $customer->default_source){
    			$card= $scard;
    			break;
    		}
    	}
    }elseif(!empty($customer->payment_method_card)){
    	$card = $customer->payment_method_card;
    }
    ob_start();    

    if( $card ){
    	?>
    	<?php
    	$active_card = $card;    	
    	$img_name = ctf_stripe_customer_get_card_image($active_card->brand);

    	?>    	
		<table class="tbl-a sp-mode-vertical">
			<tbody>
				<tr>
					<th>ご利用カード</th>
					<td>
						<?php if($img_name!=''): ?>
						<img class="card-logo" src="<?=get_stylesheet_directory_uri()?>/assets/img/common/<?=$img_name?>" alt="<?=$active_card->brand?>" width="86" height="55" />
						<?php else: ?>
							<strong><?=strtoupper($active_card->brand)?></strong>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th>クレジットカード番号</th>
					<td>************<?=$active_card->last4?></td>
				</tr>
				<tr>
					<th>有効期限</th>
					<td><?=$active_card->exp_month?>/<?=$active_card->exp_year?></td>
				</tr>
				<tr>
					<th>カード所有者名</th>
					<td><?=($active_card->name)?$active_card->name:$customer->name ?></td>
				</tr>
			</tbody>
		</table>
	<?php 
	}else{ ?>
		<div class="nosubs" style="text-align: center;margin-bottom: 20px;"><strong><?=__('ご利用中の有料プランはございません。','ct-stripe-customer')?></strong></div>
	<?php }
	$output_string=ob_get_contents();
	ob_end_clean();
	return $output_string;
}

function ctf_stripe_customer_update_customer_card($datas){
   
	if ( ! SwpmMemberUtils::is_member_logged_in() ) {
		//member not logged in
		return 0;
	}

	$member_id = SwpmMemberUtils::get_logged_in_members_id();
	$subscr_id = SwpmMemberUtils::get_member_field_by_id( $member_id, 'subscr_id' );
	if ( ! $subscr_id ) {
		return 0;
	}

	$payment_button = ctf_stripe_customer_getPaymentButton($member_id,$subscr_id);

	if ($payment_button) {	  

		$api_keys = SwpmMiscUtils::get_stripe_api_keys_from_payment_button( $payment_button['payment_button_id'], $payment_button['is_live'] );
		
		SwpmMiscUtils::load_stripe_lib();
		\Stripe\Stripe::setApiKey( $api_keys['secret'] );

		$stripe_sub = \Stripe\Subscription::retrieve( 
							[
							  'id' => $subscr_id,
							  'expand' => ['customer','customer.sources'],
							]
					 );
		if(isset($stripe_sub->customer) ) {
			$customer = $stripe_sub->customer;

			if(!empty($stripe_sub->default_payment_method)){
				// /https://stripe.com/docs/api/payment_methods/detach?lang=php
				$pm = \Stripe\PaymentMethod::retrieve( $stripe_sub->default_payment_method );//to get PaymentMethod object
				$pm->detach(
				  $stripe_sub->default_payment_method,
				  []
				);
			}

			//https://stripe.com/docs/api/customers/update
			$customer_new = \Stripe\Customer::update($customer->id, [
			    'source' => $datas['tok_card'], //token get
			]);
			return $customer_new;
		}
			
		
	}
	return 0;
}

add_shortcode( 'ctf-stripe-customer-card-change', 'ctf_stripe_customer_card_change' );
function ctf_stripe_customer_card_change($atts, $content = NULL){
	extract (
		shortcode_atts( 
			array(
		        'success_url' => '',
		        'title' => 'カード情報の変更',
	    	), 
    		$atts 
   		)
	);

    if(! SwpmMemberUtils::is_member_logged_in()){
    	echo '<script>window.location.href = "'.home_url().'";</script>';
    }
    if(isset($_POST['tok_card'])){
    	$customer = ctf_stripe_customer_update_customer_card($_POST);
    	//thanh cong thi dieu huong den success_url
    	if($customer){
    		$redirect_to =  $success_url ? $success_url : home_url();
    		echo '<script>window.location.href = "'.$redirect_to.'";</script>';			
    	}
    }
    $customer = ctf_striper_customer_retrive_customer();
    //echo "<pre>Customer: "; print_r($customer); echo "</pre>";
    ob_start();    
    if( $customer ){
    ?>    
	    <form action="" method="post" id="pymt_frm">
	    	<table class="tbl-a sp-mode-vertical">
				<tr>
					<th>クレジットカード番号</th>
					<td>
						<div id="card_number" class="field"></div>
						<div id="incomplete_number" class="msg-error"></div> 
						<!-- <div id="card-errors" class="msg-error"></div>  -->
					</td>
				</tr>
				<tr>
					<th>セキュリティコード</th>
					<td>
						<div id="card_cvv" class="field"></div>
						<div id="incomplete_cvc" class="msg-error"></div> 
					</td>
				</tr>
				<tr>
					<th>有効期限</th>
					<td>
						<div id="card_expiry" name="card_expiry" class="field fieldexpr"></div>		
						<div id="incomplete_expiry" class="msg-error"></div> 				
					</td>
				</tr>
				<tr>
					<th>カード所有者名</th>
					<td>名 <input type="text" name="card_firstname" class="field" id="card_firstname">&nbsp;&nbsp; 姓 <input type="text" name="card_lastname" class="field" id="card_lastname"></td>
				</tr>
			</table>
			<?php $nonce = wp_create_nonce("validate_userpass_nonce"); ?>
			<input type="hidden" name="nonce" id="vup_nonce" value="<?=$nonce?>" />
			<p class="mod-button-group">
				<button type="button" class="btn btn-e btn-rev" onclick="history.back()">キャンセル</button>
				<button type="sumit" id="sbmpymt-btn" name="save_change" class="btn btn-a">登録する</button>
			</p>
		</form>
		<style type="text/css">
			.field {
			    border: 1px solid #ccc;
			    padding: 7px;
			    width: 100%;
			    max-width: 300px;
			}
			.fieldexpr{max-width: 80px;}
			.invalid{border-color: #e50e0a }
			.msg-error{margin-top: 10px;color: #fa755a;}
		</style>
	<?php 
	}else{ ?>
		<div class="nosubs" style="text-align: center;margin-bottom: 20px;"><strong><?=__('ご利用中の有料プランはございません。','ct-stripe-customer')?></strong></div>
	<?php }

	$output_string=ob_get_contents();
	ob_end_clean();
	return $output_string;
}