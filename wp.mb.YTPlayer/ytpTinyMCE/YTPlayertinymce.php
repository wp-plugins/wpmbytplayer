<?php

$plugin_version = $_GET['plugin_version'];
$includes_url = $_GET['includes_url'];
$plugins_url = $_GET['plugins_url'];
$charset = $_GET['charset'];

if (!headers_sent()) {
    header('Content-Type: text/html; charset='.$charset);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
    <title>Add a shortcode for mb.YTPlayer</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $plugins_url.'/wpmbytplayer/ytpTinyMCE/bootstrap-1.4.0.min.css?v='.$plugin_version; ?>"/>
    <script type="text/javascript" src="<?php echo $includes_url.'js/tinymce/tiny_mce_popup.js?v='.$plugin_version; ?>"></script>
    <style>
        fieldset label > span.label{
            display: inline-block;
            width: 100px;
        }
        fieldset label {
            margin: 5px;
        }

        .actions{
            text-align: right;
        }
    </style>

</head>
<body>

<form class="form-stacked" action="#">

    <fieldset>
        <legend>mb.YTPlayer background video parameters:</legend>

        <label>
            <span class="label">Video url <span style="color:red">*</span> : </span>
            <input type="text" name="url" class="span5"/>
            <span class="help-inline">YouTube video URL</span>
        </label>

        <label>
            <span class="label">Element ID: </span>
            <input type="text" name="id" class="span5"/><br>
            <span class="label"></span><span class="help-inline">The page element id where you want to target the player</span><br>
            <span class="label"></span><span class="help-inline">if empty it will play as background</span>
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
            <span class="label">Aspect-ratio:</span>
            <select name="ratio">
                <option value="4/3">4/3</option>
                <option value="16/9">16/9</option>
            </select>
            <span class="help-inline">YouTube video aspect ratio</span>
        </label>

        <label>
            <span class="label">Quality:</span>
            <select name="quality">
                <option value="default">auto detect</option>
                <option value="small">small</option>
                <option value="medium">medium</option>
                <option value="large">large</option>
                <option value="hd720">hd720</option>
                <option value="hd1080">hd1080</option>
                <option value="highres">highres</option>
            </select>
            <span class="help-inline">YouTube video quality</span>
        </label>

        <label>
            <span class="label">Show controls:</span>
            <input type="checkbox" name="showcontrols" value="true"/>
            <span class="help-inline">show controls at the bottom of the page</span><br>
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

<!--[mbYTPlayer url="http://www.youtube.com/watch?v=V2rifmjZuKQ" ratio="4/3" mute="false" loop="true" showcontrols="true" opacity=1]-->
<script type="text/javascript">
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
                    if (inputName == "url" && (isEmpty(inputValue) || inputValue.toLowerCase().indexOf("youtube")==-1)){
                        alert("a valid Youtube video URL is required");
                        return false;
                    }
                    // inputs of type "checkbox", "radio" and "text"
                    if ((input.type == "text" && !isEmpty(inputValue) && inputValue != input.defaultValue) || input.type == "select-one" || input.type =="checkbox") {

                        if (input.type =="checkbox") {
                            if(!input.checked)
                                inputValue = false;
                        }

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