<?php
/*
Plugin Name: mb.YTPlayer
Plugin URI: http://pupunzi.com/#mb.components/mb.YTPlayer/YTPlayer.html
Description: Play a Youtube video as background of your page. <strong>Go to settings > mbYTPlayer</strong> to activate the background video option for your homepage. Or use the shortcode following the reference in the settings panel. <strong>And don't forget to make a donation if you like it :-)</strong>
Author: Pupunzi (Matteo Bicocchi)
Version: 0.1
Author URI: http://pupunzi.com
*/

define("MBYTPLAYER_VERSION", "0.1");

register_activation_hook( __FILE__, 'mbYTPlayer_install' );

function mbYTPlayer_install() {
// add and update our default options upon activation
    update_option('mbYTPlayer_version', MBYTPLAYER_VERSION);
    add_option('mbYTPlayer_home_video_url','');
    add_option('mbYTPlayer_show_controls','false');
    add_option('mbYTPlayer_mute','false');
    add_option('mbYTPlayer_ratio','16/9');
    add_option('mbYTPlayer_loop','false');
    add_option('mbYTPlayer_opacity','1');
}
$mbYTPlayer_home_video_url = get_option('mbYTPlayer_home_video_url');
$mbYTPlayer_version = get_option('mbYTPlayer_version');
$mbYTPlayer_show_controls = get_option('mbYTPlayer_show_controls');
$mbYTPlayer_mute = get_option('mbYTPlayer_mute');
$mbYTPlayer_ratio = get_option('mbYTPlayer_ratio');
$mbYTPlayer_loop = get_option('mbYTPlayer_loop');
$mbYTPlayer_opacity = get_option('mbYTPlayer_opacity');

//set up defaults if these fields are empty
if (empty($mbYTPlayer_show_controls)) {$mbYTPlayer_show_controls = "false";}
if (empty($mbYTPlayer_mute)) {$mbYTPlayer_mute = "false";}
if (empty($mbYTPlayer_ratio)) {$mbYTPlayer_ratio = "16/9";}
if (empty($mbYTPlayer_loop)) {$mbYTPlayer_loop = "false";}
if (empty($mbYTPlayer_opacity)) {$mbYTPlayer_opacity = "1";}


//action link http://www.wpmods.com/adding-plugin-action-links

function mbYTPlayer_action_links($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    // check to make sure we are on the correct plugin
    if ($file == $this_plugin) {
        // the anchor tag and href to the URL we want. For a "Settings" link, this needs to be the url of your settings page
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=wp.mb.YTPlayer/mbYTPlayer-admin.php">Settings</a>';
        // add the link to the list
        array_unshift($links, $settings_link);
    }

    return $links;
}

add_filter('plugin_action_links', 'mbYTPlayer_action_links', 10, 2);


add_shortcode('mbYTPlayer', 'mbYTPlayer_player_shortcode');
// define the shortcode function

function mbYTPlayer_player_shortcode($atts) {
    STATIC $i = 1;
    extract(shortcode_atts(array(
        'url'	=> '',
        'showcontrols' => '',
        'mute' => '',
        'ratio' => '',
        'loop' => '',
        'opacity' => ''
    ), $atts));
    // stuff that loads when the shortcode is called goes here

    if (empty($url) || is_home() ) //
        return false;

    if (empty($ratio)) {$ratio = "16/9";}
    if (empty($showcontrols)) {$showcontrols = "true";}
    if (empty($opacity)) {$opacity = "1";}
    if (empty($mute)) {$mute = "false";}
    if (empty($loop)) {$loop = "false";}

    $mbYTPlayer_player_shortcode = '<a id="bgndVideo'.$i.'" href="'.$url.'" class="movie {opacity:'.$opacity.', isBgndMovie:{width:\'window\',mute:'.$mute.'}, optimizeDisplay:true, showControls:'.$showcontrols.', ratio:\''.$ratio.'\', loop: '.$loop.'}"></a>';

    $i++; //increment static variable for unique player IDs
    return $mbYTPlayer_player_shortcode;
}
//ends the mbYTPlayer_player_shortcode function

// scripts to go in the header and/or footer
function mbYTPlayer_init() {
    global $mbYTPlayer_version;
    if ( !is_admin() ) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('metadata', plugins_url( '/js/jquery.metadata.js', __FILE__ ), false, '1.2', false);
        wp_enqueue_script('swfobject', plugins_url( '/js/swfobject.js', __FILE__ ), false, '1.2', false);
        wp_enqueue_script('mb.YTPlayer', plugins_url( '/js/jquery.mb.YTPlayer.js', __FILE__ ), false, $mbYTPlayer_version, false);
        wp_enqueue_style('mbYTPlayer', plugins_url( '/mb.YTPlayer.css', __FILE__ ), false, $mbYTPlayer_version, 'screen');
    }
}

add_action('init', 'mbYTPlayer_init');

function mbYTPlayer_player_head() {
    global $mbYTPlayer_home_video_url,$mbYTPlayer_show_controls,$mbYTPlayer_mute,$mbYTPlayer_ratio,$mbYTPlayer_loop,$mbYTPlayer_opacity;

    echo '
	<!-- mbYTPlayer -->
	<script type="text/javascript">
	jQuery(function(){

	    jQuery.mbYTPlayer.controls.play ="<img src=\''. plugins_url( '/images/', __FILE__ ) . '/play.png\'>";
	    jQuery.mbYTPlayer.controls.pause ="<img src=\''. plugins_url( '/images/', __FILE__ ) . '/pause.png\'>";
	    jQuery.mbYTPlayer.controls.mute ="<img src=\''. plugins_url( '/images/', __FILE__ ) . '/mute.png\'>";
	    jQuery.mbYTPlayer.controls.unmute ="<img src=\''. plugins_url( '/images/', __FILE__ ) . '/unmute.png\'>";
	    jQuery.mbYTPlayer.rasterImg ="'. plugins_url( '/images/', __FILE__ ) . '/raster.png";

	    jQuery(".movie").mb_YTPlayer();
	});

	</script>
	<!-- end mbYTPlayer -->
	';

    if (is_home()){
        if (empty($mbYTPlayer_home_video_url))
            return false;

        $mbYTPlayer_player_homevideo = '<a id=\'bgndVideo_home\' href=\''.$mbYTPlayer_home_video_url.'\' class=\"movieHome {opacity:'.$mbYTPlayer_opacity.', isBgndMovie:{width:\'window\',mute:'.$mbYTPlayer_mute.'}, optimizeDisplay:true, showControls:'.$mbYTPlayer_show_controls.', ratio:\''.$mbYTPlayer_ratio.'\', loop: '.$mbYTPlayer_loop.'}\"></a>';


        echo '
	<!-- mbYTPlayer Home -->
	<script type="text/javascript">
	jQuery(function(){
	    var homevideo = "'.$mbYTPlayer_player_homevideo.'";
	    jQuery("body").prepend(homevideo);
	    jQuery("#bgndVideo_home").mb_YTPlayer();
	});

	</script>
	<!-- end mbYTPlayer Home -->
        ';
    }

}; // ends mbYTPlayer_player_head function
add_action('wp_head', 'mbYTPlayer_player_head');


if ( is_admin() ) {
    require('mbYTPlayer-admin.php');
}

?>