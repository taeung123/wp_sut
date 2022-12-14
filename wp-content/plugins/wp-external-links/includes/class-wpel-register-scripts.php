<?php

/**
 * Class WPEL_Register_Scripts
 *
 * @package  WPEL
 * @category WordPress Plugin
 * @version  2.3
 * @link     https://www.webfactoryltd.com/
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPEL_Register_Scripts extends WPRun_Base_1x0x0
{

    /**
     * Action for "wp_enqueue_scripts"
     */
    protected function action_wp_enqueue_scripts()
    {
        $this->register_scripts();
    }

    /**
     * Action for "admin_enqueue_scripts"
     */
    protected function action_admin_enqueue_scripts()
    {
        $this->register_scripts();
    }

    /**
     * Register styles and scripts
     */
    protected function register_scripts()
    {
        $plugin_version = get_option('wpel-version');

        // set style font awesome icons
        wp_register_style(
            'font-awesome',
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
            array(),
            $plugin_version
        );

        // front style
        wp_register_style(
            'wpel-style',
            plugins_url('/public/css/wpel.css', WPEL_Plugin::get_plugin_file()),
            array(),
            $plugin_version
        );

        // set admin style
        wp_register_style(
            'wpel-admin-style',
            plugins_url('/public/css/wpel-admin.css', WPEL_Plugin::get_plugin_file()),
            array(),
            $plugin_version
        );

        // set admin global style
        wp_register_style(
            'wpel-admin-global-style',
            plugins_url('/public/css/wpel-admin-global.css', WPEL_Plugin::get_plugin_file()),
            array(),
            $plugin_version
        );

        $linkhero = get_option('wpel-linkhero', array('checker' => array(), 'enabled' => false));
        if(!isset($linkhero['enabled'])){
            $linkhero['enabled'] = false;
        }
        $wpel_js = array(
            'nonce_ajax' => wp_create_nonce('wpel_run_tool'),
            'loader' => admin_url('/images/spinner.gif'),
            'link_checking_enabled' => false
        );

        $wpel_js['lh_url'] = WPEL_LinkHero::$lh_url;

        if(!WPEL_LinkHero::is_localhost()){
            $wpel_js['link_checking_enabled'] = $linkhero['enabled'];
        }

        // set wpel admin script
        wp_register_script(
            'wpel-admin-script',
            plugins_url('/public/js/wpel-admin.js', WPEL_Plugin::get_plugin_file()),
            array('jquery'),
            $plugin_version,
            true
        );

        wp_localize_script('wpel-admin-script', 'wpel', $wpel_js);
    }
}

/*?>*/
