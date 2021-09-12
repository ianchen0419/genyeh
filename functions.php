<?php

/********************
カスタマイズロゴ
********************/
$defaults = array(
	'height'				=> 50,
	'width'					=> 361,
	'flex-height'			=> true,
	'flex-width'			=> true,
	'header-text'			=> array('site-title', 'site-description'),
	'unlink-homepage-logo'	=> true, 
);
add_theme_support('custom-logo', $defaults);

/********************
カラーパレット定義
********************/
add_theme_support('editor-color-palette', array(
	array(
		'name'  => '白色',
		'slug'  => 'white',
		'color'	=> '#FFFFFF',
	),
	array(
		'name'  => '黒色',
		'slug'  => 'black',
		'color' => '#000000',
	),
	array(
		'name'  => '藍色',
		'slug'  => 'blue',
		'color' => '#063D82',
	),
	array(
		'name'  => '紅色',
		'slug'  => 'red',
		'color' => '#C92E2A',
	),
	array(
		'name'  => '黃色',
		'slug'  => 'yellow',
		'color' => '#FACF0D',
	),
	array(
		'name'  => '灰色',
		'slug'  => 'gray',
		'color' => '#595959',
	),
)
);

/********************
アイキャッチ画像
********************/
add_theme_support('post-thumbnails');

/********************
自作UIブロック　＆　現存してるUIブロックのスタイル追加
********************/
function add_my_assets_to_block_editor() {
	wp_enqueue_style('block-type', get_stylesheet_directory_uri().'/block.css');
	wp_enqueue_script('block-type', get_stylesheet_directory_uri().'/block.js', array(), "", true);
}
add_action('enqueue_block_editor_assets', 'add_my_assets_to_block_editor');

/********************
独自メタデータ登録
********************/
function myguten_register_post_meta() {
	register_post_meta('post', 'user', array(
		'show_in_rest' => true,
		'single' => true,
		'type' => 'string',
		)
	);
}
add_action('init', 'myguten_register_post_meta');

/********************
ユーザーリストajaxデータ取得
********************/
function getUserFunc(){
	wp_send_json(user_list_json());
	wp_die();
}

add_action('wp_ajax_getuser', 'getUserFunc');
add_action('wp_ajax_nopriv_getuser', 'getUserFunc');

function user_list_json(){
	$users=get_users();
	$arr=array();
	array_push($arr, array('label'=>'請選擇使用者', 'value'=>''));
	foreach($users as $user){
		$display_name=$user->display_name;
		$user_login=$user->user_login;
		$label=$display_name.' ('.$user_login.')';
		
		array_push($arr, array('label'=>$label, 'value'=>$user_login));
	}
	$arr1=json_encode($arr);
	return $arr1;
}

/********************
投稿リストテーブルに指定されたユーザーを追加
********************/
function add_new_columns($columns){
 	$column_meta=array('meta' => '公開對象');
	$columns=array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, NULL, true);
	return $columns;
}
add_filter('manage_edit-post_columns', 'add_new_columns');

function custom_columns($column){
	global $post;
	switch($column){
		case 'meta':
			$metaData=get_post_meta($post->ID, 'user', true);
			$user_info=$user=get_user_by('slug',$metaData);
			$user_display_name=$user_info->display_name;

			$column_value=$user_display_name.' ('.$metaData.')';

			if($metaData){
				echo $column_value;	
			}
			
		break;
	}
}
add_action('manage_posts_custom_column' , 'custom_columns');

/********************
カスタマイズメニュー有効化
********************/
function register_my_menu() {
	$locations = array(
		'header'  => 'header',
		'quick'  => 'quick',
	);
	register_nav_menus($locations);
}
add_action('init', 'register_my_menu');

/********************
全幅ブロック有効化
********************/
add_theme_support('align-wide');

/********************
フォントサイズ設定
********************/
// add_theme_support('editor-font-sizes', array(
// 	array(
// 		'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
// 		'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
// 		'size'      => 18,
// 		'slug'      => 'small',
// 	),
// 	array(
// 		'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
// 		'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
// 		'size'      => 21,
// 		'slug'      => 'normal',
// 	),
// 	array(
// 		'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
// 		'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
// 		'size'      => 26.25,
// 		'slug'      => 'large',
// 	),
// 	array(
// 		'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
// 		'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
// 		'size'      => 32,
// 		'slug'      => 'larger',
// 	),
// ))

?>