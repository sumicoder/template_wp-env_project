<?php
/**
 * セキュリティー対策 security
 */

/**
 * wordpressバージョン情報の削除
 * @see　https://qiita.com/Taka96/items/b541b1fef0fa20add47d
 */
remove_action('wp_head', 'wp_generator');

/**
 * 投稿者一覧ページを自動で生成されないようにする
 * @see　https://qiita.com/Taka96/items/b541b1fef0fa20add47d
 */
add_filter('author_rewrite_rules', '__return_empty_array');
function disable_author_archive()
{
	if (preg_match('#/author/.+#', $_SERVER['REQUEST_URI'])) {
		wp_redirect(esc_url(home_url('/404.php')));
		exit;
	}
}
add_action('init', 'disable_author_archive');

/**
 * /?author=1 などでアクセスしたらリダイレクトさせる
 * @see https://www.webdesignleaves.com/pr/wp/wp_user_enumeration.html
 */
if (!is_admin()) {
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
	add_filter('redirect_canonical', 'my_shapespace_check_enum', 10, 2);
}
function my_shapespace_check_enum($redirect, $request)
{
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}

/* ---------- ログイン画面のロゴを変更 ---------- */
function custom_login_logo()
{
?>
	<style type="text/css">
		#login h1 a {
			display: block;
			background-repeat: no-repeat;
			background-size: cover;
			background-image: url(./wp-content/themes/wp-theme-name/assets/images/00_common/logo.svg);
			width: 200px;
			height: 60px;
		}
	</style>
<?php
}
add_action('login_head', 'custom_login_logo');

/* ---------- ログイン画面のURLを変更 ---------- */
function custom_login_logo_url()
{
	return get_bloginfo('url');
}
add_filter('login_headerurl', 'custom_login_logo_url');

/* ---------- マイグレーションでnode_modulesなどを除外 ---------- */
$my_theme = wp_get_theme();
$_theme_name = $my_theme->stylesheet;

add_filter(
	'ai1wm_exclude_themes_from_export',
	function ($exclude_filters) {
		global $_theme_name;
		$exclude_filters = array(
			"{$_theme_name}/gulp/node_modules",
		);
		return $exclude_filters;
	}
);