/**
 *  Copied and changed from "Execute PHP" plugin
 */

 
function gp_init_inline_edit(area_id,section_object){

  loaded();
  gp_editing.editor_tools();

  gp_editor = {
    cache                     : "",
    ui                        : {},
    edit_div                  : gp_editing.get_edit_area(area_id),
    save_path                 : gp_editing.get_path(area_id),
    destroy                   : function(){},
    checkDirty                : function(){ return gp_editor.cache != gp_editor.ui.textarea.val(); },
    gp_saveData               : function(){ return 'gpcontent=' + encodeURIComponent(gp_editor.ui.textarea.val()); },
    resetDirty                : function(){ gp_editor.cache = gp_editor.ui.textarea.val(); },
    updateElement             : function(){},
    replaceEasyMarkWYSIWYGDiv : function(data){ gp_editor.ui.wysiwygDiv.html(data); },

    /* used by the WYSIWYG display */
    getPostResponseEasyMark   : function(){ 
                                  $.post( gpBase + "/Admin_EasyMark", 
                                    { 
                                      content   : gp_editor.ui.textarea.val(),
                                      gpreq     : 'flush',
                                      rp        : '',
                                      verified  : post_nonce,
                                      cmd       : 'renderContent'
                                    } 
                                    ).done(gp_editor.replaceEasyMarkWYSIWYGDiv);
                                },

    /* initiates the WYSIWYG display */
    getGetResponseEasyMark    : function (){ 
                                  $.get( gpBase + "/Admin_EasyMark", 
                                    { 
                                      content   : '**Loading...**',
                                      gpreq     : 'flush',
                                      rp        : '',
                                      cmd       : 'renderContent'
                                    } 
                                    ).done(gp_editor.replaceEasyMarkWYSIWYGDiv);
                                }
  }; /* gp_editor --end */
  
  gp_editor.ui.mainDiv = 
    $('<div style="width:100%; margin:0; border:0 none; position:relative; vertical-align:top; display:table;" />');

  gp_editor.edit_div.html(gp_editor.ui.mainDiv);
  
  //set up textarea
  gp_editor.ui.textarea = 
    $('<textarea style="width:100%; height:100%; margin:0;border:0 none; display:table-cell; vertical align:top;" />')
      .val(section_object.content)
      .appendTo(gp_editor.ui.mainDiv);

  //set up content div...
  gp_editor.ui.wysiwygDiv = 
    $('<div style="width:50%; height:100%; margin:0; border:0 none; right:0px; display:table-cell; vertical-align:top;">Loading...</div>')
    .appendTo(gp_editor.ui.mainDiv);
  
  gp_editor.getGetResponseEasyMark();
}
