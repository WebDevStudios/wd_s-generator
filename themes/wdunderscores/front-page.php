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
					<h2 class="title"><?php esc_html_e( 'Create a WordPress theme based on wd_s', 'wdunderscores' ); ?></h2>
					<?php do_action( 'wds_wdunderscores_print_form' ); ?>
				</section><!-- .generator -->

				<section class="content-section install">
					<h2><?php esc_html_e( 'Generator instructions', 'wdunderscores' ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Answer the questions above', 'wdunderscores' ); ?></li>
						<li><?php esc_html_e( 'Click "Generate"', 'wdunderscores' ); ?></li>
						<li><?php esc_html_e( 'The script will do a find-replace and give you a .zip file', 'wdunderscores' ); ?></li>
						<li><?php esc_html_e( 'Download the zip file, extract, and place your new theme files into wp-content/themes', 'wdunderscores' ); ?></li>
						<li><?php esc_html_e( 'For more information on using wd_s, see the ', 'wdunderscores' ); ?><a title="wd_s readme" href="<?php echo esc_url( 'https://github.com/WebDevStudios/wd_s/blob/master/README.md' ); ?>"><?php esc_html_e( 'wd_s readme', 'wdunderscores' ); ?></a></li>
					</ul>
				</section><!-- .install -->

				<section class="two-col">

					<div class="about">
						<h3><?php esc_html_e( 'Have Questions?', 'wdunderscores' ); ?></h3>
						<p><?php esc_html_e( 'We\'re here to answer any questions or feedback you might have. You can find out more about wd_s on ', 'wdunderscores' ); ?><a href="<?php echo esc_url( 'https://webdevstudios.com/blog/' ); ?>"><?php esc_html_e( 'our blog', 'wdunderscores' ); ?></a><?php esc_html_e( ' or the ', 'wdunderscores' ); ?><a href="<?php echo esc_url( 'https://github.com/WebDevStudios/wd_s' ); ?>"><?php esc_html_e( 'official Github repo.', 'wdunderscores' ); ?></a></p>
						<a href="<?php echo esc_url( 'https://github.com/WebDevStudios/wd_s' ); ?>" class="button button-small"><span class="github-icon"></span><?php esc_html_e( 'Ask a Question', 'wdunderscores' ); ?></a>
						</div><!-- .about -->

					<div class="twitter">
						<h3><?php esc_html_e( 'Follow WebDevStudios', 'wdunderscores' ); ?></h3>
						<p><?php esc_html_e( 'Start a conversation with us on Tiwtter or just drop a friendly “Hello!”.', 'wdunderscores' ); ?></p>
						<a href="<?php echo esc_url( 'https://twitter.com/webdevstudios' ); ?>" class="button button-small"><span class="twitter-icon"></span><?php esc_html_e( '@webdevstudios', 'wdunderscores' ); ?></a>
					</div><!-- .twitter -->
				</section>

				<section class="content-section contribute">
					<h2><?php esc_html_e( 'Brought to you by these fine folks' ); ?></h2>
					<?php echo wds_wdunderscores_do_contributors(); // WPCS XSS OK. ?>
				</section><!-- .contribute -->

			</div><!-- .wrap -->
		</main><!-- #main -->
	</div><!-- .primary -->
<?php get_footer(); ?>
