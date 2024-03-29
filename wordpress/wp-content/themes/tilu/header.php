<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?>
	<!doctype html>
	<html <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="description" content="TILU er en bæredygtig vintage interiørbutik med fokus på mix and match. Sammensætte din egen unikke borddækning med TILU’s udvalg af tallerkner, skåle og mere" />
		<link rel="profile" href="https://gmpg.org/xfn/11" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
			<div id="page" class="site">
				<a class="skip-link screen-reader-text" href="#content">
					<?php _e( 'Skip to content', 'twentynineteen' ); ?>
				</a>

				<header id="masthead" class="<?php echo is_singular() && twentynineteen_can_show_post_thumbnail() ? 'site-header featured-image' : 'site-header'; ?>">

					<div class="site-branding-container">
						<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
					</div>
					<!-- .site-branding-container -->

					<?php if ( is_singular() && twentynineteen_can_show_post_thumbnail() ) : ?>
						<div class="site-featured-image">
							<?php
						twentynineteen_post_thumbnail();
						the_post();
						$discussion = ! is_page() && twentynineteen_can_show_post_thumbnail() ? twentynineteen_get_discussion_data() : null;

						$classes = 'entry-header';
					if ( ! empty( $discussion ) && absint( $discussion->responses ) > 0 ) {
						$classes = 'entry-header has-discussion';
					}
					?>
								<div class="<?php echo $classes; ?>">
									<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
								</div>
								<!-- .entry-header -->
								<?php rewind_posts(); ?>
						</div>
						<?php endif; ?>
							<img src="https://cdn2.iconfinder.com/data/icons/250-perfect-vector-pictograms/48/3.5-512.png" alt="shoppingkurv" class="kurv">
				</header>
				<!-- #masthead -->

				<div id="content" class="site-content">
