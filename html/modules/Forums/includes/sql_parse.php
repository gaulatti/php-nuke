<?php
/***************************************************************************
*                             sql_parse.php
*                              -------------------
*     begin                : Thu May 31, 2001
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*     $Id: sql_parse.php,v 1.8 2002/03/18 23:53:12 psotfx Exp $
*
****************************************************************************/
/***************************************************************************
* phpbb2 forums port version 2.0.5 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Nuke Cops to phpbb2 standalone 2.0.5 Test
* and debugging completed by the Elite Nukers and site members.
*
* You run this package at your sole risk. Nuke Cops and affiliates cannot
* be held liable if anything goes wrong. You are advised to test this
* package on a development system. Backup everything before implementing
* in a production environment. If something goes wrong, you can always
* backout and restore your backups.
*
* Installing and running this also means you agree to the terms of the AUP
* found at Nuke Cops.
*
* This is version 2.0.5 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.0.5 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.5 that fixes some bugs and the
* invalid_session error message.
***************************************************************************/
/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
 *
 ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/***************************************************************************
*
*        These functions are mainly for use in the db_utilities under the admin
*        however in order to make these functions available elsewhere, specifically
*        in the installation phase of phpBB I have seperated out a couple of
*        functions into this file.  JLH
*
\***************************************************************************/

//
// remove_comments will strip the sql comment lines out of an uploaded sql file
// specifically for mssql and postgres type files in the install....
//
function remove_comments(&$output)
{
        $lines = explode("\n", $output);
        $output = "";

        // try to keep mem. use down
        $linecount = count($lines);

        $in_comment = false;
        for($i = 0; $i < $linecount; $i++)
        {
                if( preg_match("/^\/\*/", preg_quote($lines[$i])) )
                {
                        $in_comment = true;
                }

                if( !$in_comment )
                {
                        $output .= $lines[$i] . "\n";
                }

                if( preg_match("/\*\/$/", preg_quote($lines[$i])) )
                {
                        $in_comment = false;
                }
        }

        unset($lines);
        return $output;
}

//
// remove_remarks will strip the sql comment lines out of an uploaded sql file
//
function remove_remarks($sql)
{
        $lines = explode("\n", $sql);

        // try to keep mem. use down
        $sql = "";

        $linecount = count($lines);
        $output = "";

        for ($i = 0; $i < $linecount; $i++)
        {
                if (($i != ($linecount - 1)) || (strlen($lines[$i]) > 0))
                {
                        if ($lines[$i][0] != "#")
                        {
                                $output .= $lines[$i] . "\n";
                        }
                        else
                        {
                                $output .= "\n";
                        }
                        // Trading a bit of speed for lower mem. use here.
                        $lines[$i] = "";
                }
        }

        return $output;

}

//
// split_sql_file will split an uploaded sql file into single sql statements.
// Note: expects trim() to have already been run on $sql.
//
function split_sql_file($sql, $delimiter)
{
        // Split up our string into "possible" SQL statements.
        $tokens = explode($delimiter, $sql);

        // try to save mem.
        $sql = "";
        $output = array();

        // we don't actually care about the matches preg gives us.
        $matches = array();

        // this is faster than calling count($oktens) every time thru the loop.
        $token_count = count($tokens);
        for ($i = 0; $i < $token_count; $i++)
        {
                // Don't wanna add an empty string as the last thing in the array.
                if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
                {
                        // This is the total number of single quotes in the token.
                        $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
                        // Counts single quotes that are preceded by an odd number of backslashes,
                        // which means they're escaped quotes.
                        $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

                        $unescaped_quotes = $total_quotes - $escaped_quotes;

                        // If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
                        if (($unescaped_quotes % 2) == 0)
                        {
                                // It's a complete sql statement.
                                $output[] = $tokens[$i];
                                // save memory.
                                $tokens[$i] = "";
                        }
                        else
                        {
                                // incomplete sql statement. keep adding tokens until we have a complete one.
                                // $temp will hold what we have so far.
                                $temp = $tokens[$i] . $delimiter;
                                // save memory..
                                $tokens[$i] = "";

                                // Do we have a complete statement yet?
                                $complete_stmt = false;

                                for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
                                {
                                        // This is the total number of single quotes in the token.
                                        $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
                                        // Counts single quotes that are preceded by an odd number of backslashes,
                                        // which means they're escaped quotes.
                                        $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

                                        $unescaped_quotes = $total_quotes - $escaped_quotes;

                                        if (($unescaped_quotes % 2) == 1)
                                        {
                                                // odd number of unescaped quotes. In combination with the previous incomplete
                                                // statement(s), we now have a complete statement. (2 odds always make an even)
                                                $output[] = $temp . $tokens[$j];

                                                // save memory.
                                                $tokens[$j] = "";
                                                $temp = "";

                                                // exit the loop.
                                                $complete_stmt = true;
                                                // make sure the outer loop continues at the right point.
                                                $i = $j;
                                        }
                                        else
                                        {
                                                // even number of unescaped quotes. We still don't have a complete statement.
                                                // (1 odd and 1 even always make an odd)
                                                $temp .= $tokens[$j] . $delimiter;
                                                // save memory.
                                                $tokens[$j] = "";
                                        }

                                } // for..
                        } // else
                }
        }

        return $output;
}

?>