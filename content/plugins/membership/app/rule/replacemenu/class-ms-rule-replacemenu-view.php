<?php

class MS_Rule_ReplaceMenu_View extends MS_View {

	public function to_html() {
		$membership = MS_Model_Membership::get_base();
		$rule = $membership->get_rule( MS_Rule_ReplaceMenu::RULE_ID );

		// This fixes the list-title generated by MS_Helper_ListTable_Rule.
		unset( $_GET['status'] );

		$listtable = new MS_Rule_ReplaceMenu_ListTable( $rule );
		$listtable->prepare_items();

		$header_data = apply_filters(
			'ms_view_membership_protectedcontent_header',
			array(
				'title' => __( 'Replace Menus', 'membership2' ),
				'desc' => __( 'Replace or protect WordPress menus.', 'membership2' ),
			),
			MS_Rule_ReplaceMenu::RULE_ID,
			$this
		);

		ob_start();
		?>
		<div class="ms-settings">
			<?php
			MS_Helper_Html::settings_tab_header( $header_data );

			$listtable->views();
			$listtable->search_box();
			?>
			<form action="" method="post">
				<?php
				$listtable->display();

				do_action(
					'ms_view_membership_protectedcontent_footer',
					MS_Rule_ReplaceMenu::RULE_ID,
					$this
				);
				?>
			</form>
		</div>
		<?php

		MS_Helper_Html::settings_footer();

		return ob_get_clean();
	}

}