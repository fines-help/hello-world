<?php 
$first_name = do_shortcode('[swpm_show_member_info column="first_name"]');
$last_name = do_shortcode('[swpm_show_member_info column="last_name"]');
$name = $last_name.$first_name;
$mail = do_shortcode('[swpm_show_member_info column = "email"]');

;?>
<tr>
<th>会員名</th>
<td>
<?php echo $name;?>
<input type="hidden" name="your_name" size="60" value="<?php echo $name; ?>" class="swpm-text swpm-medium">
</td>
</tr>
<tr>
<th>メールアドレス</th>
<td>
<?php echo $mail;?>
<input type="hidden" name="your_mail" size="60" value="<?php echo $mail; ?>" class="swpm-text swpm-medium">
</td>
</tr>

