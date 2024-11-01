<?php
/*
Plugin Name: WP-Qiannao
Plugin URI: http://bwskyer.com/wp-qiannao-plugin-wordpress.html
Description: 在WordPress编辑页面直接上传文件到千脑网盘.
Version: 1.0
Author: Sam Zuo
Author URI: http://bwskyer.com
*/

function qiannao(){
	$username = get_option("wp_qiannao_user");
    if($username == ""){
	update_option("wp_qiannao_user","bwskyer");
	}
	echo '<div id="upload" class="meta-box-sortables ui-sortable" style="position: relative;"><div class="postbox">';
	echo '<div class="handlediv" title="Click to toggle"><br />';
	echo '</div>';
	echo '<h3 class="hndle"><span>Upload</span></h3>';
	echo '<div class="inside"><iframe src=http://qiannao.com/tomos/ui/qnupload.jsp?id='. get_option("wp_qiannao_user") . ' id=qn_upload frameborder=0 width=100% height=95 scrolling=auto allowTransparency=true></iframe>';
	echo '</div></div></div>';
        }
		
function qiannao_options(){
	$message='更新成功';
	if($_POST['update_qiannao_option']){
		$wp_qiannao_user_saved = get_option("wp_qiannao_user");
		$wp_qiannao_user = $_POST['wp_qiannao_user_option'];
		if ($wp_qiannao_user_saved != $wp_qiannao_user)
			if(!update_option("wp_qiannao_user",$wp_qiannao_user))
				$message='更新失败';
		
		echo '<div class="updated"><strong><p>'. $message . '</p></strong></div>';
	}
?>
<div class=wrap>
	<form method="post" action="">
		<h2>千脑网盘</h2>
		<fieldset name="wp_basic_options"  class="options">
		<table>
			<tr>
                <td valign="top" align="right">输入千脑用户名:</td>
				<td><input type="text" name="wp_qiannao_user_option" value="<?php echo get_option("wp_qiannao_user");  ?>" /></td>
			</tr>
		</table>			
		</fieldset>
		<p class="submit"><input type="submit" name="update_qiannao_option" value="更新设置 &raquo;" /></p>
	</form>
</div>
<?php
}

function qiannao_options_admin(){
	add_options_page('Qiannao', '千脑上传插件', 5,  __FILE__, 'qiannao_options');
}

add_action('admin_menu', 'qiannao_options_admin');		
add_action('edit_form_advanced','qiannao');
?>
