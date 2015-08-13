function tiny(name,url) {
	tinymce.init({
		selector: 'textarea[name='+name+']',
		plugins: [
         	"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality template paste textcolor colorpicker"
   		],
   		toolbar: "code | insertfile undo redo | styleselect | bold italic  forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link image media | pagebreak print preview fullpage",
		width: 900,
		height: 500,
		menubar : false,
		relative_urls: true,
		document_base_url: url,
		extended_valid_elements : "map[name],area[href|shape|coords|style|title|alt|target],iframe[src|style|width|scrolling|frameborder|height|name|align],applet[style|width|code|archive|height]"
	});
}

function browser(type,field) {
	switch (type) {
		case 'image': type = 1;
			break;
		case 'video': type = 3;
			break;
		default: type = 2;
			break;
	}
	var url = "js/tinymce/plugins/filemanager/dialog.php?type="+type+"&popup=1&field_id="+field;
	var w = 880;
	var h = 570;
	var l = Math.floor((screen.width-w)/2);
	var t = Math.floor((screen.height-h)/2);
    var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}
