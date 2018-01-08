tinymce.init({
	selector: "textarea#tinymce1",
	theme: "modern",
	relative_urls: false,
	remove_script_host: false,
	plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
	],
	toolbar1: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
   	toolbar2: "link image responsivefilemanager | print preview code media fullpage | forecolor backcolor emoticons",
   	image_advtab: true,
   	external_filemanager_path: "/filemanager/",
   	filemanager_title: "Responsive Filemanager" ,
   	external_plugins: {"filemanager" : "/filemanager/plugin.min.js"} 
}); 

$(document).ready(function(){
	var url = window.location.search;
	if(url.search(/affected_edit=1/i) == 1){
		swal("Good job!", "You edited the article", "success")
	} else if(url.search(/affected_edit=0/i) == 1){
		swal("No!", "You did nothing", "error");
	}
});