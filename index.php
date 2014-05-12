<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				
					<?php 
						$current_user = wp_get_current_user(); 
						$current_user_blog = get_active_blog_for_user($current_user->ID);
						//switch_to_blog($current_user_blog->blog_id);
						//var_dump($current_user_blog);
						$menu_tumblr = get_site_option( 'cb_menu_tumblr' );
						$menu_blogpr = get_site_option( 'cb_menu_blogpr' );
						
					?>
					<?php if($current_user->ID > 0): ?>
					<?php if(isset($menu_tumblr) && $menu_tumblr==1): ?>
					<div id="new-posting-copingblog" class="box-left-copingblog box-shadow-copingblog">
					
						<h1 class="entry-title">Einen neuen Artikel schreiben</a></h1>
						<a href="<?php echo $current_user_blog->siteurl ?>/wp-admin/post-new.php">
							<img title="&Ouml;ffentlich" src="<?php echo get_stylesheet_directory_uri() ?>/images/icons/glyphicons_010_envelope.png" />
							&Ouml;ffentlich</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
						<a href="<?php echo $current_user_blog->siteurl ?>/wp-admin/post-new.php?visi=pwd">
							<img title="&Ouml;ffentlich mit Passwort" src="<?php echo get_stylesheet_directory_uri() ?>/images/icons/glyphicons_128_message_lock.png" />
							&Ouml;ffentlich mit Passwort</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
						<a href="<?php echo $current_user_blog->siteurl ?>/wp-admin/post-new.php?visi=private">
							<img title="&Ouml;ffentlich mit Passwort" src="<?php echo get_stylesheet_directory_uri() ?>/images/icons/glyphicons_126_message_ban.png" />
							Privat</a>
					
					</div>
					<?php endif;?>
					<?php if(isset($menu_blogpr) && $menu_blogpr==1): ?>
					<div id="bloggingtool-copingblog" class="box-left-copingblog box-shadow-copingblog">
					
						<h1 class="entry-title">Blogging Tool</a></h1>
					<!--	<a href="<?php echo $current_user_blog->siteurl ?>/wp-admin/admin.php?page=feinplanung_menu">
							<img title="Planungsinstrumente" src="<?php echo get_stylesheet_directory_uri() ?>/images/icons/glyphicons_119_table.png" />
							Planungsinstrumente</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
						<a href="<?php echo $current_user_blog->siteurl ?>/wp-admin/admin.php?page=reflexionps_menu">
							<img title="Reflexion PS" src="<?php echo get_stylesheet_directory_uri() ?>/images/icons/glyphicons_082_roundabout.png" />
						 	Reflexion PS</a>&nbsp;&nbsp;|&nbsp;&nbsp;
				-->		<?php if (cb_get_user_experimental_group() != CB_GROUP_CTRL): ?>
						<a href="<?php echo $current_user_blog->siteurl ?>/wp-admin/admin.php?page=reflexion_menu">
							<img title="Bloggen" src="<?php echo get_stylesheet_directory_uri() ?>/images/icons/glyphicons_080_retweet.png" />
							Bloggen</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<!--			<?php endif;?>
						<a href="<?php echo $current_user_blog->siteurl ?>/wp-admin/admin.php?page=evaluation_menu">
							<img title="Evaluation" src="<?php echo get_stylesheet_directory_uri() ?>/images/icons/glyphicons_041_charts.png" />
							Evaluation</a>
				-->	
					</div>
					<?php endif;?>
					<?php endif;?>
					<?php //restore_current_blog(); ?>
				
			<div id="posts-copingblog" class="box-left-copingblog box-shadow-copingblog">
			<?php if ( have_posts() ) : ?>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
			</div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>