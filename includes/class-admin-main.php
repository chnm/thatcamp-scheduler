<?php

if ( !class_exists( 'Thatcamp_Scheduler_Admin_Main' ) ) :

class Thatcamp_Scheduler_Admin_Main {

    function thatcamp_scheduler_admin_main () {
        add_action( 'admin_init', array ( $this, 'init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }
    
    function init() {
        do_action( 'thatcamp_scheduler_admin_init' );
    }
    
    function admin_menu() {
        if (function_exists('add_menu_page')) {
            add_menu_page(__('THATCamp Scheduler'), __('TC Scheduler'), 'manage-options', dirname(__FILE__) . '/class-admin-main.php', array( $this, 'display'));
        }
    }

    function display() {
    
    ?>
    
    <div class="wrap">
        
        <h2><?php echo _e('THATCamp Scheduler'); ?></h2>        
    
    </div>
    
    <?php
    }

}

endif;

$thatcamp_scheduler_admin_main = new Thatcamp_Scheduler_Admin_Main();