jQuery(document).ready( function($){
	var updateCSS = function(){ $("#ganesh_css").val( editor.getSession().getValue() ); }
	$("#save-custom-css-form").submit( updateCSS );
});
var editor = ace.edit("ganeshcss");
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/css");