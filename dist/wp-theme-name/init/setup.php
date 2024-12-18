<?php
/* ---------- パスの短縮 ---------- */
define('IMAGEPATH', get_template_directory_uri() . '/assets/images');

/* ---------- 各ページのリンク ---------- */
define('HOME_URL', esc_url(home_url())); // トップページ
define('COMPANY_URL', esc_url(home_url('/company/'))); // 運営会社
define('CONTACT_URL', esc_url(home_url('/contact/'))); // お問い合わせ
define('THANKS_URL', esc_url(home_url('/completed/'))); // お問い合わせ 完了
define('PRIVACY_URL', esc_url(get_privacy_policy_url())); // プライバシーポリシー

/* ---------- 外部リンク ---------- */
define('SNS_INSTAGRAM_URL', 'https://www.instagram.com/'); // Instagram
define('SNS_FACEBOOK_URL', 'https://www.facebook.com/'); // Facebook
define('SNS_X_URL', 'https://www.x.com'); // X
define('SNS_LINE_URL', 'https://line.me'); // LINE

/* ---------- セットアップ ---------- */
function my_setup()
{
	add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
	add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
	add_theme_support('title-tag'); // タイトルタグ自動生成
	add_theme_support('widgets');
	add_theme_support('menus');
	add_theme_support(
		'html5',
		array( // HTML5でマークアップ
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action('after_setup_theme', 'my_setup');

/* ---------- Adobe Fontsの読み込み ---------- */
function add_adobe_fonts_script()
{
?>
	<script>
	</script>
<?php
}
add_action('wp_head', 'add_adobe_fonts_script');

/* ---------- CSSとJavaScriptの読み込み ---------- */
function my_script_init()
{ // WordPress提供のjquery.jsを読み込まない
	wp_deregister_script('jquery');
	// jQueryの読み込み
	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), "3.6.4", true);
	// scrollHint
	// wp_enqueue_script('scroll-hint', '//unpkg.com/scroll-hint@latest/js/scroll-hint.min.js', array(), null, true);
	// wp_enqueue_style('scroll-hint', '//unpkg.com/scroll-hint@latest/css/scroll-hint.css', array(), null);
	// SimpleBar
	wp_enqueue_script('simplebar', '//cdnjs.cloudflare.com/ajax/libs/simplebar/6.2.5/simplebar.min.js', array(), '6.2.5', true);
	wp_enqueue_style('simplebar', '//cdnjs.cloudflare.com/ajax/libs/simplebar/6.2.5/simplebar.min.css', array(), '6.2.5');
	// GSAP
	wp_enqueue_script('gsap', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array('jquery'), '3.12.5', true);
	wp_enqueue_script('gsap-CustomEase', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/CustomEase.min.js', array('gsap'), '3.12.5', true);
	wp_enqueue_script('gsap-ScrollTrigger', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('gsap'), '3.12.5', true);
	wp_enqueue_script('gsap-ScrollTo', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js', array('gsap'), '3.12.5', true);
	// Swiper JavaScript
	wp_enqueue_script('swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js', array(), '11.0.5', true);
	// Swiper CSS
	wp_enqueue_style('swiper', get_theme_file_uri('/assets/css/lib/swiper.min.css'), array(), '11.0.5');
	wp_enqueue_style('swiper-customize', get_theme_file_uri('/assets/css/lib/swiper-customize.css'), array(), filemtime(get_theme_file_path('/assets/css/lib/swiper-customize.css')));
	// テーマのJavaScript
	wp_enqueue_script('theme-common', get_theme_file_uri('/assets/js/common.js'), array('swiper', 'gsap', 'simplebar'), filemtime(get_theme_file_path('/assets/js/common.js')), true);
	// テーマのCSS
	wp_enqueue_style('theme-common', get_theme_file_uri('/assets/css/style.css'), array(), filemtime(get_theme_file_path('/assets/css/style.css')));
}
add_action('wp_enqueue_scripts', 'my_script_init');

/* ---------- キャッチフレーズをtitleタグ内から除去 ---------- */
function my_document_title_separator($sep)
{
	$sep = '|';
	return $sep;
}
add_filter('document_title_separator', 'my_document_title_separator');
// function remove_title_tagline($title)
// {
// 	if (isset($title['tagline'])) {
// 		unset($title['tagline']);
// 	}
// 	return $title;
// }
// add_filter('document_title_template-parts', 'remove_title_tagline');

/* ---------- 固定ページで抜粋を使えるようにする ---------- */
add_post_type_support('page', 'excerpt');

/* ---------- pタグとbrタグの自動挿入を解除 ---------- */
function disable_output()
{
	remove_filter('the_content', 'wpautop');  // 本文欄
	// remove_filter('the_title', 'wpautop');  // タイトル蘭
	// remove_filter('comment_text', 'wpautop');  // コメント欄
	remove_filter('the_excerpt', 'wpautop');  // 抜粋欄
}
add_action('init', 'disable_output');

/* ---------- モバイル端末判定 ---------- */
function is_mobile()
{
	$useragents = array(
		'iPhone',          // iPhone
		'iPod',            // iPod touch
		'^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
		'dream',           // Pre 1.5 Android
		'CUPCAKE',         // 1.5+ Android
		'blackberry9500',  // Storm
		'blackberry9530',  // Storm
		'blackberry9520',  // Storm v2
		'blackberry9550',  // Storm v2
		'blackberry9800',  // Torch
		'webOS',           // Palm Pre Experimental
		'incognito',       // Other iPhone browser
		'webmate'          // Other iPhone browser
	);
	$pattern = '/' . implode('|', $useragents) . '/i';
	return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

/* ---------- 管理画面のカスタマイズ ---------- */
// function my_custom_menu_order($menu_order)
// {
// 	if (!$menu_order) return true;
// 	return array(
// 		'index.php', // ダッシュボード
// 		'separator1', // 余白
// 		'upload.php', // メディア
// 		'edit.php?post_type=page', // 固定ページ
// 		'edit.php', // トピックス
// 		'edit.php?post_type=works', // 実績紹介
// 		'separator2', // セパレータ２
// 		'plugins.php', // プラグイン
// 		'ai1wm_export', // All-in-One WP Mygration
// 		'wpseo_dashboard', // Yoast SEO
// 		'wp_file_manager', // WP File Manager
// 		'filebird-settings', // Filebird
// 		'cptui_main_menu', // CPT UI
// 		'edit.php?post_type=acf-field-group', // Advanced Custom Fields
// 		'password-protected', // Password Protected
// 		'siteguard', // SiteGugrd
// 		'separator-last', // 最後のセパレータ
// 		'themes.php', // 外観
// 		'users.php', // ユーザー
// 		'tools.php', // ツール
// 		'options-general.php', // 設定
// 		'edit-comments.php', // コメント
// 	);
// }
// add_filter('custom_menu_order', 'my_custom_menu_order');
// add_filter('menu_order', 'my_custom_menu_order');

/* ---------- 一部メニューを削除 ---------- */
function my_remove_menu_pages()
{
	remove_menu_page('edit-comments.php'); // コメント
}
add_action('admin_init', 'my_remove_menu_pages');

/* ---------- デフォルトのエディタスタイルを変更 ---------- */
function editor_enqueue_style()
{
	wp_enqueue_style('block-customize', get_stylesheet_directory_uri() . '/assets/css/block-customize.css', array(), filemtime(get_theme_file_path('/assets/css/block-customize.css')));
}
add_action('enqueue_block_assets', 'editor_enqueue_style', 100);

/* ---------- デフォルトのブロックスタイルを変更 ---------- */
function custom_button_block_render($block_content, $block)
{
	// ボタンブロックかどうかを確認
	if ($block['blockName'] === 'core/button') {
		// 外部リンクを設定
		$block_content = str_replace('<a ', '<a target="_blank" rel="noreferrer external" ', $block_content);
		$block_content = str_replace('</a', '<span></span></a', $block_content);
	}
	// テーブルブロックかどうかを確認
	if ($block['blockName'] === 'core/table') {
		// スクロールバーを設定
		$block_content = str_replace('<figure class="wp-block-table', '<figure data-simplebar data-simplebar-auto-hide="false" class="wp-block-table', $block_content);
	}
	return $block_content;
}
add_filter('render_block', 'custom_button_block_render', 10, 2);
