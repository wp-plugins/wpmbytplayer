=== mb.YTPlayer for background videos ===

Contributors: Pupunzi (Matteo Bicocchi)
Tags: video player, Youtube, full background, video, flash, mov, jquery, pupunzi, mb.components
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 0.6.5
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y

Play any Youtube video as background of your page or as custom player inside an element of the page.

== Description ==

A Chrome-less Youtube® video player that let you play any YouTube® video as background of your WordPress® page or post.
You can activate it for your home page from the settings panel or on any post or page using the short code as described in the Reference section of the settings.

* demo: http://pupunzi.com/mb.components/mb.YTPlayer/demo/demo_background.html
* video: http://www.youtube.com/watch?v=lTW937ld02Y
* pupunzi blog: http://pupunzi.open-lab.com
* pupunzi site: http://pupunzi.com


[youtube http://www.youtube.com/watch?v=lTW937ld02Y]


note: If you doesn't want ADs on your background video and you are the owner of it you can disable this on your Youtube channel as explained here: http://12starsmedia.com/blog/how-to-remove-ads-from-youtube-videos

== Installation ==

Extract the zip file and upload the contents to the wp-content/plugins/ directory of your WordPress installation, and then activate the plugin from the plugins page.

== Screenshots ==

1. The settings panel.
2. You can add a video as background or targeted to a DOM element in any page or post by inserting a shortcode generated via the editor button.
3. The shortcode editor.

== To set your homepage background video: ==

1. Go to the mbYTPlayer settings panel (you can find it under the "settings" section of the WP backend.
2. set the complete YT video url
3. set all the other parameters as you need.

To remove the video just leave the url blank.

You can also set it by placing a shortcode in the home page via the YTPlayer shortcode window. 
You can open it by clicking on the YTPlayer button in the top toolbar of the page editor.

== To set a video as background of a post or a page: ==
Use the editor button or write the below shortcode into the content of your post or page:

[mbYTPlayer url="http://www.youtube.com/watch?v=V2rifmjZuKQ" ratio="4/3" mute="false" loop="true" showcontrols="true" opacity=1]

* @ url = the YT url of the video you want as background
* @ ratio = the aspect ratio of the video 4/3 or 16/9
* @ mute = a boolean to mute the video
* @ loop = a boolean to loop the video on its end
* @ showcontrols = a boolean to show or hide controls and progression of the video
* @ opacity = a value from 0 to 1 that set the opacity of the background video
* @ id = The ID of the element in the DOM where you want to target the player (default is the BODY)
* @ quality:
  * small: Player height is 240px, and player dimensions are at least 320px by 240px for 4:3 aspect ratio.
  * medium: Player height is 360px, and player dimensions are 640px by 360px (for 16:9 aspect ratio) or 480px by 360px (for 4:3 aspect ratio).
  * large: Player height is 480px, and player dimensions are 853px by 480px (for 16:9 aspect ratio) or 640px by 480px (for 4:3 aspect ratio).
  * hd720: Player height is 720px, and player dimensions are 1280px by 720px (for 16:9 aspect ratio) or 960px by 720px (for 4:3 aspect ratio).
  * hd1080: Player height is 1080px, and player dimensions are 1920px by 1080px (for 16:9 aspect ratio) or 1440px by 1080px (for 4:3 aspect ratio).
  * highres: Player height is greater than 1080px, which means that the player's aspect ratio is greater than 1920px by 1080px.
  * default: YouTube selects the appropriate playback quality.

== Changelog ==

= 0.6.5 =
* bugfix for Chrome: The control bar was unreachable.

= 0.6.4 =
* minor bugfix for the bottom player tool bar and for body positioning.

= 0.6.3 =
* Added the "link to Youtube® video" option both on settings and shortcode editor; if checked shows the link to the original video at the bottom right over the seek bar.

= 0.6.2 =
* Solved a bug that prevent the use of the plugin into a target DOM element on the front or home page.

= 0.6.1 =
* added a new property to choose if the player should stop or not if a link is clicked.

= 0.6.0 =
* fixed a bug for YT player API (OnStateChange is not triggered anymore) AGAIN!!!
* Now it supports youtube short-urls too ( ex: http://youtu.be/V2rifmjZuKQ ).

= 0.5.9 =
* removed a "console.debug" that break the component in IE

= 0.5.8 =
* fixed a bug for YT player API (OnStateChange is not triggered anymore)

= 0.5.7 =
* Tested on wordpress v. 3.4.1

= 0.5.6 =
* bug fix: video took too much to show

= 0.5.5 =
* Added: addRaster parameter -> choose to add or remove the raster over the video
* bug fix: added is_frontPage() for home background video

= 0.5.2 =
* Added: Quality parameter
* Added: better fade in once video loaded

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
