<?php 
	if (is_user_logged_in()==false) {
		wp_redirect(home_url('login'));
	}

	$thumbnail;
	if(has_post_thumbnail()) {
		$thumbnail="background: url(".get_the_post_thumbnail_url().")";
	}
?>
<?php get_header();?>

<div id="visual" class="has-blue-background-color" style="<?php echo $thumbnail; ?>">
	<div class="page-title">
		<div class="wrapper-size">
			<h1 class="has-white-color has-text-align-center has-large-font-size"><?php the_title(); ?></h1>
		</div>
	</div>
</div>
<main id="contact">
	<figure class="wp-block-table is-style-stripes">
		<table>
			<thead>
				<tr>
					<th>工程名稱</th>
					<th>客戶名稱</th>
					<th>發布日期</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$user=wp_get_current_user();
					$user_login=$user->user_login;
					$arg='';
					if(user_can($user, 'administrator') || user_can($user, 'author')){
						$arg=array();
					}else{
						$arg=array(
							'meta_key'	=> 'user',
							'meta_value'	=> $user_login,
						);
					}

					$html='';
					$posts=get_posts($arg);
					foreach($posts as $post){
						$post_user=get_post_meta($post->ID, 'user')[0];
						$user_info=$user=get_user_by('slug',$post_user);
						$user_display_name='';
						if($post_user!=''){
							$user_display_name=$user_info->display_name.' ('.$post_user.')';
						}
						

						$html.='<tr>';
						$html.='<td>'.'<a href="'.$post->guid.'">'.$post->post_title.'</a>'.'</td>';
						$html.='<td>'.$user_display_name.'</td>';
						$html.='<td>'.$post->post_date.'</td>';
						$html.='</tr>';
					}
					echo $html;
				?>
			</tbody>
		</table>
	</figure>
</main>


<?php get_footer();?>