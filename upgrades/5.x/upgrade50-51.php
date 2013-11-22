<?php

# File to upgrade from PHP-Nuke 5.0 to the Multilingual PHP-Nuke 5.1 version
# After you used this file, you can safely delete it.
# Change the parameters to fit your info:

#############################################################################
# Multilingual PHP-Nuke 5.1                                                 #
# Provided by Crocket, WebMasters , http://www.webmasters.be                #
#############################################################################

$host 		= "localhost";
$database 	= "nuke";
$username 	= "root";
$password 	= "";
$language 	= "english"; /* You need to set a default language for all the data that is already present in your db,
			        use lowercase to match exactly the language filenames you have installed! */
$prefix 	= "nuke"; /* Your database table's prefix */


mysql_connect($host, $username, $password);
@mysql_select_db($database);

####################### BEGIN ML UPDATE ##################################################

// Add language field for admins , no need to set a default because blank means ALL languages
mysql_query("ALTER TABLE ".$prefix."_authors ADD admlanguage VARCHAR (30) not null ");


// Add language field to automated news and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_autonews ADD alanguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_autonews SET alanguage='$language' ");


// Add language field to blocks, no need to fill up because blank means visible to ALL
mysql_query("ALTER TABLE ".$prefix."_blocks ADD blanguage VARCHAR (30) not null");
mysql_query("ALTER TABLE ".$prefix."_blocks ADD blockfile VARCHAR (255) not null");

// Add language field to ephemerids and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_ephem ADD elanguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_ephem SET elanguage='$language' ");


// Add language field to faq categories and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_faqCategories ADD flanguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_faqCategories SET flanguage='$language' ");


// New Message System : Add message id and language field , fill up with one example to explain
// WARNING : This will drop the existing message table first !!!
mysql_query("DROP TABLE ".$prefix."_message");
$result = mysql_query("CREATE TABLE ".$prefix."_message (
   mid int(11) DEFAULT '0' NOT NULL auto_increment,
   title varchar(100) NOT NULL,
   content text NOT NULL,
   date varchar(14) NOT NULL,
   expire int(7) DEFAULT '0' NOT NULL,
   active int(1) DEFAULT '1' NOT NULL,
   view int(1) DEFAULT '1' NOT NULL,
   mlanguage varchar(30) NOT NULL,
   PRIMARY KEY (mid),
   UNIQUE mid (mid)
)");
mysql_query("INSERT INTO ".$prefix."_message VALUES ( '1', 'New ML Message system', 'The original version allowed the admin to post only 1 message either to \'ALL visitors\' OR \'Anonymous users only\' OR \'Registered users only\' OR \'Admins only\'.<br>The new system allows admin(s) to post <b>multiple</b> messages in <b>multiple languages</b>, visible to different types of users. There is also an option to post a message to ALL languages at once...', '993373194', '0', '1', '1', '')");

// Add language field to poll description and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_poll_desc ADD planguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_poll_desc SET planguage='$language' ");


// Add language field to submitted news in queue and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_queue ADD alanguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_queue SET alanguage='$language' ");


// Add language field to reviews and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_reviews ADD rlanguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_reviews SET rlanguage='$language' ");


// Add language field to waiting reviews and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_reviews_add ADD rlanguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_reviews_add SET rlanguage='$language' ");


// Add language field to articles in sections and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_seccont ADD slanguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_seccont SET slanguage='$language' ");


// Add language field to the stories and fill it up with the default language
mysql_query("ALTER TABLE ".$prefix."_stories ADD alanguage VARCHAR (30) not null ");
mysql_query("UPDATE ".$prefix."_stories SET alanguage='$language' ");

// Stories table alteration to add comments removal option
mysql_query("ALTER TABLE ".$prefix."_stories ADD acomm INT (1) DEFAULT '0' not null");
mysql_query("ALTER TABLE ".$prefix."_autonews ADD acomm INT (1) DEFAULT '0' not null");

echo "Multilingual PHP-Nuke 5.1 update finished<br><br>";
echo "Thanks for your interest...<br>";
echo "Don't forget to copy and replace all the scripts!<br>";

?>
