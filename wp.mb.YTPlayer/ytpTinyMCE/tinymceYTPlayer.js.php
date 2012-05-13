<?php
	if (!headers_sent()) {
	    header("Content-Type: application/x-javascript; charset=UTF-8");
	}
?>
(function() {

    tinymce.create('tinymce.plugins.YTPlayer', {
        
        init : function(ed, url) {
        
        	var popUpURL = url + '/YTPlayertinymce.php?' + '<?php echo base64_decode(urldecode($_GET['params'])); ?>';

			ed.addCommand('YTPlayerpopup', function() {
				ed.windowManager.open({
					url : popUpURL,
					width : 600,
					height : 330,
					inline : 1
				});
			});

			ed.addButton('YTPlayerbutton', {
				title : 'YTPlayer TinyMCE',
				image : url + '/YTPlayerbutton.png',
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