<?php
/**
 * Plugin Name: Underscores.me Generator
 * Description: Generates themes based on the _s theme.
 */

class Underscores_Generator_Plugin {

	protected $theme;

	/**
	 * Fired when file is loaded.
	 */
	function __construct() {
		// All the black magic is happening in these actions.
		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'underscoresme_generator_file_contents', array( $this, 'do_replacements' ), 10, 2 );

		// Use do_action( 'underscoresme_print_form' ); in your theme to render the form.
		add_action( 'underscoresme_print_form', array( $this, 'underscoresme_print_form' ) );
	}


	/**
	 * Renders the generator form
	 */
	function underscoresme_print_form() {
		?>
		<div id="generator-form" class="generator-form-skinny">
			<form method="POST">
				<input type="hidden" name="underscoresme_generate" value="1" />

				<section class="generator-form-inputs">
					<section class="generator-form-primary">
						<label for="underscoresme-name">Theme/Client Name</label>
						<input type="text" id="underscoresme-name" name="underscoresme_name" placeholder="Theme/Client Name" />
						<p class="description">Acme Inc.</p>

						<label for="underscoresme-theme-uri">Theme/Client URL</label>
						<input type="text" id="underscoresme-theme-uri" name="underscoresme_theme_uri" placeholder="Theme/Client URL" />
						<p class="description">https://acmeinc.com</p>

						<label for="underscoresme-description">Theme Description</label>
						<input type="text" id="underscoresme-description" name="underscoresme_description" placeholder="Theme Description" />
						<p class="description">A spiffy new theme for Acme Inc. by WebDevStudios based on wd_s</p>

						<label for="underscoresme-functions">Theme Functions Prefix</label>
						<input type="text" id="underscoresme-functions" name="underscoresme_functions" placeholder="Theme Functions Prefix (wds_client)" />
						<p class="description">Functions prefix. Use underscores: wds_acme</p>

						<label for="underscoresme-slug">Theme Text Domain</label>
						<input type="text" id="underscoresme-slug" name="underscoresme_slug" placeholder="Theme Text Domain (wds-client)" />
						<p class="description">Text domain prefix. Use hyphens: wds-acme</p>

						<label for="underscoresme-author">Theme Author</label>
						<input type="text" id="underscoresme-author" name="underscoresme_author" placeholder="Theme Author" />
						<p class="description">WebDevStudios</p>

						<label for="underscoresme-author-uri">Theme Author URL</label>
						<input type="text" id="underscoresme-author-uri" name="underscoresme_author_uri" placeholder="Theme Author URL" />
						<p class="description">https://webdevstudios.com</p>

						<label for="underscoresme-author-email">Theme Author Email</label>
						<input type="text" id="underscoresme-author-email" name="underscoresme_author_email" placeholder="Theme Author Email" />
						<p class="description">wds@webdevstudios.com</p>

						<label for="underscoresme-dev-uri">Theme Development URL</label>
						<input type="text" id="underscoresme-dev-uri" name="underscoresme_dev_uri" placeholder="Theme Development URL" />
						<p class="description">http://acmeinc.dev</p>

					</section><!-- .generator-form-primary-->
				</section><!-- .generator-form-inputs -->

				<div class="generator-form-submit">
					<input type="submit" name="underscoresme_generate_submit" value="Generate" />
					<span class="generator-form-version">Based on <a href="https://github.com/WebDevStudios/wd_s">wd_s from github</a></span>
				</div><!-- .generator-form-submit -->
			</form>
		</div><!-- .generator-form -->
		<?php
	}


	/**
	 * Creates zip files and does a bunch of other stuff.
	 */
	function init() {

		if ( ! isset( $_REQUEST['underscoresme_generate'], $_REQUEST['underscoresme_name'] ) ) {
			return;
		}

		if ( empty( $_REQUEST['underscoresme_name'] ) ) {
			wp_die( 'Please enter a theme name. Please go back and try again.' );
		}

		// Set defaults
		$this->theme = array(
			'name'         => 'Theme Name',
			'slug'         => 'theme-name',
			'uri'          => 'http://underscores.me/',
			'author'       => 'Underscores.me',
			'author_uri'   => 'http://underscores.me/',
			'author_email' => 'no-reply@underscores.me/',
			'dev_uri'      => 'http://underscores.dev',
			'description'  => 'Description',
			'functions'    => 'wds_client',
			'wpcom'        => false,
		);

		$this->theme['name'] = trim( $_REQUEST['underscoresme_name'] );
		$this->theme['slug'] = sanitize_title_with_dashes( $this->theme['name'] );
		$this->theme['functions'] = trim( $_REQUEST['underscoresme_functions'] );
		$this->theme['wpcom'] = (bool) isset( $_REQUEST['can_i_haz_wpcom'] );

		if ( ! empty( $_REQUEST['underscoresme_description'] ) ) {
			$this->theme['description'] = trim( $_REQUEST['underscoresme_description'] );
		}

		if ( ! empty( $_REQUEST['underscoresme_theme_uri'] ) ) {
			$this->theme['uri'] = trim( $_REQUEST['underscoresme_theme_uri'] );
		}

		if ( ! empty( $_REQUEST['underscoresme_functions'] ) ) {
			$this->theme['functions'] = preg_replace( '/\s+/', '_', $_REQUEST['underscoresme_functions'] );
		}

		if ( ! empty( $_REQUEST['underscoresme_slug'] ) ) {
			$this->theme['slug'] = sanitize_title_with_dashes( $_REQUEST['underscoresme_slug'] );
		}

		if ( ! empty( $_REQUEST['underscoresme_author'] ) ) {
			$this->theme['author'] = trim( $_REQUEST['underscoresme_author'] );
		}

		if ( ! empty( $_REQUEST['underscoresme_author_uri'] ) ) {
			$this->theme['author_uri'] = trim( $_REQUEST['underscoresme_author_uri'] );
		}

		if ( ! empty( $_REQUEST['underscoresme_author_email'] ) ) {
			$this->theme['author_email'] = trim( $_REQUEST['underscoresme_author_email'] );
		}

		if ( ! empty( $_REQUEST['underscoresme_dev_uri'] ) ) {
			$this->theme['dev_uri'] = esc_url( $_REQUEST['underscoresme_dev_uri'] );
		}

		$zip = new ZipArchive;
		$zip_filename = sprintf( '/tmp/underscoresme-%s.zip', md5( print_r( $this->theme, true ) ) );
		$res = $zip->open( $zip_filename, ZipArchive::CREATE && ZipArchive::OVERWRITE );

		$prototype_dir = dirname( __FILE__ ) . '/prototype/';

		$exclude_files = array( '.travis.yml', 'codesniffer.ruleset.xml', 'CONTRIBUTING.md', '.git', '.svn', '.DS_Store', '.gitignore', '.', '..' );
		$exclude_directories = array( '.git', '.svn', '.', '..' );

		$iterator = new RecursiveDirectoryIterator( $prototype_dir );
		foreach ( new RecursiveIteratorIterator( $iterator ) as $filename ) {

			if ( in_array( basename( $filename ), $exclude_files ) ) {
				continue;
			}

			foreach ( $exclude_directories as $directory ) {

				if ( strstr( $filename, "/{$directory}/" ) ) {
					continue 2; // continue the parent foreach loop
				}
			}

			$local_filename = str_replace( trailingslashit( $prototype_dir ), '', $filename );

			if ( 'languages/_s.pot' == $local_filename ) {
				$local_filename = sprintf( 'languages/%s.pot', $this->theme['slug'] );
			}

			$contents = file_get_contents( $filename );
			$contents = apply_filters( 'underscoresme_generator_file_contents', $contents, $local_filename );
			$zip->addFromString( trailingslashit( $this->theme['slug'] ) . $local_filename, $contents );
		}

		$zip->close();

		header( 'Content-type: application/zip' );
		header( sprintf( 'Content-Disposition: attachment; filename="%s.zip"', $this->theme['slug'] ) );
		readfile( $zip_filename );
		unlink( $zip_filename );/**/
		die();
	}


	/**
	 * Runs when looping through files contents, does the replacements fun stuff.
	 */
	function do_replacements( $contents, $filename ) {

		// Replace only text files, skip png's and other stuff.
		$valid_extensions = array( 'php', 'css', 'scss', 'js', 'txt' );
		$valid_extensions_regex = implode( '|', $valid_extensions );
		if ( ! preg_match( "/\.({$valid_extensions_regex})$/", $filename ) ) {
			return $contents;
		}

		// Special treatment for style.scss
		if ( in_array( $filename, array( 'assets/sass/style.scss' ), true ) ) {
			$theme_headers = array(
				'Theme Name'  => $this->theme['name'],
				'Theme URI'   => esc_url_raw( $this->theme['uri'] ),
				'Author'      => $this->theme['author'],
				'Author URI'  => esc_url_raw( $this->theme['author_uri'] ),
				'Description' => $this->theme['description'],
				'Text Domain' => $this->theme['slug'],
			);

			// Loop through each file and rename.
			foreach ( $theme_headers as $key => $value ) {
				$contents = preg_replace( '/(' . preg_quote( $key ) . ':)\s?(.+)/', '\\1 ' . $value, $contents );
			}

			// If all else fails, update with just theme name.
			$contents = preg_replace( '/\b_s\b/', $this->theme['slug'], $contents );

			return $contents;
		}

		// Special treatment for functions.php
		if ( 'functions.php' == $filename ) {
			if ( ! $this->theme['wpcom'] ) {
				// The following hack will remove the WordPress.com comment and include in functions.php.
				$find = 'WordPress.com-specific functions';
				$contents = preg_replace( '#/\*\*\n\s+\*\s+' . preg_quote( $find ) . '#i', '@wpcom_start', $contents );
				$contents = preg_replace( '#/inc/wpcom\.php\';#i', '@wpcom_end', $contents );
				$contents = preg_replace( '#@wpcom_start(.+)@wpcom_end\n?(\n\s)?#ims', '', $contents );
			}
		}

		// Special treatment for footer.php
		if ( 'footer.php' == $filename ) {
			// <?php printf( __( 'Theme: %1$s by %2$s.', '_s' ), '_s', '<a href="http://automattic.com/" rel="designer">Automattic</a>' );
			$contents = str_replace( 'http://automattic.com/', esc_url( $this->theme['author_uri'] ), $contents );
			$contents = str_replace( 'Automattic', $this->theme['author'], $contents );
			$contents = preg_replace( "#printf\\((\\s?__\\(\\s?'Theme:[^,]+,[^,]+,)([^,]+),#", sprintf( "printf(\\1 '%s',", esc_attr( $this->theme['name'] ) ), $contents );
		}

		// Special treatment for Gulpfile.js
		if ( 'Gulpfile.js' == $filename ) {
			$contents = str_replace( '_s.pot', $this->theme['slug'] . '.pot', $contents );
			$contents = str_replace( 'mail@_s.com',  $this->theme['author_email'], $contents );
			$contents = str_replace( 'John Doe', $this->theme['author'], $contents );
			$contents = str_replace( 'http://_s.com', esc_url( $this->theme['author_uri'] ), $contents );
			$contents = str_replace( '_s.com', $this->theme['dev_uri'], $contents );
		}

		// DocBlocks Package
		$contents = str_replace( "@package _s", sprintf( "@package %s", $this->theme['name'] ), $contents );

		// Scipt/Styles Prefixed Handles
		$contents = str_replace( "_s-", sprintf( "%s-",  $this->theme['slug'] ), $contents );

		// Text Domains
		$contents = str_replace( "'_s'", sprintf( "'%s'",  $this->theme['slug'] ), $contents );

		// Function names
		$contents = str_replace( "_s_", str_replace( '-', '_', $this->theme['functions'] ) . '_', $contents );

		// I have no idea
		$contents = preg_replace( '/\b_s\b/', $this->theme['name'], $contents );

		return $contents;
	}
}
new Underscores_Generator_Plugin;
