<?php
/*
Plugin Name: THATCamp Scheduler
Plugin URI: http://thatcamp.org
Description: Manages session schedules.
Version: 1.0-alpha
Author: Center for History and New Media
Author URI: http://chnm.gmu.edu
*/

/*
Copyright (C) 2010 Center for History and New Media, George Mason University

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( !class_exists('Thatcamp_Scheduler_Loader') ):

class Thatcamp_Scheduler_Loader {
    
	function thatcamp_scheduler_loader() {
	    add_action( 'init', array ( $this, 'init' ) );
	    add_action( 'plugins_loaded', array ( $this, 'loaded'));
	    
	    // Include the necessary files
		add_action( 'thatcamp_scheduler_loaded', array ( $this, 'includes' ) );
		
		// Attach textdomain for localization
		add_action( 'thatcamp_scheduler_init', array ( $this, 'textdomain' ) );
	}
	
	function init() {
	    do_action( 'thatcamp_scheduler_init' );
	}
	
	function loaded() {
	    do_action( 'thatcamp_scheduler_loaded' );
	}
	
	function includes() {
		if ( is_admin() ) {
			require( dirname( __FILE__ ) . '/includes/class-admin-main.php' );
        }
	}
	
	// Allow this plugin to be translated by specifying text domain
	// Todo: Make the logic a bit more complex to allow for custom text within a given language
	function textdomain() {
		$locale = get_locale();

		// First look in wp-content/thatcamp-scheduler-files/languages, where custom language files will not be overwritten by Anthologize upgrades. Then check the packaged language file directory.
		$mofile_custom = WP_CONTENT_DIR . "/thatcamp-scheduler-files/languages/thatcamp-scheduler-$locale.mo";
		$mofile_packaged = WP_PLUGIN_DIR . "/thatcamp-scheduler/languages/thatcamp-scheduler-$locale.mo";

    	if ( file_exists( $mofile_custom ) ) {
      		load_textdomain( 'thatcamp-scheduler', $mofile_custom );
      		return;
      	} else if ( file_exists( $mofile_packaged ) ) {
      		load_textdomain( 'thatcamp-scheduler', $mofile_packaged );
      		return;
      	}
	}
}

endif; // class exists

$thatcamp_scheduler_loader = new Thatcamp_Scheduler_Loader();