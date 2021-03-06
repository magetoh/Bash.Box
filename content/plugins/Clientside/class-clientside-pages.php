<?php
/*
 * Clientside Pages class
 * Contains methods and information concerning all plugin pages
 */

class Clientside_Pages {

	// Return (array) the properties of all Clientside admin pages
	static function get_pages( $page_slug = '' ) {

		$pages = array();

		// Default page properties
		$default_args = array(
			'menu-title' => '',
			'tab-title' => '',
			'parent' => 'themes.php',
			'in-menu' => false,
			'has-tab' => true,
			'tab-side' => false,
			'network' => false
		);

		$pages['clientside-options-general'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-options-general',
				'menu-title' => _x( 'Admin Theme', 'Page title in the menu', 'clientside' ),
				'tab-title' => _x( 'Plugin Options', 'Option tab title', 'clientside' ),
				'title' => _x( 'Clientside Admin Theme Options', 'Option page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_general_options_page' ),
				'in-menu' => true
			)
		);

		$pages['clientside-options-network'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-options-network',
				'menu-title' => _x( 'Admin Theme', 'Page title in the menu', 'clientside' ),
				'title' => _x( 'Clientside Admin Theme', 'Option page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_network_options_page' ),
				'in-menu' => true,
				'has-tab' => false,
				'network' => true
			)
		);

		$pages['clientside-tools'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-tools',
				'title' => _x( 'Admin Tools', 'Option page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_tools_page' )
			)
		);

		$pages['clientside-documentation'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-documentation',
				'title' => _x( 'Documentation & Support', 'Option page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_documentation_page' )
			)
		);

		$pages['clientside-admin-menu-editor'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-admin-menu-editor',
				'title' => _x( 'Admin Menu Editor', 'Tool page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_admin_menu_editor' ),
				'parent' => 'tools.php',
				'in-menu' => true,
				'has-tab' => false
			)
		);

		$pages['clientside-admin-widget-manager'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-admin-widget-manager',
				'title' => __( 'Admin Widget Manager', 'Tool page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_admin_widget_manager' ),
				'parent' => 'tools.php',
				'in-menu' => true,
				'has-tab' => false
			)
		);

		$pages['clientside-admin-column-manager'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-admin-column-manager',
				'title' => __( 'Admin Column Manager', 'Tool page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_admin_column_manager' ),
				'parent' => 'tools.php',
				'in-menu' => true,
				'has-tab' => false
			)
		);

		// Return
		if ( $page_slug ) {
			if ( ! isset( $pages[ $page_slug ] ) ) {
				return null;
			}
			return $pages[ $page_slug ];
		}
		return $pages;

	}

	// Output the content of the requested options page
	static function display_general_options_page() {
		$page_info = self::get_pages( 'clientside-options-general' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-options-general.php' );
	}

	// Output the content of the requested options page
	static function display_network_options_page() {
		$page_info = self::get_pages( 'clientside-options-network' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-options-network.php' );
	}

	// Output the content of the documentation page
	static function display_documentation_page() {
		$page_info = self::get_pages( 'clientside-documentation' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-documentation.php' );
	}

	// Output the content of the Clientside Tools page
	static function display_tools_page() {
		$page_info = self::get_pages( 'clientside-tools' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-tools.php' );
	}

	// Output the content of the admin menu editor tool page
	static function display_admin_menu_editor() {
		$page_info = self::get_pages( 'clientside-admin-menu-editor' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-admin-menu-editor.php' );
	}

	// Output the content of the admin widget manager tool page
	static function display_admin_widget_manager() {
		$page_info = self::get_pages( 'clientside-admin-widget-manager' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-admin-widget-manager.php' );
	}

	// Output the content of the admin widget manager tool page
	static function display_admin_column_manager() {
		$page_info = self::get_pages( 'clientside-admin-column-manager' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-admin-column-manager.php' );
	}

	// Output the HTML for page tabs on the Clientside pages
	static function show_page_tabs( $active_page = '' ) {

		echo '<h2 class="nav-tab-wrapper">';
		foreach ( self::get_pages() as $page_info ) {

			if ( ! $page_info['has-tab'] ) {
				continue;
			}

			$url = self::get_page_url( $page_info['slug'] );
			echo '<a class="nav-tab ' . ( $page_info['slug'] == $active_page ? 'nav-tab-active ' : '' ) . ( $page_info['tab-side'] ? 'nav-tab-side ' : '' ) . '" href="' . $url . '">';
			echo $page_info['tab-title'] ? $page_info['tab-title'] : $page_info['title'];
			echo '</a> '; // Has trailing space to match native tabs

		}
		echo '</h2>';

	}

	// Return URL to specific page
	static function get_page_url( $page_slug = '' ) {

		// Get page info
		$page_info = self::get_pages( $page_slug );
		if ( is_null( $page_info ) ) {
			return '';
		}

		// Network page
		if ( $page_info['network'] ) {
			$url = network_admin_url( $page_info['parent'] . '?page=' . $page_info['slug'] );
		}

		// Regular page
		else{
			$url = admin_url( $page_info['parent'] . '?page=' . $page_info['slug'] );
		}

		// Return
		return esc_url( $url );

	}

}
?>