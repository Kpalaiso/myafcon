<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage FCUNITED
 * @since FCUNITED 1.0.22
 */

// If this theme is a free version of premium theme
if ( ! defined( 'FCUNITED_THEME_FREE' ) ) {
	define( 'FCUNITED_THEME_FREE', false );
}
if ( ! defined( 'FCUNITED_THEME_FREE_WP' ) ) {
	define( 'FCUNITED_THEME_FREE_WP', false );
}

// If this theme uses multiple skins
if ( ! defined( 'FCUNITED_ALLOW_SKINS' ) ) {
	define( 'FCUNITED_ALLOW_SKINS', true );
}
if ( ! defined( 'FCUNITED_DEFAULT_SKIN' ) ) {
	define( 'FCUNITED_DEFAULT_SKIN', 'default' );
}



// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
//-------------------------------------------------------------------------
$GLOBALS['FCUNITED_STORAGE'] = array(

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'      => 'env-axiom',

	// Generate Personal token from Envato to automatic upgrade theme
	'upgrade_token_url'  => 'https://1.envato.market/c/1262870/275988/4415?subId1=axioma&u=themeforest.net/item/fc-united-football-soccer-wordpress-sports-theme/23390465',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'     => 'https://fc-united.axiomthemes.com',
	'theme_doc_url'      => 'https://fc-united.axiomthemes.com/doc',

	'theme_upgrade_url'   => 'https://upgrade.themerex.net/',
	
	'theme_rate_url'     => 'https://themeforest.net/download',

    'theme_custom_url' => '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash',

    'theme_download_url' => 'https://themeforest.net/item/fc-united-football-soccer-wordpress-sports-theme/23390465',         // Axiom

    'theme_support_url'  => 'https://themerex.net/support/',

    'theme_video_url'    => 'https://www.youtube.com/channel/UCBjqhuwKj3MfE3B6Hg2oA8Q',   // Axiom

    'theme_privacy_url'  => 'https://axiomthemes.com/privacy-policy/',                    // Axiom

	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'   => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'         => array(
		// By size
		'xxl'        => array( 'max' => 1679 ),
		'xl'         => array( 'max' => 1439 ),
		'lg'         => array( 'max' => 1279 ),
		'md_over'    => array( 'min' => 1024 ),
		'md'         => array( 'max' => 1023 ),
		'sm'         => array( 'max' => 767 ),
		'sm_wp'      => array( 'max' => 600 ),
		'xs'         => array( 'max' => 479 ),
		// By device
		'wide'       => array(
			'min' => 2160
		),
		'desktop'    => array(
			'min' => 1680,
			'max' => 2159,
		),
		'notebook'   => array(
			'min' => 1280,
			'max' => 1679,
		),
		'tablet'     => array(
			'min' => 768,
			'max' => 1279,
		),
		'not_mobile' => array(
			'min' => 768
		),
		'mobile'     => array(
			'max' => 767
		),
	),
);



// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$fcunited_theme_required_plugins_group = esc_html__( 'Core', 'fcunited' );
$fcunited_theme_required_plugins = array(
	// Section: "CORE" (required plugins)
	// DON'T COMMENT OR REMOVE NEXT LINES!
	'trx_addons'         => array(
								'title'       => esc_html__( 'ThemeREX Addons', 'fcunited' ),
								'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'fcunited' ),
								'required'    => true,
								'logo'        => 'logo.png',
								'group'       => $fcunited_theme_required_plugins_group,
							),
);

// Section: "PAGE BUILDERS"
$fcunited_theme_required_plugins_group = esc_html__( 'Page Builders', 'fcunited' );
$fcunited_theme_required_plugins['elementor'] = array(
	'title'       => esc_html__( 'Elementor', 'fcunited' ),
	'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'fcunited' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $fcunited_theme_required_plugins_group,
);
$fcunited_theme_required_plugins['gutenberg'] = array(
	'title'       => esc_html__( 'Gutenberg', 'fcunited' ),
	'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'fcunited' ),
	'required'    => false,
	'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
	'logo'        => 'logo.png',
	'group'       => $fcunited_theme_required_plugins_group,
);

if ( ! FCUNITED_THEME_FREE ) {
    $fcunited_theme_required_plugins['js_composer']          = array(
        'title'       => esc_html__( 'WPBakery PageBuilder', 'fcunited' ),
        'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'fcunited' ),
        'required'    => false,
        'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
        'logo'        => 'logo.jpg',
        'group'       => $fcunited_theme_required_plugins_group,
    );
}


// Section: "E-COMMERCE"
$fcunited_theme_required_plugins_group = esc_html__( 'E-Commerce', 'fcunited' );
$fcunited_theme_required_plugins['woocommerce']              = array(
	'title'       => esc_html__( 'WooCommerce', 'fcunited' ),
	'description' => esc_html__( "Connect the store to your website and start selling now", 'fcunited' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $fcunited_theme_required_plugins_group,
);
$fcunited_theme_required_plugins['elegro-payment']              = array(
	'title'       => esc_html__( 'elegro Crypto Payment', 'fcunited' ),
	'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'fcunited' ),
	'required'    => false,
	'logo'        => 'elegro-payment.png',
	'group'       => $fcunited_theme_required_plugins_group,
);


// Section: "SOCIALS & COMMUNITIES"
$fcunited_theme_required_plugins_group = esc_html__( 'Socials and Communities', 'fcunited' );
$fcunited_theme_required_plugins['instagram-feed']   = array(
	'title'       => esc_html__( 'Instagram Feed', 'fcunited' ),
	'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'fcunited' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $fcunited_theme_required_plugins_group,
);
$fcunited_theme_required_plugins_group = esc_html__( 'Socials and Communities', 'fcunited' );
$fcunited_theme_required_plugins['mailchimp-for-wp'] = array(
	'title'       => esc_html__( 'MailChimp for WP', 'fcunited' ),
	'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'fcunited' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $fcunited_theme_required_plugins_group,
);

// Section: "CONTENT"
$fcunited_theme_required_plugins_group = esc_html__( 'Content', 'fcunited' );
$fcunited_theme_required_plugins['contact-form-7'] = array(
	'title'       => esc_html__( 'Contact Form 7', 'fcunited' ),
	'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'fcunited' ),
	'required'    => false,
	'logo'        => 'logo.jpg',
	'group'       => $fcunited_theme_required_plugins_group,
);
if ( ! FCUNITED_THEME_FREE ) {
	$fcunited_theme_required_plugins['revslider']                  = array(
		'title'       => esc_html__( 'Revolution Slider', 'fcunited' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $fcunited_theme_required_plugins_group,
	);
    $fcunited_theme_required_plugins['sportspress']             = array(
        'title'       => esc_html__( 'SportsPress', 'fcunited' ),
        'description' => '',
        'required'    => false,
        'logo'        => 'logo.png',
        'group'       => $fcunited_theme_required_plugins_group,
    );
    $fcunited_theme_required_plugins['joomsport-sports-league-results-management']             = array(
        'title'       => esc_html__( 'JoomSport', 'fcunited' ),
        'description' => '',
        'required'    => false,
        'logo'        => 'logo.png',
        'group'       => $fcunited_theme_required_plugins_group,
    );
    $fcunited_theme_required_plugins['sportspress-for-soccer']             = array(
        'title'       => esc_html__( 'SportsPress for Football (Soccer)', 'fcunited' ),
        'description' => '',
        'required'    => false,
        'logo'        => 'logo.png',
        'group'       => $fcunited_theme_required_plugins_group,
    );
    $fcunited_theme_required_plugins['sportspress-for-basketball']             = array(
        'title'       => esc_html__( 'SportsPress for Basketball', 'fcunited' ),
        'description' => '',
        'required'    => false,
        'logo'        => 'logo.png',
        'group'       => $fcunited_theme_required_plugins_group,
    );
    $fcunited_theme_required_plugins['sportspress-for-golf']             = array(
        'title'       => esc_html__( 'SportsPress for Golf', 'fcunited' ),
        'description' => '',
        'required'    => false,
        'logo'        => 'logo.png',
        'group'       => $fcunited_theme_required_plugins_group,
    );
	$fcunited_theme_required_plugins['essential-grid']             = array(
		'title'       => esc_html__( 'Essential Grid', 'fcunited' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $fcunited_theme_required_plugins_group,
	);
	$fcunited_theme_required_plugins['sitepress-multilingual-cms'] = array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'fcunited' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'fcunited' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'logo.png',
		'group'       => $fcunited_theme_required_plugins_group,
	);
}

// Section: "EVENTS & TIMELINES"
$fcunited_theme_required_plugins_group = esc_html__( 'Events and Appointments', 'fcunited' );
if ( ! FCUNITED_THEME_FREE ) {
	$fcunited_theme_required_plugins['the-events-calendar']    = array(
		'title'       => esc_html__( 'The Events Calendar', 'fcunited' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $fcunited_theme_required_plugins_group,
	);
}



// Section: "OTHER"
$fcunited_theme_required_plugins_group = esc_html__( 'Other', 'fcunited' );
$fcunited_theme_required_plugins['wp-gdpr-compliance'] = array(
	'title'       => esc_html__( 'Cookie Information', 'fcunited' ),
	'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'fcunited' ),
	'required'    => false,
	'install'     => false,
	'logo'        => 'logo.png',
	'group'       => $fcunited_theme_required_plugins_group,
);
$fcunited_theme_required_plugins['trx_updater'] = array(
	'title'       => esc_html__( 'ThemeREX Updater', 'fcunited' ),
	'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'fcunited' ),
	'required'    => false,
	'logo'        => 'trx_updater.png',
	'group'       => $fcunited_theme_required_plugins_group,
);

// Add plugins list to the global storage
$GLOBALS['FCUNITED_STORAGE']['required_plugins'] = $fcunited_theme_required_plugins;

// THEME-SPECIFIC BLOG LAYOUTS
//----------------------------------------------
$fcunited_theme_blog_styles = array(
	'excerpt' => array(
		'title'   => esc_html__( 'Standard', 'fcunited' ),
		'archive' => 'index-excerpt',
		'item'    => 'content-excerpt',
		'styles'  => 'excerpt',
	),
	'classic' => array(
		'title'   => esc_html__( 'Classic', 'fcunited' ),
		'archive' => 'index-classic',
		'item'    => 'content-classic',
		'columns' => array( 2, 3 ),
		'styles'  => 'classic',
	),
);
if ( ! FCUNITED_THEME_FREE ) {
	$fcunited_theme_blog_styles['masonry']   = array(
		'title'   => esc_html__( 'Masonry', 'fcunited' ),
		'archive' => 'index-classic',
		'item'    => 'content-classic',
		'columns' => array( 2, 3 ),
		'styles'  => 'masonry',
	);
	$fcunited_theme_blog_styles['portfolio'] = array(
		'title'   => esc_html__( 'Portfolio', 'fcunited' ),
		'archive' => 'index-portfolio',
		'item'    => 'content-portfolio',
		'columns' => array( 2, 3, 4 ),
		'styles'  => 'portfolio',
	);
	$fcunited_theme_blog_styles['gallery']   = array(
		'title'   => esc_html__( 'Gallery', 'fcunited' ),
		'archive' => 'index-portfolio',
		'item'    => 'content-portfolio-gallery',
		'columns' => array( 2, 3, 4 ),
		'styles'  => array( 'portfolio', 'gallery' ),
	);
	$fcunited_theme_blog_styles['chess']     = array(
		'title'   => esc_html__( 'Chess', 'fcunited' ),
		'archive' => 'index-chess',
		'item'    => 'content-chess',
		'columns' => array( 1, 2, 3 ),
		'styles'  => 'chess',
	);
}

// Add list of blog styles to the global storage
$GLOBALS['FCUNITED_STORAGE']['blog_styles'] = $fcunited_theme_blog_styles;


// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( ! function_exists( 'fcunited_customizer_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'fcunited_customizer_theme_setup1', 1 );
	function fcunited_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		fcunited_storage_set(
			'settings', array(

				'duplicate_options'      => 'child',                    // none  - use separate options for the main and the child-theme
																		// child - duplicate theme options from the main theme to the child-theme only
																		// both  - sinchronize changes in the theme options between main and child themes

				'customize_refresh'      => 'auto',                     // Refresh method for preview area in the Appearance - Customize:
																		// auto - refresh preview area on change each field with Theme Options
																		// manual - refresh only obn press button 'Refresh' at the top of Customize frame

				'max_load_fonts'         => 5,                          // Max fonts number to load from Google fonts or from uploaded fonts

				'comment_after_name'     => true,                       // Place 'comment' field after the 'name' and 'email'

				'show_author_avatar'     => true,                       // Display author's avatar in the post meta

				'icons_selector'         => 'internal',                 // Icons selector in the shortcodes:
																		// vc  default  - standard VC (very slow) or Elementor's icons selector (not support images and svg)
																		// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

				'icons_type'             => 'icons',                    // Type of icons (if 'icons_selector' is 'internal'):
																		// icons  - use font icons to present icons
																		// images - use images from theme's folder trx_addons/css/icons.png
																		// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'socials_type'           => 'icons',                    // Type of socials icons (if 'icons_selector' is 'internal'):
																		// icons  - use font icons to present social networks
																		// images - use images from theme's folder trx_addons/css/icons.png
																		// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'check_min_version'      => true,                       // Check if exists a .min version of .css and .js and return path to it
																		// instead the path to the original file
																		// (if debug_mode is off and modification time of the original file < time of the .min file)

				'autoselect_menu'        => false,                      // Show any menu if no menu selected in the location 'main_menu'
																		// (for example, the theme is just activated)

				'disable_jquery_ui'      => false,                      // Prevent loading custom jQuery UI libraries in the third-party plugins

				'use_mediaelements'      => true,                       // Load script "Media Elements" to play video and audio

				'tgmpa_upload'           => false,                      // Allow upload not pre-packaged plugins via TGMPA

				'allow_no_image'         => false,                      // Allow to use theme-specific image placeholder if no image present in the blog, related posts, post navigation, etc.

				'separate_schemes'       => true,                       // Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

				'allow_fullscreen'       => false,                      // Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
																		// In the Page Options this styles are present always
																		// (can be removed if filter 'fcunited_filter_allow_fullscreen' return false)

				'attachments_navigation' => false,                      // Add arrows on the single attachment page to navigate to the prev/next attachment

				'gutenberg_safe_mode'    => array(),                    // 'vc', 'elementor' - Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)

				'gutenberg_add_context'  => false,                      // Add context to the Gutenberg editor styles with our method (if true - use if any problem with editor styles) or use native Gutenberg way via add_editor_style() (if false - used by default)

				'allow_gutenberg_blocks' => true,                       // Allow our shortcodes and widgets as blocks in the Gutenberg (not ready yet - in the development now)

				'subtitle_above_title'   => true,                       // Put subtitle above the title in the shortcodes

				'add_hide_on_xxx'        => 'replace',                  // Add our breakpoints to the Responsive section of each element
																		// 'add' - add our breakpoints after Elementor's
																		// 'replace' - add our breakpoints instead Elementor's
																		// 'none' - don't add our breakpoints (using only Elementor's)
			)
		);

		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------

		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		fcunited_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'Poppins',
					'family' => 'sans-serif',
					'styles' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800',     // Parameter 'style' used only for the Google fonts
				),
				// Font-face packed with theme
				array(
					'name'   => 'BebasNeue',
					'family' => 'sans-serif',
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		fcunited_storage_set( 'load_fonts_subset', 'latin,latin-ext' );


		fcunited_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'fcunited' ),
					'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'fcunited' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.76em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.26px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.6em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'fcunited' ),
					'font-family'     => '"BebasNeue",sans-serif',
					'font-size'       => '4.286em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '0.93em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '2.1px',
					'margin-top'      => '1.69em',
					'margin-bottom'   => '0.63em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'fcunited' ),
					'font-family'     => '"BebasNeue",sans-serif',
					'font-size'       => '3.429em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '0.96em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '1.75px',
					'margin-top'      => '1.82em',
					'margin-bottom'   => '0.52em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'fcunited' ),
					'font-family'     => '"BebasNeue",sans-serif',
					'font-size'       => '2.571em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '0.91em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '1.3px',
					'margin-top'      => '2.2em',
					'margin-bottom'   => '0.92em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'fcunited' ),
					'font-family'     => '"BebasNeue",sans-serif',
					'font-size'       => '2.143em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.06em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '1.1px',
					'margin-top'      => '2.3em',
					'margin-bottom'   => '0.6em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'fcunited' ),
					'font-family'     => '"BebasNeue",sans-serif',
					'font-size'       => '1.714em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.06em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.85px',
					'margin-top'      => '2.9em',
					'margin-bottom'   => '0.7em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'fcunited' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.286em',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.23em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '3.25em',
					'margin-bottom'   => '0.69em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'fcunited' ),
					'description'     => esc_html__( 'Font settings of the text case of the logo', 'fcunited' ),
					'font-family'     => '"BebasNeue",sans-serif',
					'font-size'       => '1.9em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.1em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '1px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'fcunited' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '18px',
					'text-decoration' => 'none',
					'text-transform'  => '',
					'letter-spacing'  => '0',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'fcunited' ),
					'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'fcunited' ),
					'font-family'     => 'inherit',
					'font-size'       => '1em',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em', // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'fcunited' ),
					'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'fcunited' ),
					'font-family'     => 'inherit',
					'font-size'       => '13px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.4em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'fcunited' ),
					'description'     => esc_html__( 'Font settings of the main menu items', 'fcunited' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.18px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'fcunited' ),
					'description'     => esc_html__( 'Font settings of the dropdown menu items', 'fcunited' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.35em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.18px',
				),
			)
		);

		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		fcunited_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'fcunited' ),
					'description' => esc_html__( 'Colors of the main content area', 'fcunited' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'fcunited' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'fcunited' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'fcunited' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'fcunited' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'fcunited' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'fcunited' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'fcunited' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'fcunited' ),
				),
			)
		);
		fcunited_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'fcunited' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'fcunited' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'fcunited' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'fcunited' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'fcunited' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'fcunited' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'fcunited' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'fcunited' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'fcunited' ),
					'description' => esc_html__( 'Color of the plain text inside this block', 'fcunited' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'fcunited' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'fcunited' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'fcunited' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'fcunited' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'fcunited' ),
					'description' => esc_html__( 'Color of the links inside this block', 'fcunited' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'fcunited' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'fcunited' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Link 2', 'fcunited' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'fcunited' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Link 2 hover', 'fcunited' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'fcunited' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Link 3', 'fcunited' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'fcunited' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Link 3 hover', 'fcunited' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'fcunited' ),
				),
			)
		);
		fcunited_storage_set(
			'schemes', array(

				// Color scheme: 'default'
				'default' => array(
					'title'    => esc_html__( 'Default', 'fcunited' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#ffffff',
						'bd_color'         => '#e3e3e3',

						// Text and links colors
						'text'             => '#797e87',
						'text_light'       => '#797e87',
						'text_dark'        => '#262f3e',
						'text_link'        => '#ff0000',
						'text_hover'       => '#081324',
						'text_link2'       => '#80d572',
						'text_hover2'      => '#8be77c',
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#ffffff',
						'alter_bg_hover'   => '#f4f4f4',
						'alter_bd_color'   => '#e3e3e3',
						'alter_bd_hover'   => '#EBEBEB',
						'alter_text'       => '#797e87',
						'alter_light'      => '#b7b7b7',
						'alter_dark'       => '#1d1d1d',
						'alter_link'       => '#ff0000',
						'alter_hover'      => '#ff0000',
						'alter_link2'      => '#ffffff',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#ddb837',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#081224',
						'extra_bg_hover'   => '#28272e',
						'extra_bd_color'   => '#262f3e',
						'extra_bd_hover'   => '#3d3d3d',
						'extra_text'       => '#9d9ea1',
						'extra_light'      => '#797e87',
						'extra_dark'       => '#8c9097',
						'extra_link'       => '#ffffff',
						'extra_hover'      => '#ff0000',
						'extra_link2'      => '#224452',
						'extra_hover2'     => '#8be77c',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#eec432',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#f4f4f4',
						'input_bg_hover'   => '#f4f4f4',
						'input_bd_color'   => '#e4e4e4',
						'input_bd_hover'   => '#262f3e',
						'input_text'       => '#797e87',
						'input_light'      => '#797e87',
						'input_dark'       => '#262f3e',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#67bcc1',
						'inverse_bd_hover' => '#5aa4a9',
						'inverse_text'     => '#1d1d1d',
						'inverse_light'    => '#333333',
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#ffffff',
					),
				),

                // Color scheme: 'alter'
                'alter' => array(
                    'title'    => esc_html__( 'Alter', 'fcunited' ),
                    'internal' => true,
                    'colors'   => array(

                        // Whole block border and background
                        'bg_color'         => '#ffffff',
                        'bd_color'         => '#e3e3e3',

                        // Text and links colors
                        'text'             => '#797e87',
                        'text_light'       => '#797e87',
                        'text_dark'        => '#262f3e',
                        'text_link'        => '#ff0000',
                        'text_hover'       => '#081324',
                        'text_link2'       => '#80d572',
                        'text_hover2'      => '#8be77c',
                        'text_link3'       => '#ddb837',
                        'text_hover3'      => '#eec432',

                        // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                        'alter_bg_color'   => '#ffffff',
                        'alter_bg_hover'   => '#f4f4f4',
                        'alter_bd_color'   => '#e3e3e3',
                        'alter_bd_hover'   => '#EBEBEB',
                        'alter_text'       => '#797e87',
                        'alter_light'      => '#b7b7b7',
                        'alter_dark'       => '#1d1d1d',
                        'alter_link'       => '#ff0000',
                        'alter_hover'      => '#ff0000',
                        'alter_link2'      => '#ffffff',
                        'alter_hover2'     => '#80d572',
                        'alter_link3'      => '#eec432',
                        'alter_hover3'     => '#ddb837',

                        // Extra blocks (submenu, tabs, color blocks, etc.)
                        'extra_bg_color'   => '#224452',
                        'extra_bg_hover'   => '#28272e',
                        'extra_bd_color'   => '#262f3e',
                        'extra_bd_hover'   => '#3d3d3d',
                        'extra_text'       => '#797e87',
                        'extra_light'      => '#797e87',
                        'extra_dark'       => '#8c9097',
                        'extra_link'       => '#ffffff',
                        'extra_hover'      => '#ff0000',
                        'extra_link2'      => '#224452',
                        'extra_hover2'     => '#8be77c',
                        'extra_link3'      => '#ddb837',
                        'extra_hover3'     => '#eec432',

                        // Input fields (form's fields and textarea)
                        'input_bg_color'   => '#f4f4f4',
                        'input_bg_hover'   => '#f4f4f4',
                        'input_bd_color'   => '#e4e4e4',
                        'input_bd_hover'   => '#262f3e',
                        'input_text'       => '#797e87',
                        'input_light'      => '#797e87',
                        'input_dark'       => '#262f3e',

                        // Inverse blocks (text and links on the 'text_link' background)
                        'inverse_bd_color' => '#67bcc1',
                        'inverse_bd_hover' => '#5aa4a9',
                        'inverse_text'     => '#1d1d1d',
                        'inverse_light'    => '#333333',
                        'inverse_dark'     => '#000000',
                        'inverse_link'     => '#ffffff',
                        'inverse_hover'    => '#ffffff',
                    ),
                ),

				// Color scheme: 'dark'
				'dark'    => array(
					'title'    => esc_html__( 'Dark', 'fcunited' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#081224',
						'bd_color'         => '#262F3E',

						// Text and links colors
						'text'             => '#848992',
						'text_light'       => '#6f6f6f',
						'text_dark'        => '#ffffff',
						'text_link'        => '#ff0000',
						'text_hover'       => '#ffffff',
						'text_link2'       => '#80d572',
						'text_hover2'      => '#8be77c',
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#081224',
						'alter_bg_hover'   => '#333333',
						'alter_bd_color'   => '#848992',
						'alter_bd_hover'   => '#262F3E',
						'alter_text'       => '#a6a6a6',
						'alter_light'      => '#6f6f6f',
						'alter_dark'       => '#ffffff',
						'alter_link'       => '#ff0000',
						'alter_hover'      => '#262F3E',
						'alter_link2'      => '#ff0000',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#ddb837',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#ffffff',
						'extra_bg_hover'   => '#224452',
						'extra_bd_color'   => '#464646',
						'extra_bd_hover'   => '#4a4a4a',
						'extra_text'       => '#a6a6a6',
						'extra_light'      => '#6f6f6f',
						'extra_dark'       => '#262f3e',
						'extra_link'       => '#081224',
						'extra_hover'      => '#ff0000',
						'extra_link2'      => '#224452',
						'extra_hover2'     => '#8be77c',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#eec432',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#262F3E',
						'input_bg_hover'   => '#262F3E',
						'input_bd_color'   => '#262F3E',
						'input_bd_hover'   => '#353535',
						'input_text'       => '#b7b7b7',
						'input_light'      => '#6f6f6f',
						'input_dark'       => '#ffffff',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#e36650',
						'inverse_bd_hover' => '#cb5b47',
						'inverse_text'     => '#1d1d1d',
						'inverse_light'    => '#6f6f6f',
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#262f3e',
					),
				),

			)
		);




        fcunited_storage_set( 'schemes_original', fcunited_storage_get( 'schemes' ) );




		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		fcunited_storage_set(
			'schemes_simple', array(
				'text_link'        => array(),
				'text_hover'       => array(),
				'text_link2'       => array(),
				'text_hover2'      => array(),
				'text_link3'       => array(),
				'text_hover3'      => array(),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
				'inverse_bd_color' => array(),
				'inverse_bd_hover' => array(),
			)
		);

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		fcunited_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_00' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_05' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.5,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
                'text_dark_04'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.4,
                ),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Parameters to set order of schemes in the css
		fcunited_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		fcunited_storage_set(
			'theme_thumbs', apply_filters(
				'fcunited_filter_add_thumb_sizes', array(
					// Width of the image is equal to the content area width (without sidebar)
					// Height is fixed
					'fcunited-thumb-huge'        => array(
						'size'  => array( 1278, 719, true ),
						'title' => esc_html__( 'Huge image', 'fcunited' ),
						'subst' => 'trx_addons-thumb-huge',
					),
					// Width of the image is equal to the content area width (with sidebar)
					// Height is fixed
					'fcunited-thumb-big'         => array(
						'size'  => array( 818, 461, true ),
						'title' => esc_html__( 'Large image', 'fcunited' ),
						'subst' => 'trx_addons-thumb-big',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'fcunited-thumb-med'         => array(
						'size'  => array( 406, 228, true ),
						'title' => esc_html__( 'Medium image', 'fcunited' ),
						'subst' => 'trx_addons-thumb-medium',
					),

					// Small square image (for avatars in comments, etc.)
					'fcunited-thumb-tiny'        => array(
						'size'  => array( 90, 90, true ),
						'title' => esc_html__( 'Small square avatar', 'fcunited' ),
						'subst' => 'trx_addons-thumb-tiny',
					),

					// Width of the image is equal to the content area width (with sidebar)
					// Height is proportional (only downscale, not crop)
					'fcunited-thumb-masonry-big' => array(
						'size'  => array( 818, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry Large (scaled)', 'fcunited' ),
						'subst' => 'trx_addons-thumb-masonry-big',
					),

					// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
					// Height is proportional (only downscale, not crop)
					'fcunited-thumb-masonry'     => array(
						'size'  => array( 406, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry (scaled)', 'fcunited' ),
						'subst' => 'trx_addons-thumb-masonry',
					),

                    'fcunited-thumb-extra'         => array(
                        'size'  => array( 600, 394, true ),
                        'title' => esc_html__( 'Extra image', 'fcunited' ),
                        'subst' => 'trx_addons-thumb-extra',
                    ),
                    'fcunited-thumb-alternate'         => array(
                        'size'  => array( 650, 720, true ),
                        'title' => esc_html__( 'Alternate image', 'fcunited' ),
                        'subst' => 'trx_addons-thumb-alternate',
                    ),
                    'fcunited-thumb-height'         => array(
                        'size'  => array( 380, 495, true ),
                        'title' => esc_html__( 'Height image', 'fcunited' ),
                        'subst' => 'trx_addons-thumb-height',
                    ),
                    'fcunited-thumb-plain'         => array(
                        'size'  => array( 260, 240, true ),
                        'title' => esc_html__( 'Plain image', 'fcunited' ),
                        'subst' => 'trx_addons-thumb-plain',
                    ),
				)
			)
		);
	}
}



//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'fcunited_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'fcunited_importer_set_options', 9 );
	function fcunited_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			$rtl_slug = is_rtl() ? '-rtl' : '';
			$rtl_url = is_rtl() ? 'rtl.' : '';
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url( fcunited_get_protocol() . '://demofiles.axiomthemes.com/fcunited'. $rtl_slug .'/' );
			// Required plugins
			$options['required_plugins'] = array_keys( fcunited_storage_get( 'required_plugins' ) );
			// Set number of thumbnails (usually 3 - 5) to regenerate at once when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 0;
			// Default demo
			$options['files']['default']['title']       = esc_html__( 'FC United Demo', 'fcunited' );
			$options['files']['default']['domain_dev']  = '';       // Developers domain
			$options['files']['default']['domain_demo'] = esc_url( 'https://' . $rtl_url . 'fc-united.axiomthemes.com' );       // Demo-site domain

			$options['banners'] = array();
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'fcunited_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'fcunited_ocdi_set_options', 9 );
	function fcunited_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			$rtl_slug = is_rtl() ? '-rtl' : '';
			$rtl_url = is_rtl() ? 'rtl.' : '';
			// Prepare demo data
			$options['demo_url'] = esc_url( fcunited_get_protocol() . '://demofiles.axiomthemes.com/fcunited/'. $rtl_slug .'/'  );
			// Required plugins
			$options['required_plugins'] = array_keys( fcunited_storage_get( 'required_plugins' ) );
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'FC United OCDI Demo', 'fcunited' );
			$options['files']['ocdi']['domain_demo'] = esc_url( fcunited_get_protocol() . '://' . $rtl_url . 'fc-united.axiomthemes.com' );
		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if ( ! function_exists( 'fcunited_create_theme_options' ) ) {

	function fcunited_create_theme_options() {

		// Message about options override.
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = esc_html__( 'Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages. If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page. These options are marked with an asterisk (*) in the title.', 'fcunited' );

		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count( fcunited_storage_get( 'schemes' ) ) < 2;

		fcunited_storage_set(

			'options', array(

				// 'Logo & Site Identity'
				//---------------------------------------------
				'title_tagline'                 => array(
					'title'    => esc_html__( 'Logo & Site Identity', 'fcunited' ),
					'desc'     => '',
					'priority' => 10,
					'type'     => 'section',
				),
				'logo_info'                     => array(
					'title'    => esc_html__( 'Logo Settings', 'fcunited' ),
					'desc'     => '',
					'priority' => 20,
					'qsetup'   => esc_html__( 'General', 'fcunited' ),
					'type'     => 'info',
				),
				'logo_text'                     => array(
					'title'    => esc_html__( 'Use Site Name as Logo', 'fcunited' ),
					'desc'     => wp_kses_data( esc_html__( 'Use the site title and tagline as a text logo if no image is selected', 'fcunited' ) ),
					'class'    => 'fcunited_column-1_2 fcunited_new_row',
					'priority' => 30,
					'std'      => 1,
					'qsetup'   => esc_html__( 'General', 'fcunited' ),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_retina_enabled'           => array(
					'title'    => esc_html__( 'Allow retina display logo', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Show fields to select logo images for Retina display', 'fcunited' ) ),
					'class'    => 'fcunited_column-1_2',
					'priority' => 40,
					'refresh'  => false,
					'std'      => 0,
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_zoom'                     => array(
					'title'   => esc_html__( 'Logo zoom', 'fcunited' ),
					'desc'    => wp_kses_post(
									__( 'Zoom the logo (set 1 to leave original size).', 'fcunited' )
									. ' <br>'
									. __( 'Attention! For this parameter to affect images, their max-height should be specified in "em" instead of "px" when creating a header.', 'fcunited' )
									. ' <br>'
									. __( 'In this case maximum size of logo depends on the actual size of the picture.', 'fcunited' )
								),
					'std'     => 1,
					'min'     => 0.2,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'slider',
				),
				// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
				'logo_retina'                   => array(
					'title'      => esc_html__( 'Logo for Retina', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'fcunited' ) ),
					'class'      => 'fcunited_column-1_2',
					'priority'   => 70,
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile_header'            => array(
					'title' => esc_html__( 'Logo for the mobile header', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'fcunited' ) ),
					'class' => 'fcunited_column-1_2 fcunited_new_row',
					'std'   => '',
					'type'  => 'hidden'
				),
				'logo_mobile_header_retina'     => array(
					'title'      => esc_html__( 'Logo for the mobile header on Retina', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'fcunited' ) ),
					'class'      => 'fcunited_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
                    'type'  => 'hidden'
                ),
				'logo_mobile'                   => array(
					'title' => esc_html__( 'Logo for the mobile menu', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile menu', 'fcunited' ) ),
					'class' => 'fcunited_column-1_2 fcunited_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_retina'            => array(
					'title'      => esc_html__( 'Logo mobile on Retina', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'fcunited' ) ),
					'class'      => 'fcunited_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_side'                     => array(
					'title' => esc_html__( 'Logo for the side menu', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu', 'fcunited' ) ),
					'class' => 'fcunited_column-1_2 fcunited_new_row',
					'std'   => '',
					'type'  => 'hidden',
				),
				'logo_side_retina'              => array(
					'title'      => esc_html__( 'Logo for the side menu on Retina', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'fcunited' ) ),
					'class'      => 'fcunited_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
                    'type'  => 'hidden',
				),



				// 'General settings'
				//---------------------------------------------
				'general'                       => array(
					'title'    => esc_html__( 'General', 'fcunited' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 20,
					'type'     => 'section',
				),

				'general_layout_info'           => array(
					'title'  => esc_html__( 'Layout', 'fcunited' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'fcunited' ),
					'type'   => 'info',
				),
				'body_style'                    => array(
					'title'    => esc_html__( 'Body style', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select width of the body content', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'qsetup'   => esc_html__( 'General', 'fcunited' ),
					'refresh'  => false,
					'std'      => 'wide',
					'options'  => fcunited_get_list_body_styles( false ),
					'type'     => 'select',
				),
                'body_color'                    => array(
                    'title'    => esc_html__( 'Body color', 'fcunited' ),
                    'desc'     => wp_kses_data( __( 'Body background color', 'fcunited' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Content', 'fcunited' ),
                    ),
                    'qsetup'   => esc_html__( 'General', 'fcunited' ),
                    'refresh'  => false,
                    'std'      => '#F4F4F4',
                    'type'     => 'color',
                ),
				'page_width'                    => array(
					'title'      => esc_html__( 'Page width', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Total width of the site content and sidebar (in pixels). If empty - use default width', 'fcunited' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed', 'wide' ),
					),
					'std'        => 1278,
					'min'        => 1000,
					'max'        => 1400,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page',
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'slider',
				),
				'page_boxed_extra'             => array(
					'title'      => esc_html__( 'Boxed page extra spaces', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Width of the extra side space on boxed pages', 'fcunited' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'std'        => 60,
					'min'        => 0,
					'max'        => 300,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page_boxed_extra',
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'slider',
				),
				'boxed_bg_image'                => array(
					'title'      => esc_html__( 'Boxed bg image', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'fcunited' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'std'        => '',
					'qsetup'     => esc_html__( 'General', 'fcunited' ),
					'type'       => 'image',
				),
				'remove_margins'                => array(
					'title'    => esc_html__( 'Remove margins', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Remove margins above and below the content area', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'refresh'  => false,
					'std'      => 0,
					'type'     => 'checkbox',
				),

				'general_sidebar_info'          => array(
					'title' => esc_html__( 'Sidebar', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position'              => array(
					'title'    => esc_html__( 'Sidebar position', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'std'      => 'right',
					'qsetup'   => esc_html__( 'General', 'fcunited' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_position_ss'       => array(
					'title'    => esc_html__( 'Sidebar position on the small screen', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to move sidebar on the small screen - above or below the content', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'dependency' => array(
						'sidebar_position' => array( '^hide' ),
					),
					'std'      => 'below',
					'qsetup'   => esc_html__( 'General', 'fcunited' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets'               => array(
					'title'      => esc_html__( 'Sidebar widgets', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'dependency' => array(
						'sidebar_position' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'fcunited' ),
					'type'       => 'select',
				),
				'sidebar_width'                 => array(
					'title'      => esc_html__( 'Sidebar width', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Width of the sidebar (in pixels). If empty - use default width', 'fcunited' ) ),
					'std'        => 435,
					'min'        => 150,
					'max'        => 500,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'sidebar',
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'slider',
				),
				'sidebar_gap'                   => array(
					'title'      => esc_html__( 'Sidebar gap', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Gap between content and sidebar (in pixels). If empty - use default gap', 'fcunited' ) ),
					'std'        => 25,
					'min'        => 0,
					'max'        => 100,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'gap',
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'slider',
				),
				'expand_content'                => array(
					'title'   => esc_html__( 'Expand content', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'fcunited' ) ),
					'refresh' => false,
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'general_widgets_info'          => array(
					'title' => esc_html__( 'Additional widgets', 'fcunited' ),
					'desc'  => '',
					'type'  => FCUNITED_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page'            => array(
					'title'    => esc_html__( 'Widgets at the top of the page', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content'         => array(
					'title'    => esc_html__( 'Widgets above the content', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content'         => array(
					'title'    => esc_html__( 'Widgets below the content', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page'            => array(
					'title'    => esc_html__( 'Widgets at the bottom of the page', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),

				'general_effects_info'          => array(
					'title' => esc_html__( 'Design & Effects', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'border_radius'                 => array(
					'title'      => esc_html__( 'Border radius', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Specify the border radius of the form fields and buttons in pixels', 'fcunited' ) ),
					'std'        => 0,
					'min'        => 0,
					'max'        => 20,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'rad',
					'type'       => 'hidden',
				),

				'general_misc_info'             => array(
					'title' => esc_html__( 'Miscellaneous', 'fcunited' ),
					'desc'  => '',
					'type'  => FCUNITED_THEME_FREE ? 'hidden' : 'info',
				),
				'seo_snippets'                  => array(
					'title' => esc_html__( 'SEO snippets', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Add structured data markup to the single posts and pages', 'fcunited' ) ),
					'std'   => 0,
					'type'  => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'privacy_text' => array(
					"title" => esc_html__("Text with Privacy Policy link", 'fcunited'),
					"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'fcunited') ),
					"std"   => wp_kses( __( 'I agree that my submitted data is being collected and stored.', 'fcunited'), 'fcunited_kses_content' ),
					"type"  => "text"
				),



				// 'Header'
				//---------------------------------------------
				'header'                        => array(
					'title'    => esc_html__( 'Header', 'fcunited' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 30,
					'type'     => 'section',
				),

				'header_style_info'             => array(
					'title' => esc_html__( 'Header style', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type'                   => array(
					'title'    => esc_html__( 'Header style', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'std'      => 'default',
					'options'  => fcunited_get_list_header_footer_types(),
					'type'     => FCUNITED_THEME_FREE || ! fcunited_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'fcunited' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'fcunited' ), 'fcunited_kses_content' ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'dependency' => array(
						'header_type' => array( 'custom' ),
					),
					'std'        => FCUNITED_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position'               => array(
					'title'    => esc_html__( 'Header position', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight'             => array(
					'title'    => esc_html__( 'Header fullheight', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'std'      => 0,
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_wide'                   => array(
					'title'      => esc_html__( 'Header fullwidth', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_zoom'                   => array(
					'title'   => esc_html__( 'Header zoom', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Zoom the header title. 1 - original size', 'fcunited' ) ),
					'std'     => 1,
					'min'     => 0.3,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'slider',
				),

				'header_widgets_info'           => array(
					'title' => esc_html__( 'Header widgets', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Here you can place a widget slider, advertising banners, etc.', 'fcunited' ) ),
					'type'  => 'info',
				),
				'header_widgets'                => array(
					'title'    => esc_html__( 'Header widgets', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select set of widgets to show in the header on each page', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
						'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'fcunited' ) ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => 'select',
				),
				'header_columns'                => array(
					'title'      => esc_html__( 'Header columns', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'dependency' => array(
						'header_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => fcunited_get_list_range( 0, 6 ),
					'type'       => 'select',
				),

				'menu_info'                     => array(
					'title' => esc_html__( 'Main menu', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select main menu style, position and other parameters', 'fcunited' ) ),
					'type'  => FCUNITED_THEME_FREE ? 'hidden' : 'info',
				),
				'menu_style'                    => array(
					'title'    => esc_html__( 'Menu position', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position of the main menu', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'std'      => 'top',
					'options'  => array(
						'top'   => esc_html__( 'Top', 'fcunited' ),
					),
					'type'     => FCUNITED_THEME_FREE || ! fcunited_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'menu_side_stretch'             => array(
					'title'      => esc_html__( 'Stretch sidemenu', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Stretch sidemenu to window height (if menu items number >= 5)', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 0,
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_side_icons'               => array(
					'title'      => esc_html__( 'Iconed sidemenu', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 1,
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_mobile_fullscreen'        => array(
					'title' => esc_html__( 'Mobile menu fullscreen', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'fcunited' ) ),
					'std'   => 1,
					'type'  => 'hidden',
				),

				'header_image_info'             => array(
					'title' => esc_html__( 'Header image', 'fcunited' ),
					'desc'  => '',
					'type'  => FCUNITED_THEME_FREE ? 'hidden' : 'info',
				),
				'header_image_override'         => array(
					'title'    => esc_html__( 'Header image override', 'fcunited' ),
					'desc'     => wp_kses_data( __( "Allow override the header image with the page's/post's/product's/etc. featured image", 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'std'      => 0,
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_mobile_info'            => array(
					'title'      => esc_html__( 'Mobile header', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Configure the mobile version of the header', 'fcunited' ) ),
					'priority'   => 500,
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'type'       => 'hidden',
				),
				'header_mobile_enabled'         => array(
					'title'      => esc_html__( 'Enable the mobile header', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Use the mobile version of the header (if checked) or relayout the current header on mobile devices', 'fcunited' ) ),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 0,
                    'type'       => 'hidden',
				),
				'header_mobile_additional_info' => array(
					'title'      => esc_html__( 'Additional info', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Additional info to show at the top of the mobile header', 'fcunited' ) ),
					'std'        => '',
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'refresh'    => false,
					'teeny'      => false,
					'rows'       => 20,
                    'type'       => 'hidden',
				),
				'header_mobile_hide_info'       => array(
					'title'      => esc_html__( 'Hide additional info', 'fcunited' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
                    'type'       => 'hidden',
				),
				'header_mobile_hide_logo'       => array(
					'title'      => esc_html__( 'Hide logo', 'fcunited' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
                    'type'       => 'hidden',
				),
				'header_mobile_hide_login'      => array(
					'title'      => esc_html__( 'Hide login/logout', 'fcunited' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
                    'type'       => 'hidden',
				),
				'header_mobile_hide_search'     => array(
					'title'      => esc_html__( 'Hide search', 'fcunited' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
                    'type'       => 'hidden',
				),
				'header_mobile_hide_cart'       => array(
					'title'      => esc_html__( 'Hide cart', 'fcunited' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
                    'type'       => 'hidden',
				),



				// 'Footer'
				//---------------------------------------------
				'footer'                        => array(
					'title'    => esc_html__( 'Footer', 'fcunited' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 50,
					'type'     => 'section',
				),
				'footer_type'                   => array(
					'title'    => esc_html__( 'Footer style', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'fcunited' ),
					),
					'std'      => 'default',
					'options'  => fcunited_get_list_header_footer_types(),
					'type'     => FCUNITED_THEME_FREE || ! fcunited_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'fcunited' ),
					'desc'       => wp_kses( __( 'Select custom footer from Layouts Builder', 'fcunited' ), 'fcunited_kses_content' ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'fcunited' ),
					),
					'dependency' => array(
						'footer_type' => array( 'custom' ),
					),
					'std'        => FCUNITED_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets'                => array(
					'title'      => esc_html__( 'Footer widgets', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'fcunited' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns'                => array(
					'title'      => esc_html__( 'Footer columns', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'fcunited' ),
					),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'footer_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => fcunited_get_list_range( 0, 6 ),
					'type'       => 'select',
				),
				'footer_wide'                   => array(
					'title'      => esc_html__( 'Footer fullwidth', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'fcunited' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_in_footer'                => array(
					'title'      => esc_html__( 'Show logo', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Show logo in the footer', 'fcunited' ) ),
					'refresh'    => false,
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'hidden',
				),
				'logo_footer'                   => array(
					'title'      => esc_html__( 'Logo for footer', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo to display it in the footer', 'fcunited' ) ),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'logo_in_footer' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'logo_footer_retina'            => array(
					'title'      => esc_html__( 'Logo for footer (Retina)', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'fcunited' ) ),
					'dependency' => array(
						'footer_type'         => array( 'default' ),
						'logo_in_footer'      => array( 1 ),
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'image',
				),
				'socials_in_footer'             => array(
					'title'      => esc_html__( 'Show social icons', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Show social icons in the footer (under logo or footer widgets)', 'fcunited' ) ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'hidden',
				),
				'copyright'                     => array(
					'title'      => esc_html__( 'Copyright', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'fcunited' ) ),
					'translate'  => true,
					'std'        => esc_html__( 'Copyright &copy; {Y} by AxiomThemes. All rights reserved.', 'fcunited' ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'refresh'    => false,
					'type'       => 'textarea',
				),



				// 'Mobile version'
				//---------------------------------------------
				'mobile'                        => array(
					'title'    => esc_html__( 'Mobile', 'fcunited' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 55,
					'type'     => 'section',
				),

				'mobile_header_info'            => array(
					'title' => esc_html__( 'Header on the mobile device', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_mobile'            => array(
					'title'    => esc_html__( 'Header style', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use on mobile devices: the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => fcunited_get_list_header_footer_types( true ),
					'type'     => FCUNITED_THEME_FREE || ! fcunited_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_mobile'           => array(
					'title'      => esc_html__( 'Select custom layout', 'fcunited' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'fcunited' ), 'fcunited_kses_content' ),
					'dependency' => array(
						'header_type_mobile' => array( 'custom' ),
					),
					'std'        => 'inherit',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_mobile'        => array(
					'title'    => esc_html__( 'Header position', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),

				'mobile_sidebar_info'           => array(
					'title' => esc_html__( 'Sidebar on the mobile device', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_mobile'       => array(
					'title'    => esc_html__( 'Sidebar position on mobile', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_mobile'        => array(
					'title'      => esc_html__( 'Sidebar widgets', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar on mobile devices', 'fcunited' ) ),
					'dependency' => array(
						'sidebar_position_mobile' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'expand_content_mobile'         => array(
					'title'   => esc_html__( 'Expand content', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden on mobile devices', 'fcunited' ) ),
					'refresh' => false,
					'dependency' => array(
						'sidebar_position_mobile' => array( 'hide', 'inherit' ),
					),
					'std'     => 'inherit',
					'options'  => fcunited_get_list_checkbox_values( true ),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),

				'mobile_footer_info'           => array(
					'title' => esc_html__( 'Footer on the mobile device', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'footer_type_mobile'           => array(
					'title'    => esc_html__( 'Footer style', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use on mobile devices: the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => fcunited_get_list_header_footer_types(true),
					'type'     => FCUNITED_THEME_FREE || ! fcunited_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style_mobile'          => array(
					'title'      => esc_html__( 'Select custom layout', 'fcunited' ),
					'desc'       => wp_kses( __( 'Select custom footer from Layouts Builder', 'fcunited' ), 'fcunited_kses_content' ),
					'dependency' => array(
						'footer_type_mobile' => array( 'custom' ),
					),
					'std'        => 'inherit',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets_mobile'        => array(
					'title'      => esc_html__( 'Footer widgets', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'fcunited' ) ),
					'dependency' => array(
						'footer_type_mobile' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns_mobile'        => array(
					'title'      => esc_html__( 'Footer columns', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'fcunited' ) ),
					'dependency' => array(
						'footer_type_mobile'    => array( 'default' ),
						'footer_widgets_mobile' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => fcunited_get_list_range( 0, 6 ),
					'type'       => 'select',
				),



				// 'Blog'
				//---------------------------------------------
				'blog'                          => array(
					'title'    => esc_html__( 'Blog', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Options of the the blog archive', 'fcunited' ) ),
					'priority' => 70,
					'type'     => 'panel',
				),


				// Blog - Posts page
				//---------------------------------------------
				'blog_general'                  => array(
					'title' => esc_html__( 'Posts page', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Style and components of the blog archive', 'fcunited' ) ),
					'type'  => 'section',
				),
				'blog_general_info'             => array(
					'title'  => esc_html__( 'Posts page settings', 'fcunited' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'fcunited' ),
					'type'   => 'info',
				),
				'blog_style'                    => array(
					'title'      => esc_html__( 'Blog style', 'fcunited' ),
					'desc'       => '',
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'excerpt',
					'qsetup'     => esc_html__( 'General', 'fcunited' ),
					'options'    => array(),
					'type'       => 'select',
				),
				'first_post_large'              => array(
					'title'      => esc_html__( 'First post large', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Make your first post stand out by making it bigger', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),						
						'blog_style' => array( 'classic', 'masonry' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'blog_content'                  => array(
					'title'      => esc_html__( 'Posts content', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Display either post excerpts or the full post content', 'fcunited' ) ),
					'std'        => 'excerpt',
					'dependency' => array(
						'blog_style' => array( 'excerpt' ),
					),
					'options'    => array(
						'excerpt'  => esc_html__( 'Excerpt', 'fcunited' ),
						'fullpost' => esc_html__( 'Full post', 'fcunited' ),
					),
					'type'       => 'switch',
				),
				'excerpt_length'                => array(
					'title'      => esc_html__( 'Excerpt length', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged', 'fcunited' ) ),
					'dependency' => array(
						'blog_style'   => array( 'excerpt' ),
						'blog_content' => array( 'excerpt' ),
					),
					'std'        => 39,
					'type'       => 'text',
				),
				'blog_columns'                  => array(
					'title'   => esc_html__( 'Blog columns', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'How many columns should be used in the blog archive (from 2 to 4)?', 'fcunited' ) ),
					'std'     => 2,
					'options' => fcunited_get_list_range( 2, 4 ),
					'type'    => 'hidden',      // This options is available and must be overriden only for some modes (for example, 'shop')
				),
				'post_type'                     => array(
					'title'      => esc_html__( 'Post type', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select post type to show in the blog archive', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'linked'     => 'parent_cat',
					'refresh'    => false,
					'hidden'     => true,
					'std'        => 'post',
					'options'    => array(),
					'type'       => 'select',
				),
				'parent_cat'                    => array(
					'title'      => esc_html__( 'Category to show', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select category to show in the blog archive', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'refresh'    => false,
					'hidden'     => true,
					'std'        => '0',
					'options'    => array(),
					'type'       => 'select',
				),
				'posts_per_page'                => array(
					'title'      => esc_html__( 'Posts per page', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'How many posts will be displayed on this page', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'hidden'     => true,
					'std'        => '',
					'type'       => 'text',
				),
				'blog_pagination'               => array(
					'title'      => esc_html__( 'Pagination style', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Show Older/Newest posts or Page numbers below the posts list', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'std'        => 'pages',
					'qsetup'     => esc_html__( 'General', 'fcunited' ),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'options'    => array(
						'pages'    => esc_html__( 'Page numbers', 'fcunited' ),
						'links'    => esc_html__( 'Older/Newest', 'fcunited' ),
						'more'     => esc_html__( 'Load more', 'fcunited' ),
						'infinite' => esc_html__( 'Infinite scroll', 'fcunited' ),
					),
					'type'       => 'select',
				),
				'blog_animation'                => array(
					'title'      => esc_html__( 'Animation for the posts', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'none',
					'options'    => array(),
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),
				'show_filters'                  => array(
					'title'      => esc_html__( 'Show filters', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Show categories as tabs to filter posts', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'portfolio', 'gallery' ),
					),
					'hidden'     => true,
					'std'        => 0,
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_header_info'              => array(
					'title' => esc_html__( 'Header', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_blog'              => array(
					'title'    => esc_html__( 'Header style', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => fcunited_get_list_header_footer_types( true ),
					'type'     => FCUNITED_THEME_FREE || ! fcunited_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_blog'             => array(
					'title'      => esc_html__( 'Select custom layout', 'fcunited' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'fcunited' ), 'fcunited_kses_content' ),
					'dependency' => array(
						'header_type_blog' => array( 'custom' ),
					),
					'std'        => FCUNITED_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_blog'          => array(
					'title'    => esc_html__( 'Header position', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight_blog'        => array(
					'title'    => esc_html__( 'Header fullheight', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => fcunited_get_list_checkbox_values( true ),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_wide_blog'              => array(
					'title'      => esc_html__( 'Header fullwidth', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'fcunited' ) ),
					'dependency' => array(
						'header_type_blog' => array( 'default' ),
					),
					'std'      => 'inherit',
					'options'  => fcunited_get_list_checkbox_values( true ),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),

				'blog_sidebar_info'             => array(
					'title' => esc_html__( 'Sidebar', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_blog'         => array(
					'title'   => esc_html__( 'Sidebar position', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar', 'fcunited' ) ),
					'std'     => 'inherit',
					'options' => array(),
					'qsetup'     => esc_html__( 'General', 'fcunited' ),
					'type'    => 'switch',
				),
				'sidebar_position_ss_blog'  => array(
					'title'    => esc_html__( 'Sidebar position on the small screen', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to move sidebar on the small screen - above or below the content', 'fcunited' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( '^hide' ),
					),
					'std'      => 'inherit',
					'qsetup'   => esc_html__( 'General', 'fcunited' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_blog'          => array(
					'title'      => esc_html__( 'Sidebar widgets', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'fcunited' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'fcunited' ),
					'type'       => 'select',
				),
				'expand_content_blog'           => array(
					'title'   => esc_html__( 'Expand content', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'fcunited' ) ),
					'refresh' => false,
					'std'     => 'inherit',
					'options'  => fcunited_get_list_checkbox_values( true ),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),

				'blog_widgets_info'             => array(
					'title' => esc_html__( 'Additional widgets', 'fcunited' ),
					'desc'  => '',
					'type'  => FCUNITED_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the top of the page', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'fcunited' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content_blog'    => array(
					'title'   => esc_html__( 'Widgets above the content', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'fcunited' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content_blog'    => array(
					'title'   => esc_html__( 'Widgets below the content', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'fcunited' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the bottom of the page', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'fcunited' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'select',
				),

				'blog_advanced_info'            => array(
					'title' => esc_html__( 'Advanced settings', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'no_image'                      => array(
					'title' => esc_html__( 'Image placeholder', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select or upload an image used as placeholder for posts without a featured image', 'fcunited' ) ),
					'std'   => '',
					'type'  => 'image',
				),
				'time_diff_before'              => array(
					'title' => esc_html__( 'Easy Readable Date Format', 'fcunited' ),
					'desc'  => wp_kses_data( __( "For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'fcunited' ) ),
					'std'   => 5,
					'type'  => 'text',
				),
				'sticky_style'                  => array(
					'title'   => esc_html__( 'Sticky posts style', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Select style of the sticky posts output', 'fcunited' ) ),
					'std'     => 'inherit',
					'options' => array(
						'inherit' => esc_html__( 'Decorated posts', 'fcunited' ),
						'columns' => esc_html__( 'Mini-cards', 'fcunited' ),
					),
					'type'    => 'hidden'
				),
				'meta_parts'                    => array(
					'title'      => esc_html__( 'Post meta', 'fcunited' ),
					'desc'       => wp_kses_data( __( "If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'fcunited' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=1|views=0|likes=0|comments=0|author=0|share=0|edit=0',
					'options'    => fcunited_get_list_meta_parts(),
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'checklist',
				),


				// Blog - Single posts
				//---------------------------------------------
				'blog_single'                   => array(
					'title' => esc_html__( 'Single posts', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Settings of the single post', 'fcunited' ) ),
					'type'  => 'section',
				),

				'blog_single_header_info'       => array(
					'title' => esc_html__( 'Header', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_single'            => array(
					'title'    => esc_html__( 'Header style', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => fcunited_get_list_header_footer_types( true ),
					'type'     => FCUNITED_THEME_FREE || ! fcunited_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_single'           => array(
					'title'      => esc_html__( 'Select custom layout', 'fcunited' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'fcunited' ), 'fcunited_kses_content' ),
					'dependency' => array(
						'header_type_single' => array( 'custom' ),
					),
					'std'        => FCUNITED_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_single'        => array(
					'title'    => esc_html__( 'Header position', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight_single'      => array(
					'title'    => esc_html__( 'Header fullheight', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'fcunited' ) ),
					'std'      => 'inherit',
					'options'  => fcunited_get_list_checkbox_values( true ),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_wide_single'            => array(
					'title'      => esc_html__( 'Header fullwidth', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'fcunited' ) ),
					'dependency' => array(
						'header_type_single' => array( 'default' ),
					),
					'std'      => 'inherit',
					'options'  => fcunited_get_list_checkbox_values( true ),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),

				'blog_single_sidebar_info'      => array(
					'title' => esc_html__( 'Sidebar', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_single'       => array(
					'title'   => esc_html__( 'Sidebar position', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar on the single posts', 'fcunited' ) ),
					'std'     => 'right',
					'override'   => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'options' => array(),
					'type'    => 'switch',
				),
				'sidebar_position_ss_single'=> array(
					'title'    => esc_html__( 'Sidebar position on the small screen', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select position to move sidebar on the single posts on the small screen - above or below the content', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'dependency' => array(
						'sidebar_position_single' => array( '^hide' ),
					),
					'std'      => 'below',
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_single'        => array(
					'title'      => esc_html__( 'Sidebar widgets', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar on the single posts', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'fcunited' ),
					),
					'dependency' => array(
						'sidebar_position_single' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'expand_content_single'           => array(
					'title'   => esc_html__( 'Expand content', 'fcunited' ),
					'desc'    => wp_kses_data( __( 'Expand the content width on the single posts if the sidebar is hidden', 'fcunited' ) ),
					'refresh' => false,
					'std'     => 'inherit',
					'options'  => fcunited_get_list_checkbox_values( true ),
					'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),

				'blog_single_title_info'      => array(
					'title' => esc_html__( 'Featured image and title', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'hide_featured_on_single'       => array(
					'title'    => esc_html__( 'Hide featured image on the single post', 'fcunited' ),
					'desc'     => wp_kses_data( __( "Hide featured image on the single post's pages", 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'post_thumbnail_type'      => array(
					'title'      => esc_html__( 'Type of post thumbnail', 'fcunited' ),
					'desc'       => wp_kses_data( __( "Select type of post thumbnail on the single post's pages", 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 'is_empty', 0 ),
					),
					'std'        => 'default',
					'options'    => array(
						'fullwidth'   => esc_html__( 'Fullwidth', 'fcunited' ),
						'boxed'       => esc_html__( 'Boxed', 'fcunited' ),
						'default'     => esc_html__( 'Default', 'fcunited' ),
					),
					'type'       => 'hidden',
				),
				'post_header_position'          => array(
					'title'      => esc_html__( 'Post header position', 'fcunited' ),
					'desc'       => wp_kses_data( __( "Select post header position on the single post's pages", 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 'is_empty', 0 )
					),
					'std'        => 'under',
					'options'    => array(
						'above'      => esc_html__( 'Above the post thumbnail', 'fcunited' ),
						'under'      => esc_html__( 'Under the post thumbnail', 'fcunited' ),
						'default'    => esc_html__( 'Default', 'fcunited' ),
					),
                    'type'       => 'hidden',
				),
				'post_header_align'             => array(
					'title'      => esc_html__( 'Align of the post header', 'fcunited' ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'post_header_position' => array( 'on_thumb' ),
					),
					'std'        => 'mc',
					'options'    => array(
						'ts' => esc_html__('Top Stick Out', 'fcunited'),
						'tl' => esc_html__('Top Left', 'fcunited'),
						'tc' => esc_html__('Top Center', 'fcunited'),
						'tr' => esc_html__('Top Right', 'fcunited'),
						'ml' => esc_html__('Middle Left', 'fcunited'),
						'mc' => esc_html__('Middle Center', 'fcunited'),
						'mr' => esc_html__('Middle Right', 'fcunited'),
						'bl' => esc_html__('Bottom Left', 'fcunited'),
						'bc' => esc_html__('Bottom Center', 'fcunited'),
						'br' => esc_html__('Bottom Right', 'fcunited'),
						'bs' => esc_html__('Bottom Stick Out', 'fcunited'),
					),
                    'type'       => 'hidden',
				),
				'post_subtitle'                 => array(
					'title' => esc_html__( 'Post subtitle', 'fcunited' ),
					'desc'  => wp_kses_data( __( "Specify post subtitle to display it under the post title.", 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'std'   => '',
					'hidden' => true,
					'type'  => 'text',
				),
				'show_post_meta'                => array(
					'title' => esc_html__( 'Show post meta', 'fcunited' ),
					'desc'  => wp_kses_data( __( "Display block with post's meta: date, categories, counters, etc.", 'fcunited' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'meta_parts_single'             => array(
					'title'      => esc_html__( 'Post meta', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active', 'fcunited' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'fcunited' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=1|views=0|likes=0|comments=0|author=0|share=0|edit=0',
					'options'    => fcunited_get_list_meta_parts(),
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'checklist',
				),
				'show_share_links'              => array(
					'title' => esc_html__( 'Show share links', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Display share links on the single post', 'fcunited' ) ),
					'std'   => 1,
					'type'  => ! fcunited_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'show_author_info'              => array(
					'title' => esc_html__( 'Show author info', 'fcunited' ),
					'desc'  => wp_kses_data( __( "Display block with information about post's author", 'fcunited' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),

				'blog_single_related_info'      => array(
					'title' => esc_html__( 'Related posts', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_related_posts'            => array(
					'title'    => esc_html__( 'Show related posts', 'fcunited' ),
					'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single post's pages", 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'std'      => 1,
					'type'     => 'checkbox',
				),
				'related_style'                 => array(
					'title'      => esc_html__( 'Related posts style', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select style of the related posts output', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'classic',
					'options'    => array(
						'modern'  => esc_html__( 'Modern', 'fcunited' ),
						'classic' => esc_html__( 'Classic', 'fcunited' ),
						'wide'    => esc_html__( 'Wide', 'fcunited' ),
						'list'    => esc_html__( 'List', 'fcunited' ),
						'short'   => esc_html__( 'Short', 'fcunited' ),
					),
					'type'       => 'hidden',
				),
				'related_position'              => array(
					'title'      => esc_html__( 'Related posts position', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Select position to display the related posts', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'below_content',
					'options'    => array (
						'inside'        => esc_html__( 'Inside the content (fullwidth)', 'fcunited' ),
						'inside_left'   => esc_html__( 'At left side of the content', 'fcunited' ),
						'inside_right'  => esc_html__( 'At right side of the content', 'fcunited' ),
						'below_content' => esc_html__( 'After the content', 'fcunited' ),
						'below_page'    => esc_html__( 'After the content & sidebar', 'fcunited' ),
					),
					'type'       => 'hidden',
				),
				'related_position_inside'       => array(
					'title'      => esc_html__( 'Before # paragraph', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Before what paragraph should related posts appear? If 0 - randomly.', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_position' => array( 'inside', 'inside_left', 'inside_right' ),
					),
					'std'        => 2,
					'options'    => fcunited_get_list_range( 0, 9 ),
                    'type'       => 'hidden',
				),
				'related_posts'                 => array(
					'title'      => esc_html__( 'Related posts', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'min'        => 1,
					'max'        => 9,
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'slider',
				),
				'related_columns'               => array(
					'title'      => esc_html__( 'Related columns', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'How many columns should be used to output related posts in the single page?', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_position' => array( 'inside', 'below_content', 'below_page' ),
					),
					'std'        => 2,
					'options'    => fcunited_get_list_range( 1, 6 ),
					'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider'                => array(
					'title'      => esc_html__( 'Use slider layout', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Use slider layout in case related posts count is more than columns count', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 0,
                    'type'       => 'hidden',
				),
				'related_slider_controls'       => array(
					'title'      => esc_html__( 'Slider controls', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Show arrows in the slider', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'none',
					'options'    => array(
						'none'    => esc_html__('None', 'fcunited'),
						'side'    => esc_html__('Side', 'fcunited'),
						'outside' => esc_html__('Outside', 'fcunited'),
						'top'     => esc_html__('Top', 'fcunited'),
						'bottom'  => esc_html__('Bottom', 'fcunited')
					),
                    'type'       => 'hidden',
				),
				'related_slider_pagination'       => array(
					'title'      => esc_html__( 'Slider pagination', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Show bullets after the slider', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'bottom',
					'options'    => array(
						'none'    => esc_html__('None', 'fcunited'),
						'bottom'  => esc_html__('Bottom', 'fcunited')
					),
                    'type'       => 'hidden',
				),
				'related_slider_space'          => array(
					'title'      => esc_html__( 'Space', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Space between slides', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'fcunited' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 30,
                    'type'       => 'hidden',
				),
				'posts_navigation_info'      => array(
					'title' => esc_html__( 'Posts navigation', 'fcunited' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'posts_navigation'           => array(
					'title'   => esc_html__( 'Show posts navigation', 'fcunited' ),
					'desc'    => wp_kses_data( __( "Show posts navigation on the single post's pages", 'fcunited' ) ),
					'std'     => 'links',
					'options' => array(
						'none'   => esc_html__('None', 'fcunited'),
						'links'  => esc_html__('Prev/Next links', 'fcunited'),
					),
					'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
				),
				'posts_navigation_fixed'     => array(
					'title'      => esc_html__( 'Fixed posts navigation', 'fcunited' ),
					'desc'       => wp_kses_data( __( "Make posts navigation fixed position. Display it when the content of the article is inside the window.", 'fcunited' ) ),
					'dependency' => array(
						'posts_navigation' => array( 'links' ),
					),
					'std'        => 0,
					'type'       => 'hidden',
				),
				'posts_navigation_scroll_hide_author'  => array(
					'title'      => esc_html__( 'Hide author bio', 'fcunited' ),
					'desc'       => wp_kses_data( __( "Hide author bio after post content when infinite scroll is used.", 'fcunited' ) ),
					'dependency' => array(
						'posts_navigation' => array( 'scroll' ),
					),
					'std'        => 0,
                    'type'       => 'hidden',
                ),
				'posts_navigation_scroll_hide_related'  => array(
					'title'      => esc_html__( 'Hide related posts', 'fcunited' ),
					'desc'       => wp_kses_data( __( "Hide related posts after post content when infinite scroll is used.", 'fcunited' ) ),
					'dependency' => array(
						'posts_navigation' => array( 'scroll' ),
					),
					'std'        => 0,
                    'type'       => 'hidden',
                ),
				'posts_navigation_scroll_hide_comments' => array(
					'title'      => esc_html__( 'Hide comments', 'fcunited' ),
					'desc'       => wp_kses_data( __( "Hide comments after post content when infinite scroll is used.", 'fcunited' ) ),
					'dependency' => array(
						'posts_navigation' => array( 'scroll' ),
					),
					'std'        => 1,
                    'type'       => 'hidden',
                ),
				'posts_banners_info'      => array(
					'title' => esc_html__( 'Posts banners', 'fcunited' ),
					'desc'  => '',
                    'type'  => 'hidden',
				),
				'header_banner_link'     => array(
					'title' => esc_html__( 'Header banner link', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'   => '',
					'type'  => 'hidden',
				),
				'header_banner_img'     => array(
					'title' => esc_html__( 'Header banner image', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
                    'type'  => 'hidden',
                ),
				'header_banner_height'  => array(
					'title' => esc_html__( 'Header banner height', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Specify minimal height of the banner (in "px" or "em"). For example: 15em', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
                    'type'  => 'hidden',
                ),
				'header_banner_code'     => array(
					'title'      => esc_html__( 'Header banner code', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
					'allow_html' => true,
                    'type'  => 'hidden',
				),
				'footer_banner_link'     => array(
					'title' => esc_html__( 'Footer banner link', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'   => '',
                    'type'  => 'hidden',
				),
				'footer_banner_img'     => array(
					'title' => esc_html__( 'Footer banner image', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
                    'type'  => 'hidden',
				),
				'footer_banner_height'  => array(
					'title' => esc_html__( 'Footer banner height', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Specify minimal height of the banner (in "px" or "em"). For example: 15em', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
                    'type'  => 'hidden',
				),
				'footer_banner_code'     => array(
					'title'      => esc_html__( 'Footer banner code', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
					'allow_html' => true,
                    'type'  => 'hidden',
				),
				'sidebar_banner_link'     => array(
					'title' => esc_html__( 'Sidebar banner link', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'   => '',
                    'type'  => 'hidden',
				),
				'sidebar_banner_img'     => array(
					'title' => esc_html__( 'Sidebar banner image', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
                    'type'  => 'hidden',
				),
				'sidebar_banner_code'     => array(
					'title'      => esc_html__( 'Sidebar banner code', 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
					'allow_html' => true,
                    'type'  => 'hidden',
				),
				'background_banner_link'     => array(
					'title' => esc_html__( "Post's background banner link", 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'   => '',
                    'type'  => 'hidden',
				),
				'background_banner_img'     => array(
					'title' => esc_html__( "Post's background banner image", 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
                    'type'  => 'hidden',
				),
				'background_banner_code'     => array(
					'title'      => esc_html__( "Post's background banner code", 'fcunited' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'fcunited' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'fcunited' ),
					),
					'std'        => '',
					'allow_html' => true,
                    'type'  => 'hidden',
				),
				'blog_end'                      => array(
					'type' => 'panel_end',
				),



				// 'Colors'
				//---------------------------------------------
				'panel_colors'                  => array(
					'title'    => esc_html__( 'Colors', 'fcunited' ),
					'desc'     => '',
					'priority' => 300,
					'type'     => 'section',
				),

				'color_schemes_info'            => array(
					'title'  => esc_html__( 'Color schemes', 'fcunited' ),
					'desc'   => wp_kses_data( __( 'Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'fcunited' ) ),
					'hidden' => $hide_schemes,
					'type'   => 'info',
				),
				'color_scheme'                  => array(
					'title'    => esc_html__( 'Site Color Scheme', 'fcunited' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'fcunited' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'header_scheme'                 => array(
					'title'    => esc_html__( 'Header Color Scheme', 'fcunited' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'fcunited' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'menu_scheme'                   => array(
					'title'    => esc_html__( 'Sidemenu Color Scheme', 'fcunited' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'fcunited' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => 'hidden',
				),
				'sidebar_scheme'                => array(
					'title'    => esc_html__( 'Sidebar Color Scheme', 'fcunited' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'fcunited' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'footer_scheme'                 => array(
					'title'    => esc_html__( 'Footer Color Scheme', 'fcunited' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'fcunited' ),
					),
					'std'      => 'dark',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),

				'color_scheme_editor_info'      => array(
					'title' => esc_html__( 'Color scheme editor', 'fcunited' ),
					'desc'  => wp_kses_data( __( 'Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'fcunited' ) ),
					'type'  => 'info',
				),
				'scheme_storage'                => array(
					'title'       => esc_html__( 'Color scheme editor', 'fcunited' ),
					'desc'        => '',
					'std'         => '$fcunited_get_scheme_storage',
					'refresh'     => false,
					'colorpicker' => 'tiny',
					'type'        => 'scheme_editor',
				),

				// Internal options.
				// Attention! Don't change any options in the section below!
				// Use huge priority to call render this elements after all options!
				'reset_options'                 => array(
					'title'    => '',
					'desc'     => '',
					'std'      => '0',
					'priority' => 10000,
					'type'     => 'hidden',
				),

				'last_option'                   => array(     // Need to manually call action to include Tiny MCE scripts
					'title' => '',
					'desc'  => '',
					'std'   => 1,
					'type'  => 'hidden',
				),

			)
		);



		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(

			// 'Fonts'
			//---------------------------------------------
			'fonts'             => array(
				'title'    => esc_html__( 'Typography', 'fcunited' ),
				'desc'     => '',
				'priority' => 200,
				'type'     => 'panel',
			),

			// Fonts - Load_fonts
			'load_fonts'        => array(
				'title' => esc_html__( 'Load fonts', 'fcunited' ),
				'desc'  => wp_kses_data( __( 'Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'fcunited' ) )
						. '<br>'
						. wp_kses_data( __( 'Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'fcunited' ) ),
				'type'  => 'section',
			),
			'load_fonts_subset' => array(
				'title'   => esc_html__( 'Google fonts subsets', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Specify comma separated list of the subsets which will be load from Google fonts', 'fcunited' ) )
						. '<br>'
						. wp_kses_data( __( 'Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'fcunited' ) ),
				'class'   => 'fcunited_column-1_3 fcunited_new_row',
				'refresh' => false,
				'std'     => '$fcunited_get_load_fonts_subset',
				'type'    => 'text',
			),
		);

		for ( $i = 1; $i <= fcunited_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			if ( fcunited_get_value_gp( 'page' ) != 'theme_options' ) {
				$fonts[ "load_fonts-{$i}-info" ] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					'title' => esc_html( sprintf( __( 'Font %s', 'fcunited' ), $i ) ),
					'desc'  => '',
					'type'  => 'info',
				);
			}
			$fonts[ "load_fonts-{$i}-name" ]   = array(
				'title'   => esc_html__( 'Font name', 'fcunited' ),
				'desc'    => '',
				'class'   => 'fcunited_column-1_3 fcunited_new_row',
				'refresh' => false,
				'std'     => '$fcunited_get_load_fonts_option',
				'type'    => 'text',
			);
			$fonts[ "load_fonts-{$i}-family" ] = array(
				'title'   => esc_html__( 'Font family', 'fcunited' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Select font family to use it if font above is not available', 'fcunited' ) )
							: '',
				'class'   => 'fcunited_column-1_3',
				'refresh' => false,
				'std'     => '$fcunited_get_load_fonts_option',
				'options' => array(
					'inherit'    => esc_html__( 'Inherit', 'fcunited' ),
					'serif'      => esc_html__( 'serif', 'fcunited' ),
					'sans-serif' => esc_html__( 'sans-serif', 'fcunited' ),
					'monospace'  => esc_html__( 'monospace', 'fcunited' ),
					'cursive'    => esc_html__( 'cursive', 'fcunited' ),
					'fantasy'    => esc_html__( 'fantasy', 'fcunited' ),
				),
				'type'    => 'select',
			);
			$fonts[ "load_fonts-{$i}-styles" ] = array(
				'title'   => esc_html__( 'Font styles', 'fcunited' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'fcunited' ) )
								. '<br>'
								. wp_kses_data( __( 'Attention! Each weight and style increase download size! Specify only used weights and styles.', 'fcunited' ) )
							: '',
				'class'   => 'fcunited_column-1_3',
				'refresh' => false,
				'std'     => '$fcunited_get_load_fonts_option',
				'type'    => 'text',
			);
		}
		$fonts['load_fonts_end'] = array(
			'type' => 'section_end',
		);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = fcunited_get_theme_fonts();
		foreach ( $theme_fonts as $tag => $v ) {
			$fonts[ "{$tag}_section" ] = array(
				'title' => ! empty( $v['title'] )
								? $v['title']
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html( sprintf( __( '%s settings', 'fcunited' ), $tag ) ),
				'desc'  => ! empty( $v['description'] )
								? $v['description']
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf( __( 'Font settings of the "%s" tag.', 'fcunited' ), $tag ) ),
				'type'  => 'section',
			);

			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$options    = '';
				$type       = 'text';
				$load_order = 1;
				$title      = ucfirst( str_replace( '-', ' ', $css_prop ) );
				if ( 'font-family' == $css_prop ) {
					$type       = 'select';
					$options    = array();
					$load_order = 2;        // Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} elseif ( 'font-weight' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'fcunited' ),
						'100'     => esc_html__( '100 (Light)', 'fcunited' ),
						'200'     => esc_html__( '200 (Light)', 'fcunited' ),
						'300'     => esc_html__( '300 (Thin)', 'fcunited' ),
						'400'     => esc_html__( '400 (Normal)', 'fcunited' ),
						'500'     => esc_html__( '500 (Semibold)', 'fcunited' ),
						'600'     => esc_html__( '600 (Semibold)', 'fcunited' ),
						'700'     => esc_html__( '700 (Bold)', 'fcunited' ),
						'800'     => esc_html__( '800 (Black)', 'fcunited' ),
						'900'     => esc_html__( '900 (Black)', 'fcunited' ),
					);
				} elseif ( 'font-style' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'fcunited' ),
						'normal'  => esc_html__( 'Normal', 'fcunited' ),
						'italic'  => esc_html__( 'Italic', 'fcunited' ),
					);
				} elseif ( 'text-decoration' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'      => esc_html__( 'Inherit', 'fcunited' ),
						'none'         => esc_html__( 'None', 'fcunited' ),
						'underline'    => esc_html__( 'Underline', 'fcunited' ),
						'overline'     => esc_html__( 'Overline', 'fcunited' ),
						'line-through' => esc_html__( 'Line-through', 'fcunited' ),
					);
				} elseif ( 'text-transform' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'    => esc_html__( 'Inherit', 'fcunited' ),
						'none'       => esc_html__( 'None', 'fcunited' ),
						'uppercase'  => esc_html__( 'Uppercase', 'fcunited' ),
						'lowercase'  => esc_html__( 'Lowercase', 'fcunited' ),
						'capitalize' => esc_html__( 'Capitalize', 'fcunited' ),
					);
				}
				$fonts[ "{$tag}_{$css_prop}" ] = array(
					'title'      => $title,
					'desc'       => '',
					'class'      => 'fcunited_column-1_5',
					'refresh'    => false,
					'load_order' => $load_order,
					'std'        => '$fcunited_get_theme_fonts_option',
					'options'    => $options,
					'type'       => $type,
				);
			}

			$fonts[ "{$tag}_section_end" ] = array(
				'type' => 'section_end',
			);
		}

		$fonts['fonts_end'] = array(
			'type' => 'panel_end',
		);

		// Add fonts parameters to Theme Options
		fcunited_storage_set_array_before( 'options', 'panel_colors', $fonts );

		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if ( ! function_exists( 'get_header_video_url' ) ) {
			fcunited_storage_set_array_after(
				'options', 'header_image_override', 'header_video', array(
					'title'    => esc_html__( 'Header video', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select video to use it as background for the header', 'fcunited' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'fcunited' ),
					),
					'std'      => '',
					'type'     => 'video',
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is not 'Customize'
		// ------------------------------------------------------
		if ( ! function_exists( 'the_custom_logo' ) || ! fcunited_check_url( 'customize.php' ) ) {
			fcunited_storage_set_array_before(
				'options', 'logo_retina', function_exists( 'the_custom_logo' ) ? 'custom_logo' : 'logo', array(
					'title'    => esc_html__( 'Logo', 'fcunited' ),
					'desc'     => wp_kses_data( __( 'Select or upload the site logo', 'fcunited' ) ),
					'class'    => 'fcunited_column-1_2 fcunited_new_row',
					'priority' => 60,
					'std'      => '',
					'qsetup'   => esc_html__( 'General', 'fcunited' ),
					'type'     => 'image',
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if ( ! function_exists( 'fcunited_options_get_list_cpt_options' ) ) {
	function fcunited_options_get_list_cpt_options( $cpt, $title = '' ) {
		if ( empty( $title ) ) {
			$title = ucfirst( $cpt );
		}
		return array(
			"content_info_{$cpt}"           => array(
				'title' => esc_html__( 'Content', 'fcunited' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"body_style_{$cpt}"             => array(
				'title'    => esc_html__( 'Body style', 'fcunited' ),
				'desc'     => wp_kses_data( __( 'Select width of the body content', 'fcunited' ) ),
				'std'      => 'inherit',
				'options'  => fcunited_get_list_body_styles( true ),
				'type'     => 'select',
			),
			"boxed_bg_image_{$cpt}"         => array(
				'title'      => esc_html__( 'Boxed bg image', 'fcunited' ),
				'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'fcunited' ) ),
				'dependency' => array(
					"body_style_{$cpt}" => array( 'boxed' ),
				),
				'std'        => 'inherit',
				'type'       => 'image',
			),
			"header_info_{$cpt}"            => array(
				'title' => esc_html__( 'Header', 'fcunited' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"header_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Header style', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'fcunited' ) ),
				'std'     => 'inherit',
				'options' => fcunited_get_list_header_footer_types( true ),
				'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'fcunited' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select custom layout to display the site header on the %s pages', 'fcunited' ), $title ) ),
				'dependency' => array(
					"header_type_{$cpt}" => array( 'custom' ),
				),
				'std'        => 'inherit',
				'options'    => array(),
				'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'select',
			),
			"header_position_{$cpt}"        => array(
				'title'   => esc_html__( 'Header position', 'fcunited' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to display the site header on the %s pages', 'fcunited' ), $title ) ),
				'std'     => 'inherit',
				'options' => array(),
				'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_image_override_{$cpt}"  => array(
				'title'   => esc_html__( 'Header image override', 'fcunited' ),
				'desc'    => wp_kses_data( __( "Allow override the header image with the post's featured image", 'fcunited' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'fcunited' ),
					1         => esc_html__( 'Yes', 'fcunited' ),
					0         => esc_html__( 'No', 'fcunited' ),
				),
				'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_widgets_{$cpt}"         => array(
				'title'   => esc_html__( 'Header widgets', 'fcunited' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select set of widgets to show in the header on the %s pages', 'fcunited' ), $title ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => 'select',
			),

			"sidebar_info_{$cpt}"           => array(
				'title' => esc_html__( 'Sidebar', 'fcunited' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"sidebar_position_{$cpt}"       => array(
				'title'   => sprintf( esc_html__( 'Sidebar position on the %s list', 'fcunited' ), $title ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf(esc_html__( 'Select position to show sidebar on the %s list', 'fcunited' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_position_ss_{$cpt}"=> array(
				'title'    => sprintf( esc_html__( 'Sidebar position on the %s list on the small screen', 'fcunited' ), $title ),
				'desc'     => wp_kses_data( __( 'Select position to move sidebar on the small screen - above or below the content', 'fcunited' ) ),
				'std'      => 'below',
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( '^hide' ),
				),
				'options'  => array(),
				'type'     => 'switch',
			),
			"sidebar_widgets_{$cpt}"        => array(
				'title'      => sprintf( esc_html__( 'Sidebar widgets on the %s list', 'fcunited' ), $title ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select sidebar to show on the %s list', 'fcunited' ), $title ) ),
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( '^hide' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"sidebar_position_single_{$cpt}"       => array(
				'title'   => sprintf( esc_html__( 'Sidebar position on the single post', 'fcunited' ), $title ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the single posts of the %s', 'fcunited' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_position_ss_single_{$cpt}"=> array(
				'title'    => esc_html__( 'Sidebar position on the single post on the small screen', 'fcunited' ),
				'desc'     => wp_kses_data( __( 'Select position to move sidebar on the small screen - above or below the content', 'fcunited' ) ),
				'dependency' => array(
					"sidebar_position_single_{$cpt}" => array( '^hide' ),
				),
				'std'      => 'below',
				'options'  => array(),
				'type'     => 'switch',
			),
			"sidebar_widgets_single_{$cpt}"        => array(
				'title'      => sprintf( esc_html__( 'Sidebar widgets on the single post', 'fcunited' ), $title ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select widgets to show in the sidebar on the single posts of the %s', 'fcunited' ), $title ) ),
				'dependency' => array(
					"sidebar_position_single_{$cpt}" => array( '^hide' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"expand_content_{$cpt}"         => array(
				'title'   => esc_html__( 'Expand content', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'fcunited' ) ),
				'refresh' => false,
				'std'     => 'inherit',
				'options'  => fcunited_get_list_checkbox_values( true ),
				'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
			),
			"expand_content_single_{$cpt}"         => array(
				'title'   => esc_html__( 'Expand content on the single post', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Expand the content width on the single post if the sidebar is hidden', 'fcunited' ) ),
				'refresh' => false,
				'std'     => 'inherit',
				'options'  => fcunited_get_list_checkbox_values( true ),
				'type'     => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
			),

			"footer_info_{$cpt}"            => array(
				'title' => esc_html__( 'Footer', 'fcunited' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"footer_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Footer style', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'fcunited' ) ),
				'std'     => 'inherit',
				'options' => fcunited_get_list_header_footer_types( true ),
				'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'switch',
			),
			"footer_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'fcunited' ),
				'desc'       => wp_kses_data( __( 'Select custom layout to display the site footer', 'fcunited' ) ),
				'std'        => 'inherit',
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'custom' ),
				),
				'options'    => array(),
				'type'       => FCUNITED_THEME_FREE ? 'hidden' : 'select',
			),
			"footer_widgets_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer widgets', 'fcunited' ),
				'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'fcunited' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 'footer_widgets',
				'options'    => array(),
				'type'       => 'select',
			),
			"footer_columns_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer columns', 'fcunited' ),
				'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'fcunited' ) ),
				'dependency' => array(
					"footer_type_{$cpt}"    => array( 'default' ),
					"footer_widgets_{$cpt}" => array( '^hide' ),
				),
				'std'        => 0,
				'options'    => fcunited_get_list_range( 0, 6 ),
				'type'       => 'select',
			),
			"footer_wide_{$cpt}"            => array(
				'title'      => esc_html__( 'Footer fullwidth', 'fcunited' ),
				'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'fcunited' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 0,
				'type'       => 'checkbox',
			),

			"widgets_info_{$cpt}"           => array(
				'title' => esc_html__( 'Additional panels', 'fcunited' ),
				'desc'  => '',
				'type'  => FCUNITED_THEME_FREE ? 'hidden' : 'info',
			),
			"widgets_above_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the top of the page', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'fcunited' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_above_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets above the content', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'fcunited' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets below the content', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'fcunited' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the bottom of the page', 'fcunited' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'fcunited' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => FCUNITED_THEME_FREE ? 'hidden' : 'select',
			),
		);
	}
}


// Return lists with choises when its need in the admin mode
if ( ! function_exists( 'fcunited_options_get_list_choises' ) ) {
	add_filter( 'fcunited_filter_options_get_list_choises', 'fcunited_options_get_list_choises', 10, 2 );
	function fcunited_options_get_list_choises( $list, $id ) {
		if ( is_array( $list ) && count( $list ) == 0 ) {
			if ( strpos( $id, 'header_style' ) === 0 ) {
				$list = fcunited_get_list_header_styles( strpos( $id, 'header_style_' ) === 0 );
			} elseif ( strpos( $id, 'header_position' ) === 0 ) {
				$list = fcunited_get_list_header_positions( strpos( $id, 'header_position_' ) === 0 );
			} elseif ( strpos( $id, 'header_widgets' ) === 0 ) {
				$list = fcunited_get_list_sidebars( strpos( $id, 'header_widgets_' ) === 0, true );
			} elseif ( strpos( $id, '_scheme' ) > 0 ) {
				$list = fcunited_get_list_schemes( 'color_scheme' != $id );
			} elseif ( strpos( $id, 'sidebar_widgets' ) === 0 ) {
				$list = fcunited_get_list_sidebars( 'sidebar_widgets_single' != $id && ( strpos( $id, 'sidebar_widgets_' ) === 0 || strpos( $id, 'sidebar_widgets_single_' ) === 0 ), true );
			} elseif ( strpos( $id, 'sidebar_position_ss' ) === 0 ) {
				$list = fcunited_get_list_sidebars_positions_ss( strpos( $id, 'sidebar_position_ss_' ) === 0 );
			} elseif ( strpos( $id, 'sidebar_position' ) === 0 ) {
				$list = fcunited_get_list_sidebars_positions( strpos( $id, 'sidebar_position_' ) === 0 );
			} elseif ( strpos( $id, 'widgets_above_page' ) === 0 ) {
				$list = fcunited_get_list_sidebars( strpos( $id, 'widgets_above_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_above_content' ) === 0 ) {
				$list = fcunited_get_list_sidebars( strpos( $id, 'widgets_above_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_page' ) === 0 ) {
				$list = fcunited_get_list_sidebars( strpos( $id, 'widgets_below_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_content' ) === 0 ) {
				$list = fcunited_get_list_sidebars( strpos( $id, 'widgets_below_content_' ) === 0, true );
			} elseif ( strpos( $id, 'footer_style' ) === 0 ) {
				$list = fcunited_get_list_footer_styles( strpos( $id, 'footer_style_' ) === 0 );
			} elseif ( strpos( $id, 'footer_widgets' ) === 0 ) {
				$list = fcunited_get_list_sidebars( strpos( $id, 'footer_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'blog_style' ) === 0 ) {
				$list = fcunited_get_list_blog_styles( strpos( $id, 'blog_style_' ) === 0 );
			} elseif ( strpos( $id, 'post_type' ) === 0 ) {
				$list = fcunited_get_list_posts_types();
			} elseif ( strpos( $id, 'parent_cat' ) === 0 ) {
				$list = fcunited_array_merge( array( 0 => esc_html__( '- Select category -', 'fcunited' ) ), fcunited_get_list_categories() );
			} elseif ( strpos( $id, 'blog_animation' ) === 0 ) {
				$list = fcunited_get_list_animations_in();
			} elseif ( 'color_scheme_editor' == $id ) {
				$list = fcunited_get_list_schemes();
			} elseif ( strpos( $id, '_font-family' ) > 0 ) {
				$list = fcunited_get_list_load_fonts( true );
			}
		}
		return $list;
	}
}
