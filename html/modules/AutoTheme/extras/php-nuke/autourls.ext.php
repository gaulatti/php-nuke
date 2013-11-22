<?php
// ----------------------------------------------------------------------
// Google Tap Beta 0.5.0 - 09 Feb 2003                                  
// Copyright (c) 2002 by Nuke Cops                                      
// http://nukecops.com
// ----------------------------------------------------------------------
// LICENSE and CREDITS
// This program is free software and it's released under the terms of the
// GNU General Public License(GPL) - http://www.gnu.org/licenses/gpl.html
// Please READ carefully the Docs/License.txt file for further details
// Please READ the Docs/credits.txt file for complete credits list
// ----------------------------------------------------------------------
// 05-01-04 Shawn McKenzie: Modified for use as an Extra in AutoTheme 1.7
// ----------------------------------------------------------------------

// Check platform
//
if (atGetPlatform() == "php-nuke")
{
    // How to register an extra and the functions that it performs and when to perform them (at operation)
    //
    // $extra[extra name] = array ( 'at operation' => "extra function" );
    //
    $extra['autourls'] = array (
           'name' => 'AutoURLs (BETA)',
           'description' => 'Updated Google Tap implementation for AutoTheme',
           'version' => '1.7',
           'author' => 'Nuke Cops',
           'contact' => 'http://nukecops.com',
           'themepostprocess' => 'at_autourls_rewrite',
           'atadmin' => 'at_admin_autourls'
    );
}

// Extra functions
//
function at_autourls_rewrite($display)
{
    $autourls = atAutoGetVar("autourls");
    $autourlsext = $autourls['extension'];
    
    if (!$autourlsext) {
        $autourlsext = "phtml";
    }
    
    $search = array(
		"'(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)'",
		"'(?<!/)modules.php\?name=News&file=article&sid=([0-9]*)'",
		"'(?<!/)modules.php\?name=Stories_Archive&sa=show_month&year=([0-9]*)&month=([0-9]*)&month_l=([a-zA-Z]*)'",
		"'(?<!/)modules.php\?name=Stories_Archive'",
		"'(?<!/)modules.php\?name=Downloads&d_op=getit&amp;lid=([0-9]*)'",
		"'(?<!/)modules.php\?name=Downloads&d_op=viewdownload&amp;cid=([0-9]*)&amp;min=([0-9]*)&amp;orderby=titleA&amp;show=([0-9]*)'",
		"'(?<!/)modules.php\?name=Downloads&d_op=viewdownload&amp;cid=([0-9]*)'",
		"'(?<!/)modules.php\?name=Downloads&d_op=viewdownloaddetails&amp;lid=([0-9]*)&amp;ttitle=([§/:\-\'(){}.&=a-zA-Z0-9_ ]*)'",
		"'(?<!/)modules.php\?name=(Downloads\")'",
		"'(?<!/)modules.php\?name=Reviews&rop=showcontent&amp;id=([0-9]*)'",
		"'(?<!/)modules.php\?name=Reviews&rop=write_review'",
		"'(?<!/)modules.php\?name=Reviews&rop=postcomment&amp;id=([0-9]*)&amp;title=([a-zA-Z0-9+]*)'",
		"'(?<!/)modules.php\?name=Reviews&rop=mod_review&amp;id=([0-9]*)'",
		"'(?<!/)modules.php\?name=Reviews&rop=del_review&amp;id_del=([0-9]*)'",
		"'(?<!/)modules.php\?name=Reviews&rop=([a-zA-Z0-9]*)'",
		"'(?<!/)modules.php\?name=Reviews'",
		"'(?<!/)modules.php\?name=Submit_News'",
		"'(?<!/)modules.php\?name=Topics'",
		"'(?<!/)modules.php\?name=Top'",
		"'(?<!/)modules.php\?name=FAQ'",
		"'(?<!/)modules.php\?name=FAQ&amp;myfaq=yes&amp;id_cat=([0-9]*)&amp;categories=([a-zA-Z0-9+]*)'",
		"'(?<!/)modules.php\?name=Forums&file=viewtopic&t=([0-9]+)&amp;postdays=([0-9]+)&amp;postorder=asc&amp;start=([0-9]+)'",
		"'(?<!/)modules.php\?name=Forums&file=viewforum&f=([0-9]+)&amp;topicdays=([0-9]+)&amp;start=([0-9]+)'",
		"'(?<!/)modules.php\?name=Content&amp;pa=showpage&amp;pid=([0-9]*)'",
		"'(?<!/)modules.php\?name=Content&amp;pa=list_pages_categories&amp;cid=([0-9]*)'",
		"'(?<!/)modules.php\?name=Forums&file=viewforum&f=([0-9]*)'",
		"'(?<!/)modules.php\?name=Forums&file=viewtopic&t=([0-9]*)&amp;start=([0-9]*)'",
		"'(?<!/)modules.php\?name=Forums&file=viewtopic&(p|t)=([0-9]*)'",
		"'(?<!/)modules.php\?name=Forums&file=index'",
		"'(?<!/)modules.php\?name=Your_Account&op=userinfo&uname=([a-zA-Z0-9_-]*)'",
		"'(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;uname=([a-zA-Z0-9_-]*)'",
		"'(?<!/)modules.php\?op=modload&name=Web_Links&file=index&l_op=visit&amp;lid=([0-9]*)'",
		"'(?<!/)modules.php\?op=modload&name=Web_Links&file=index&l_op=viewlink&amp;cid=([0-9]*)'",
		"'(?<!/)modules.php\?name=Web_Links'"
	);

	$replace = array(
		"article\\1.".$autourlsext,
		"article\\1.".$autourlsext,
		"archive-\\1-\\2-\\3.".$autourlsext,
		"archive.".$autourlsext,
		"downloads-file-\\1.".$autourlsext,
		"downloads-cats-\\1-\\2-\\3.".$autourlsext,
		"downloads-cat-\\1.".$autourlsext,
		"downloads-file-\\1-details-\\2.".$autourlsext,
		"downloads.html\"",
		"reviews-\\1.".$autourlsext,
		"reviews-new.".$autourlsext,
		"reviews-comment-\\1-\\2",
		"reviews-\\1-edit.".$autourlsext,
		"reviews-\\1-delete.".$autourlsext,
		"reviews-sortby-\\1.".$autourlsext,
		"reviews.".$autourlsext,
		"submit.".$autourlsext,
		"topics.".$autourlsext,
		"top.".$autourlsext,
		"faq.".$autourlsext,
		"faq-\\1-\\2.".$autourlsext,
		"postx\\1-\\2-\\3.".$autourlsext,
		"forumx\\1-\\2-\\3.".$autourlsext,
		"contentid-\\1.".$autourlsext,
		"content-cat-\\1.".$autourlsext,
		"forum\\1.".$autourlsext,
		"posts\\1-\\2.".$autourlsext,
		"post\\1\\2.".$autourlsext,
		"forums.".$autourlsext,
		"userinfo-\\1.".$autourlsext,
		"userinfo-\\1.".$autourlsext,
		"viewlink-\\1.".$autourlsext,
		"link-\\1.".$autourlsext,
		"links".$autourlsext
	);
	
	$display = preg_replace($search, $replace, $display);

	return $display;
}

function at_admin_autourls($autourls)
{
    extract($autourls);

    if (!$extension) {
        $extension = "phtml";
    }	
    $output = _AT_EXTENSION." .<input type=\"text\" name=\"extension\" value=\"$extension\">\n";
	
	return $output;
}

?>
