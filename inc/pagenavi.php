<?php

### Function: Page Navigation: Boxed Style Paging
function wp_pagenavi($args = array() ) {

	$args = wp_parse_args( $args, array(
		'before' => '',
		'after' => '',
		'options' => array(),
		'query' => $GLOBALS['wp_query'],
		'type' => 'posts',
		'echo' => true
	) );

	extract( $args, EXTR_SKIP );

	global $wpdb, $wp_query, $paged;
	pagenavi_init(); //Calling the pagenavi_init() function
    //print_r($query);
	if (!is_single()) {
		$request = $query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		if(!empty($paged)) {
			$paged = $paged;
		}elseif(get_query_var( 'paged')) {
        	$paged = get_query_var('paged');
    	}elseif(get_query_var( 'page')) {
    		$paged = get_query_var('page');
    	}else {
    		$paged = 1;
    	}
		$pagenavi_options = get_option('pagenavi_options');
		$numposts = $query->found_posts;
		$max_page = $query->max_num_pages;
        
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = intval($pagenavi_options['num_pages']);
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
			$pages_text = str_replace("%CURRENT_PAGE%", $paged, $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", $max_page, $pages_text);
			echo '<div class="pagination clearfix">'."\n";
			switch(intval($pagenavi_options['style'])) {
				case 1:
					echo ' <span class="pages">'.$pages_text.'</span> ';
					if ($paged >= $pages_to_show_minus_1 && $pages_to_show < $max_page) {
						echo ' <a href="'.get_pagenum_link().'" title="'.$pagenavi_options['first_text'].'">'.$pagenavi_options['first_text'].'</a> ';
						if(!empty($pagenavi_options['dotleft_text'])) {
							echo ' <span class="extend">'.$pagenavi_options['dotleft_text'].'</span> ';
						}
					}
					//previous_posts_link($pagenavi_options['prev_text']);
					for($i = $start_page; $i  <= $end_page; $i++) {						
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", $i, $pagenavi_options['current_text']);
							echo ' <span class="current">'.$current_page_text.'</span> ';
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", $i, $pagenavi_options['page_text']);
							echo ' <a href="'.get_pagenum_link($i).'" title="'.$page_text.'">'.$page_text.'</a> ';
						}
					}
					//next_posts_link($pagenavi_options['next_text'], $max_page);
					if ($end_page < $max_page) {
						if(!empty($pagenavi_options['dotright_text'])) {
							echo ' <span class="extend">'.$pagenavi_options['dotright_text'].'</span> ';
						}
						echo ' <a href="'.get_pagenum_link($max_page).'" title="'.$pagenavi_options['last_text'].'">'.$max_page.'</a> ';
					}
					break;
				case 2;
					echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">'."\n";
					echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">'."\n";
					for($i = 1; $i  <= $max_page; $i++) {
						$page_num = $i;
						if($page_num == 1) {
							$page_num = 0;
						}
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", $i, $pagenavi_options['current_text']);
							echo '<option value="'.get_pagenum_link($page_num).'" selected="selected" class="current">'.$current_page_text."</option>\n";
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", $i, $pagenavi_options['page_text']);
							echo '<option value="'.get_pagenum_link($page_num).'">'.$page_text."</option>\n";
						}
					}
					echo "</select>\n";
					echo "</form>\n";
					break;
			}
			echo '</div>'."\n";
		}
	}
}


### Function: Page Navigation: Drop Down Menu (Deprecated)
function wp_pagenavi_dropdown() { 
	wp_pagenavi(); 
}


### Function: Page Navigation Options

function pagenavi_init() {
	$pagenavi_options = array();
	$pagenavi_options['pages_text'] = __('%CURRENT_PAGE% / %TOTAL_PAGES% Pages','twenty-theme');
	$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['first_text'] = __('1','twenty-theme');
	$pagenavi_options['last_text'] = __('Last Page &rarr;','twenty-theme');
	$pagenavi_options['next_text'] = __('Next Page','twenty-theme');
	$pagenavi_options['prev_text'] = __('Prev Page','twenty-theme');
	$pagenavi_options['dotright_text'] = __('...','twenty-theme');
	$pagenavi_options['dotleft_text'] = __('...','twenty-theme');
	$pagenavi_options['style'] = 1;
	$pagenavi_options['num_pages'] = 5;
	$pagenavi_options['always_show'] = 0;
	
	$update_pagenavi_queries = array();
	$update_pagenavi_queries[] = update_option('pagenavi_options', $pagenavi_options);
	foreach($update_pagenavi_queries as $update_pagenavi_query) {
				$update_pagenavi_query;
				}
}
?>
