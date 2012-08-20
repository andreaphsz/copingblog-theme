<?php

function change_new_post_menu_item()
{
	global $wp_admin_bar;
	$current_user = wp_get_current_user();

	if( $current_user->ID != 1) 
	{
		$wp_admin_bar->remove_node( 'my-sites' );
	}
	$wp_admin_bar->remove_node( 'new-post' );
	$wp_admin_bar->remove_node( 'wp-logo' );
}

add_action('wp_before_admin_bar_render', 'change_new_post_menu_item');

function add_new_post_menu_item()
{
	global $wp_admin_bar;
 
	$args = array(
		'id' => 'blogpraktikum-ch', // id of the existing child node (New > Post)
		'title' => 'blogpraktikum.ch', // alter the title of existing node
		'href' => '/',

    );
	
	$wp_admin_bar->add_node($args);
	
	$current_user = wp_get_current_user(); 
	$current_user_blog = get_active_blog_for_user($current_user->ID);
	
	$args = array(
		'id' => 'mein-blog',
		'title' => $current_user_blog->blogname . "'s Blog",
		'href' => $current_user_blog->siteurl,

    );

    $wp_admin_bar->add_node($args);
	
	$args = array(
		'id' => 'post-public',
		'title' => 'Artikel (&Ouml;ffentlich)',
		'href' => site_url() . '/wp-admin/post-new.php',
    	'parent' => 'new-content',
    );

    $wp_admin_bar->add_node($args);
	
	$args = array(
    	'id' => 'post-pwd',
    	'title' => 'Artikel (&Ouml;ffentlich mit Passwort)',
    	'href' => site_url() . '/wp-admin/post-new.php?visi=pwd',
    	'parent' => 'new-content',
		//'meta' => array('class' => 'my-toolbar-page')
  	);

  	$wp_admin_bar->add_node($args);

	$args = array(
    	'id' => 'post-private',
    	'title' => 'Artikel (Privat)',
    	'href' => site_url() . '/wp-admin/post-new.php?visi=private',
    	'parent' => 'new-content',
		//'meta' => array('class' => 'my-toolbar-page')
  	);

	$wp_admin_bar->add_node($args);

}

add_action('admin_bar_menu', 'add_new_post_menu_item');

// Add support for custom headers.
$custom_header_support = array(
	// Callback for styling the header.
	//'wp-head-callback' => 'blogpraktikum_background_color',
	'height' => apply_filters( 'blogpraktikum_header_image_height', 188 ),
	'width' => apply_filters( 'blogpraktikum_header_image_width', 960 ),
);

add_theme_support( 'custom-header', $custom_header_support );


function blogpraktikum_color_option()
{
	if ( isset( $_POST['blogpraktikum-color'] ) ) {
		//check_admin_referer( 'custom-header-options', '_wpnonce-custom-header-options' );
		$_POST['blogpraktikum-color'] = str_replace( '#', '', $_POST['blogpraktikum-color'] );
		$color = preg_replace('/[^0-9a-fA-F]/', '', $_POST['blogpraktikum-color']);
		if ( strlen($color) == 6 || strlen($color) == 3 )
			set_theme_mod('blogpraktikum_color', $color);
		elseif ( ! $color )
			set_theme_mod( 'blogpraktikum_color', '298951' );
	}
	
	?>
	<table class="form-table">
	<tbody>
<!--	<tr valign="top">
	<th scope="row"><?php echo "Blogpraktikum Farbe"; ?></th>
	<td>
		<p>
		<label><input type="checkbox" name="display-header-text" id="display-header-text"<?php checked( display_header_text() ); ?> /> <?php _e( 'Show header text with your image.' ); ?></label>
		</p>
	</td>
	</tr>
-->
	<tr valign="top">
	<th scope="row"><?php echo "Blogpraktikum Farbe <br>(default: #298951)"; ?></th>
	<td>
		<p>
			<input type="text" name="blogpraktikum-color" id="blogpraktikum-color" value="#<?php echo esc_attr( get_theme_mod('blogpraktikum_color') ); ?>" />
	<!--	<input type="text" name="blogpraktikum-color" id="blogpraktikum-color" value="#<?php echo esc_attr( get_header_textcolor() ); ?>" />
		<input type="text" name="blogpraktikum-color" id="blogpraktikum-color" value="#<?php echo esc_attr( get_theme_support( 'custom-header', 'default-text-color' ) ); ?>" />
	-->
			<a href="#2" class="hide-if-no-js" id="pickcolor-2"><?php _e( 'Select a Color' ); ?></a>
		</p>
		<div id="color-picker-2" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
	</td>
	</tr>


	</tbody>
	</table>
	<?php
	
}

add_action('custom_header_options','blogpraktikum_color_option');



//modification of js_1() in custom-header.php
function js_()
{ ?>
<script type="text/javascript">
/* <![CDATA[ */

(function($) {
	var farbtastic2
	//var default_color = '#<?php echo get_theme_support( 'custom-header', 'default-text-color' ); ?>',
	var default_blogpraktikum_color = '#298951'
	//	header_text_fields;

	function pickColor2(color) 
	{
		//$('#name').css('color', color);
		//$('#desc').css('color', color);
		$('#blogpraktikum-color').val(color);
		farbtastic2.setColor(color);
	}

	function toggle_text2() 
	{
		//var checked = $('#display-header-text').prop('checked'),
		var	blogpraktikum_color;
		//header_text_fields.toggle( checked );
		//if ( ! checked )
		//	return;
		blogpraktikum_color = $('#blogpraktikum-color');
		if ( '' == blogpraktikum_color.val().replace('#', '') ) 
		{
			blogpraktikum_color.val( default_blogpraktikum_color );
			pickColor2( default_blogpraktikum_color );
		} 
		else 
		{
			pickColor2( blogpraktikum_color.val() );
		}
	}

	$(document).ready(function() {
		//alert("hallo")
		//header_text_fields = $('.displaying-header-text');
		$('#pickcolor-2').click(function(e) {
			e.preventDefault();
			$('#color-picker-2').show();
		});

		//$('#display-header-text').click( toggle_text );

		$('#defaultcolor2').click(function() {
			pickColor2(default_blogpraktikum_color);
			$('#blogpraktikum-color').val(default_blogpraktikum_color);
		});

		$('#blogpraktikum-color').keyup(function() {
			var _hex = $('#blogpraktikum-color').val();
			var hex = _hex;
			if ( hex[0] != '#' )
				hex = '#' + hex;
			hex = hex.replace(/[^#a-fA-F0-9]+/, '');
			if ( hex != _hex )
				$('#blogpraktikum-color').val(hex);
			if ( hex.length == 4 || hex.length == 7 )
				pickColor2( hex );
		});

		$(document).mousedown(function() {
			$('#color-picker-2').each( function() {
				var display = $(this).css('display');
				if (display == 'block')
					$(this).fadeOut(2);
			});
		});

		farbtastic2 = $.farbtastic('#color-picker-2', function(color) { 
			pickColor2(color); 
		});
		toggle_text2();
/*	//	<?php if ( display_header_text() ) { ?>
	//	pickColor('#<?php echo get_header_textcolor(); ?>');
	//	<?php } else { ?>
		toggle_text2();
	//	<?php } ?>
*/	});
})(jQuery);
/* ]]> */
</script>
<?php
	}

if( (int) $_GET['step'] != 2 )
{
	add_action("admin_head-appearance_page_custom-header", 'js_');
}


add_filter( 'the_title', 'copingblog_modified_post_title', 10, 2);

function copingblog_modified_post_title ($title, $id)
{
 	$post = get_post($id);

	if ( !is_admin() && empty($post->post_password) && 'private' != $post->post_status ) {
    	$title = $title . '&nbsp;&nbsp;<img title="&Ouml;ffentlich" src="' . get_stylesheet_directory_uri() . '/images/icons/glyphicons_010_envelope.png" />';
  	}
  	return $title;
}

//see http://ben.lobaugh.net/blog/20041/wordpress-how-to-remove-protected-and-private-from-post-titles
add_filter( 'protected_title_format', 'bl_remove_protected_title' );
 
function bl_remove_protected_title( $title ) 
{
    // Return only the title portion as defined by %s, not the additional 
    // 'Protected: ' as added in core
    return "%s" . '&nbsp;&nbsp;<img title="&Ouml;ffentlich mit Passwort" src="' . get_stylesheet_directory_uri() . '/images/icons/glyphicons_128_message_lock.png" />';
}

add_filter( 'private_title_format', 'bl_remove_private_title' );
 
function bl_remove_private_title( $title ) 
{
    // Return only the title portion as defined by %s, not the additional 
    // 'Private: ' as added in core
    return "%s" . '&nbsp;&nbsp;<img title="Privat" src="' . get_stylesheet_directory_uri() . '/images/icons/glyphicons_126_message_ban.png" />';
}

//deregister the header images of Twenty Eleven, and register a few new RAW header images//
//see http://wordpress.stackexchange.com/questions/40881/optimal-approach-for-replacing-the-8-header-images-in-a-child-theme
add_action( 'after_setup_theme', 'raw_theme_header_images', 11 ); 

function raw_theme_header_images() {
	unregister_default_headers( array( 'wheel', 'shore', 'trolley', 'pine-cone', 'chessboard', 'lanterns', 'willow', 'hanoi' ) ); 
	//$folder = get_stylesheet_directory_uri();
	register_default_headers( array(
		'wheel' => array(
			'url' => '%2$s/images/headers/wheel.jpg',
			'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wheel', 'twentyeleven' )
		),
		'shore' => array(
			'url' => '%2$s/images/headers/shore.jpg',
			'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Shore', 'twentyeleven' )
		),
		'trolley' => array(
			'url' => '%2$s/images/headers/trolley.jpg',
			'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Trolley', 'twentyeleven' )
		),
		'pine-cone' => array(
			'url' => '%2$s/images/headers/pine-cone.jpg',
			'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Pine Cone', 'twentyeleven' )
		),
		'chessboard' => array(
			'url' => '%2$s/images/headers/chessboard.jpg',
			'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Chessboard', 'twentyeleven' )
		),
		'lanterns' => array(
			'url' => '%2$s/images/headers/lanterns.jpg',
			'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Lanterns', 'twentyeleven' )
		),
		'willow' => array(
			'url' => '%2$s/images/headers/willow.jpg',
			'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Willow', 'twentyeleven' )
		),
		'hanoi' => array(
			'url' => '%2$s/images/headers/hanoi.jpg',
			'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hanoi Plant', 'twentyeleven' )
		)
	) );

}