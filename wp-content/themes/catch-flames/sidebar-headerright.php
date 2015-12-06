<?php
/**
 * The Sidebar containing the Header Right Widget Area
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
?>

<div id="sidebar-header-right" class="widget-area sidebar-top clearfix">
	<aside class="widget widget_search">	
          <?php echo get_search_form(); ?>
        </aside>

	<aside class="widget widget_catchflames_social_widget">
    	  <?php catchflames_social_networks(); ?>
          <?php if ( function_exists( 'mltlngg_display_switcher' ) ) mltlngg_display_switcher(); ?>
        </aside>
</div><!-- #sidebar-header-right -->
	
