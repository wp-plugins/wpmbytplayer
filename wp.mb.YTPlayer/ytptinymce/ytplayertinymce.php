<?php

$plugin_version = $_GET['plugin_version'];
$includes_url = $_GET['includes_url'];
$plugins_url = $_GET['plugins_url'];
$charset = $_GET['charset'];
$donate = $_GET['donate'];

if (!headers_sent()) {
    header('Content-Type: text/html; charset='.$charset);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
    <title>Add a shortcode for mb.YTPlayer</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $plugins_url.'/wpmbytplayer/ytptinymce/bootstrap-1.4.0.min.css?v='.$plugin_version; ?>"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $includes_url.'js/tinymce/tiny_mce_popup.js?v='.$plugin_version; ?>"></script>
    <style>
        fieldset span.label{
            display: inline-block;
            width: 100px;
        }
        fieldset label {
            margin: 0;
            padding: 3px!important;
            border-top: 1px solid #dcdcdc;
            border-bottom: 1px solid #f9f9f9;
            display: block;
        }

        .actions{
            text-align: right;
        }

        #inlinePlayer{
            display: none;
            background: #fff;
            padding: 5px;
        }
    </style>

</head>
<body>

<!-- DONATE POPUP-->
<style>
    #donate{ position: fixed; top: 0; left: 0; width: 100%; height: 100%; padding: 30px; text-align: center; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; z-index: 10000; }
    #donateContent{ position: relative; margin: 30px auto; background: rgba(77, 71, 61, 0.88); color:white; padding: 30px; text-align: center; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; width: 450px; border-radius: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.5) }
    #donate h2{ font-size: 30px; line-height: 33px; color: #ffffff; }
    #donate p{ margin: 30px; font-size: 16px; line-height: 22px; display: block; float: none; }
    #donate p#follow{ margin: 30px; font-size: 16px; line-height: 33px; }
    #donate p#timer{ padding: 5px; font-size: 20px; line-height: 33px; background: #231d0c; border-radius: 30px; color: #ffffff; width: 30px; margin: auto; }
    #donate button{padding: 5px;border-radius: 3px;background: #ffffff}
</style>

<div id="donate" style="display: none">
    <div id="donateContent">
        <h2>mb.YTPlayer</h2>
        <p >If you like it and you are using it then you should consider a donation <br> (€15,00 or more) :-)</p>
        <p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y" target="_blank" onclick="donate();">
                <img border="0" alt="PayPal" src="https://www.paypalobjects.com/en_US/IT/i/btn/btn_donateCC_LG.gif">
            </a></p>
        <p id="timer">&nbsp;</p>
        <br>
        <br>
        <button onclick="donate()">I already donate</button>
    </div>
</div>
<script type="text/javascript">

    $.mbCookie = {
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
            $.mbCookie.set(name, "", -1);
        }
    };

    function donate() {
        $.mbCookie.set("ytpdonate", true);
        self.location.reload();
    }

    jQuery(function () {
        var hasDonate = <?php echo $donate ?> ;
        if (hasDonate || $.mbCookie.get("ytpdonate") === "true" ) {
            jQuery("#donate").remove();
            jQuery("#inlineDonate").remove()
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

<!--END DONATE POPUP-->

<form class="form-stacked" action="#">
    <fieldset>
        <legend>mb.YTPlayer video parameters:</legend>



        <label>
            <span class="label">Video url <span style="color:red">*</span> : </span>
            <input type="text" name="url" class="span5"/>
            <span class="help-inline">YouTube video URL</span>
        </label>

        <label>
            <span class="label">Opacity:</span>
            <select name="opacity">
                <option value="1">1</option>
                <option value=".8">0.8</option>
                <option value=".5">0.5</option>
                <option value=".3">0.3</option>
            </select>
            <span class="help-inline">YouTube video opacity</span>
        </label>

        <label>
            <span class="label">Quality:</span>
            <select name="quality">
                <option value="default">auto detect</option>
                <option value="small">small</option>
                <option value="medium" selected="selected">medium</option>
                <option value="large">large</option>
                <option value="hd720">hd720</option>
                <option value="hd1080">hd1080</option>
                <option value="highres">highres</option>
            </select>
            <span class="help-inline">YouTube video quality</span>
        </label>

        <label>
            <span class="label">Aspect ratio:</span>
            <select name="ratio">
                <option value="auto" selected="selected">auto detect</option>
                <option value="4/3">4/3</option>
                <option value="16/9">16/9</option>
            </select>
            <span class="help-inline">YouTube video aspect ratio.</span>
            <span class="label"></span><span class="help-inline"> If "auto" the plug in will try to get it from Youtube.</span>
        </label>

        <label>
            <span class="label">Is inline: </span>
            <input type="checkbox" name="isinline" value="true" onclick="isInline()" /><br>
            <span class="label"></span><span class="help-inline">check this if you want to show the player inline</span><br>
        </label>

        <div id="inlinePlayer" style="">
            <span class="label">Player width: </span>
            <input type="text" name="playerwidth" class="span5" style="width: 60px" onblur="suggestedHeight()"/> px
            <span class="help-inline">Set the width of the inline player</span><br><br>
            <span class="label">Aspect ratio:</span>
            <select name="inLine_ratio" style="width: 60px" onchange="suggestedHeight()">
                <option value="4/3">4/3</option>
                <option value="16/9">16/9</option>
            </select>
            <span class="help-inline">To get the suggested height for the player</span><br><br>

            <span class="label">Player height: </span>
            <input type="text" name="playerheight" class="span5" style="width: 60px" /> px
            <span class="help-inline">Set the height of the inline player</span><br>

            <br>
            <span class="label">Autoplay: </span>
            <input type="checkbox" name="autoplay" value="true" /><br>
            <span class="label"></span><span class="help-inline">check this if you want the player start on page load</span><br>

        </div>

        <label>
            <span class="label">Start at: </span>
            <input type="text" name="startat" class="span5" style="width: 60px" /> sec.
            <span class="help-inline">Set the seconds you want the player start at</span><br>
        </label>

        <label>
            <span class="label">full screen:</span><br>
            <input type="radio" name="realfullscreen" value="true" checked/>
            <span class="help-inline">Full screen containment is the screen</span><br>

            <input type="radio" name="realfullscreen" value="false"/>
            <span class="help-inline">Full screen containment is the browser window</span><br>
        </label>

        <label>
            <span class="label">Show controls:</span>
            <input type="checkbox" name="showcontrols" value="true"/>
            <span class="help-inline">show controls at the bottom of the page</span><br>
        </label>

        <label>
            <span class="label">YouTube® link:</span>
            <input type="checkbox" name="printurl" value="true"/>
            <span class="help-inline">show the link to the original YouTube® video.</span>
        </label>

        <label>
            <span class="label">Mute video:</span>
            <input type="checkbox" name="mute" value="true"/>
            <span class="help-inline">mute the audio of the video</span>
        </label>

        <label>
            <span class="label">Loop video:</span>
            <input type="checkbox" name="loop" value="true"/>
            <span class="help-inline">loop the video once ended</span>
        </label>

        <label>
            <span class="label">Add raster:</span>
            <input type="checkbox" name="addraster" value="true"/>
            <span class="help-inline">add a raster effect</span>
        </label>

    </fieldset>

    <div class="actions">
        <input type="submit" value="Insert shortcode" class="btn primary"/>
        or
        <input class="btn" type="reset" value="Reset settings"/>
    </div>
</form>

<script type="text/javascript">

    function isInline(){
        var inlineBox = jQuery('#inlinePlayer');
        if(inlineBox.is(":visible")){
            inlineBox.slideUp();
            $("[name=showcontrols]").removeAttr("checked").removeAttr("disabled");
        }else{
            inlineBox.slideDown();
            $("[name=showcontrols]").attr("checked","checked").attr("disabled","disabled");
        }
    }

    function suggestedHeight(){
        var width = parseFloat(jQuery("[name=playerwidth]").val());
        var margin = (width*10)/100;
        width = width + margin;
        var ratio = jQuery("[name=inLine_ratio]").val();
        var suggestedHeight = "";
        if(width)
            if(ratio == "16/9"){
                suggestedHeight = (width*9)/16;
            }else{
                suggestedHeight = (width*3)/4;
            }
        jQuery("[name=playerheight]").val(Math.floor(suggestedHeight));
    }

    tinyMCEPopup.onInit.add(function(ed) {

        var form = document.forms[0],

            isEmpty = function(value) {
                return (/^\s*$/.test(value));
            },

            encodeStr = function(value) {
                return value.replace(/\s/g, "%20")
                    .replace(/"/g, "%22")
                    .replace(/'/g, "%27")
                    .replace(/=/g, "%3D")
                    .replace(/\[/g, "%5B")
                    .replace(/\]/g, "%5D")
                    .replace(/\//g, "%2F");
            },

            insertShortcode = function(e){
                var sc = "[mbYTPlayer ",
                    inputs = form.elements, input, inputName, inputValue,
                    l = inputs.length, i = 0;

                for ( ; i < l; i++) {
                    input = inputs[i];
                    inputName = input.name;
                    inputValue = input.value;
                    // Video URL validation
                    if (inputName == "url" && (isEmpty(inputValue) || (inputValue.toLowerCase().indexOf("youtube")==-1) && inputValue.toLowerCase().indexOf("youtu.be")==-1)){
                        alert("a valid Youtube video URL is required");
                        return false;
                    }
                    // inputs of type "checkbox", "radio" and "text"
                    if ((input.type == "text" && !isEmpty(inputValue) && inputValue != input.defaultValue) || input.type == "select-one" || input.type =="checkbox"|| input.type =="radio") {

                        if (input.type =="checkbox") {
                            if(!input.checked)
                                inputValue = false;
                        }

                        if (inputName =="realfullscreen" && !input.checked)
                            continue;

                        if (inputName =="inLine_ratio")
                            continue;

                        sc += ' ' + inputName + '="' + inputValue + '"';
                    }
                }
                sc += "]";

                ed.execCommand('mceInsertContent', 0, sc);
                tinyMCEPopup.close();

                return false;
            };

        form.onsubmit = insertShortcode;

        tinyMCEPopup.resizeToInnerSize();
    });
</script>
</body>
</html>
