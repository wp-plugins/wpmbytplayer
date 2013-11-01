<?php
/*
Plugin Name: mb.YTPlayer background video
Plugin URI: http://pupunzi.com/#mb.components/mb.YTPlayer/YTPlayer.html
Description: Play a Youtube video as background of your page. <strong>Go to settings > mbYTPlayer</strong> to activate the background video option for your homepage. Or use the short code following the reference in the settings panel.
Author: Pupunzi (Matteo Bicocchi)
Version: 1.6.5
Author URI: http://pupunzi.com
*/

define("MBYTPLAYER_VERSION", "1.6.5");



function isMobile()
{
// Check the server headers to see if they're mobile friendly
    if (isset($_SERVER["HTTP_X_WAP_PROFILE"])) {
        return true;
    }
// If the http_accept header supports wap then it's a mobile too
    if (preg_match("/wap.|.wap/i", $_SERVER["HTTP_ACCEPT"])) {
        return true;
    }
    if (preg_match("/iphone|ipad/i", $_SERVER["HTTP_USER_AGENT"])) {
        return true;
    }
// None of the above? Then it's probably not a mobile device.
    return false;
}


register_activation_hook(__FILE__, 'mbYTPlayer_install');

function mbYTPlayer_install()
{
// add and update our default options upon activation
    update_option('mbYTPlayer_version', MBYTPLAYER_VERSION);
    add_option('mbYTPlayer_donate', 'false');
    add_option('mbYTPlayer_home_video_url', '');
    add_option('mbYTPlayer_show_controls', 'false');
    add_option('mbYTPlayer_show_videourl', 'false');
    add_option('mbYTPlayer_mute', 'false');
    add_option('mbYTPlayer_start_at', 'false');
    add_option('mbYTPlayer_ratio', '16/9');
    add_option('mbYTPlayer_loop', 'false');
    add_option('mbYTPlayer_opacity', '1');
    add_option('mbYTPlayer_quality', 'default');
    add_option('mbYTPlayer_stop_onclick', 'false');
    add_option('mbYTPlayer_realfullscreen', 'true');
}

$mbYTPlayer_donate = get_option('mbYTPlayer_donate');
$mbYTPlayer_home_video_url = get_option('mbYTPlayer_home_video_url');
$mbYTPlayer_version = get_option('mbYTPlayer_version');
$mbYTPlayer_show_controls = get_option('mbYTPlayer_show_controls');
$mbYTPlayer_show_videourl = get_option('mbYTPlayer_show_videourl');
$mbYTPlayer_ratio = get_option('mbYTPlayer_ratio');
$mbYTPlayer_mute = get_option('mbYTPlayer_mute');
$mbYTPlayer_start_at = get_option('mbYTPlayer_start_at');
$mbYTPlayer_loop = get_option('mbYTPlayer_loop');
$mbYTPlayer_opacity = get_option('mbYTPlayer_opacity');
$mbYTPlayer_quality = get_option('mbYTPlayer_quality');
$mbYTPlayer_add_raster = get_option('mbYTPlayer_add_raster');
$mbYTPlayer_realfullscreen = get_option('mbYTPlayer_realfullscreen');

$mbYTPlayer_stop_onclick = get_option('mbYTPlayer_stop_onclick');

//set up defaults if these fields are empty
if ($mbYTPlayer_version != MBYTPLAYER_VERSION) {
    $mbYTPlayer_version = MBYTPLAYER_VERSION;
}
if (empty($mbYTPlayer_donate)) {
    $mbYTPlayer_donate = "false";
}
if (empty($mbYTPlayer_show_controls)) {
    $mbYTPlayer_show_controls = "false";
}
if (empty($mbYTPlayer_show_videourl)) {
    $mbYTPlayer_show_videourl = "false";
}
if (empty($mbYTPlayer_ratio)) {
    $mbYTPlayer_ratio = "auto";
}
if (empty($mbYTPlayer_mute)) {
    $mbYTPlayer_mute = "false";
}
if (empty($mbYTPlayer_start_at)) {
    $mbYTPlayer_start_at = 0;
}
if (empty($mbYTPlayer_loop)) {
    $mbYTPlayer_loop = "false";
}
if (empty($mbYTPlayer_opacity)) {
    $mbYTPlayer_opacity = "1";
}
if (empty($mbYTPlayer_quality)) {
    $mbYTPlayer_quality = "default";
}
if (empty($mbYTPlayer_add_raster)) {
    $mbYTPlayer_add_raster = "false";
}

if (empty($mbYTPlayer_stop_onclick)) {
    $mbYTPlayer_stop_onclick = "false";
}

if (empty($mbYTPlayer_realfullscreen)) {
    $mbYTPlayer_realfullscreen = "true";
}


//action link http://www.wpmods.com/adding-plugin-action-links

function mbYTPlayer_action_links($links, $file)
{
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    // check to make sure we are on the correct plugin
    if ($file == $this_plugin) {
        // the anchor tag and href to the URL we want. For a "Settings" link, this needs to be the url of your settings page
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=wpmbytplayer/mbYTPlayer-admin.php">Settings</a>';
        // add the link to the list
        array_unshift($links, $settings_link);
    }

    return $links;
}

add_filter('plugin_action_links', 'mbYTPlayer_action_links', 10, 2);

// define the shortcode function

add_shortcode('mbYTPlayer', 'mbYTPlayer_player_shortcode');
add_filter('widget_text', 'do_shortcode');

function mbYTPlayer_player_shortcode($atts)
{
    STATIC $i = 1;
    $elId = "body";
    $style = "";
    extract(shortcode_atts(array(
        'url' => '',
        'showcontrols' => '',
        'printurl' => '',
        'mute' => '',
        'ratio' => '',
        'loop' => '',
        'opacity' => '',
        'quality' => '',
        'addraster' => '',
        'isinline' => '',
        'playerwidth' => '',
        'playerheight' => '',
        'autoplay' => '',
        'realfullscreen' => '',
        'startat' => ''
    ), $atts));
    // stuff that loads when the shortcode is called goes here

    if (empty($url) || ((is_home() || is_front_page()) && !empty($mbYTPlayer_home_video_url) && empty($isInline))) // || (empty($id) && (is_home() || is_front_page()))
    return false;

    if (empty($startat)) {
        $startat = 0;
    }
    if (empty($isinline)) {
        $isinline = "false";
    }
    if (empty($ratio)) {
        $ratio = "auto";
    }
    if (empty($showcontrols)) {
        $showcontrols = "true";
    }
    if (empty($printurl)) {
        $printurl = "true";
    }
    if (empty($opacity)) {
        $opacity = "1";
    }
    if (empty($mute)) {
        $mute = "false";
    }
    if (empty($loop)) {
        $loop = "false";
    }
    if (empty($quality)) {
        $quality = "default";
    }
    if (empty($addraster)) {
        $addraster = "false";
    };
    if (empty($realfullscreen)) {
        $realfullscreen = "true";
    };

    if ($isinline == "true") {
        if (empty($playerwidth)) {
            $playerwidth = "300";
        };
        if (empty($playerheight)) {
            $playerheight = "220";
        };
        if (empty($autoplay)) {
            $autoplay = "false";
        };

        $startat = $startat > 0 ? $startat : 1;
        $elId = "self";
        $style = " style=\"width:" . $playerwidth . "px; height:" . $playerheight . "px; position:relative\"";
    } else {
        $autoplay = "true";
    };

    $mbYTPlayer_player_shortcode = '<div id="bgndVideo' . $i . '" ' . $style . ' class="movie' . ($isinline ? " inline_YTPlayer" : "") . '" data-property="{videoURL:\'' . $url . '\', opacity:' . $opacity . ', autoPlay:' . $autoplay . ', containment:\'' . $elId . '\', startAt:' . $startat . ', mute:' . $mute . ', optimizeDisplay:true, showControls:' . $showcontrols . ', printUrl:' . $printurl . ', loop:' . $loop . ', addRaster:' . $addraster . ', quality:\'' . $quality . '\', realfullscreen:\'' . $realfullscreen . '\', ratio:\'' . $ratio . '\'}"></div>';

    $i++; //increment static variable for unique player IDs
    return $mbYTPlayer_player_shortcode;
}

//ends the mbYTPlayer_player_shortcode function

// scripts to go in the header and/or footer
function mbYTPlayer_init()
{
    global $mbYTPlayer_version;

    if (isset($_COOKIE['ytpdonate']) && $_COOKIE['ytpdonate'] !== "false") {
        update_option('mbYTPlayer_donate', "true");
        echo '
            <script type="text/javascript">
                expires = "; expires= -10000";
                document.cookie = "ytpdonate=false" + expires + "; path=/";
            </script>
        ';

    }

    if (!is_admin() && !isMobile()) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('mb.YTPlayer', plugins_url('/js/jquery.mb.YTPlayer.js', __FILE__), false, $mbYTPlayer_version, false);
        wp_enqueue_style('mbYTPlayer', plugins_url('/css/mb.YTPlayer.css', __FILE__), false, $mbYTPlayer_version, 'screen');
    }
}

add_action('init', 'mbYTPlayer_init');

function mbYTPlayer_player_head()
{
    global $mbYTPlayer_home_video_url, $mbYTPlayer_show_controls, $mbYTPlayer_ratio, $mbYTPlayer_show_videourl, $mbYTPlayer_start_at, $mbYTPlayer_mute, $mbYTPlayer_loop, $mbYTPlayer_opacity, $mbYTPlayer_quality, $mbYTPlayer_add_raster, $mbYTPlayer_realfullscreen, $mbYTPlayer_stop_onclick;

    if (isMobile())
        return false;

    if ($mbYTPlayer_stop_onclick == "true")
        $mbYTPlayer_stop_onclick = "true";
    else
        $mbYTPlayer_stop_onclick = "false";

    echo '
	<!-- mbYTPlayer -->
	<script type="text/javascript">
	var ytp = {};
	jQuery(function(){
	    jQuery.mbYTPlayer.rasterImg ="' . plugins_url('/images/', __FILE__) . 'raster.png";
	    jQuery.mbYTPlayer.rasterImgRetina ="' . plugins_url('/images/', __FILE__) . 'raster@2x.png";

	    jQuery(".movie").mb_YTPlayer();
	});

	</script>
	<!-- end mbYTPlayer -->
	';

    if ((is_home() || is_front_page()) && !isMobile()) {

        if (empty($mbYTPlayer_home_video_url))
            return false;

        $mbYTPlayer_start_at = $mbYTPlayer_start_at > 0 ? $mbYTPlayer_start_at : 1;

        $mbYTPlayer_player_homevideo = '<div id=\"bgndVideo_home\" data-property=\"{videoURL:\'' . $mbYTPlayer_home_video_url . '\', opacity:' . $mbYTPlayer_opacity . ', autoPlay:true, containment:\'body\', startAt:' . $mbYTPlayer_start_at . ', mute:' . $mbYTPlayer_mute . ', optimizeDisplay:true, showControls:' . $mbYTPlayer_show_controls . ', printUrl:' . $mbYTPlayer_show_videourl . ', loop:' . $mbYTPlayer_loop . ', addRaster:' . $mbYTPlayer_add_raster . ', quality:\'' . $mbYTPlayer_quality . '\', ratio:\'' . $mbYTPlayer_ratio . '\', realfullscreen:\'' . $mbYTPlayer_realfullscreen . '\', stopMovieOnClick:\'' . $mbYTPlayer_stop_onclick . '\'}\"></div>';

        echo '
	<!-- mbYTPlayer Home -->
	<script type="text/javascript">
	jQuery(function(){
	    var homevideo = "' . $mbYTPlayer_player_homevideo . '";
	    jQuery("body").prepend(homevideo);
	    jQuery("#bgndVideo_home").mb_YTPlayer();
	});

	</script>
	<!-- end mbYTPlayer Home -->
        ';
    }

}

;
// ends mbYTPlayer_player_head function

//add_action('wp_head', 'mbYTPlayer_player_head');
add_action('wp_footer', 'mbYTPlayer_player_head',20);
add_action('admin_init', 'setup_ytplayer_button');


// TinyMCE Button ***************************************************

// Set up our TinyMCE button
function setup_ytplayer_button()
{
    if (get_user_option('rich_editing') == 'true' && current_user_can('edit_posts')) {
        add_filter('mce_external_plugins', 'add_ytplayer_button_script');
        add_filter('mce_buttons', 'register_ytplayer_button');
    }
}

// Register our TinyMCE button
function register_ytplayer_button($buttons)
{
    array_push($buttons, '|', 'YTPlayerbutton');
    return $buttons;
}

// Register our TinyMCE Script
function add_ytplayer_button_script($plugin_array)
{
    $plugin_array['YTPlayer'] = plugins_url('ytptinymce/tinymceytplayer.js.php?params=' . get_ytplayer_pop_up_params(), __FILE__);
    return $plugin_array;
}

function get_ytplayer_pop_up_params()
{
    global $mbYTPlayer_version, $mbYTPlayer_donate;

    return urlencode(
        'plugin_version=' . $mbYTPlayer_version . '&' .
        'includes_url=' . urlencode(includes_url()) . '&' .
        'plugins_url=' . urlencode(plugins_url()) . '&' .
        'charset=' . urlencode(get_option('blog_charset')) . '&' .
        'donate=' . $mbYTPlayer_donate
    );
}


if (is_admin()) {
    require('mbYTPlayer-admin.php');
}
