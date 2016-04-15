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

					<section class="content-section generator" role="main">
						<h2>Create a WordPress theme based on wd_s</h2>
						<?php do_action( 'wds_wdunderscores_print_form' ); ?>
					</section><!-- .generator -->

					<section class="content-section install">
						<h2>Generator instructions</h2>
						<ol>
							<li>Answer the questions above</li>
							<li>Click "Generate"</li>
							<li>The script will do a find-replace and give you a .zip file</li>
							<li>Download the zip file, extract, and place your new theme files into wp-content/themes</li>
							<li>For more information on using wd_s, see the <a title="wd_s readme" href="https://github.com/WebDevStudios/wd_s/blob/master/README.md">wd_s readme</a></li>
						</ol>
					</section><!-- .install -->

					<section class="content-section about">
						<h2>About</h2>
						<a href="https://github.com/WebDevStudios/wd_s">wd_s</a> is a fork of Automattic's <a href="https://github.com/Automattic/_s">_s</a>. It's used as the starter theme at <a href="https://webdevstudios.com">WebDevStudios</a>, a leading WordPress development agency.
					</section><!-- .contribute -->

					<section class="content-section contribute">
						<h2>Brought to you by these fine folks</h2>
						<?php echo wds_wdunderscores_do_contributors(); ?>
					</section><!-- .contribute -->

				</div><!-- .wrap -->
			</main><!-- #main -->
		</div><!-- .primary -->
<?php get_footer(); ?>