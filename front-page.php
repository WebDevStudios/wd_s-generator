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
					<h2 class="title"><?php echo esc_html( 'Create a WordPress theme based on wd_s' ); ?></h2>
					<?php do_action( 'wds_wdunderscores_print_form' ); ?>
				</section><!-- .generator -->

				<section class="content-section install">
					<h2><?php echo esc_html( 'Generator instructions' ); ?></h2>
					<ul>
						<li><?php echo esc_html( 'Answer the questions above' ); ?></li>
						<li><?php echo esc_html( 'Click "Generate"' ); ?></li>
						<li><?php echo esc_html( 'The script will do a find-replace and give you a .zip file' ); ?></li>
						<li><?php echo esc_html( 'Download the zip file, extract, and place your new theme files into wp-content/themes' ); ?></li>
						<li><?php echo esc_html( 'For more information on using wd_s, see the ' ); ?><a title="wd_s readme" href="<?php echo esc_url( 'https://github.com/WebDevStudios/wd_s/blob/master/README.md' ); ?>"><?php echo esc_html( 'wd_s readme' ); ?></a></li>
					</ul>
				</section><!-- .install -->

				<section class="two-col">

					<div class="about">
						<h3><?php echo esc_html( 'Have Questions?' ); ?></h3>
						<p><?php echo esc_html( 'We\'re here to answer any questions or feedback you might have. You can find out more about wd_s on ' ); ?><a href="<?php echo esc_url( 'https://webdevstudios.com/blog/' ); ?>"><?php echo esc_html( 'our blog' ); ?></a><?php echo esc_html( ' or the ' ); ?><a href="<?php echo esc_url( 'https://github.com/WebDevStudios/wd_s' ); ?>"><?php echo esc_html( 'official Github repo.' ); ?></a></p>
						<a href="<?php echo esc_url( 'https://github.com/WebDevStudios/wd_s' ); ?>" class="button button-small"><span class="github-icon"></span><?php echo esc_html( 'Ask a Question' ); ?></a>
						</div><!-- .about -->

					<div class="twitter">
						<h3><?php echo esc_html( 'Follow WebDevStudios' ); ?></h3>
						<p><?php echo esc_html( 'Start a conversation with us on Tiwtter or just drop a friendly “Hello!”.' ); ?></p>
						<a href="<?php echo esc_url( 'https://twitter.com/webdevstudios' ); ?>" class="button button-small"><span class="twitter-icon"></span><?php echo esc_html( '@webdevstudios' ); ?></a>
					</div><!-- .twitter -->
				</section>

				<section class="content-section contribute">
					<h2><?php echo esc_html( 'Brought to you by these fine folks' ); ?></h2>
					<?php echo wds_wdunderscores_do_contributors(); ?>
				</section><!-- .contribute -->

			</div><!-- .wrap -->
		</main><!-- #main -->
	</div><!-- .primary -->
<?php get_footer(); ?>