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

				<div id="new-posting-copingblog" class="box-left-copingblog">
					<div class="menu-copingblog">
					<h1 class="entry-title"><a href="/">blogpraktikum.ch</a></h1>
					<a href="/">Frontseite</a> |
					<a href="/">FAQ</a> |
					<a href="/">Impressum</a>
					</div>
					<?php 
						$current_user = wp_get_current_user(); 
						$current_user_blog = get_active_blog_for_user($current_user->ID);
						switch_to_blog($current_user_blog->blog_id);
					?>
					<div>
					<h1 class="entry-title"><a href="<?php echo get_bloginfo('wpurl') ?>/">Mein Weblog</a></h1>
					<a href="<?php echo get_bloginfo('wpurl') ?>/">Frontseite</a> | 
					<a href="<?php echo get_bloginfo('wpurl') ?>/wp-admin/">Dashboard</a>
					
					<p><br>Einen neuen Artikel schreiben<br>
					<a href="<?php echo get_bloginfo('wpurl') ?>/wp-admin/post-new.php?visi=private">Privat</a> | 
					<a href="<?php echo get_bloginfo('wpurl') ?>/wp-admin/post-new.php?visi=pwd">Passwortgesch&uuml;tzt</a> | 
					<a href="<?php echo get_bloginfo('wpurl') ?>/wp-admin/post-new.php">&Ouml;ffentlich</a>
					</p>
					</div>
					<?php restore_current_blog(); ?>
				</div>
			<div id="posts-copingblog" class="box-left-copingblog">
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