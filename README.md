# EasyMark
Markdown section type for GPEasy CMS

GPEasy is a fun little CMS, somehow I thought it would benefit from having a MarkDown content type - and for once in this life, I finally found something nobody has done yet and within my boundaries, so here it is. Enjoy everybody!

Here is what works:
 * Default content
 * Section add/remove (Well, Ok, most of this is done by the CMS itself...)
 * Displaying Markdown content (The heavy lifting is done by Parsedown 1.5.0)
 * Inline content editing -- Woohooo! (Ok, I copied most of the JavaScript work from the "Execute PHP" plugin available in the GPEasy repo...)
 * Downloadable from the GPEasy plugin repository: [EasyMark: MarkDown for GPEasy](http://gpeasy.com/Plugins/301_EasyMark_MarkDown_for_GPEasy)

 
Here are the outstanding points:
 * add Parsedown Extra
 * add some kind of link to help or cheatsheet regarding Markdown to the inline editing part

The project uses Parsedown 1.5.0 for transforming Markdown into HTML.