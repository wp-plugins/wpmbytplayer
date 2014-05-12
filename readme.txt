=== mb.YTPlayer for background videos ===

Contributors: pupunzi
Tags: video player, youtube, full background, video, HTML5, flash, mov, jquery, pupunzi, mb.components, cover video, embed, embed videos, embed youtube, embedding, plugin, shortcode, video cover, video HTML5, youtube, youtube embed, youtube player, youtube videos
Requires at least: 3.0
Tested up to: 3.9
Stable tag:  1.8.1
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y
License: GPLv2 or later

Play any Youtube video as background of your page or as custom player inside an element of the page.

== Description ==

A Chrome-less Youtube® video player that let you play any YouTube® video as background of your WordPress® page or post.
You can activate it for your home page from the settings panel or on any post or page using the short code as described in the Reference section of the settings.

[youtube http://www.youtube.com/watch?v=lTW937ld02Y]

**From version 1.0 the player is using the Youtube® iframe API displaying the video using the HTML5 VIDEO tag for all the browsers that support it.**

**From version 1.7.6 the plug in is internationalized; available in English, Italian and Spanish (thanks to Andrew Kurtis http://www.webhostinghub.com ).**


The mb.YTPlayer doesn't work on any mobile devices (iOs, Android, Windows, etc.) due to restrictions applied by the vendors on media controls via javascript.
Adding a background image to the body as mobile devices fallback is a good practice and it will also prevent unwanted white flickering on desktop browsers when the video is buffering.



note:
If you doesn't want ADs on your background video and you are the owner of it you can disable this on your Youtube channel as explained here: http://candidio.com/blog/how-to-remove-ads-from-your-youtube-videos .


Links:

* demo: http://pupunzi.com/mb.components/mb.YTPlayer/demo/demo_background.html
* video: http://www.youtube.com/watch?v=lTW937ld02Y
* pupunzi blog: http://pupunzi.open-lab.com
* pupunzi site: http://pupunzi.com

This plug in has been tested successfully on:

* Chrome 11+, Firefox 7+, Opera 9+    on Mac OsX, Windows and Linux
* Safari 5+    on Mac OsX
* IE7+    on Windows (via Adobe Flash player)

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


== What about mobile ==

The mb.YTPlayer doesn't work on any mobile devices (iOs, Android, Windows, etc.) due to restrictions applied by the vendors on media controls via javascript.
Adding a background image to the body as mobile devices fallback is a good practice and it will also prevent unwanted white flickering on desktop browsers when the video is buffering.

== Changelog ==

= 1.8.1 =
* Major update: Updated to solve issue compatibilities with the latest 3.9 Wordpress release.

= 1.8.0 =
* Bugfix: Removed a blocking bug introduced with the 1.7.9 release.

= 1.7.9 =
* Feature: Added the possibility choose which video should be tracked by Google Analytics checking the apposite checkbox both in the preferences window and in the edit window.

= 1.7.8 =
* Bugfix: With the latest Chrome release something was lost with the aspect ratio.

= 1.7.7 =
* bugfox for the startAt behavior.

= 1.7.6 =
* Added internationalization. In addition to English are now available the Italian translation and the Spanish translation (thanks to Andrew Kurtis http://www.webhostinghub.com ).
  If you want to translate the YTPlayer plugin in your language here is the .POT file: http://pupunzi.open-lab.com/wp-translations/mbYTPlayer.pot
  Send me the translation once finished; it'll be available with the next update.

= 1.7.5 =
* fixed bug on the shortcode editor window where the "autoplay" option where shown only if "is inline" was checked.
* Added the "stopAt" option to set when the video should stop.

= 1.7.4 =
* fixed bug that prevented the player to start muted.

= 1.7.3 =
* fixed a vulnerability issue in the TinyMCE popup.
* fixed bug that prevented the correct behavior of the switch between the two full-screen modality.

= 1.7.2 =
* Bug fix: Better detection of the video availability to check when to start the video.

= 1.7.1 =
* Bug fix:
If the default Wordpress audio player was instanced in a page together with the YTPlayer, the YTPlayer didn't work.
That was for a conflict with the "mediaelement".

= 1.7.0 =
* Bug fix:
Solved a problem in the TinyMCE editor that prevented the fullscreen option to be checked.

= 1.6.9 =
* Bug fix:
added wp_enqueue_script('yt_api_player', '//www.youtube.com/player_api', false, $mbYTPlayer_version, false) in mbYTPlayer.php to solve audio short-code incompatibility.

= 1.6.8 =
* Feature: Added _GA event track to get statistics if GA Analytics is active (under the Events section): _gaq.push(['_trackEvent', 'YTPlayer', 'Play', (YTPlayer.title || YTPlayer.videoID.toString())]);.

= 1.6.7 =
* Feature: "autoplay = false" works also for background videos.

= 1.6.6 =
* Bug fix: the fullscreen method switcher didn't work from the TinyMCE editor.

= 1.6.5 =
* New feature: You can choose if the fullscreen behavior should be contained into the browser window or cover all the screen.

= 1.6.4 =
* Bug fix: fixed a jQuery $ conflict.

= 1.6.3 =
* Bug fix: the player was initialized twice duplicating the controls HTML element.

= 1.6.2 =
* Button icons are rendered using @font-face instead of images.

= 1.6.1 =
* Major bug fix: the video ended behavior that prevent the display of the play button was available only if the control bar was available.

= 1.6.0 =
* fixed a bug on Safari that was affecting the "mute/unmute" behaviour.

= 1.5.8 /  1.5.9 =
* Added the "start at" property in the settings panel.
* Fixed a bug introduced in the 1.5.8 release.

= 1.5.7 =
* Update for issue compatibility with jQuery 1.9.

= 1.5.6 =
* Bug fix - Solved a potential bug for servers that don't allow CamelCase in path for folders name.

= 1.5.5 =
* Improvements - Refined the loop behavior of the background video.

= 1.5.4 =
* Bug fix - Set poster frame to transparent once the player start playing (if the player had an opacity <1 the poster frame was visible).

= 1.5.3 =
* Bug fix - fixed "url not valid" if a short url has been used in the post editor short code dialog.
* Feature - Refined the in line use and display adding the poster frame to the player and introducing the "autoplay" that allow this also for in line players.

= 1.5.2 =
* New feature - Added support for the short-url of youtube videos.

= 1.5 =
* Bug fix - Fixed a potential bug if there are more instances of the player in a single page (for example one as background video and one as inline player).

= 1.4 =
* CSS Bug fix - Defined specific player CSS classes to prevent incorrect positioning of the player due to possible CSS Theme definitions conflict.

= 1.3 =
* Bug fix for IE - Now it works on IE 8+ Forcing the rendering via Flash® if is Explorer.

= 1.2 =
* bug fix: Fixed a bug with the donate popup.
	bug fix: fixed a bug with Chrome audio (didn't mute).
	bug fix: fixed a bug appending the video in the DOM of the page.

= 1.1 =
* bug fix: removed a console.debug() from the script that can cause IE to fail loading the video.

= 1.0 =
* Major update:
	With this release all the YTPlayer code has been rewritten to use the Youtube® iframe API.
	That means that for all browsers that support HTML5 VIDEO tags the component will use that instead of the FLASH player;
	saving processor worming and speeding up performances.
	As the "seekTo()" method of the API was retrieving an error I opened an issue ticket on the Youtube bug tracking system thinking that anyway they would never take care of it.
	But after 3 days they write me back saying the bug was fixed :-). So now I can publish this great new release!

	If you have problems you can always fall back to the previous 6.8 version downloading it from: http://wordpress.org/extend/plugins/wpmbytplayer/developers/
	Let me know.

= 0.6.7 =
* bug fix: 			raster image display.

= 0.6.7 =
* bug fix: 			var BGisInit = typeof document.YTPBG != "undefined";.

= 0.6.6 =
* Cleaned up the js.
* Video fade in once start playing.

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

== Frequently Asked Questions ==

= I'm using the plug in as background video and I can see the control bar on the bottom but the video doesn't display =
 Your theme is probably using a wrapper for the content and it probably has a background color or image. You should check the CSS and remove that background to let the video that is behind do display correctly.

= Everything is working fine on my desktop but it doesn't work on any mobile devices =
Do to restrictions adopted both by browser vendors and Youtube this plugin can't work on touch devices.

= I would have an image on the background before the video starts and after the video end; how can I do? =
The simplest way is to add an image as background of the body via CSS.

= I set the video quality to hd1080 but it doesn't display at this quality; why? =
The video quality option is just a suggestion for the Youtube API; the video is served by Youtube with the quality that best fits the bandwidth and the display size according to that setting.

= The video stops some seconds before the real end; why? =
To prevent the display of the "play" button provided by the Youtube API the video intentionally stops some seconds before the end; if you are the owner of the video I can suggest to make it a little bit longer (about 3/4 seconds).


