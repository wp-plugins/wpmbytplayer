<?php
	if (!headers_sent()) {
	    header("Content-Type: application/x-javascript; charset=UTF-8");
	}
?>
(function() {

    tinymce.create('tinymce.plugins.YTPlayer', {

        init : function(ed, url) {

        	var popUpURL = url + '/ytplayertinymce.php?' + '<?php echo urldecode($_GET['params']); ?>';

			ed.addCommand('YTPlayerpopup', function() {
				ed.windowManager.open({
					url : popUpURL,
					width : 600,
					height : 670,
					inline : 1
				});
			});

			ed.addButton('YTPlayerbutton', {
				title : 'YTPlayer TinyMCE',
				image : url + '/ytplayerbutton.png',
				cmd : 'YTPlayerpopup'
			});
		},

		createControl : function() {
            return null;
        },

		getInfo : function() {
            return {};
        }
    });
    tinymce.PluginManager.add('YTPlayer', tinymce.plugins.YTPlayer);
}());
