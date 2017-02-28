<?php
/**
 * Theme generator.
 */
class WDS_Theme_Generator {

	protected $theme;

	/**
	 * Contructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'wds_wdunderscores_generator_file_contents', array( $this, 'do_replacements' ), 10, 2 );

		// Use do_action( 'underscoresme_print_form' ); in your theme to render the form.
		add_action( 'wds_wdunderscores_print_form', array( $this, 'print_form' ) );
	}

	/**
	 * Renders the generator form.
	 */
	public function print_form() { ?>

		<div id="generator-form" class="generator-form">
			<form method="POST">
				<input type="hidden" name="wds_wdunderscores_generate" value="1" />

				<section class="generator-form-inputs">
					<section class="generator-form-primary">

						<div class="input-group group-one">
							<div class="field-group">
								<label for="wdunderscores-name">Name</label>
								<input type="text" id="wdunderscores-name" name="wds_wdunderscores_name" placeholder="Theme Name" />
								<p class="description">Acme Inc.</p>
							</div>
							<div class="field-group">
								<label for="wdunderscores-theme-uri">URL</label>
								<input type="text" id="wdunderscores-theme-uri" name="wds_wdunderscores_theme_uri" placeholder="Theme URL" />
								<p class="description">https://acmeinc.com</p>
							</div>
						</div><!-- .group-one -->

						<div class="input-group group-two">
							<div class="field-group">
								<label for="wdunderscores-description">Description</label>
								<input type="text" id="wdunderscores-description" name="wds_wdunderscores_description" placeholder="Theme Description" />
								<p class="description">A spiffy new theme for Acme Inc. by WebDevStudios based on wd_s.</p>
							</div>
							<div class="field-group">
								<label for="wdunderscores-functions">Functions Prefix</label>
								<input type="text" id="wdunderscores-functions" name="wds_wdunderscores_functions" placeholder="Theme Functions Prefix (wds_client)" />
								<p class="description">Functions prefix. Use underscores: wds_acme</p>
							</div>
						</div><!-- .group-two -->


						<div class="input-group group-three">
							<div class="field-group">
								<label for="wdunderscores-slug">Text Domain</label>
								<input type="text" id="wdunderscores-slug" name="wds_wdunderscores_slug" placeholder="Theme Text Domain (acme-inc)" />
								<p class="description">Text domain prefix. acme-inc</p>
							</div>
							<div class="field-group">
								<label for="wdunderscores-author">Author</label>
								<input type="text" id="wdunderscores-author" name="wds_wdunderscores_author" placeholder="Theme Author" />
								<p class="description">WebDevStudios</p>
							</div>
						</div><!-- .group-three -->


						<div class="input-group group-four">
							<div class="field-group">
								<label for="wdunderscores-author-uri">Author URL</label>
								<input type="text" id="wdunderscores-author-uri" name="wds_wdunderscores_author_uri" placeholder="Theme Author URL" />
								<p class="description">https://webdevstudios.com</p>
							</div>
							<div class="field-group">
								<label for="wdunderscores-author-email">Author Email</label>
								<input type="text" id="wdunderscores-author-email" name="wds_wdunderscores_author_email" placeholder="Theme Author Email" />
								<p class="description">wds@webdevstudios.com</p>
							</div>
						</div><!-- .group-four -->


						<div class="input-group group-five">
							<div class="field-group">
								<label for="wdunderscores-dev-uri">Development URL</label>
								<input type="text" id="wdunderscores-dev-uri" name="wds_wdunderscores_dev_uri" placeholder="Theme Development URL" />
								<p class="description">http://acmeinc.dev</p>
							</div>
						</div><!-- .group-five -->


					</section><!-- .generator-form-primary-->
				</section><!-- .generator-form-inputs -->

				<div class="generator-form-submit">
					<input type="submit" name="wds_wdunderscores_generate_submit" value="Generate my theme!" />
				</div><!-- .generator-form-submit -->
			</form>
		</div><!-- .generator-form -->

		<?php
	}

	/**
	 * Creates zip files and does a bunch of other stuff.
	 */
	public function init() {

		if ( ! isset( $_REQUEST['wds_wdunderscores_generate'], $_REQUEST['wds_wdunderscores_name'] ) ) {
			return;
		}

		if ( empty( $_REQUEST['wds_wdunderscores_name'] ) ) {
			wp_die( 'Please enter a theme name. Please go back and try again.' );
		}

		// Set defaults
		$this->theme = array(
			'name'         => 'Acme Inc.',
			'slug'         => 'acme-inc',
			'uri'          => 'https://acmeinc.com',
			'author'       => 'WebDevStudios',
			'author_uri'   => 'https://webdevstudios.com/',
			'author_email' => 'wds@webdevstudios.com',
			'dev_uri'      => 'http://acmeinc.dev',
			'description'  => 'A spiffy new theme for Acme Inc. by WebDevStudios based on wd_s',
			'functions'    => 'wds_acme',
			'wpcom'        => false,
		);

		$this->theme['name'] = trim( $_REQUEST['wds_wdunderscores_name'] );
		$this->theme['slug'] = sanitize_title_with_dashes( $this->theme['name'] );
		$this->theme['functions'] = trim( $_REQUEST['wds_wdunderscores_functions'] );
		$this->theme['wpcom'] = (bool) isset( $_REQUEST['can_i_haz_wpcom'] );

		if ( ! empty( $_REQUEST['wds_wdunderscores_description'] ) ) {
			$this->theme['description'] = trim( $_REQUEST['wds_wdunderscores_description'] );
		}

		if ( ! empty( $_REQUEST['wds_wdunderscores_theme_uri'] ) ) {
			$this->theme['uri'] = trim( $_REQUEST['wds_wdunderscores_theme_uri'] );
		}

		if ( ! empty( $_REQUEST['wds_wdunderscores_functions'] ) ) {
			$this->theme['functions'] = preg_replace( '/\s+/', '_', $_REQUEST['wds_wdunderscores_functions'] );
		}

		if ( ! empty( $_REQUEST['wds_wdunderscores_slug'] ) ) {
			$this->theme['slug'] = sanitize_title_with_dashes( $_REQUEST['wds_wdunderscores_slug'] );
		}

		if ( ! empty( $_REQUEST['wds_wdunderscores_author'] ) ) {
			$this->theme['author'] = trim( $_REQUEST['wds_wdunderscores_author'] );
		}

		if ( ! empty( $_REQUEST['wds_wdunderscores_author_uri'] ) ) {
			$this->theme['author_uri'] = trim( $_REQUEST['wds_wdunderscores_author_uri'] );
		}

		if ( ! empty( $_REQUEST['wds_wdunderscores_author_email'] ) ) {
			$this->theme['author_email'] = trim( $_REQUEST['wds_wdunderscores_author_email'] );
		}

		if ( ! empty( $_REQUEST['wds_wdunderscores_dev_uri'] ) ) {
			$this->theme['dev_uri'] = esc_url( $_REQUEST['wds_wdunderscores_dev_uri'] );
		}

		$zip = new ZipArchive;
		$zip_filename = sprintf( '/tmp/wdunderscores-%s.zip', md5( print_r( $this->theme, true ) ) );
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
			$contents = apply_filters( 'wds_wdunderscores_generator_file_contents', $contents, $local_filename );
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
	public function do_replacements( $contents, $filename ) {

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

		// Special treatment for Gulpfile.js
		if ( 'Gulpfile.js' == $filename ) {
			$contents = str_replace( '_s.pot', $this->theme['slug'] . '.pot', $contents );
			$contents = str_replace( 'mail@_s.com',  $this->theme['author_email'], $contents );
			$contents = str_replace( 'John Doe', $this->theme['author'], $contents );
			$contents = str_replace( 'http://_s.com', esc_url( $this->theme['author_uri'] ), $contents );
			$contents = str_replace( 'testing.dev', esc_url( $this->theme['dev_uri'] ), $contents );
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

// Engage!
new WDS_Theme_Generator;