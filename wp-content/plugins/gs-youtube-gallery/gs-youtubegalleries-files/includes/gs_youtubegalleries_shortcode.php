<?php
// -- Getting values from setting panel
function gs_youtubegalleries_getoption( $option, $section, $default = '' ) {
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

add_shortcode('gs_ytgal','gs_ytgal_shortcode');
function gs_ytgal_shortcode( $atts ) {
    $gsytgal_op_youtubegalleries_cols        = gs_youtubegalleries_getoption('gs_youtubegalleries_cols', 'gs_youtubegalleries_settings', 3);
    $gsytgal_op_youtubegalleries_theme       = gs_youtubegalleries_getoption('gs_youtubegalleries_theme', 'gs_youtubegalleries_settings', 'gs_ytgal_popup');
    $gsytgal_op_channel_profile              = gs_youtubegalleries_getoption('gs_youtube_channel_profile', 'gs_youtubegalleries_settings', ' ');
    $gsytgal_op_video_height                 = gs_youtubegalleries_getoption('gs_youtubegallery_youtube_height', 'gs_youtubegalleries_settings', 350);
    $gs_yt_title_contl                       = gs_youtubegalleries_getoption('gs_yt_title_contl', 'gs_youtubegalleries_settings', 40);
    $gs_yt_desc_contl                        = gs_youtubegalleries_getoption('gs_yt_desc_contl', 'gs_youtubegalleries_settings', 120);
    $gsytgal_op_orderby                      = gs_youtubegalleries_getoption('gs_youtube_orderby', 'gs_youtubegalleries_settings', 'date');
    $gsytgal_op_apikey_id                    = gs_youtubegalleries_getoption('gs_youtube_apikey_id', 'gs_youtubegalleries_settings', '');
    $gsytgal_op_channel_id                   = gs_youtubegalleries_getoption('gs_youtube_channel_id', 'gs_youtubegalleries_settings', '');
    $gsytgal_op_palylist_id                  = gs_youtubegalleries_getoption('gs_youtube_playlist_id', 'gs_youtubegalleries_settings', '');
    $gsytgal_op_count                        = gs_youtubegalleries_getoption('gs_youtube_count', 'gs_youtubegalleries_settings', 6);

   extract(shortcode_atts(
        array(
        'api_key'       => $gsytgal_op_apikey_id,
        'channel_id'    => $gsytgal_op_channel_id,
        'playlist_id'   => $gsytgal_op_palylist_id,
        'count'         => $gsytgal_op_count,
        'orderby'       => $gsytgal_op_orderby,
        'theme'         => $gsytgal_op_youtubegalleries_theme,
        'cols'          => $gsytgal_op_youtubegalleries_cols,
        'video_height'  => $gsytgal_op_video_height,
        'title_limit'   => $gs_yt_title_contl,
        'desc_limit'    => $gs_yt_desc_contl
        ), $atts
    ));

if(empty($gsytgal_op_apikey_id)){
    return '<h1>Please Insert - "API Key" in Settings Options.<h1>';
}
elseif (empty($gsytgal_op_channel_id) && empty($gsytgal_op_palylist_id)){
    return '<h1>Please Insert - "Channel ID or Playlist ID" in Settings Options.<h1>';
}
else{
    if(!empty($gsytgal_op_channel_id)){
        $gsytv_url = 'https://www.googleapis.com/youtube/v3/search';
        $gsytv_url .= '?part=snippet';
        $gsytv_url .= '&channelId='.$channel_id.'';
        $gsytv_url .= '&maxResults='.$count.'';
        $gsytv_url .= '&order='.$orderby.'';  // orderby work only in channel id
        $gsytv_url .= '&type=video';
        $gsytv_url .= '&key='.$api_key.'';
    }
    if(!empty($gsytgal_op_palylist_id)){
        $gsytv_url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,contentDetails&maxResults=".$count."&playlistId=".$playlist_id."&key=".$api_key."";
    }
}

    $gsytv_response = wp_remote_get( $gsytv_url, array( 'sslverify' => false ) );
    $gsytv_xml      = wp_remote_retrieve_body( $gsytv_response );
    $gsytgal_json   = json_decode( $gsytv_xml ,true );

        $output = '';
        $output = '<div class="wrap gs_ytgallery_area '.$theme.'">';

            if ( $theme == 'gs_ytgal_grid') {
                include GSYOUTUBEGALLERIES_FILES_DIR . '/includes/templates/gs_ytgal_theme1_grid.php';
            } else {
                $output = '<h4 style="text-align: center;">Select correct Theme or Upgrade to <a href="https://www.gsplugins.com/product/wordpress-youtube-video-gallery-plugin" target="_blank">Pro version</a><br>For more Options <a href="http://youtubegallery.gsplugins.com" target="_blank">Check available demos</a></h4>';
            }
       
        $output .= '</div>'; // end wrap
             
    return $output;
}

// -- CSS values
if ( !function_exists( 'gs_youtubegalleries_setting_styles' )) {
    function gs_youtubegalleries_setting_styles() {
        //this variable hold user input data/settings from style settings
        $gsytgal_fz          = gs_youtubegalleries_getoption('gs_youtubegallery_fz', 'gs_youtubegalleries_style_settings', 18);
        $gsytgal_fntw        = gs_youtubegalleries_getoption('gs_youtubegallery_fntw', 'gs_youtubegalleries_style_settings', 'normal');
        $gsytgal_fnstyl      = gs_youtubegalleries_getoption('gs_youtubegallery_fnstyl', 'gs_youtubegalleries_style_settings', 'normal');
        $gsytgal_name_color  = gs_youtubegalleries_getoption('gs_youtubegallery_name_color', 'gs_youtubegalleries_style_settings', '#141412');

    ?>
    <style>
        .items .gs-ytgal-name,
        .items .gs-ytgal-name a,
        .item-details .gs-ytgal-name,
        .widget-gsyt-videos .gs-ytgal-name {
            font-size: <?php echo $gsytgal_fz;?>px;
            font-weight: <?php echo $gsytgal_fntw; ?>;
            font-style: <?php echo $gsytgal_fnstyl; ?>;
            color: <?php echo $gsytgal_name_color; ?>;
            text-transform: capitalize;
        }

    </style>
    <?php
    }
}
add_action('wp_head', 'gs_youtubegalleries_setting_styles' );