<?php $settings = apex_section_settings(); ?>

<div <?php echo apex_sidebar_class('secondary widget-area'); ?> role="complementary">

	<?php dynamic_sidebar( $settings['widget_area'] ); ?>

</div>