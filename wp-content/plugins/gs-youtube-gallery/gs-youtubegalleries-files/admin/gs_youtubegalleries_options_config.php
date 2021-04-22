<?php
/**
 * This page shows the procedural or functional example
 * OOP way example is given on the main plugin file.
 * @author GS Plugins <hello@gsplugins.com>
 */

/**
 * WordPress settings API demo class
 * @author GS Plugins
 */

if ( !class_exists('gs_Youtubegalleries_Settings_Config' ) ):
class gs_Youtubegalleries_Settings_Config {
    private $settings_api;
    function __construct() {
        $this->settings_api = new GS_Youtubegalleries_WeDevs_Settings_API;
        add_action( 'admin_init', array($this, 'admin_init') ); //display options
        add_action( 'admin_menu', array($this, 'admin_menu') ); //display the page of options.
    }

    function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_submenu_page( 'gsp-main', 'YouTube Gallery Settings', 'GS YouTube Gallery', 'delete_posts', 'youtube-gallery-settings', array($this, 'plugin_page')); 
    }
    function get_settings_sections() {
        $sections = array(
            array(
                'id'     => 'gs_youtubegalleries_settings',
                'title' => __( 'GS Youtube Gallery Settings', 'gsyoutubegalleries' )
            ),
            array(
                'id'    => 'gs_youtubegalleries_style_settings',
                'title' => __( 'Style Settings', 'gsyoutubegalleries' )
            )
        );
        return $sections;
    }

    //start all options of "GS Youtube settings" and "Style Settings" under nav
    /*
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            // Start of Youtube settings nav,
            'gs_youtubegalleries_settings' => array(
                // api id
                array(
                    'name'      => 'gs_youtube_apikey_id',
                    'label'     => __( 'Your Youtube API KEY', 'gsyoutubegalleries' ),
                    'desc'      => __( 'Enter Your Youtube API KEY', 'gsyoutubegalleries' ),
                    'type'      => 'text',
                    'default'   => ''
                ),

                // channel id
                array(
                    'name'      => 'gs_youtube_channel_id',
                    'label'     => __( 'Channel ID', 'gsyoutubegalleries' ),
                    'desc'      => __( 'Enter Youtube channel ID', 'gsyoutubegalleries' ),
                    'type'      => 'text',
                    'default'   => ''
                ),
                  // Playlist id
                array(
                    'name'      => 'gs_youtube_playlist_id',
                    'label'     => __( 'Playlist ID', 'gsyoutubegalleries' ),
                    'desc'      => __( 'Enter Youtube playlist ID', 'gsyoutubegalleries' ),
                    'type'      => 'text',
                    'default'   => ''
                ),

                // Number of shots to display
                array(
                    'name'  => 'gs_youtube_count',
                    'label' => __( 'Total Videos', 'gsyoutubegalleries' ),
                    'desc'  => __( 'Set 1-50 number of videos to display ', 'gsyoutubegalleries' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 50, // youtube referance value.
                    'default' => 6
                ),
                //dsplay channel profile section 
                // array(
                //     'name'      => 'gs_youtube_channel_profile',
                //     'label'     => __( 'Channel Profile', 'gsyoutubegalleries' ),
                //     'desc'      => __( 'Show or Hide Channel Profile', 'gsyoutubegalleries' ),
                //     'type'      => 'select',
                //     'default'   => 'yes',
                //     'options'   => array(
                //         'yes'       => 'Yes',
                //         'no'        => 'No'
                //     )
                // ),
                // order
                array(
                    'name'      => 'gs_youtube_orderby',
                    'label'     => __( 'OrderBy', 'gsyoutubegalleries' ),
                    'desc'      => __( 'Select Videos orderby, Default : Date', 'gsyoutubegalleries' ),
                    'type'      => 'select',
                    'default'   => 'date',
                    'options'   => array(
                        'date'          => 'Date',
                        'rating'        => 'Rating',
                        'title'         => 'Title',
                        'videoCount'    => 'VideoCount',
                        'viewCount'     => 'ViewCount'
                    )
                ),
                // Front page display Columns
                array(
                    'name'      => 'gs_youtubegalleries_cols',
                    'label'     => __( 'Page Columns', 'gsyoutubegalleries' ),
                    'desc'      => __( 'Select number of Youtube Showcase columns', 'gsyoutubegalleries' ),
                    'type'      => 'select',
                    'default'   => '4',
                    'options'   => array(
                        '6'    => '2 Columns',
                        '4'      => '3 Columns',
                        '3'      => '4 Columns'
                    )
                ),
                // properties theme
                array(
                    'name'  => 'gs_youtubegalleries_theme',
                    'label' => __( 'Style & Theming', 'gsyoutubegalleries' ),
                    'desc'  => __( 'Select preferred Style & Theme', 'gsyoutubegalleries' ),
                    'type'  => 'select',
                    'default'   => 'gs_ytgal_grid',
                    'options'   => array(
                        'gs_ytgal_grid'         => 'Grid',
                        'gs_ytgal_grid_details' => 'Grid Details (Pro)',
                        'gs_ytgal_hoverpop'     => 'Hover & Pop (Pro)',
                        'gs_ytgal_right_info'   => 'Right Info (Pro)',
                        'gs_ytgal_left_info'    => 'Left Info (Pro)',
                        'gs_ytgal_popup'        => 'Popup (Pro)',
                        'gs_ytgal_slider_popup' => 'Slider & Popup (Pro)',
                        'gs_ytgal_slider'       => 'Slider View (Pro)'
                    )
                ),

                // Youtube Detail Description character control
                array(
                    'name'  => 'gs_youtubegallery_youtube_height',
                    'label' => __( 'Youtube Video Height', 'gsyoutubegalleries' ),
                    'desc'  => __( 'Define Youtube video height.', 'gsyoutubegalleries' ),
                    'type'  => 'number',
                    'min'   => 50,
                    'max'   => 1000,
                    'default' => 350
                ),
                // Title character control
                array(
                    'name'  => 'gs_yt_title_contl',
                    'label' => __( 'Title Character Control', 'gsyoutubegalleries' ),
                    'desc'  => __( 'Set maximum number of characters in Youtube Video Title. Default 40', 'gsyoutubegalleries' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 300,
                    'default' => 40
                ),
                // Title character control
                array(
                    'name'  => 'gs_yt_desc_contl',
                    'label' => __( 'Desc Character Control', 'gsyoutubegalleries' ),
                    'desc'  => __( 'Set max no of characters in YT Video Description. Default 120. Max 150', 'gsyoutubegalleries' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 150,
                    'default' => 120
                ),
                // array(
                //     'name'      => 'gs_ytv_link_tar',
                //     'label'     => __( 'Book Link Target', 'gsyoutubegalleries' ),
                //     'desc'      => __( 'Specify target to load the Video Links, Default New Tab ', 'gsyoutubegalleries' ),
                //     'type'      => 'select',
                //     'default'   => '_blank',
                //     'options'   => array(
                //         '_blank'    => 'New Tab',
                //         '_self'     => 'Same Window'
                //     )
                // )
            ), // end of Youtube Settings nav, 'gs_properties_option_01_settings'


            // start of Style Settings nav array, 'gs_properties_style_settings'
            'gs_youtubegalleries_style_settings' => array(
                array(
                    'name'      => 'gs_yt_setting_banner',
                    'label'     => __( '', 'gsyoutubegalleries' ),
                    'desc'      => __( '<p class="gs_yt_pro">Available at <a href="https://www.gsplugins.com/product/wordpress-youtube-video-gallery-plugin" target="_blank">PRO</a> version.</p>', 'gsyoutubegalleries' ),
                    'row_classes' => 'gs_yt_banner'
                ),
                // Font Size
                array(
                    'name'      => 'gs_youtubegallery_fz',
                    'label'     => __( 'Font Size', 'gsyoutubegalleries' ),
                    'desc'      => __( 'Set Font Size for <b>Youtube Name</b>', 'gsyoutubegalleries' ),
                    'type'      => 'number',
                    'default'   => '13',
                    'options'   => array(
                        'min'   => 1,
                        'max'   => 30,
                        'default' => 13
                    )
                ),

                // Font weight
                array(
                    'name'      => 'gs_youtubegallery_fntw',
                    'label'     => __( 'Font Weight', 'gsyoutubegalleries' ),
                    'desc'      => __( 'Select Font Weight for <b>Youtube Name</b>', 'gsyoutubegalleries' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'bold'      => 'Bold',
                        'lighter'   => 'Lighter'
                    )
                ),

                // Font style
                array(
                    'name'      => 'gs_youtubegallery_fnstyl',
                    'label'     => __( 'Font Style', 'gsyoutubegalleries' ),
                    'desc'      => __( 'Select Font Weight for <b>Youtube Name</b>', 'gsyoutubegalleries' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'italic'      => 'Italic'
                    )
                ),

                // Font Color of Youtube Name
                array(
                    'name'    => 'gs_youtubegallery_name_color',
                    'label'   => __( 'Font Color', 'gsyoutubegalleries' ),
                    'desc'    => __( 'Select color for <b>Youtube Name</b>.', 'gsyoutubegalleries' ),
                    'type'    => 'color',
                    'default' => '#141412'
                ),

                // Properties Custom CSS
                array(
                    'name'    => 'gs_youtubegallery_custom_css',
                    'label'   => __( 'Your Custom CSS', 'gsyoutubegalleries' ),
                    'desc'    => __( 'You can write your own custom css', 'gsyoutubegalleries' ),
                    'type'    => 'textarea'
                )

            ) // end of Style Settings nav array, 'gs_properties_style_settings' => array()
        ); //end of $settings_fields = array()
        return $settings_fields;
    } // end of function get_settings_fields()

    function plugin_page() {
        // settings_errors();
        echo '<div class="wrap gs_ytgallery_wrap" style="width: 845px; float: left;">';
        // echo '<div id="post-body-content">';
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        echo '</div>';

        ?>
            <div class="gswps-admin-sidebar" style="width: 277px; float: left; margin-top: 62px;">
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Support / Report a bug' ) ?></span></h3>
                    <div class="inside centered">
                        <p>Please feel free to let us know if you have any bugs to report. Your report / suggestion can make the plugin awesome!</p>
                        <p style="margin-bottom: 1px! important;"><a href="https://www.gsplugins.com/support" target="_blank" class="button button-primary">Get Support</a></p>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Buy me a coffee' ) ?></span></h3>
                    <div class="inside centered">
                        <p>If you like the plugin, please buy me a coffee to inspire me to develop further.</p>
                        <p style="margin-bottom: 1px! important;"><a href='https://www.2checkout.com/checkout/purchase?sid=202460873&quantity=1&product_id=8' class="button button-primary" target="_blank">Donate</a></p>
                    </div>
                </div>

                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Join GS Plugins on facebook' ) ?></span></h3>
                    <div class="inside centered">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/gsplugins&amp;width&amp;height=258&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=723137171103956" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:220px;" allowTransparency="true"></iframe>
                    </div>
                </div>

                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Follow GS Plugins on twitter' ) ?></span></h3>
                    <div class="inside centered">
                        <a href="https://twitter.com/gsplugins" target="_blank" class="button button-secondary">Follow @gsplugins<span class="dashicons dashicons-twitter" style="position: relative; top: 3px; margin-left: 3px; color: #0fb9da;"></span></a>
                    </div>
                </div>
            </div>
        <?php
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }
}
endif;

$settings = new gs_Youtubegalleries_Settings_Config();
