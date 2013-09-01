<?php
/*
	Section: DMS Breadcrumb NavXT
	Author: Simple Mama
	Author URI: http://www.simplemama.com
	Description: Display post and page breadcrumbs for reader and SEO benefit. This section requires that the Breadcrumb NavXT Wordpress plugin be installed and creates a seamless integration with PageLines DMS.
	Class Name: BreadcrumbNavXT
	Demo:
	Version: 1.0
	Filter: nav
	v3: true
*/

class BreadcrumbNavXT extends PageLinesSection {

	const version = '1.0';

/* STUFF THAT LOADS ONLY IN THE SECTION HEADER */

	function section_head() {		
	}

/* THE FRONT END */

	function section_template() {
		if(function_exists('bcn_display'))
			printf( '<div class="dms-breadcrumb-navxt">%s</div>', $this->get_breadcrumb() );
	}
/* MAKE IT DISPLAY */
	
	function get_breadcrumb() {
		ob_start();
		if($this->opt('breadcrumb_no_link', $this->oset)) {
			//Make new breadcrumb object
			$breadcrumb_trail    = new bcn_breadcrumb_trail;
			$breadcrumb_trail->fill();
			bcn_display(false,false);
		}else{
			bcn_display();
		}
	return ob_get_clean();
	}

/** WELCOME MESSAGE **/

	function welcome(){

		ob_start();

		?><div style="font-size:14px;"><?php _e('<strong>Important!</strong> Make sure you have installed and activated the Breadcrumb NavXT plugin otherwise my section will do nothing. You can <a href="http://wordpress.org/plugins/breadcrumb-navxt/" target="_blank" title="Breadcrumb NavXT">download it here from Wordpress.org</a>.<br /><br />Thanks for downloading DMS Breadcrumb NavXT! This section is free for you but still took me time to create. If you feel like saying thank you, please consider buying me a cup of coffee by making a donation at <a href="http://www.simplemama.com" target="_blank" title="Simple Mama">simplemama.com</a>. Enjoy your day!','dms-breadcrumb-navxt');?></div><?php

		return ob_get_clean();
	}

/* THE ADMIN OPTIONS */

	function section_opts(){

/* WELCOME BOX */

		$options[]    = array(
			'key'        => 'breadcrumb_welcome',
			'type'       => 'template',
			'title'      => __('Welcome to DMS Breadcrumb NavXT!','dms-breadcrumb-navxt'),
			'template'   => $this->welcome()
		);

/* ICON OPTIONS */

		$options[]    = array(
			'key'        => 'breadcrumb_no_link',
			'default'    => false,
			'type'       => 'check',
			'title'      => 'Breadcrumb Links',
			'label'      => 'Disable breadcrumb links?',
			'help'       => 'Breadcrumb NavXT automatically links each breadcrumb. Checking this box will disable those links. Link titles will still be shown but will not be clickable.',
		);
		
		return $options;
	}

}//end class and file