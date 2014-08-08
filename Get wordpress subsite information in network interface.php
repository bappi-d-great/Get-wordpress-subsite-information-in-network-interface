<?php
/*
Plugin Name: Site Info
Plugin URI: http://premium.wpmudev.org/
Description: Will shows information about all subsites
Version: 1.0.1
Author: Ashok (Incsub)
Author URI: http://bappi-d-great.com
License: GNU General Public License (Version 2 - GPLv2)
Network: true
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'SITE_INFO' ) ) {
    
    class SITE_INFO {
        
        public function __construct() {
            add_action( 'network_admin_menu', array( $this, 'site_info_page' ) );
        }
        
        public function site_info_page() {
            add_submenu_page( 'settings.php', 'Site Info', 'Site Info', 'manage_network', 'site-info', array( $this, 'site_info_page_cb' ) );
        }
        
        public function site_info_page_cb() {
            $sites = wp_get_sites();
            ?>
            <div class="wrap">
                <h2>Site Information</h2>
                <table class="wp-list-table widefat fixed sites">
                    <tr>
                        <th>Subsites</th>
                        <th>Path</th>
                        <th>Email</th>
                    </tr>
                    <?php $i = 0; foreach( $sites as $site ) { ?>
                    <?php
                        switch_to_blog( $site['blog_id'] );
                        $i++;
                    ?>
                    <tr <?php echo ( $i % 2 == 1 ) ? 'class="alternate"' : ''; ?>>
                        <td><?php echo get_bloginfo( 'name' ); ?></td>
                        <td><?php echo $site['path']; ?></td>
                        <td><?php echo get_bloginfo( 'admin_email' ); ?></td>
                    </tr>
                    <?php restore_current_blog(); ?>
                    <?php } ?>
                </table>
            </div>
            <?php
        }
        
    }
    
    $site_info = new SITE_INFO();
    
}
