<?php
/***************************************************************************
 *                            lang_main.php [Estonian]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_main.php,v 1.85 2002/03/25 19:22:42 dougk_ff7 Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// The format of this file is:
//
// ---> $lang['message'] = "text";
//
// You should also try to set a locale and a character
// encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may
// not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

//setlocale(LC_ALL, "et");
$lang['ENCODING'] = "iso-8859-1";
$lang['DIRECTION'] = "LTR";
$lang['LEFT'] = "VASAK";
$lang['RIGHT'] = "PAREM";
$lang['DATE_FORMAT'] =  "d M Y, G:i"; // This should be changed to the default date format for your language, php date() format

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = "Foorum";
$lang['Category'] = "Kategooria";
$lang['Topic'] = "Teema";
$lang['Topics'] = "Teemad";
$lang['Replies'] = "Vastuseid";
$lang['Views'] = "Vaadatud";
$lang['Post'] = "Teade";
$lang['Posts'] = "Teateid";
$lang['Posted'] = "Postitatud";
$lang['Username'] = "Kasutajanimi";
$lang['Password'] = "Parool";
$lang['Email'] = "e-kiri";
$lang['Poster'] = "Postitaja";
$lang['Author'] = "Autor";
$lang['Time'] = "Aeg";
$lang['Hours'] = "Tundi";
$lang['Message'] = "Sõnum";

$lang['1_Day'] = "1 Päev";
$lang['7_Days'] = "7 Päeva";
$lang['2_Weeks'] = "2 Nädalat";
$lang['1_Month'] = "1 Kuu";
$lang['3_Months'] = "3 Kuud";
$lang['6_Months'] = "6 Kuud";
$lang['1_Year'] = "1 Aasta";

$lang['Go'] = "Mine";
$lang['Jump_to'] = "Hüppa";
$lang['Submit'] = "Saada";
$lang['Reset'] = "Taasta";
$lang['Cancel'] = "Katkesta";
$lang['Preview'] = "Eelvaade";
$lang['Confirm'] = "Kinnita";
$lang['Spellcheck'] = "Õigekirja kontroll";
$lang['Yes'] = "Jah";
$lang['No'] = "Ei";
$lang['Enabled'] = "Võimaldatud";
$lang['Disabled'] = "Mittevõimaldatud";
$lang['Error'] = "Viga";

$lang['Next'] = "Järgmine";
$lang['Previous'] = "Eelmine";
$lang['Goto_page'] = "Mine lehele";
$lang['Joined'] = "Liitunud";
$lang['IP_Address'] = "IP Aadress";

$lang['Select_forum'] = "Vali foorum";
$lang['View_latest_post'] = "Vaata viimast teadet";
$lang['View_newest_post'] = "Vaata uusimat teadet";
$lang['Page_of'] = "Lehekülg <b>%d</b>, kokku lehekülgi <b>%d</b>"; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = "ICQ Number";
$lang['AIM'] = "AIM Aadress";
$lang['MSNM'] = "MSN Messenger";
$lang['YIM'] = "Yahoo Messenger";

$lang['Forum_Index'] = "%s ";  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = "Uus teema";
$lang['Reply_to_topic'] = "Vasta sellele teemale";
$lang['Reply_with_quote'] = "Vasta viitega";

$lang['Click_return_topic'] = "Vajuta %ssiia%s, et pealkirja juurde tagasi pöörduda"; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = "Vajuta %ssiia%s, et proovida uuesti";
$lang['Click_return_forum'] = "Vajuta %ssiia%s, et minna tagasi foorumile";
$lang['Click_view_message'] = "Vajuta %ssiia%s, et vaadata oma postitust";
$lang['Click_return_modcp'] = "Vajuta %ssiia%s, et minna tagasi Moderaatori Kontrolpaneeli";
$lang['Click_return_group'] = "Vajuta %ssiia%s, et minna tagasi grupi info juurde";

$lang['Admin_panel'] = "Mine Administrationipaneeli";
$lang['Board_disable'] = "Kahjuks on see tahvel ajutiselt kättesaamatu. Proovi palun hiljem uuesti.";
//
// Global Header strings
//
$lang['Registered_users'] = "Foorumil olevad liitunud kasutajad:";
$lang['Browsing_forum'] = "Kasutajaid seda foorumit uurimas:";
$lang['Online_users_zero_total'] = "Foorumil pole ühtegi kasutajat";
$lang['Online_users_total'] = "Kokku on <b>%d</b> kasutajat foorumil";
$lang['Online_user_total'] = "Kokku on foorumil <b>%d</b> kasutaja - ";
$lang['Reg_users_zero_total'] = "Pole ühtegi liitunud kasutajat,";
$lang['Reg_users_total'] = "%d liitunud kasutaja, ";
$lang['Reg_user_total'] = "%d liitunud kasutaja, ";
$lang['Hidden_users_zero_total'] = "pole ühtegi varjatud kasutajat ja ";
$lang['Hidden_user_total'] = "foorumil on %d varjatud kasutaja ja ";
$lang['Hidden_users_total'] = "foorumil on %d varjatud kasutajat ja ";
$lang['Guest_users_zero_total'] = "pole ühtegi külalist";
$lang['Guest_users_total'] = "on %d külalist";
$lang['Guest_user_total'] = "on %d külaline";
$lang['Record_online_users'] = "Rekordarv kasutajaid (%s) oli foorumil %s"; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = "%sAdministraator%s";
$lang['Mod_online_color'] = "%sModeraator%s";

$lang['You_last_visit'] = "Viimati külastasid %s"; // %s replaced by date/time
$lang['Current_time'] = "%s"; // %s replaced by time

$lang['Search_new'] = "Vaata vahepeal postitatud teateid";
$lang['Search_your_posts'] = "Vaata oma teateid";
$lang['Search_unanswered'] = "Vaata vastamata teateid";

$lang['Register'] = "Liitu";
$lang['Profile'] = "Profiil";
$lang['Edit_profile'] = "Muuda oma profiili";
$lang['Search'] = "Otsi";
$lang['Memberlist'] = "Kasutajate nimekiri";
$lang['FAQ'] = "Abi";
$lang['BBCode_guide'] = "BBKoodi Juhend";
$lang['Usergroups'] = "Kasutajagrupid";
$lang['Last_Post'] = "Värskeim teade";
$lang['Moderator'] = "Moderaator";
$lang['Moderators'] = "Moderaatorid";

//
// Stats block text
//
$lang['Posted_articles_zero_total'] = "Pole postitanud ühtki teadet"; // Number of posts
$lang['Posted_articles_total'] = "Kasutajad on kokku postitanud <b>%d</b> teadet"; // Number of posts
$lang['Posted_article_total'] = "Kokku on postiatud <b>%d</b> teade"; // Number of posts
$lang['Registered_users_zero_total'] = "Pole ühtegi liitunud kasutajat"; // # registered users
$lang['Registered_users_total'] = "Kokku on <b>%d</b> liitunud kasutajat"; // # registered users
$lang['Registered_user_total'] = "Kokku on <b>%d</b> liitunud kasutaja"; // # registered users
$lang['Newest_user'] = "Värskeim liitunud kasutaja on <b>%s%s%s</b>"; // a href, username, /a

$lang['No_new_posts_last_visit'] = "Vahepaeal pole postitatud uusi teateid";
$lang['No_new_posts'] = "Pole uusi teateid";
$lang['New_posts'] = "Uued teated";
$lang['New_post'] = "Uus teade";
$lang['No_new_posts_hot'] = "Pole uusi teateid [ Populaarne ]";
$lang['New_posts_hot'] = "Uued teated [ Populaarne ]";
$lang['No_new_posts_locked'] = "Pole uusi teateid [ Kinni ]";
$lang['New_posts_locked'] = "Uued teated [ Kinni ]";
$lang['Forum_is_locked'] = "Foorum on kinni";
//
// Login
//
$lang['Enter_password'] = "Sisesta oma kasutajanimi ja parool";
$lang['Login'] = "Logi sisse";
$lang['Logout'] = "Logi välja";
$lang['Forgotten_password'] = "Unustasid oma parooli?";
$lang['Log_me_in'] = "Logi mind alati automaatselt sisse";
$lang['Error_login'] = "Sisestatud kasutajanimi või parool oli vale.";
//
// Index page
//
$lang['Index'] = "Sisukord";
$lang['No_Posts'] = "Pole teateid";
$lang['No_forums'] = "Sellel tahvlil pole foorumeid";

$lang['Private_Message'] = "Privaatsõnum";
$lang['Private_Messages'] = "Privaatsõnumid";
$lang['Who_is_Online'] = "Kes on foorumil";

$lang['Mark_all_forums'] = "Märgi kõik foorumid loetuks";
$lang['Forums_marked_read'] = "Kõik foorumid on märgitud loetuks";
//
// Viewforum
//
$lang['View_forum'] = "Vaata foorumit";

$lang['Forum_not_exist'] = "Foorumit ei ole olemas";
$lang['Reached_on_error'] = "Sellel lehel on viga";

$lang['Display_topics'] = "Reasta postitused eelmise järgi";
$lang['All_Topics'] = "Kõik teemad";

$lang['Topic_Announcement'] = "<b>Teadanne:</b>";
$lang['Topic_Sticky'] = "<b>Kleeps:</b>";
$lang['Topic_Moved'] = "<b>Liigutatud:</b>";
$lang['Topic_Poll'] = "<b>[ Küsitlus ]</b>";

$lang['Mark_all_topics'] = "Märgi kõik teemad loetuks";
$lang['Topics_marked_read'] = "Selle foorumi teemad on märgitud loetuks";

$lang['Rules_post_can'] = "Sa <b>saad</b> algatada uusi teemasid selles foorumis";
$lang['Rules_post_cannot'] = "Sa <b>ei saa</b> teha algatada uusi teemasid selles foorumis";
$lang['Rules_reply_can'] = "Sa <b>saad</b> vastata teemadele selles foorumis";
$lang['Rules_reply_cannot'] = "Sa <b>ei saa</b> vastata teemdaele selles foorumis";
$lang['Rules_edit_can'] = "Sa <b>saad</b> muuta oma teateid selles foorumis";
$lang['Rules_edit_cannot'] = "Sa <b>ei saa</b> muuta oma teateid selles foorumis";
$lang['Rules_delete_can'] = "Sa <b>saad</b> kustutada oma teateid selles foorumis";
$lang['Rules_delete_cannot'] = "Sa <b>ei saa</b> kustutada oma teateid selles foorumis";
$lang['Rules_vote_can'] = "Sa <b>saad</b> hääletada küsitlustes selles foorumis";
$lang['Rules_vote_cannot'] = "Sa <b>ei saa</b> hääletada küsitlustes selles foorumis";
$lang['Rules_moderate'] = "Sa <b>saad</b> %smodereerida seda foorumit%s"; // %s replaced by a href links, do not remove!

$lang['No_topics_post_one'] = "Siin foorumis pole uusi teateid <br />Vajuta <b>Uus teade</b> lingile, et postitada uus teade";
//
// Viewtopic
//
$lang['View_topic'] = "Vaata teemat";

$lang['Guest'] = 'Külaline';
$lang['Post_subject'] = "Postita teema";
$lang['View_next_topic'] = "Vaata järgmist teemat";
$lang['View_previous_topic'] = "Vaata eelmist teemat";
$lang['Submit_vote'] = "Hääleta";
$lang['View_results'] = "Vaata tulemusi";

$lang['No_newer_topics'] = "Selles foorumis pole uusi teemasid";
$lang['No_older_topics'] = "Selles foorumis pole vanemaid teemasid";
$lang['Topic_post_not_exist'] = "Teemat, mida te otsisite, ei leitud";
$lang['No_posts_topic'] = "Selle teema kohta pole postitaud teateid";

$lang['Display_posts'] = "Reasta teated eelmise järgi";
$lang['All_Posts'] = "Kõik teated";
$lang['Newest_First'] = "Uuemad ennet";
$lang['Oldest_First'] = "Vanemad enne";

$lang['Back_to_top'] = "Tagasi üles";

$lang['Read_profile'] = "Vaata kasutaja profiili";
$lang['Send_email'] = "Saada kasutajale e-kiri";
$lang['Visit_website'] = "Külasta postitaja kodulehekülge";
$lang['ICQ_status'] = "ICQ staatus";
$lang['Edit_delete_post'] = "Muuda/Kustuta see teade";
$lang['View_IP'] = "Vaata postitaja IP'd";
$lang['Delete_post'] = "Kustuta see teade";

$lang['wrote'] = "kirjutas"; // proceeds the username and is followed by the quoted text
$lang['Quote'] = "Tsiteerin:"; // comes before bbcode quote output.
$lang['Code'] = "Kood"; // comes before bbcode code output.

$lang['Edited_time_total'] = "Viimati muudetud %s poolt (%s), kokku muudetud %d korda"; // Last edited by me on 12 Oct 2001, edited 1 time in total
$lang['Edited_times_total'] = "Viimati muutis %s (%s), kokku muudetud %d korda"; // Last edited by me on 12 Oct 2001, edited 2 times in total

$lang['Lock_topic'] = "Sule see teema";
$lang['Unlock_topic'] = "Ava see teema";
$lang['Move_topic'] = "Liiguta seda teemat";
$lang['Delete_topic'] = "Kustuta see teema";
$lang['Split_topic'] = "Poolita see teema";

$lang['Stop_watching_topic'] = "Lõpeta selle teema jälgimine";
$lang['Start_watching_topic'] = "Jälgi seda teemat uute postitusteni";
$lang['No_longer_watching'] = "Sa ei jälgi enam seda teemat";
$lang['You_are_watching'] = "Sa jälgid praegu seda teemat";

$lang['Total_votes'] = "Hääli kokku";

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = "Teate sisu";
$lang['Topic_review'] = "Teema ülevaade";

$lang['No_post_mode'] = "Postitusviis valimata"; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = "Uus teema";
$lang['Post_a_reply'] = "Vasta";
$lang['Post_topic_as'] = "Postita teema nagu";
$lang['Edit_Post'] = "Muuda";
$lang['Options'] = "Valikud";

$lang['Post_Announcement'] = "Teadanne";
$lang['Post_Sticky'] = "Kleeps";
$lang['Post_Normal'] = "Tavaline";

$lang['Confirm_delete'] = "Oled sa kindel, et soovid seda teadet kustutada?";
$lang['Confirm_delete_poll'] = "Oled sa kindel, et soovid seda küsitlust kustutada??";

$lang['Flood_Error'] = "Sa ei saa teha postitusi üksteise järel. Palun oota natuke ja proovi uuesti.";
$lang['Empty_subject'] = "Sa pead teemale ka pealkirja panema";
$lang['Empty_message'] = "Sa pead teatesse ka midagi kirjutama";
$lang['Forum_locked'] = "See foorum on suletud ja sa ei saa postitada ega muuta oma teateid.";
$lang['Topic_locked'] = "See teema on suletud ja sa ei saa postitada ega muuta oma teateid.";
$lang['No_post_id'] = "Sa pead kõigepealt valima teate, et seda muuta";
$lang['No_topic_id'] = "Sa pead kõigepealt valima teema millele soovid vastata";
$lang['No_valid_mode'] = "Sa saad ainult postitada, muuta, tsiteerida või vastata postitustele. Proovi palun uuesti";
$lang['No_such_post'] = "Sellist teadet pole. Mine tagasi ja proovi uuesti";
$lang['Edit_own_posts'] = "Sa saad muuta ainult oma teateid";
$lang['Delete_own_posts'] = "Sa saad kustutada ainult oma teateid";
$lang['Cannot_delete_replied'] = "Sa ei saa teateid postitust millele on vastatud";
$lang['Cannot_delete_poll'] = "Sa ei saa kustutada aktiivset küsitlust";
$lang['Empty_poll_title'] = "Sa pead oma küsitlusele lisama ka pealkirja";
$lang['To_few_poll_options'] = "Sa pead andma küsitlusele vähemalt kaks valikuvõimalust";
$lang['To_many_poll_options'] = "Sa üritasid anda küsitlusele liiga palju valikuvõimalusi";
$lang['Post_has_no_poll'] = "Sellel teateid pole küsitlus";

$lang['Add_poll'] = "Lisa küsitlus";
$lang['Add_poll_explain'] = "Kui sa ei soovi lisada oma postitusele küsitlust, siis jäta järgnevad väljad lihtsalt tühjaks";
$lang['Poll_question'] = "Küsitluse alune küsimus";
$lang['Poll_option'] = "Küsitluse valikuvõimalus";
$lang['Add_option'] = "Lisa valikuvõimalus";
$lang['Update'] = "Uuenda";
$lang['Delete'] = "Kustuta";
$lang['Poll_for'] = "Küsitlus on aktiivne";
$lang['Days'] = "päeva"; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = "[ Sisesta 0 või jäta tühjaks kui soovid, et küsitlus ei lõppeks. ]";
$lang['Delete_poll'] = "Kustuta küsitlus";

$lang['Disable_HTML_post'] = "Ära luba HTML'i selles teates";
$lang['Disable_BBCode_post'] = "Ära luba BBKoodi selles teates";
$lang['Disable_Smilies_post'] = "Ära luba emotsioone selles teates";

$lang['HTML_is_ON'] = "HTML on <u>sees</u>";
$lang['HTML_is_OFF'] = "HTML on <u>väljas</u>";
$lang['BBCode_is_ON'] = "%sBBCode%s on <u>sees</u>"; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = "%sBBCode%s on <u>väljas</u>";
$lang['Smilies_are_ON'] = "Emotsioonid on <u>sees</u>";
$lang['Smilies_are_OFF'] = "Emotsioonid on <u>väljas</u>";

$lang['Attach_signature'] = "Lisa allkiri (allkirju saab muuta profiilis)";
$lang['Notify'] = "Teata kui keegi vastab sellele teatele";
$lang['Delete_post'] = "Kustuta see teade";

$lang['Stored'] = "Sinu teade on edukalt sisestatud";
$lang['Deleted'] = "Sinu teade on edukalt kustutatud";
$lang['Poll_delete'] = "Sinu ksüitlus on edukalt kustutatud";
$lang['Vote_cast'] = "Sinu hääl on arvesse võetud";

$lang['Topic_reply_notification'] = "Teavitus teemale vastamisest";

$lang['bbcode_b_help'] = "Rasvane tekst: [b]tekst[/b]  (alt+b)";
$lang['bbcode_i_help'] = "Kursiivtekst: [i]tekst[/i]  (alt+i)";
$lang['bbcode_u_help'] = "Allajoonitud tekst: [u]tekst[/u]  (alt+u)";
$lang['bbcode_q_help'] = "Tsitaat: [quote]tekst[/quote]  (alt+q)";
$lang['bbcode_c_help'] = "Kood: [code]kood[/code]  (alt+c)";
$lang['bbcode_l_help'] = "Nimekiri: [list]tekst[/list] (alt+l)";
$lang['bbcode_o_help'] = "Korrastatud nimekiri: [list=]tekst[/list]  (alt+o)";
$lang['bbcode_p_help'] = "Sisesta pilt: [img]http://image_url[/img]  (alt+p)";
$lang['bbcode_w_help'] = "Sisesta URL: [url]http://url[/url] või [url=http://url]URL tekst[/url]  (alt+w)";
$lang['bbcode_a_help'] = "Sulge kõik BBCode käsud";
$lang['bbcode_s_help'] = "Teksti värvus: [color=red]tekst[/color]  Tip: you can also use color=#FF0000";
$lang['bbcode_f_help'] = "Teksti suurus: [size=x-small]väike tekst[/size]";

$lang['Emoticons'] = "Emotsioonid";
$lang['More_emoticons'] = "Veel smalisi";

$lang['Font_color'] = "Teksti värv";
$lang['color_default'] = "Tavaline";
$lang['color_dark_red'] = "Tumepunane";
$lang['color_red'] = "Punane";
$lang['color_orange'] = "Oranz";
$lang['color_brown'] = "Pruun";
$lang['color_yellow'] = "Kollane";
$lang['color_green'] = "Roheline";
$lang['color_olive'] = "Oliiv";
$lang['color_cyan'] = "Helesinine";
$lang['color_blue'] = "Sinine";
$lang['color_dark_blue'] = "Tumesinine";
$lang['color_indigo'] = "Indigo";
$lang['color_violet'] = "Lilla";
$lang['color_white'] = "Valge";
$lang['color_black'] = "Must";

$lang['Font_size'] = "Teksti suurus";
$lang['font_tiny'] = "Pisike";
$lang['font_small'] = "Väike";
$lang['font_normal'] = "Normaalne";
$lang['font_large'] = "Suur";
$lang['font_huge'] = "Hiiglaslik";

$lang['Close_Tags'] = "Sulge käsud";
$lang['Styles_tip'] = "Soovitus: Stiile saab kiiresti lisada selekteeritud tekstile";


//
// Private Messaging
//
$lang['Private_Messaging'] = "Privaatsõnumid";

$lang['Login_check_pm'] = "Logi sisse, et kontrollida oma privaatsõnumeid";
$lang['New_pms'] = "Sul on %d uut sõnumit"; // You have 2 new messages
$lang['New_pm'] = "Sul on %d uus sõnum"; // You have 1 new message
$lang['No_new_pm'] = "Sul ei ole uusi sõnumeid";
$lang['Unread_pms'] = "Sul on %d lugemata sõnumit";
$lang['Unread_pm'] = "Sul on %d lugemata sõnum";
$lang['No_unread_pm'] = "Sul ei ole lugemata sõnumeid";
$lang['You_new_pm'] = "Uus privaatteade ootab sind Inbox'is";
$lang['You_new_pms'] = "Uued privaatteated ootavad sind Inbox'is";
$lang['You_no_new_pm'] = "Sulle pole uusi privaatsõnumeid";

$lang['Inbox'] = "Inbox";
$lang['Outbox'] = "Outbox";
$lang['Savebox'] = "Salvestatud";
$lang['Sentbox'] = "Saadetud";
$lang['Flag'] = "Märgista";
$lang['Subject'] = "Pealkiri";
$lang['From'] = "Kellelt";
$lang['To'] = "Kellele";
$lang['Date'] = "Kuupäev";
$lang['Mark'] = "Märgista";
$lang['Sent'] = "Saadetud";
$lang['Saved'] = "Salvestatud";
$lang['Delete_marked'] = "Kustuta märgistatud sõnumid";
$lang['Delete_all'] = "kustuta kõik sõnumid";
$lang['Save_marked'] = "Salvesta märgitud sõnumid";
$lang['Save_message'] = "Salvesta sõnum";
$lang['Delete_message'] = "Kustuta sõnum";

$lang['Display_messages'] = "Reasta sõnumid eelmise järgi"; // Followed by number of days/weeks/months
$lang['All_Messages'] = "Kõik sõnumid";

$lang['No_messages_folder'] = "Sul pole siin kaustas uusi sõnumeid";

$lang['PM_disabled'] = "Selel tahvlil ei saa privaatteateid saata";
$lang['Cannot_send_privmsg'] = "Administraator on keelanud sulle privaatsõnumite saatmise";
$lang['No_to_user'] = "Sa pead sisestama kasutajanime, et saata seda sõnumit";
$lang['No_such_user'] = "Sellist kasutajat ei ole";

$lang['Disable_HTML_pm'] = "Keela HTML selles teates";
$lang['Disable_BBCode_pm'] = "Keela BBKood selles teates";
$lang['Disable_Smilies_pm'] = "Keela emotsioonid selles teates";

$lang['Message_sent'] = "Sinu teade on saadetud";

$lang['Click_return_inbox'] = "Vajuta %ssiia%s, et minna tagasi oma Inbox'i";
$lang['Click_return_index'] = "Vajuta %ssiia%s, et minna tagasi oma algusesse";

$lang['Send_a_new_message'] = "Saada uus privaatsõnum";
$lang['Send_a_reply'] = "Vasta privaatsõnumile";
$lang['Edit_message'] = "Muuda privaatsõnumit";

$lang['Notification_subject'] = "Uus privaatsõnum on vastuvõetud";

$lang['Find_username'] = "Otsi kasutajanime";
$lang['Find'] = "Otsi";
$lang['No_match'] = "Otsing jäi tulemuseta";

$lang['No_post_id'] = "Täpsusta posti ID";
$lang['No_such_folder'] = "Selist kausta ei ole olemas";
$lang['No_folder'] = "Täpsusta kaust";

$lang['Mark_all'] = "Märgista kõik";
$lang['Unmark_all'] = "Võta märk maha kõigilt";

$lang['Confirm_delete_pm'] = "Oled sa kindel, et soovid seda teadet kustutada?";
$lang['Confirm_delete_pms'] = "Oled sa kindel, et soovid neid teateid kustutada?";

$lang['Inbox_size'] = "Su Inbox kaust on %d%% täis"; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = "Su Saadetud kaust on %d%% täis";
$lang['Savebox_size'] = "Su Salvestatud kaust %d%% täis";

$lang['Click_view_privmsg'] = "Vajuta %ssiia%s, et külastada oma Inbox'i";


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = "Vaatad %s profiili"; // %s is username
$lang['About_user'] = "Kõik %s kohta"; // %s is username
$lang['Preferences'] = "Eelistused";
$lang['Items_required'] = "* (tärniga) märgitud väljad on kohustuslikud";
$lang['Registration_info'] = "Liitumisinfo";
$lang['Profile_info'] = "Profiili info";
$lang['Profile_info_warn'] = "See dokument on avalikusele nähtav";
$lang['Avatar_panel'] = "Avatari seadistused";
$lang['Avatar_gallery'] = "Avatari galerii";
$lang['Website'] = "Kodulehekülg";
$lang['Location'] = "Asukoht";
$lang['Contact'] = "Kasutaja kontakt andmed: ";
$lang['Email_address'] = "e-posti aadress";
$lang['Email'] = "e-kiri";
$lang['Send_private_message'] = "Saada privaatteade";
$lang['Hidden_email'] = "[ Peidetud ]";
$lang['Search_user_posts'] = "Otsi selle kasutaja postitusi";
$lang['Interests'] = "Huvid";
$lang['Occupation'] = "Tegevusala";
$lang['Poster_rank'] = "Tase";

$lang['Total_posts'] = "Poste kokku";
$lang['User_post_pct_stats'] = "%.2f%% kõigist postitustest"; // 1.25% of total
$lang['User_post_day_stats'] = "%.2f päevas"; // 1.5 posts per day
$lang['Search_user_posts'] = "Otsi kõiki %s postitusi"; // Find all posts by username
$lang['No_user_id_specified'] = "Seda kasutajat ei eksisteeri";
$lang['Wrong_Profile'] = "Sa saad muuta ainult enda profiili.";
$lang['Only_one_avatar'] = "Ainult ühte tüüpi avatar";
$lang['File_no_data'] = "URL aadress oli vigane";
$lang['No_connection_URL'] = "URL'iga ei saadud ühendust";
$lang['Incomplete_URL'] = "URL mille te sisestasite on ebatäpne";
$lang['Wrong_remote_avatar_format'] = "Avatari URL oli ebatäpne";
$lang['No_send_account_inactive'] = "Kahjuks ei saa teie parooli näidata kuna teie konto ei ole aktiivne. Kontakteeruge administraatoriga";
$lang['Always_smile'] = "Alati näita emotsioone";
$lang['Always_html'] = "Alati luba HTML";
$lang['Always_bbcode'] = "Alati luba BBKood";
$lang['Always_add_sig'] = "Alati lisa allkiri";
$lang['Always_notify'] = "Alati teata mulle kui keegi vastab";
$lang['Always_notify_explain'] = "Sulle saadetakse e-kiri kui keegi vastab sellele teemale. Seda saad muuta alati kui postitad";

$lang['Board_style'] = "Tahvli stiil";
$lang['Board_lang'] = "Tahvli keel";
$lang['No_themes'] = "Andmebaasis pole theme'si";
$lang['Timezone'] = "Ajatsoon";
$lang['Date_format'] = "Kuupäeva formaat";
$lang['Date_format_explain'] = "The syntax used is identical to the PHP <a href=\"http://www.php.net/date\" target=\"_other\">date()</a> function";
$lang['Signature'] = "Allkiri";
$lang['Signature_explain'] = "See tekstijupp lisatakse sinu postituste lõppu. %d kirjamärki maksimum";
$lang['Public_view_email'] = "Alati näita e-posti aadressi";

$lang['Current_password'] = "Praegune parool";
$lang['New_password'] = "Uus parool";
$lang['Confirm_password'] = "Parool uuesti";
$lang['Confirm_password_explain'] = "Sa pead kinnitama on praeguse parooli kui sa soovid seda vahetada";
$lang['password_if_changed'] = "Parooli sisetamine on vajalik ainult siis kui sa seda muuta soovid";
$lang['password_confirm_if_changed'] = "Parooli teistkordne sisestamine on vajalik ainult siis kui sa sisestasid parooli ka ülemisse lahtrisse";

$lang['Avatar'] = "Avatar";
$lang['Avatar_explain'] = "Avatar näitab sinu detailide all väikest pilti mille järgi on sind kergem ära tunda. Ainult üks pilt võib olla korraga avatariks. Selle laius saab olla %d pikslit, ja kõrgus %d pikslit. faili suurus ei tohi ületada %dkB."; $lang['Upload_Avatar_file'] = "Upload Avatar from your machine";
$lang['Upload_Avatar_URL'] = "Lae ülesse Avatar URL'i kaudu";
$lang['Upload_Avatar_URL_explain'] = "Sisesta oma avatari URL. Avatar kopeeritakse siis siia saidile.";
$lang['Pick_local_Avatar'] = "Vali avatar galeriist";
$lang['Link_remote_Avatar'] = "Vali avatar mujalt netist";
$lang['Link_remote_Avatar_explain'] = "Sisesta avatari URL.";
$lang['Avatar_URL'] = "Avatari URL";
$lang['Select_from_gallery'] = "Vali avatar galeriist";
$lang['View_avatar_gallery'] = "Vaata galeriid";

$lang['Select_avatar'] = "Vali avatar";
$lang['Return_profile'] = "Katkesta";
$lang['Select_category'] = "Vali kategooria";

$lang['Delete_Image'] = "Kustuta pilt";
$lang['Current_Image'] = "Praegune pilt";

$lang['Notify_on_privmsg'] = "Teata kui saabub privaatteade";
$lang['Popup_on_privmsg'] = "Uue privaatteate saabumisel avan selle uues aknas?";
$lang['Popup_on_privmsg_explain'] = "Mõned themed võivad avaneda uues aknas, et sind informeerida sind uuest Privaatsest Sõnumist";
$lang['Hide_user'] = "Varja oma foorumilolekut        ";

$lang['Profile_updated'] = "Teie profiili on uuendatud";
$lang['Profile_updated_inactive'] = "Teie profiili on uuendatud, kuid sa oled muutnud tähtsaid detaile mille läbi on su konto nüüd mitteaktiivne. Kontrolli oma e-posti, et saada juhiseid oma konto taastamiseks. Kui administraatori nõusolek on vajalik siis pead ootama kuni admin su konto taastab.";

$lang['Password_mismatch'] = "Paroolid mida te sisestasite ei kattu";
$lang['Current_password_mismatch'] = "Parool mida te sisestasite ei kattu tollega, mis on andmebaasis";
$lang['Password_long'] = "Parooli maksimumpikkus on 32 tähemärki";
$lang['Username_taken'] = "Kasutajanimi on juba kasutusel";
$lang['Username_invalid'] = "See kasutajanimi sisaldab keelatud tähemärki";
$lang['Username_disallowed'] = "Seda kasutajanime pole lubatud kasutada";
$lang['Email_taken'] = "E-posti aadress mille sa sisestasid, on juba kellegi poolt kasutusel";
$lang['Email_banned'] = "See e-posti aadress on bannitud";
$lang['Email_invalid'] = "E-posti aadress on vigane";
$lang['Signature_too_long'] = "Allkiri on liiga pikk";
$lang['Fields_empty'] = "Tuleb täita kõik nõutud väljad";
$lang['Avatar_filetype'] = "Avatari faililaiend peavad olema kas .jpg, .gif või .png";
$lang['Avatar_filesize'] = "Avatar peab olema väiksem kui %d KB"; // The avatar image file size must be less than 6 kB
$lang['Avatar_imagesize'] = "Avatar peab olema väiksem kui %d pikselit laiust ja %d pikselit kõrgust";

$lang['Welcome_subject'] = "Teretulemast %s Foorumisse"; // Welcome to my.com forums
$lang['New_account_subject'] = "Uus kasutaja";
$lang['Account_activated_subject'] = "Konto aktiveeritud";

$lang['Account_added'] = "Täname sind liitumise eest, su konto on nüüd valmis. Sa võid oma kasutajanime ja parooliga nüüd sisse logida";
$lang['Account_inactive'] = "Teie kasutajakonto on loodud. Kuna see foorum nõuab kasutajakontode aktiveerimist - vastavad juhised saadeti teile e-postiga.";
$lang['Account_inactive_admin'] = "Teie kasutajakonto on loodud. Enne selle kasutamist peab selle aktiveerima foorumi administraator. Administraatorit on teie soovist teavitatud, aktiveerimise korral saate vastava teate e-postiga";
$lang['Account_active'] = "Su konto on nüüd aktiveeritud. Täname liitumise eest.";
$lang['Account_active_admin'] = "Konto on nüüd aktiveeritud";
$lang['Reactivate'] = "Reaktiveeri oma konto!";
$lang['COPPA'] = "Su konto on valmis, kuid vajab kinnitamist. Palun kontrolli oma e-posti rohkema info jaoks.";

$lang['Registration'] = "Liitumine";
$lang['Reg_agreement'] = "Foorum on mõeldud operatiivseks ja mugavaks EPTL-i siseseks infovahetuseks. Foorumi administraator ja moderaatorid omavad foorumi koristamis ja korrastamise eesmärgil õigust infot ümber tõsta ning mittevajalikke teateid kustudada. Foorumil avaldatud info salvestatakse andmebaasi. Seda infot ei jagata kolmadatele isikutele, kui aga nii juhtub, ei ole foorum ega moderaatorid vastutavad häkkimiskatsete eest, mis võivad infot paljastada (sellise juhtumi tõenäosus on väga väike, kuna ka juurdepääs sellele foorumile on parooliga kaitstud - tegu pole avaliku foorumiga). See foorum kasutab küpsiseid, (cookies). Nendes küpsistes pole ühtegi asja sellest infost, mida te ülalpool sisestasite - nad on ainult selleks, et foorumi kasutamist mugavamaks muuta. E-posti kasutatakse ainult sinu informeerimiseks ja paroolide saatmiseks. Kui te vajutad liitumise nupule, nõustute nende tingimustega.";

$lang['Agree_under_13'] = "Ma nõustun nende tingimustega, kuid olen noorem kui 13";
$lang['Agree_over_13'] = "Ma nõustun nende tingimustega ja olen vanem, kui 13";
$lang['Agree_not'] = "Ma ei nõustu nende tingimustega ";

$lang['Wrong_activation'] = "Sinu aktiveerimise kood ei klapi meie andmebaasiga";
$lang['Send_password'] = "Saada uus parool";
$lang['Password_updated'] = "Uus parool on saadetud sinu e-posti aadressile palun kontrolli on posti ja saad teada kuidas seda käivitada";
$lang['No_email_match'] = "E-posti aadress mille te sisestasite ei ole sama mis kasutaja nimele registreeritud";
$lang['New_password_activation'] = "Uus parooli aktiveerimine";
$lang['Password_activated'] = "Teie kasutajakonto on aktiveeritud. Sisse logimiseks kasutage parooli, mille saite e-postiga";

$lang['Send_email_msg'] = "Saade e-kiri";
$lang['No_user_specified'] = "Kasutaja nime ei ole märgitud";
$lang['User_prevent_email'] = "See kasutaja ei soovi e-kirju vastu võtta. Proovige saata talle erasõnum";
$lang['User_not_exist'] = "Sellist kasutajat ei eksisteeri";
$lang['CC_email'] = "Saada endale koopia sellest e-kirjast";
$lang['Email_message_desc'] = "See kiri saadetakse tavalise tekstina - ärge pange siia HTML-i või BBKood-i. Vastamisaadress saadetakse teie e-posti aadressile.";
$lang['Flood_email_limit'] = "Sa ei saa saata praegu teist e-kirja, proovi natukese aja pärast uuesti";
$lang['Recipient'] = "Vastuvõtja";
$lang['Email_sent'] = "E-kiri on saadetud";
$lang['Send_email'] = "Saada e-kiri";
$lang['Empty_subject_email'] = "Sa pead panema e-kirjale pealkirja";
$lang['Empty_message_email'] = "Sa pead sisestama teate mida võiks saata";


//
// Memberslist
//
$lang['Select_sort_method'] = "Vali sorteerimis meetod";
$lang['Sort'] = "Sorteeri";
$lang['Sort_Top_Ten'] = "Top10 Postitajat";
$lang['Sort_Joined'] = "Liitumise kuupäeva";
$lang['Sort_Username'] = "Kasutajanime";
$lang['Sort_Location'] = "Asukoha";
$lang['Sort_Posts'] = "Postituste arvu";
$lang['Sort_Email'] = "E-kirja";
$lang['Sort_Website'] = "Kodulehe";
$lang['Sort_Ascending'] = "Tõusvas";
$lang['Sort_Descending'] = "Kahanevas";
$lang['Order'] = "Korrasta";


//
// Group control panel
//
$lang['Group_Control_Panel'] = "Grupi kontrol paneel";
$lang['Group_member_details'] = "Grupi liikmete detailid";
$lang['Group_member_join'] = "Liitu grupiga";

$lang['Group_Information'] = "Grupi info";
$lang['Group_name'] = "Grupi nimi";
$lang['Group_description'] = "Grupi kirjeldus";
$lang['Group_membership'] = "Grupi liikmsekond";
$lang['Group_Members'] = "Grupi liikmed";
$lang['Group_Moderator'] = "Grupi moderaator";
$lang['Pending_members'] = "Ootel liikmed";
$lang['Group_type'] = "Grupi tüüp";
$lang['Group_open'] = "Avatud grupp";
$lang['Group_closed'] = "Suletud grupp";
$lang['Group_hidden'] = "Varjatud grupp";
$lang['Current_memberships'] = "Praegune liikmeskond";
$lang['Non_member_groups'] = "Mitte liikmelised grupid";
$lang['Memberships_pending'] = "Liikmeskonnad pending";
$lang['No_groups_exist'] = "Ei ole gruppe";
$lang['Group_not_exist'] = "See kasutajagrupp ei eksisteeri";
$lang['Join_group'] = "Liitu grupiga";
$lang['No_group_members'] = "Sellel grupil pole liikmeid";
$lang['Group_hidden_members'] = "See grupp on varjatud";
$lang['No_pending_group_members'] = "Selles grupis ei ole ootel kasutajaid";
$lang["Group_joined"] = "Oled saatnud edukalt grupiga liitumistaotluse<br />Sulle antakse teada kui grupi moderaator on sind gruppi lisanud";
$lang['Group_request'] = "On tehtud soov sinu grupiga ühineda";
$lang['Group_approved'] = "Sinu taotlus on heaks kiidetud";
$lang['Group_added'] = "Sa oled lisatud kasutajate hulka";
$lang['Already_member_group'] = "Sa oled juba selle grupi liige";
$lang['User_is_member_group'] = "Kasutaja on juba selle grupi liige";
$lang['Group_type_updated'] = "Grupi tüübi uuendamine õnnestus";

$lang['Could_not_add_user'] = "Kasutajat ei leitud";
$lang['Could_not_anon_user'] = "Anonüümne isik ei saa olla grupi liige";

$lang['Confirm_unsub'] = "Oled sa kindel, et soovid sellest grupist väljuda?";
$lang['Confirm_unsub_pending'] = "Sinu avaldust selle grupiga liitumiseks ei ole veel aksepteeritud, kas sa oled kindel, et soovid tühistada oma tellimust?";

$lang['Unsub_success'] = "Sa oled sellest grupist väljunud.";

$lang['Approve_selected'] = "Kiida valitud heaks";
$lang['Deny_selected'] = "Keela valitud";
$lang['Not_logged_in'] = "Sa pead olema sisse loginud, et grupiga liituda.";
$lang['Remove_selected'] = "Eemalda valitud";
$lang['Add_member'] = "Lisa liige";
$lang['Not_group_moderator'] = "Kuna sa pole selle grupi moderaator, siis sa ei saa seda tegevust sooritada.";

$lang['Login_to_join'] = "Logi sisse või liitu";
$lang['This_open_group'] = "See on vavatud grupp. Klikka, et pakkuda ennast liikmeks";
$lang['This_closed_group'] = "See on suletud grupp. Rohkem kasutajaid ei lubata";
$lang['This_hidden_group'] = "See on varjatud grupp. Autommatne kasutajate lisamine on keelatud";
$lang['Member_this_group'] = "Sa oled selle grupi liige";
$lang['Pending_this_group'] = "Sinu liikme avaldus selle grupiga liitumiseks on veel ootel";
$lang['Are_group_moderator'] = "Sa oled grupi moderaator";
$lang['None'] = "pole";

$lang['Subscribe'] = "Pane ennast kirja";
$lang['Unsubscribe'] = "Eemalda ennast";
$lang['View_Information'] = "Vaata infot";

//
// Search
//
$lang['Search_query'] = "Otsing";
$lang['Search_options'] = "Otsingu valikud";
$lang['Search_keywords'] = "Otsi märksõnasid";
$lang['Search_keywords_explain'] = "Sa võid kasutada <u>JA</u> et defineerida tulemustes esinevaid sõnu, <u>VÕI</u> et defineerida sõnu, mis võivad tulemuses olla ja <u>MITTE</u> et defineerida sõnu, mis ei tohiks tulemuses olla. Use * as a wildcard for partial matches";
$lang['Search_author'] = "Otsi autori järgi";
$lang['Search_author_explain'] = "nime osa otsimisel kasuta *";
$lang['Search_for_any'] = "Otsing kõikidele sõnadele eraldi, mida sisestasid";
$lang['Search_for_all'] = "Otsing kõikidele sõnadele kokku";
$lang['Search_title_msg'] = "Pealkirju ja sisu";
$lang['Search_msg_only'] = "Ainult pealkirju";
$lang['Return_first'] = "Tulemuses tagasta"; // followed by xxx characters in a select box
$lang['characters_posts'] = "tähemarki";
$lang['Search_previous'] = "Otsinguks kasuta"; // followed by days, weeks, months, year, all in a select box
$lang['Sort_by'] = "Soteeri";
$lang['Sort_Time'] = "Postituse aeg";
$lang['Sort_Post_Subject'] = "Postituse teema";
$lang['Sort_Topic_Title'] = "Teema pealkiri";
$lang['Sort_Author'] = "Autori";
$lang['Sort_Forum'] = "Foorumi";
$lang['Display_results'] = "Kuva tulemusi";
$lang['All_available'] = "Kõik";
$lang['No_searchable_forums'] = "Sul ei ole lubatud otsida ühestki foorumist";
$lang['No_search_match'] = "Otsitav sõna või sõnad ei ole leitavad";
$lang['Found_search_match'] = "Otsing leidis %d tulemuse"; // eg. Search found 1 match
$lang['Found_search_matches'] = "Otsing leidis %d tulemust"; // eg. Search found 24 matches
$lang['Close_window'] = "Sulge aken";

//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = "Vabandame aga %s saab postitada ainult Teadannde postitusi selles foorumis";
$lang['Sorry_auth_sticky'] = "Vabandame aga %s saab postitada ainult Kleeps postitusi selles foorumis";
$lang['Sorry_auth_read'] = "Vabandame aga %s saab lugeda teemasi selles foorumis";
$lang['Sorry_auth_post'] = "Vabandame aga %s saab postitada teemasi selles foorumis";
$lang['Sorry_auth_reply'] = "Vabandame aga %s saab vastada postitustele selles foorumis";
$lang['Sorry_auth_edit'] = "Vabandame aga %s saab muuta postitusi selles foorumis";
$lang['Sorry_auth_delete'] = "Vabandame aga %s saab kustutada postitusi selles foorumis";
$lang['Sorry_auth_vote'] = "Vabandame aga %s saab hääletada selle foorumi küsitlustes";

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = "<b>anonüümset kasutajat</b>";
$lang['Auth_Registered_Users'] = "<b>liitunud kasutajat</b>";
$lang['Auth_Users_granted_access'] = "<b>eriõigustega kasutajat</b>";
$lang['Auth_Moderators'] = "<b>moderaatorit</b>";
$lang['Auth_Administrators'] = "<b>administraatorit</b>";
$lang['Not_Moderator'] = "Sa pole selle foorumi administraator";
$lang['Not_Authorised'] = "Pole õigusi";
$lang['You_been_banned'] = "Sa oled siit foorumist bannitud<br />võta ühendust administraatoriga lisainfo saamiseks";
//
// Viewonline
//
$lang['Reg_users_zero_online'] = "Foorumil pole ühtegi liitunud kasutajat ja "; // There ae 5 Registered and
$lang['Reg_users_online'] = "Foorumil on %d liitunud kasutajat ja "; // There ae 5 Registered and
$lang['Reg_user_online'] = "Foorumil on %d registreeritud kasutajat ja "; // There ae 5 Registered and
$lang['Hidden_users_zero_online'] = "Foorumil pole ühtegi varjatud kasutajat"; // 6 Hidden users online
$lang['Hidden_users_online'] = "Foorumil on %d varjatud kasutajat"; // 6 Hidden users online
$lang['Hidden_user_online'] = "Foorumil on %d varjatud kasutajat"; // 6 Hidden users online
$lang['Guest_users_online'] = "Foorumil on %d külalist"; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = "Foorumil pole ühtegi külalist "; // There are 10 Guest users online
$lang['Guest_user_online'] = "Foorumil %d külaline "; // There is 1 Guest user online
$lang['No_users_browsing'] = "Seda foorumit ei vaata praegu ükski kasutaja";
$lang['Online_explain'] = "Foorumil olijate nimekirja uuendatakse iga viie minuti järel";
$lang['Forum_Location'] = "Foorumi asukoht";
$lang['Last_updated'] = "Viimati uuendatud";
$lang['Forum_index'] = "Foorumi sisukord";
$lang['Logging_on'] = "Logi sisse";
$lang['Posting_message'] = "Postita uus teadet";
$lang['Searching_forums'] = "Otsi foorumeid";
$lang['Viewing_profile'] = "Vaata profiili";
$lang['Viewing_online'] = "Vaata kes on foorumil";
$lang['Viewing_member_list'] = "Vaata liikmete nimekirja";
$lang['Viewing_priv_msgs'] = "Vaata erasõnumeid";
$lang['Viewing_FAQ'] = "Vaatan KKK'd";


//
// Moderator Control Panel
//
$lang['Mod_CP'] = "Moderaatori kontrollpaneel";
$lang['Mod_CP_explain'] = "Järgneva vormiga saad teostada selle foorumi massmodereerimist. Võid kinni panna, lahti teha, kustutada või liigutada piiramatul arvul teemasid.";
$lang['Select'] = "Vali";
$lang['Delete'] = "Kustuta";
$lang['Move'] = "Liiguta";
$lang['Lock'] = "Pane kinni";
$lang['Unlock'] = "Tee lahti";
$lang['Topics_Removed'] = "Valitud teemad eemaldati.";
$lang['Topics_Locked'] = "Valitud teemad pandi kinni";
$lang['Topics_Moved'] = "Valitud teemad liigutatui";
$lang['Topics_Unlocked'] = "Valitud teemad avati uuesti";
$lang['No_Topics_Moved'] = "Ühtegi teemat ei liigutatud";
$lang['Confirm_delete_topic'] = "Oled sa kindel, et soovid valitud teema(d) eemaldada?";
$lang['Confirm_lock_topic'] = "Oled sa kindel, et soovid valitud teema(d) kinni panna?";
$lang['Confirm_unlock_topic'] = "Oled sa kindel, et soovid valitud teema(d) uuesti avada?";
$lang['Confirm_move_topic'] = "Oled sa kindel, et soovid valitud teema(sid) liigutada?";
$lang['Move_to_forum'] = "Liiguta foorumisse";
$lang['Leave_shadow_topic'] = "Jäta vanasse foorumisse link liigutatud teema juurde?";
$lang['Split_Topic'] = "Teema poolitamise kontrollpaneel";
$lang['Split_Topic_explain'] = "Järgne vormiga on võimalik poolitada üks teema kaheks - selleks kas vali kindlad teated või siis poolita valitud teate järel";
$lang['Split_title'] = "Uue teema pealkiri";
$lang['Split_forum'] = "Foorum uue teema jaoks";
$lang['Split_posts'] = "Poolita valitud teated";
$lang['Split_after'] = "Poolita pärast valitud teadet";
$lang['Topic_split'] = "Valitud teema poolitamine õnnestus";
$lang['Too_many_error'] = "Sa valisid liiga palju teateid korraga. Sa saad poolitada ainult ühte teadet korraga.";
$lang['None_selected'] = "Sa ei valinud ühtegi teemat mille kallal opereerida";
$lang['New_forum'] = "Uus foorum";
$lang['This_posts_IP'] = "Selle postituse IP";
$lang['Other_IP_this_user'] = "Teised IP'd millelt see kasutaja on postitanud";
$lang['Users_this_IP'] = "Kasutajad postitanud selle IP'ga";
$lang['IP_info'] = "IP Informatsioon";
$lang['Lookup_IP'] = "Otsi IP'd";
//
// Timezones ... for display on each page
//
$lang['All_times'] = "Ajatsoon on %s"; // eg. All times are GMT - 12 Hours (times from next block)
$lang['-12'] = "GMT - 12 tndi";
$lang['-11'] = "GMT - 11 tundi";
$lang['-10'] = "HST (Hawaii)";
$lang['-9'] = "GMT - 9 tundi";
$lang['-8'] = "PST (U.S./Canada)";
$lang['-7'] = "MST (U.S./Canada)";
$lang['-6'] = "CST (U.S./Canada)";
$lang['-5'] = "EST (U.S./Canada)";
$lang['-4'] = "GMT - 4 tundi";
$lang['-3.5'] = "GMT - 3.5 tundi";
$lang['-3'] = "GMT - 3 tundi";
$lang['-2'] = "Mid-Atlantic";
$lang['-1'] = "GMT - 1 tund";
$lang['0'] = "GMT";
$lang['1'] = "CET (Europe)";
$lang['2'] = "EET Eesti talveaeg";
$lang['3'] = "GMT + 3 tundi";
$lang['3.5'] = "GMT + 3.5 tundi";
$lang['4'] = "GMT + 4 tundi";
$lang['4.5'] = "GMT + 4.5 tundi";
$lang['5'] = "GMT + 5 tundi";
$lang['5.5'] = "GMT + 5.5 tundi";
$lang['6'] = "GMT + 6 tundi";
$lang['6.5'] = "GMT + 6.5 tundi";
$lang['7'] = "GMT + 7 tundi";
$lang['8'] = "WST (Australia)";
$lang['9'] = "GMT + 9 tundi";
$lang['9.5'] = "CST (Australia)";
$lang['10'] = "EST (Australia)";
$lang['11'] = "GMT + 11 tundi";
$lang['12'] = "GMT + 12 tundi";

// These are displayed in the timezone select box
$lang['tz']['-12'] = "(GMT -12:00 tundi) Eniwetok, Kwajalein";
$lang['tz']['-11'] = "(GMT -11:00 tundi) Midway Island, Samoa";
$lang['tz']['-10'] = "(GMT -10:00 tundi) Hawaii";
$lang['tz']['-9'] = "(GMT -9:00 tundi) Alaska";
$lang['tz']['-8'] = "(GMT -8:00 tundi) Pacific Time (US &amp; Canada), Tijuana";
$lang['tz']['-7'] = "(GMT -7:00 tundi) Mountain Time (US &amp; Canada), Arizona";
$lang['tz']['-6'] = "(GMT -6:00 tundi) Central Time (US &amp; Canada), Mexico City";
$lang['tz']['-5'] = "(GMT -5:00 tundi) Eastern Time (US &amp; Canada), Bogota, Lima, Quito";
$lang['tz']['-4'] = "(GMT -4:00 tundi) Atlantic Time (Canada), Caracas, La Paz";
$lang['tz']['-3.5'] = "(GMT -3:30 tundi) Newfoundland";
$lang['tz']['-3'] = "(GMT -3:00 tundi) Brassila, Buenos Aires, Georgetown, Falkland Is";
$lang['tz']['-2'] = "(GMT -2:00 tundi) Mid-Atlantic, Ascension Is., St. Helena";
$lang['tz']['-1'] = "(GMT -1:00 tundi) Azores, Cape Verde Islands";
$lang['tz']['0'] = "(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia";
$lang['tz']['1'] = "(GMT +1:00 tundi) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome";
$lang['tz']['2'] = "(GMT +2:00 tundi) Cairo, Helsinki, Tallinn, Kaliningrad, South Africa";
$lang['tz']['3'] = "(GMT +3:00 tundi) Baghdad, Riyadh , Moscow, Nairobi";
$lang['tz']['3.5'] = "(GMT +3:30 tundi) Tehran";
$lang['tz']['4'] = "(GMT +4:00 tundi) Abu Dhabi, Baku, Muscat, Tbilisi";
$lang['tz']['4.5'] = "(GMT +4:30 tundi) Kabul";
$lang['tz']['5'] = "(GMT +5:00 tundi) Ekaterinburg, Islamabad, Karachi, Tashkent";
$lang['tz']['5.5'] = "(GMT +5:30 tundi) Bombay, Calcutta, Madras, New Delhi";
$lang['tz']['6'] = "(GMT +6:00 tundi) Almaty, Colombo, Dhaka, Novosibirsk";
$lang['tz']['6.5'] = "(GMT +6:30 tundi) Rangoon";
$lang['tz']['7'] = "(GMT +7:00 tundi) Bangkok, Hanoi, Jakarta";
$lang['tz']['8'] = "(GMT +8:00 tundi) Beijing, Hong Kong, Perth, Singapore, Taipei";
$lang['tz']['9'] = "(GMT +9:00 tundi) Osaka, Sapporo, Seoul, Tokyo, Yakutsk";
$lang['tz']['9.5'] = "(GMT +9:30 tundi) Adelaide, Darwin";
$lang['tz']['10'] = "(GMT +10:00 tundi) Canberra, Guam, Melbourne, Sydney, Vladivostok";
$lang['tz']['11'] = "(GMT +11:00 tundi) Magadan, New Caledonia, Solomon Islands";
$lang['tz']['12'] = "(GMT +12:00 tundi) Auckland, Wellington, Fiji, Marshall Island";

$lang['datetime']['Sunday'] = "pühapäev";
$lang['datetime']['Monday'] = "esmaspäev";
$lang['datetime']['Tuesday'] = "teisipäev";
$lang['datetime']['Wednesday'] = "kolmapäev";
$lang['datetime']['Thursday'] = "neljapäev";
$lang['datetime']['Friday'] = "reede";
$lang['datetime']['Saturday'] = "laupäev";
$lang['datetime']['Sun'] = "P";
$lang['datetime']['Mon'] = "E";
$lang['datetime']['Tue'] = "T";
$lang['datetime']['Wed'] = "K";
$lang['datetime']['Thu'] = "N";
$lang['datetime']['Fri'] = "R";
$lang['datetime']['Sat'] = "L";
$lang['datetime']['January'] = "jaanuar";
$lang['datetime']['February'] = "veebruar";
$lang['datetime']['March'] = "märts";
$lang['datetime']['April'] = "aprill";
$lang['datetime']['May'] = "mai";
$lang['datetime']['June'] = "juuni";
$lang['datetime']['July'] = "juuli";
$lang['datetime']['August'] = "august";
$lang['datetime']['September'] = "september";
$lang['datetime']['October'] = "oktoober";
$lang['datetime']['November'] = "november";
$lang['datetime']['December'] = "detsember";
$lang['datetime']['Jan'] = "jaan";
$lang['datetime']['Feb'] = "veeb";
$lang['datetime']['Mar'] = "mär";
$lang['datetime']['Apr'] = "apr";
$lang['datetime']['May'] = "mai";
$lang['datetime']['Jun'] = "juuni";
$lang['datetime']['Jul'] = "juuli";
$lang['datetime']['Aug'] = "aug";
$lang['datetime']['Sep'] = "sep";
$lang['datetime']['Oct'] = "okt";
$lang['datetime']['Nov'] = "nov";
$lang['datetime']['Dec'] = "dets";
//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = "Informatsioon";
$lang['Critical_Information'] = "Tähtis informtasioon";
$lang['General_Error'] = "Üldine vige";
$lang['Critical_Error'] = "Kriitline viga";
$lang['An_error_occured'] = "On ilmnenud viga";
$lang['A_critical_error'] = "On ilmnenud kriitiline viga";

//
// That's all Folks!
// -------------------------------------------------

?>