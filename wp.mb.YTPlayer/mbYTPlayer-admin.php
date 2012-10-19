<?php

// create the admin menu
// hook in the action for the admin options page
add_action('admin_menu', 'add_mbYTPlayer_option_page');

function add_mbYTPlayer_option_page() {
    // hook in the options page function
    add_options_page('mbYTPlayer', 'mbYTPlayer', 'manage_options', __FILE__, 'mbYTPlayer_options_page');
}
function mbYTPlayer_options_page() { 	// Output the options page
    global  $mbYTPlayer_version, $mbYTPlayer_home_video_url, $mbYTPlayer_show_controls,$mbYTPlayer_show_videourl, $mbYTPlayer_mute, $mbYTPlayer_ratio, $mbYTPlayer_loop, $mbYTPlayer_opacity, $mbYTPlayer_quality, $mbYTPlayer_add_raster, $mbYTPlayer_stop_onclick  ?>
<div class="wrap" style="width:800px">
    <style>

        #wpwrap{
            background: #ebf2f4 url("<?php echo plugins_url( 'images/bgnd.jpg', __FILE__ );?>");
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .form-table th{
            font-weight: bold!important;
            border-bottom: 1px solid gray;
        }
        .form-table td{
            border-bottom: 1px solid gray;
        }
        .submit{
            text-align: right;
        }

    </style>

    <form method="post" action="options.php">

        <?php wp_nonce_field('update-options'); ?>


        <h2>mb.YTPlayer Settings</h2>
        <div class="updated fade">
            <p style="line-height: 1.4em;">Thanks for downloading mb.YTPlayer! If you like it...<br />
            </p>
        </div>

        <h2>Reference</h2>

        <p>Leave the <b>home video url</b> blank if you don't want to display a background video on your homepage.
        </p>
        <p>You can add a mb.YTPlayer to any of your posts or pages by writing the shortcode
            <br>
            <b>[mbYTPlayer url="http://www.youtube.com/watch?v=V2rifmjZuKQ" ratio="4/3" mute="false" loop="true" showControls="true" opacity=1]</b>
            into the content editor. Change the parameters into the shortcode to fill your needs.</p>
        <br>
        <h2>Home page background video properties:</h2>
        <p>These settings are used only for the Home istance of the mb.YTPlayer component.</p>
        <br>
        <br>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">home video: url</th>
                <td>
                    <input type="text" name="mbYTPlayer_home_video_url" style="width:70%" value="<?php if (!empty($mbYTPlayer_home_video_url)) {echo $mbYTPlayer_home_video_url; }?>"/>
                    <p>Copy and paste here the URL of the Youtube video you want as your homepage background.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">home video: opacity</th>
                <td>
                    <select name="mbYTPlayer_opacity">
                        <option value=".3" <?php if ($mbYTPlayer_opacity==".3") {echo' selected'; }?> >0.3</option>
                        <option value=".5" <?php if ($mbYTPlayer_opacity==".5") {echo' selected'; }?>>0.5</option>
                        <option value=".8" <?php if ($mbYTPlayer_opacity==".8") {echo' selected'; }?>>0.8</option>
                        <option value="1" <?php if ($mbYTPlayer_opacity=="1") {echo' selected'; }?>>1</option>
                    </select>
                    <p>Set the opacity of the background video.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">home video: aspect ratio</th>
                <td>
                    <select name="mbYTPlayer_ratio">
                        <option value="4/3" <?php if ($mbYTPlayer_ratio=="4/3") {echo' selected'; }?> >4/3</option>
                        <option value="16/9" <?php if ($mbYTPlayer_ratio=="16/9") {echo' selected'; }?>>16/9</option>
                    </select>
                    <p>Set the aspect-ratio of the background video.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">home video: quality</th>
                <td>
                    <select name="mbYTPlayer_quality">
                        <option value="default" <?php if ($mbYTPlayer_quality=="default") {echo' selected'; }?> >default</option>
                        <option value="small" <?php if ($mbYTPlayer_quality=="small") {echo' selected'; }?> >small</option>
                        <option value="medium" <?php if ($mbYTPlayer_quality=="medium") {echo' selected'; }?> >medium</option>
                        <option value="large" <?php if ($mbYTPlayer_quality=="large") {echo' selected'; }?> >large</option>
                        <option value="hd720" <?php if ($mbYTPlayer_quality=="hd720") {echo' selected'; }?> >hd720</option>
                        <option value="hd1080" <?php if ($mbYTPlayer_quality=="hd1080") {echo' selected'; }?> >hd1080</option>
                        <option value="highres" <?php if ($mbYTPlayer_quality=="highres") {echo' selected'; }?> >highres</option>
                    </select>
                    <p>Set the quality of the background video ('default' YouTube selects the appropriate playback quality).</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">home video: show controls</th>
                <td>
                    <input id="mbYTPlayer_show_controls" onclick="videoUrlControl()" type="checkbox" name="mbYTPlayer_show_controls" value="true" <?php if ($mbYTPlayer_show_controls=="true") {echo' checked="checked"'; }?>/>
                    <p>Check to show controls at the bottom of the page.</p>
                    <div id="videourl" style="display: none;">
                        <input id="mbYTPlayer_show_videourl"  type="checkbox" name="mbYTPlayer_show_videourl" value="true" <?php if ($mbYTPlayer_show_videourl=="true") {echo' checked="checked"'; } ?>/>
                        <p>Check to show the link to the original YouTube® video.</p>
                    </div>
                    <script>
                        function videoUrlControl(){
                            if (jQuery("#mbYTPlayer_show_controls").is(":checked")){
                                jQuery("#videourl").show();
                            }else{
                                jQuery("#mbYTPlayer_show_videourl").attr("checked",false).val(false);
                                jQuery("#videourl").hide();
                            }
                        }
                        videoUrlControl();
                    </script>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">home video mute</th>
                <td>
                    <input type="checkbox" name="mbYTPlayer_mute" value="true" <?php if ($mbYTPlayer_mute=="true") {echo' checked="checked"'; }?>/>
                    <p>Check to mute the audio of the video.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">home video loop</th>
                <td>
                    <input type="checkbox" name="mbYTPlayer_loop" value="true" <?php if ($mbYTPlayer_loop=="true") {echo' checked="checked"'; }?>/>
                    <p>Check to loop the video once ended.</p>

                </td>
            </tr>

            <tr valign="top">
                <th scope="row">home video raster image</th>
                <td>
                    <input type="checkbox" name="mbYTPlayer_add_raster" value="true" <?php if ($mbYTPlayer_add_raster=="true") {echo' checked="checked"'; }?>/>
                    <p>Check to add a raster effect to the video.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Stop the player if a link is clicked</th>
                <td>
                    <input type="checkbox" name="mbYTPlayer_stop_onclick" value="true" <?php if ($mbYTPlayer_stop_onclick=="true") {echo' checked="checked"'; }?>/>
                    <p>Check to stop the player once clicked on a link<br>(firefox has problems catching the event and this speedup the action).</p>
                </td>
            </tr>
        </table>

        <p>Rate this plug in: <select onchange="window.open('http://wordpress.org/extend/plugins/wpmbytplayer/?rate='+this.value+'&topic_id=31313&_wpnonce=a0c718fddc', 'rate')">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="5" selected>rate it</option>
        </select></p>


        <input type="hidden" name="page_options" value="mbYTPlayer_home_video_url, mbYTPlayer_show_controls, mbYTPlayer_show_videourl, mbYTPlayer_mute, mbYTPlayer_ratio, mbYTPlayer_loop, mbYTPlayer_opacity, mbYTPlayer_quality, mbYTPlayer_add_raster, mbYTPlayer_stop_onclick" />
        <input type="hidden" name="action" value="update" />
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
        <a style="position: relative; display:block;top:0px;margin-right: -10px" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y"><img border="0" alt="PayPal" src="<?php echo plugins_url( 'images/btn_donateCC_LG_global.gif', __FILE__ );?>" class="alignright"></a>
    </form>

    <p>You're using mb.YTPlayer v. <?php echo $mbYTPlayer_version;?> by <a href="http://pupunzi.com">Pupunzi</a>.<br>If you like it and you use it then you should consider a donation (€15,00 or more) :-)</p>
    <a href="http://pupunzi.com"><img style="margin-top:30px;" src="<?php echo plugins_url( 'images/logo.png', __FILE__ );?>" alt="Made by Pupunzi" /></a>


</div>
<?php } ?>