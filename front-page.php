<?php
/**
 * The front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wdunderscores
 */

get_header(); ?>

	<div class="primary content-area">
		<main id="main" class="site-main" role="main">
			<div class="wrap">

			<h2 class="title"><?php echo esc_html( 'Create a WordPress theme based on wd_s' ); ?></h2>

				<section class="content-section generator" role="main">
					<?php do_action( 'wds_wdunderscores_print_form' ); ?>
				</section><!-- .generator -->

				<section class="content-section install">
					<h2><?php echo esc_html( 'Generator instructions' ); ?></h2>
					<ol>
						<li><?php echo esc_html( 'Answer the questions above' ); ?></li>
						<li><?php echo esc_html( 'Click "Generate"' ); ?></li>
						<li><?php echo esc_html( 'The script will do a find-replace and give you a .zip file' ); ?></li>
						<li><?php echo esc_html( 'Download the zip file, extract, and place your new theme files into wp-content/themes' ); ?></li>
						<li><?php echo esc_html( 'For more information on using wd_s, see the ' ); ?><a title="wd_s readme" href="<?php echo esc_url( 'https://github.com/WebDevStudios/wd_s/blob/master/README.md' ); ?>"><?php echo esc_html( 'wd_s readme' ); ?></a></li>
					</ol>
				</section><!-- .install -->

				<section class="content-section about">
					<h2><?php echo esc_html( 'About' ); ?></h2>
					<p><?php echo esc_html( 'Hi. I\'m a starter theme called wd_s, or wdunderscores. I\'m a theme meant for hacking so don\'t use me as a Parent Theme. Instead, try turning me into the next, most awesome, WordPress theme out there. That\'s what I\'m here for!' ); ?></p>
					<p><?php echo esc_html( 'I feature some of the web\'s most exciting technologies like: Gulp, LibSass, PostCSS, Bourbon, Neat, and BrowserSync to help make your development process fast and efficient. I\'m also accessible, passing both WCAG 2.0AA and Section 508 standards out of the box.' ); ?></p>
					<p><?php echo esc_html( 'Find out more about me' ); ?> <a href="<?php echo esc_html( 'https://webdevstudios.com/tags/wd_s/' ); ?>"><?php echo esc_html( 'on my blog' ); ?></a> <?php echo esc_html( 'or check me out at' ); ?> <a href="<?php echo esc_html( 'https://github.com/webdevstudios/wd_s' ); ?>"><?php echo esc_html( 'Github' ); ?></a>.
				</section><!-- .contribute -->

				<section class="content-section contribute">
					<h2><?php echo esc_html( 'Brought to you by these fine folks' ); ?></h2>
					<?php echo wds_wdunderscores_do_contributors(); ?>
				</section><!-- .contribute -->

			</div><!-- .wrap -->
		</main><!-- #main -->
	</div><!-- .primary -->
<?php get_footer(); ?>