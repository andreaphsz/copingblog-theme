<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area box-right-copingblog box-shadow-copingblog" role="complementary">
			<aside id="wp_sidebarlogin" class="widget">
				<?php the_widget('Sidebar_Login_Widget',
						array('show_lost_password_link'=>1, 
							'show_register_link'=>1, 
							'logged_in_links'=>"Dashboard | %admin_url%\nProfile | %admin_url%/profile.php\nLogout | %logout_url%"), 
						array('before_title'=>'<h3 class="widget-title">', 'after_title'=>'</h3>'))
				?>
			</aside>
			<aside id="cb_categories" class="widget widget_categories">
				<?php the_widget('WP_Widget_Categories', 'count=1', array('before_title'=>'<h3 class="widget-title">', 'after_title'=>'</h3>')); ?>
			</aside>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
				
	<!--			<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>
	-->
			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>
