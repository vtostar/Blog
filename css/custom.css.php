<?php  
header('Content-type: text/css');

require '../../../../wp-load.php';
$lang = get_bloginfo( 'language' );
$main_color = get_theme_mod( 'classplus_main_color', '#ff4629' );
?>
<?php if($lang = 'zh_CN') { ?>
body {
	font-family: "Open Sans", Arial, "Hiragino Sans GB", "Microsoft YaHei", "STHeiti", "WenQuanYi Micro Hei", SimSun, sans-serif;
}
<?php } ?>
.list-categories > li > a {
	color: <?php echo $main_color ?>;
}
.categories-links a {
	background-color: <?php echo $main_color ?>;
}
.categories-links a:hover {
	background-color: <?php echo ColorDarken($main_color, 20); ?>;
}
.pagination a:hover,
.pagination a:focus,
.pagination span.current {
	background-color: <?php echo $main_color ?>;
  	border-color: <?php echo $main_color ?>;
}
.single-post .entry-meta .entry-actions a:hover {
	color: <?php echo $main_color ?>;
}
.comment-list .comment-reply-link {
	color: <?php echo $main_color ?>;
}
.widget-title {
	color: <?php echo $main_color ?>;
}