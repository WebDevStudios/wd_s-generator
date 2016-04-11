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

				<section class="generator" role="main">
					<h2>Create your wd_s based theme</h2>
					<?php do_action( 'wds_wdunderscores_print_form' ); ?>
				</section><!-- .generator -->

				<section class="install">
					<h2>Install Instructions</h2>
					<ol>
						<li>Answer the questions above</li>
						<li>Click "Generate"</li>
						<li>The script will do a find-replace and give you a .zip file</li>
						<li>Download, extract, and place your new theme into wp-content/themes</li>
					</ol>
				</section><!-- .install -->

				<section class="contribute">
					<h2>wd_s is brought to you by these fine folks</h2>
					<?php echo wds_wdunderscores_do_contributors(); ?>
				</section><!-- .contribute -->

				</div><!-- .wrap -->

			</main><!-- #main -->
		</div><!-- .primary -->
<?php get_footer(); ?>