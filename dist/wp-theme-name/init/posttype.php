<?php
// /* ---------- デフォルト投稿タイプを『トピックス』 ---------- */
// function post_has_archive($args, $post_type)
// {
// 	if ('post' == $post_type) {
// 		$args['rewhite'] = [
// 			"slug" => "topics",
// 			"with_front" => true
// 		];
// 		$args['has_archive'] = 'topics';
// 		$args['label'] = 'トピックス';
// 		$args['labels'] = [
// 			"singular_name" => "topics",
// 			"edit_item" => "topics",
// 		];
// 	}
// 	return $args;
// }
// add_filter('register_post_type_args', 'post_has_archive', 10, 2);

// /* ---------- 投稿ページのパーマリンクをカスタマイズ ---------- */
// function add_article_post_permalink($permalink)
// {
// 	$permalink = '/topics' . $permalink;
// 	return $permalink;
// }
// add_filter('pre_post_link', 'add_article_post_permalink');

// function add_article_post_rewrite_rules($post_rewrite)
// {
// 	$return_rule = array();
// 	foreach ($post_rewrite as $regex => $rewrite) {
// 		$return_rule['topics/' . $regex] = $rewrite;
// 	}
// 	return $return_rule;
// }
// add_filter('post_rewrite_rules', 'add_article_post_rewrite_rules');

// /* ---------- サイドバーメニューからカテゴリー、タグを削除（既存の投稿と既存のカテゴリー、タグ） ---------- */
// function remove_menu() {
//     remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
// }
// add_action('admin_menu', 'remove_menu');

// /* ---------- カスタムタクソノミーを説明にある順番で並べる ---------- */
// function taxonomy_orderby_description($orderby, $args)
// {
// 	if (isset($args['orderby']) && $args['orderby'] == 'description') {
// 		$orderby = 'tt.description';
// 	}
// 	return $orderby;
// }
// add_filter('get_terms_orderby', 'taxonomy_orderby_description', 10, 2);