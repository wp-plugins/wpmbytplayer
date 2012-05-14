=== mb.YTPlayer for background videos ===

Contributors: Pupunzi (Matteo Bicocchi)
Tags: video player, Youtube, full background, video, flash, mov, jquery, pupunzi, mb.components
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 0.5.1
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y

Play any Youtube video as background of your page.


== Description ==

A Chrome-less Youtube® video player that let you play any YouTube® video as background of your WordPress® page or post.
You can activate it for your home page from the settings panel or on any post or page using the short code as described in the Reference section of the settings.

* demo: http://pupunzi.com/mb.components/mb.YTPlayer/demo/demo_background.html
* pupunzi blog: http://pupunzi.open-lab.com
* pupunzi site: http://pupunzi.com


[youtube http://www.youtube.com/watch?v=lTW937ld02Y]


== Installation ==

Extract the zip file and upload the contents to the wp-content/plugins/ directory of your WordPress installation, and then activate the plugin from the plugins page.


== To set your homepage background video: ==

1. Go to the mbYTPlayer settings panel (you can find it under the "settings" section of the WP backend.
2. set the complete YT video url
3. set all the other parameters as you need.

To remove the video just leave the url blank.


== To set a video as background of a post or a page: ==

You should write the below shortcode into the content of your post or page:

[mbYTPlayer url="http://www.youtube.com/watch?v=V2rifmjZuKQ" ratio="4/3" mute="false" loop="true" showcontrols="true" opacity=1]

* @ url = the YT url of the video you want as background
* @ ratio = the aspect ratio of the video 4/3 or 16/9
* @ mute = a boolean to mute the video
* @ loop = a boolean to loop the video on its end
* @ showcontrols = a boolean to show or hide controls and progression of the video
* @ opacity = a value from 0 to 1 that set the opacity of the background video
* @ quality:
  * small: Player height is 240px, and player dimensions are at least 320px by 240px for 4:3 aspect ratio.
  * medium: Player height is 360px, and player dimensions are 640px by 360px (for 16:9 aspect ratio) or 480px by 360px (for 4:3 aspect ratio).
  * large: Player height is 480px, and player dimensions are 853px by 480px (for 16:9 aspect ratio) or 640px by 480px (for 4:3 aspect ratio).
  * hd720: Player height is 720px, and player dimensions are 1280px by 720px (for 16:9 aspect ratio) or 960px by 720px (for 4:3 aspect ratio).
  * hd1080: Player height is 1080px, and player dimensions are 1920px by 1080px (for 16:9 aspect ratio) or 1440px by 1080px (for 4:3 aspect ratio).
  * highres: Player height is greater than 1080px, which means that the player's aspect ratio is greater than 1920px by 1080px.
  * default: YouTube selects the appropriate playback quality.

== Changelog ==

= 0.5 =

* Added: You can now add a short code to a text widget and it will be rendered as background video if the widget is printed out in the page.
* Added: TinyMCE editor button to easily add the short code.

= 0.4 =

* bugfix: Warning: preg_match() [function.preg-match]: Unknown modifier '/' in /home/content/28/9255928/html/wp-content/plugins/wpmbytplayer/mbYTPlayer.php on line 32.
          removed the check.

= 0.3 =

* bugfix: FF had some problems getting click events.

= 0.2 =

* bugfix: settings url was broken.

= 0.1 =

* First release
