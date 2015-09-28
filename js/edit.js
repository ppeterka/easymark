/**
 *  Copied and changed from "Execute PHP" plugin
 */
function stuff() {
	$.get( "/EasyMarkWysiwyg", 
		{ 
			content: $('#easymark_textarea').val() ,
			gpreq: 'flush',
			rp: ''
		} 
	  ).done(
		function( data ) {
			$('#easymark_wysiwyg_div').html(data);
		}
	  );
}

 
 function gp_init_inline_edit(area_id,section_object){
	var textarea, cache;

	loaded();
	gp_editing.editor_tools();
	var edit_div = gp_editing.get_edit_area(area_id);

	mainDiv = $('<div style="width:100%;margin:0;border:0 none;position:relative; vertical-align:top" />');
	edit_div.html(mainDiv);
	
	//set up textarea
	textarea = $('<textarea id="easymark_textarea" style="width:49%;margin:0;border:0 none;display:inline-block;" />').val(section_object.content);
	mainDiv.append(textarea);

	//set up content div...
	wysiwygDiv = $('<div id="easymark_wysiwyg_div" style="width:49%;margin:0;border:0 none; right:0px;display:inline-block;">Loading...</div>');
	mainDiv.append(wysiwygDiv);
	
	setInterval(stuff, 5000);

	gp_editor = {
		save_path: gp_editing.get_path(area_id),

		destroy:function(){},
		checkDirty:function(){
			if( cache == textarea.val() ){
				return false;
			}
			return true;
		},
		gp_saveData:function(){
			return 'gpcontent='+encodeURIComponent(textarea.val());
		},
		resetDirty:function(){
			cache = textarea.val();
		},
		updateElement:function(){}
	}
}






