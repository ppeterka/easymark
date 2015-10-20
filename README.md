# EasyMark
Markdown section type for GPEasy CMS

GPEasy is a fun little CMS, somehow I thought it would benefit from having a MarkDown content type - and for once in this life, I finally found something nobody has done yet and within my boundaries, so here it is. Enjoy everybody!

## Here is what works:
 * Default content
 * Section add/remove (Well, Ok, most of this is done by the CMS itself...)
 * Displaying Markdown content (The heavy lifting is done by Parsedown 1.5.0)
 * Displaying Markdown Extra content (The heavy lifting is done by Parsedown Extra 0.7.0)
 * Inline content editing -- Woohooo! (Ok, I copied most of the JavaScript work from the "Execute PHP" plugin available in the GPEasy repo...)
 * Downloadable from the GPEasy plugin repository: [EasyMark: MarkDown for GPEasy](http://gpeasy.com/Plugins/301_EasyMark_MarkDown_for_GPEasy)
 * WYSIWYG-like operation: not completely WYSIWYG, and not instantaneous, but this is a lot more convenient to use than without...

## Here are some of the outstanding points:
 * add some kind of link to help or cheatsheet regarding Markdown to the inline editing part
 * would be nice to have a more user-friendly editor, like [Bootstrap-Markdown](http://www.codingdrama.com/bootstrap-markdown/)

## Release notes:

### 1.3: WIP
 * Admin page with a lot of (OK, actually 5) configurable options!
 * Fix double escaping in code blocks (actually done so by adding the admin page options)
 * WYSIWYG stuff works with POST requests instead of GET
 * Updated Parsedown to 1.6

#### TODO before release:
 * do a refactor to remove ugliness/clean up code both PHP and JS
 * probably remove the Special used for the WYSIWYG editing and move the functionality to the Admin part

### 1.2: Feature release
 * Markdown Extra
 * Minor bugfix: variable not found error fixed
 * **WYSIWYG-like operation**! Yay! Not the nicest (currently uses HTTP GET requests to a special page...), but at least works most of the time. Would be nicer with posts, but having to get a nonce does not make that too easy...
 
### 1.1: Initial release, minimal functionality
 * Markdown parsing, inline editing works, as well as Section add and remove
  
The project uses [Parsedown](https://github.com/erusev/parsedown) for transforming Markdown into HTML, and [Parsedown Extra](https://github.com/erusev/parsedown-extra) for transforming Markdown Extra into HTML.