<?php

/**
 * Class Test_Minifier
 *
 * @group settings
 */
class Test_Settings extends WP_Hummingbird_Multisite_UnitTestCase {

	function setUp() {
		parent::setUp(); // TODO: Change the autogenerated stub


	}

	function tearDown() {
		parent::tearDown(); // TODO: Change the autogenerated stub
	}

	/**
	 * @group multisite
	 *
	 * Test_Settings constructor.
	 */
	function test_settings_multisite() {
		if ( ! is_multisite() )
			return;

		$args = $this->factory->blog->generate_args();
		$blog_id_1 = $this->factory->blog->create_object( $this->factory->blog->generate_args() );

		$args = $this->factory->blog->generate_args();
		$blog_id_2 = $this->factory->blog->create_object( $this->factory->blog->generate_args() );

		switch_to_blog( $blog_id_1 );
		wphb_activate();

		$settings = wphb_get_settings();
		// Change one blog option
		$settings['max_files_in_group'] = 55;
		// And one network option
		$settings['uptime'] = true;

		wphb_update_settings( $settings );

		$settings = wphb_get_settings();
		$this->assertTrue( $settings['uptime'] );
		$this->assertEquals( $settings['max_files_in_group'], 55 );

		restore_current_blog();

		switch_to_blog( $blog_id_2 );
		wphb_activate();
		$settings = wphb_get_settings();
		$defaults = wphb_get_default_settings();
		$this->assertTrue( $settings['uptime'] );
		$this->assertEquals( $defaults['max_files_in_group'], $settings['max_files_in_group'] );


		restore_current_blog();


		wpmu_delete_blog( $blog_id_1, true );
		wpmu_delete_blog( $blog_id_2, true );
	}


	/**
	 * @group multisite
	 */
	function test_minification_settings_multisite() {
		if ( ! is_multisite() )
			return;

		$args = $this->factory->blog->generate_args();
		$blog_id_1 = $this->factory->blog->create_object( $this->factory->blog->generate_args() );

		$args = $this->factory->blog->generate_args();
		$blog_id_2 = $this->factory->blog->create_object( $this->factory->blog->generate_args() );

		$settings = wphb_get_settings();
		$this->assertFalse( $settings['minify'] );
		$this->assertTrue( $settings['minify-blog'] );

		/** @var WP_Hummingbird_Module_Minify $module */
		$module = wphb_get_module( 'minify' );
		$this->assertFalse( $module->is_active() );

		switch_to_blog( $blog_id_1 );
		$this->assertFalse( $module->is_active() );
		restore_current_blog();

		wphb_toggle_minification( true, true );
		$this->assertTrue( $module->is_active() );

		switch_to_blog( $blog_id_1 );
		$this->assertTrue( $module->is_active() );

		// Deactivate only in this blog
		wphb_toggle_minification( false );
		$this->assertFalse( $module->is_active() );
		restore_current_blog();

		switch_to_blog( $blog_id_2 );
		// This other blog should be activated though
		$this->assertTrue( $module->is_active() );
		restore_current_blog();

		// Now, deactivate for the whole network
		wphb_toggle_minification( false, true );

		switch_to_blog( $blog_id_1 );
		$this->assertFalse( $module->is_active() );
		restore_current_blog();

		switch_to_blog( $blog_id_2 );
		$this->assertFalse( $module->is_active() );
		restore_current_blog();
	}

	function test_settings() {
		$settings = wphb_get_settings();
		// Change one blog option
		$settings['max_files_in_group'] = 55;
		// And one network option
		$settings['uptime'] = true;

		wphb_update_settings( $settings );

		$settings = wphb_get_settings();
		$this->assertTrue( $settings['uptime'] );
		$this->assertEquals( $settings['max_files_in_group'], 55 );
	}
}