# EasyMark
Markdown section type for GPEasy CMS

GPEasy is a fun little CMS, somehow I thought it would benefit from having a MarkDown content type - and for once in this life, I finally found something nobody has done yet and within my boundaries, so here it is. Enjoy everybody!

Here is what works:
 * Default content
 * Section add/remove (Well, Ok, most of this is done by the CMS itself...)
 * Displaying Markdown content (The heavy lifting is done by Parsedown 1.5.0)
 * Displaying Markdown Extra content (The heavy lifting is done by Parsedown Extra 0.7.0)
 * Inline content editing -- Woohooo! (Ok, I copied most of the JavaScript work from the "Execute PHP" plugin available in the GPEasy repo...)
 * Downloadable from the GPEasy plugin repository: [EasyMark: MarkDown for GPEasy](http://gpeasy.com/Plugins/301_EasyMark_MarkDown_for_GPEasy)

Here are the outstanding points:
 * add some kind of link to help or cheatsheet regarding Markdown to the inline editing part
 * "WYSIWYG" like operation? Would be very cool, it is quite clumsy not to see the edited text right away

Release notes:
1.2: Feature release (not released yet!)
 * Markdown Extra
 * Minor bugfix: variable not found error fixed
1.1: Initial release, minimal functionality
 * Markdown parsing, inline editing works, as well as Section add and remove
  
The project uses Parsedown 1.5.0 for transforming Markdown into HTML, and Parsedown Extra 0.7.0 for transforming Markdown Extra into HTML.