<?php

// create the admin menu
// hook in the action for the admin options page
add_action('admin_menu', 'add_mbYTPlayer_option_page');

function add_mbYTPlayer_option_page() {
    // hook in the options page function
    add_options_page('mbYTPlayer', 'mb.YTPlayer', 'manage_options', __FILE__, 'mbYTPlayer_options_page');
}
function mbYTPlayer_options_page() { 	// Output the options page
    global $mbYTPlayer_donate, $mbYTPlayer_version, $mbYTPlayer_home_video_url, $mbYTPlayer_show_controls, $mbYTPlayer_show_videourl, $mbYTPlayer_start_at, $mbYTPlayer_mute, $mbYTPlayer_ratio, $mbYTPlayer_loop, $mbYTPlayer_opacity, $mbYTPlayer_quality, $mbYTPlayer_add_raster, $mbYTPlayer_realfullscreen, $mbYTPlayer_stop_onclick  ?>

    <!-- DONATE POPUP-->
    <style>
        #donate{ position: fixed; top: 20%; left: 0; width: 100%; height: 100%; padding: 30px; text-align: center; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; z-index: 10000; }
        #donateContent{ position: relative; margin: 30px auto; background: rgba(77, 71, 61, 0.88); color:white; padding: 30px; text-align: center; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; width: 450px; border-radius: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.5) }
        #donate h2{ font-size: 30px; line-height: 33px; }
        #donate p{ margin: 30px; font-size: 16px; line-height: 22px; display: block; float: none; }
        #donate p#follow{ margin: 30px; font-size: 16px; line-height: 33px; }
        #donate p#timer{ padding: 5px; font-size: 20px; line-height: 33px; background: #231d0c; border-radius: 30px; color: #ffffff; width: 30px; margin: auto; }
        #donateTxt{display:none;}
        hr{border: none; height: 1px; background: #dfd490}
    </style>

    <div id="donate" style="display: none">
        <div id="donateContent">
            <h2>mb.YTPlayer</h2>
            <p >If you like it and you are using it then you should consider a donation <br> (€15,00 or more) :-)</p>
            <p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y" target="_blank" onclick="donate()">
                    <img border="0" alt="PayPal" src="https://www.paypalobjects.com/en_US/IT/i/btn/btn_donateCC_LG.gif">
                </a></p>
            <p id="timer">&nbsp;</p>
            <br>
            <br>
            <button onclick="donate()">I already donate</button>
        </div>
    </div>
    <script type="text/javascript">

        function donate() {
            jQuery("input[name=mbYTPlayer_donate]").val("true");
            jQuery("#optionsForm").submit();
        }

        jQuery(function () {

            /*todo: to be removed ---------------------------------------------------------------*/
            jQuery.mbCookie = {
                set:function (name, value, days, domain) {
                    if (!days) days = 7;
                    domain = domain ? "; domain=" + domain : "";
                    var date = new Date(), expires;
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                    document.cookie = name + "=" + value + expires + "; path=/" + domain;
                },
                get:function (name) {
                    var nameEQ = name + "=";
                    var ca = document.cookie.split(';');
                    for (var i = 0; i < ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ')
                            c = c.substring(1, c.length);
                        if (c.indexOf(nameEQ) == 0)
                            return unescape(c.substring(nameEQ.length, c.length));
                    }
                    return null;
                },
                remove:function (name) {
                    jQuery.mbCookie.set(name, "", -1);
                }
            };

            if(typeof(Storage)!=="undefined" && localStorage.ytp_donate != "null"){
                jQuery.mbCookie.set("map_donate", true);
                localStorage.ytp_donate = null;
                self.location.reload();
            }

            /*end --- todo: to be removed ------------------------------------------------------------------------*/

            if (<?php echo $mbYTPlayer_donate;?>) {
                jQuery("#donate").remove();
                jQuery("#inlineDonate").remove();
                jQuery("#donateTxt").show()
            } else {
                jQuery("#donate").show();
                var timer = 5;
                var closeDonate = setInterval(function () {
                    timer--;
                    jQuery("#timer").html(timer);
                    if (timer == 0) {
                        clearInterval(closeDonate);
                        jQuery("#donate").fadeOut(600, jQuery(this).remove)
                    }
                }, 1000)
            }
        });
    </script>
    <!-- END DONATE POPUP-->

    <div class="wrap" style="width:800px">
        <style>
            #wpwrap{ background: #ebf2f4 url("<?php echo plugins_url( 'images/bgnd.jpg', __FILE__ );?>"); background-attachment: fixed; background-repeat: no-repeat; }
            .form-table th{ font-weight: bold!important; border-bottom: 1px solid gray; }
            .form-table td{ border-bottom: 1px solid gray; }
            .submit{ text-align: right; }
        </style>

        <a href="http://pupunzi.com"><img style="margin-top:30px;" src="<?php echo plugins_url( 'images/logo.png', __FILE__ );?>" alt="Made by Pupunzi" /></a>
        <h2>mb.YTPlayer Settings</h2>
        <p>You're using mb.YTPlayer v. <?php echo $mbYTPlayer_version;?> by <a href="http://pupunzi.com">Pupunzi</a>.</p>

        <div id="share" style="position: absolute; left:650px; top:20px">
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://wordpress.org/extend/plugins/wpmbytplayer/" data-text="I'm using the mb.YTPlayer WP plugin for background videos" data-via="pupunzi" data-hashtags="HTML5,wordpress,plugin">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/it_IT/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-like" data-href="http://wordpress.org/extend/plugins/wpmbytplayer/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-font="arial"></div>
        </div>

        <div class="updated fade" style="position: relative;">
            <p style="line-height: 1.4em;">Thanks for downloading mb.YTPlayer!</p>
            <p id="inlineDonate" style="position: relative; display:block;top:0;margin-right: -10px">
                If you like it and you are using it<br>then you should consider a donation (€15,00 or more) :-)<br><br>
                <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y" target="_blank" onclick="donate()"><img border="0" alt="PayPal" src="https://www.paypalobjects.com/en_US/IT/i/btn/btn_donateCC_LG.gif"></a>
                <br><br><i>If you donate, the start popup will nevermore display.</i><br><br>
            </p>
            <hr>
            <p>Don't forget to follow me on twitter: <a href="https://twitter.com/pupunzi">@pupunzi</a></p>
            <p>Visit my site: <a href="http://pupunzi.com">http://pupunzi.com</a></p>
            <p>Visit my blog: <a href="http://pupunzi.open-lab.com">http://pupunzi.open-lab.com</a></p>
            <p id="donateTxt">Paypal: <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y" target="_blank">donate</a></p>
        </div>

        <div class="highlight fade" style="padding: 10px; margin: 0">
            <!-- Begin MailChimp Signup Form -->
            <form action="http://pupunzi.us6.list-manage2.com/subscribe/post?u=4346dc9633&amp;id=91a005172f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <label for="mce-EMAIL" style="font-weight: bold">Subscribe to my mailing list<br>to stay in touch.</label>
                <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="your email address" required>
                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
            </form>
            <!--End mc_embed_signup-->
        </div>

        <form id="optionsForm" method="post" action="options.php">
            <?php wp_nonce_field('update-options'); ?>
            <h2>Reference</h2>

            <p>Leave the <b>home video url</b> blank if you don't want to display a background video on your homepage.
            </p>
            <p>You can add a mb.YTPlayer to any of your posts via the shortcode editor available by clicking the button placed on the button-bar of the post content editor</p>
            <br>
            <h2>Home page background video properties:</h2>
            <p>These settings are used only for the Home istance of the mb.YTPlayer component.</p>
            <br>
            <br>
            <input type="hidden" name="mbYTPlayer_donate" value="<?php echo $mbYTPlayer_donate;?>" />
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
                    <th scope="row">home video: aspect ratio</th>
                    <td>
                        <select name="mbYTPlayer_ratio">
                            <option value="auto" <?php if ($mbYTPlayer_ratio=="auto") {echo' selected'; }?> >auto</option>
                            <option value="4/3" <?php if ($mbYTPlayer_ratio=="4/3") {echo' selected'; }?> >4/3</option>
                            <option value="16/9" <?php if ($mbYTPlayer_ratio=="16/9") {echo' selected'; }?>>16/9</option>
                        </select>
                        <p>Set the aspect-ratio of the background video. If "auto" the plug in will try to retrieve the aspect ratio from Youtube.
                            If you have problems on viewing the background video try setting this manually.
                        </p>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">home video: start at</th>
                    <td>
                        <input type="text" name="mbYTPlayer_start_at" style="width:10%" value="<?php if (!empty($mbYTPlayer_start_at)) {echo $mbYTPlayer_start_at; }?>"/>
                        <p>Set the seconds the video should start at.</p>
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
                    <th scope="row">home video: Full screen behavior</th>
                    <td>
                        <input type="radio" name="mbYTPlayer_realfullscreen" value="true" <?php if ($mbYTPlayer_realfullscreen=="true") {echo' checked="checked"'; }?>/>
                        <p>Full screen containment is the screen</p>
                        <input type="radio" name="mbYTPlayer_realfullscreen" value="false" <?php if ($mbYTPlayer_realfullscreen=="false") {echo' checked="checked"'; }?>/>
                        <p>Full screen containment is the browser window</p>
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
            <input type="hidden" name="page_options" value="mbYTPlayer_donate, mbYTPlayer_home_video_url, mbYTPlayer_show_controls, mbYTPlayer_show_videourl, mbYTPlayer_mute, mbYTPlayer_ratio, mbYTPlayer_start_at, mbYTPlayer_loop, mbYTPlayer_opacity, mbYTPlayer_quality, mbYTPlayer_add_raster, mbYTPlayer_stop_onclick, mbYTPlayer_realfullscreen" />
            <input type="hidden" name="action" value="update" />
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
    </div>
<?php } ?>
