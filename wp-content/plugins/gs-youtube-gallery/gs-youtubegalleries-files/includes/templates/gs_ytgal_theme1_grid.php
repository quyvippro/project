<?php
/*
 * GS Youtube Gallery - Grid
 * @author GS Plugins <hello@gsplugins.com>
 *
 */

$output .= '<div class="container">';
$output .= '<div class="row clearfix gs_youtubegalleries">';
    foreach ( $gsytgal_json['items'] as $gsytgal_item ) {
        if(!empty( $gsytgal_op_palylist_id )) {  // this code for playlist id
            $embedurl=$gsytgal_item['contentDetails']['videoId'];
            $url='https://www.youtube.com/watch?v='.$gsytgal_item['contentDetails']['videoId'].'';
            $i='<img src="http://img.youtube.com/vi/'.$gsytgal_item['contentDetails']['videoId'].'/0.jpg">';
        }
        else{  // this code for channel id //
            $embedurl = $gsytgal_item['id']['videoId'];
            $url='https://www.youtube.com/watch?v='.$gsytgal_item['id']['videoId'].'';
            $i='<img src="http://img.youtube.com/vi/'.$gsytgal_item['id']['videoId'].'/0.jpg">';
        }
        $gs_yt_vid_title    = $gsytgal_item['snippet']['title'];
        $gs_yt_vid_title    = (strlen($gs_yt_vid_title) > 35) ? substr($gs_yt_vid_title,0, $title_limit ).' ...' : $gs_yt_vid_title;
        
        $output .= '<div class="col-md-'.$cols.' col-sm-6 col-xs-12">';
            $output .='<div class="items">';
                $output .='<iframe width="100%" height="'.$video_height.'" src="https://www.youtube.com/embed/'.$embedurl.'" frameborder="0" allowfullscreen></iframe>';
                
                $output .='<p class="gs-ytgal-name">';
                    $output .='<a href="'. $url .'" target"">'. $gs_yt_vid_title .'</a>';
                $output .='</p>';

            $output .='</div>';
        $output .= '</div>'; // end col
    }
$output .= '</div>'; // end row
$output .= '</div>'; // end container

return $output;