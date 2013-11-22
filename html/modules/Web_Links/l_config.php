<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on Journey Links Hack                                          */
/* Copyright (c) 2000 by James Knickelbein                              */
/* Journey Milwaukee (http://www.journeymilwaukee.com)                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

######################################################################
# Web Links Preferences (Some variables are valid also for Downloads)
#
# $perpage:      	    	How many links to show on each page?
# $popular:      	    	How many hits need a link to be listed as popular?
# $newlinks:     	    	How many links to display in the New Links Page?
# $toplinks:     	    	How many links to display in The Best Links Page? (Most Popular)
# $linksresults: 	    	How many links to display on each search result page?
# $links_anonaddlinklock:   	Lock Unregistered users from Suggesting New Links? (0=Yes 1=No)
# $anonwaitdays:        	Number of days anonymous users need to wait to vote on a link
# $outsidewaitdays:     	Number of days outside users need to wait to vote on a link (checks IP)
# $useoutsidevoting:        	Allow Webmasters to put vote links on their site (1=Yes 0=No)
# $anonweight:          	How many Unregistered User vote per 1 Registered User Vote?
# $outsideweight:       	How many Outside User vote per 1 Registered User Vote?
# $detailvotedecimal:       	Let Detailed Vote Summary Decimal out to N places. (no max)
# $mainvotedecimal:     	Let Main Vote Summary Decimal show out to N places. (max 4)
# $toplinkspercentrigger:   	1 to Show Top Links as a Percentage (else # of links)
# $toplinks:            	Either # of links OR percentage to show (percentage as whole number. #/100)
# $mostpoplinkspercentrigger:	1 to Show Most Popular Links as a Percentage (else # of links)
# $mostpoplinks:        	Either # of links OR percentage to show (percentage as whole number. #/100)
# $featurebox:          	1 to Show Feature Link Box on links Main Page? (1=Yes 0=No)
# $linkvotemin:         	Number votes needed to make the 'top 10' list
# $blockunregmodify:        	Block unregistered users from suggesting links changes? (1=Yes 0=No)
######################################################################

$perpage = 10;
$popular = 5000;
$newlinks = 10;
$toplinks = 25;
$linksresults = 10;
$links_anonaddlinklock = 1;
$anonwaitdays = 1;
$outsidewaitdays = 1;
$useoutsidevoting = 1;
$anonweight = 10;
$outsideweight = 20;
$detailvotedecimal = 2;
$mainvotedecimal = 1;
$toplinkspercentrigger = 0;
$toplinks = 25;
$mostpoplinkspercentrigger = 0;
$mostpoplinks = 25;
$featurebox = 1;
$linkvotemin = 5;
$blockunregmodify = 1;

?>