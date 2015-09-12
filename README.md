# EasyMark
Markdown section type for GPEasy CMS

GPEasy is a fun little CMS, somehow I thought it would benefit from having a MarkDown content type - and for once in this life, I found something nobody has done yet, so here it is. Enjoy everybody!

Here is what works:
 * Default content
 * Section add/remove (Well, Ok, most of this is done by the CMS itself...)
 * Displaying Markdown content (The heavy lifting is done by Parsedown 1.5.0)

Here are the outstanding points:
 * no online content editing whatsoever... Yay for editing PHP files through FTP!
 * probably add Parsedown Extra
 * get unique addon ID to publish to GPEasy plugin repository (well, this is absolutely the last item on the list...)

The project uses Parsedown 1.5.0 for transforming Markdown into HTML.