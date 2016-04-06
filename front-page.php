<?php
/**
 * The front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wdunderscores
 */

get_header(); ?>

	<div class="wrap">
		<div class="primary content-area">
			<main id="main" class="site-main" role="main">

				<section class="generator" role="main">
					<h1>Create your wd_s based theme</h1>
					<?php do_action( 'wds_wdunderscores_print_form' ); ?>
				</section><!-- .generator -->

				<section class="about">
					<div class="intro">
						<h3>What is Underscores?</h3>
						<p>Hi. I'm a starter theme called <em>_s</em>, or <em>underscores</em>, if you like. I'm a theme meant for hacking so don't use me as a Parent Theme. Instead try turning me into the next, most awesome, WordPress theme out there. That's what I'm here for.</p>
						<p>My ultra-minimal CSS might make me look like theme tartare but that means less stuff to get in your way when you're designing your awesome theme. Here are some of the other more interesting things you'll find here ...</p>
						<p>Learn more about me in "<a href="http://themeshaper.com/2012/02/13/introducing-the-underscores-theme/">A 1000-Hour Head Start: Introducing The _s Theme</a>" on <a href="http://themeshaper.com/">ThemeShaper</a>.</p>
					</div><!-- .intro -->
					<ul class="features">
						<li>A just right amount of lean, well-commented, modern, HTML5 templates.</li>
						<li>A helpful 404 template.</li>
						<li>An optional sample custom header implementation in <code>inc/custom-header.php</code></li>
						<li>Custom template tags in <code>inc/template-tags.php</code> that keep your templates clean and neat and prevent code duplication.</li>
						<li>Some small tweaks in <code>inc/extras.php</code> that can improve your theming experience.</li>
						<li>A script at <code>js/navigation.js</code> that makes your menu a toggled dropdown on small screens (like your phone), ready for CSS artistry.</li>
						<li>2 sample CSS layouts in <code>layouts/</code>: A sidebar on the right side of your content and a sidebar on the left side of your content.</li>
						<li>Smartly organized starter CSS in <code>style.css</code> that will help you to quickly get your design off the ground.</li>
						<li>The GPL license in license.txt. Use it to make something cool.</li>
					</ul><!-- .features -->
				</section><!-- .about -->

				<section class="contribute">
					<h3>wd_s is brought to you by these fine folks</h3>
					<?php echo wds_wdunderscores_do_contributors(); ?>
				</section><!-- .contribute -->

			</main><!-- #main -->
		</div><!-- .primary -->
	</div><!-- .wrap -->
<?php get_footer(); ?>