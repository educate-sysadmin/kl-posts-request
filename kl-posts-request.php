<?php
/*
Plugin Name: KL Posts Request
Plugin URI: https://github.com/educate-sysadmin/kl-posts-request
Description: Wordpress plugin to allow REQUEST control (GET querystring or POST) of posts/pages shown on archive (multiple post) pages
Version: 0.1
Author: b.cunningham@ucl.ac.uk
Author URI: https://educate.london
License: GPL2
*/

function kl_posts_request( $query ) {	
	
	// only archive/multiple-post pages // ??
	//if ( $query->is_page !== true) { 
	if ( $query->is_archive === true) { 
		
		if (isset($_REQUEST['orderby'])) {
			// validate
			if (in_array($_REQUEST['orderby'],array('title','name','date','rand','menu_order',))) {
				$query->set( 'orderby', $_REQUEST['orderby'] );		
			}	
		}
		
		if (isset($_REQUEST['order'])) {
			// validate
			if (in_array($_REQUEST['order'],array('ASC','DESC'))) {
				$query->set( 'order', $_REQUEST['order'] );		
			}	
		}
		
		
		if (isset($_REQUEST['posts_per_page'])) {
			// validate
			if (is_numeric($_REQUEST['posts_per_page'])) {
				$query->set( 'posts_per_page', $_REQUEST['posts_per_page'] );
			}	
		}
		
	}
}
add_action( 'pre_get_posts', 'kl_posts_request' );
