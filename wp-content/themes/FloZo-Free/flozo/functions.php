<?php


/*** Option Tree code ***/
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );

/**
 * Theme Options
 */
include_once( 'includes/theme-options.php' );
/*** Option Tree end ***/

function limit_words($string, $word_limit) {
 
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
 
	$words = explode(' ', $string);
 
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
 
	return implode(' ', array_slice($words, 0, $word_limit));
 
}


add_theme_support( 'menus' );

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<aside>',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));

add_action('init', 'work_register');   

function work_register() {   

	$labels = array( 
		'name' => _x('Work', 'post type general name'), 
		'singular_name' => _x('Work Item', 'post type singular name'), 
		'add_new' => _x('Add New', 'work item'), 
		'add_new_item' => __('Add New Work Item'), 
		'edit_item' => __('Edit Work Item'), 
		'new_item' => __('New Work Item'), 
		'view_item' => __('View Work Item'), 
		'search_items' => __('Search Work'), 
		'not_found' => __('Nothing found'), 
		'not_found_in_trash' => __('Nothing found in Trash'), 
		'parent_item_colon' => '' 
	);   
	
	$args = array( 
		'labels' => $labels, 
		'public' => true, 
		'publicly_queryable' => true, 
		'show_ui' => true, 
		'query_var' => true, 
		'menu_icon' => get_stylesheet_directory_uri() . '/article16.png', 
		'rewrite' => true, 'capability_type' => 'post', 
		'hierarchical' => false, 
		'menu_position' => null, 
		'supports' => array('title','editor','thumbnail') 
	);   
	
	register_post_type( 'work' , $args ); 
	
	//register_taxonomy("categories", array("work"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => true));
	
	
	
}
	








function post_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), ' ' );
			?>
		</div>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>

	<li class="post pingback">
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)' ), ' ' ); ?></p>
	<?php

		break;
	endswitch;
}



// Custom functions 

// START : Show word count on blog post pages
// See more about the word count and reading time here http://www.welcomebrand.co.uk/blog/2010/12/12/wordpress-reading-time-and-word-count/
function show_post_word_count(){
    ob_start();
    the_content();
    $content = ob_get_clean();
    return sizeof(explode(" ", $content));
}
// END : Show word count

// START : Estimated reading time on blog post pages
if (!function_exists('est_read_time')):
function est_read_time( $return = false) {
	$wordcount = round(str_word_count(get_the_content()), -2);
	$minutes_fast = ceil($wordcount / 250);
	$minutes_slow = ceil($wordcount / 170);
 
	if ($wordcount <= 100) {
		$output = __("< 1 minute");
	} else {
		$output = sprintf(__("%s - %s minutes"), $minutes_fast, $minutes_slow);
	}
	echo $output;
}
endif;
 
if (!function_exists('est_the_content')):
function est_the_content( $orig ) {
	// Prepend the reading time to the post content
	return est_read_time(true) . "\n\n" . $orig;
}
endif;
// END : Estimated reading time


// Tidy up the <head> a little. Full reference of things you can show/remove is here: http://rjpargeter.com/2009/09/removing-wordpress-wp_head-elements/
remove_action('wp_head', 'wp_generator');// Removes the WordPress version as a layer of simple security 

add_theme_support('post-thumbnails');

add_image_size( 'flozo-thumb', 284, 200, true );

add_shortcode('gallery', 'new_gallery_shortcode');

function new_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'large',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$output.= "<script class=\"secret-source\">
		jQuery(document).ready(function($) {
			$('.gallery').bjqs({
				height      : 391,
				width       : 604,
				responsive  : true,
				showmarkers : false,
				usecaptions : false,
				animtype    : 'slide',
				randomstart : false
			});
		});
	</script>
	<div class=\"gallery\">
	<ul class=\"bjqs\">\r\n";
	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
		$output.= "\t\t".'<li>'.$link.'<p>'.wptexturize($attachment->post_excerpt).'</p></li>'."\r\n";
	}

	$output.= "\t</ul>
	</div>";

	return $output;

}