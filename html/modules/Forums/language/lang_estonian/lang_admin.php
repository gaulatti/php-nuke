<?php
/***************************************************************************
*                            lang_admin.php [Estonian]
*                              -------------------
*     begin                : Sat Dec 16 2000
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*     $Id: lang_admin.php,v 1.35.2.3 2002/06/27 20:06:44 thefinn Exp $
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
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['General'] = 'Üldine Adminn';
$lang['Users'] = 'Kasutaja Adminn';
$lang['Groups'] = 'Grupide Adminn';
$lang['Forums'] = 'Foorumi Adminn';
$lang['Styles'] = 'Stiilide Adminn';

$lang['Configuration'] = 'Konfiguratsioon';
$lang['Permissions'] = 'Õigused';
$lang['Manage'] = 'Juhtimine';
$lang['Disallow'] = 'Keelanimesi';
$lang['Prune'] = 'Puhastamine';
$lang['Mass_Email'] = 'Mass email';
$lang['Ranks'] = 'Tasemed';
$lang['Smilies'] = 'Emotsioonid';
$lang['Ban_Management'] = 'Bannimine';
$lang['Word_Censor'] = 'Roppused';
$lang['Export'] = 'Eksport';
$lang['Create_new'] = 'Loo uus';
$lang['Add_new'] = 'Lisa';
$lang['Backup_DB'] = 'Andmebaasi Varukoopia';
$lang['Restore_DB'] = 'Taasta Andmebaas';


//
// Index
//
$lang['Admin'] = 'Administratsioon';
$lang['Not_admin'] = 'Sul ei ole õigust seda foorumit administreerida';
$lang['Welcome_phpBB'] = 'Teretulemast!';
$lang['Admin_intro'] = 'See leht annab sulle kiire ülevaate oma lehe statistikast. Kõiki võimalused leiad sa vasakust menüüst.';
$lang['Main_index'] = 'Foorumi pealeht';
$lang['Forum_stats'] = 'Foorumi Statistika';
$lang['Admin_Index'] = 'Adminni pealeht';
$lang['Preview_forum'] = 'Foorumi eelvaade';

$lang['Click_return_admin_index'] = 'Vajuta %ssiia%s, et naasta adminni pealehele';

$lang['Statistic'] = 'Statistika';
$lang['Value'] = 'Väärtus';
$lang['Number_posts'] = 'Postitusi kokku';
$lang['Posts_per_day'] = 'Postitusi päevas';
$lang['Number_topics'] = 'Teemasi kokku';
$lang['Topics_per_day'] = 'Teemasi päevas';
$lang['Number_users'] = 'Kasutajaid kokku';
$lang['Users_per_day'] = 'Kasutajaid päevas';
$lang['Board_started'] = 'Foorum avati';
$lang['Avatar_dir_size'] = 'Avataride mälumaht';
$lang['Database_size'] = 'Andmebaasi suurus';
$lang['Gzip_compression'] ='Gzip kompresioon';
$lang['Not_available'] = 'Pole saadaval';

$lang['ON'] = 'SEES'; // This is for GZip compression
$lang['OFF'] = 'VÄLJAS';


//
// DB Utils
//
$lang['Database_Utilities'] = 'Andmebaasi võimalused';

$lang['Restore'] = 'Taasta';
$lang['Backup'] = 'Varukoopia';
$lang['Restore_explain'] = 'See taastab täielikult foorumi seisu varukoopia ajal. See on suur operatsioon ja palun ärke lahkuge siit lehelt enne kui see on tegevuse lõpetanud!';
$lang['Backup_explain'] = 'Siin sa saad teha varukoopia kõigele phpBB datale. Kui su server seda toetab võid nad ka pakkida Gzip formaati enne downloadi.';

$lang['Backup_options'] = 'Varukoopia võimalused';
$lang['Start_backup'] = 'Alusta varukoopia tegemist';
$lang['Full_backup'] = 'Täielik varukoopia';
$lang['Structure_backup'] = 'Ainult struktuuri varukoopia';
$lang['Data_backup'] = 'Ainult andmete(postitused, teemad, kasutajad) varukoopia';
$lang['Additional_tables'] = 'Lisa tabelid';
$lang['Gzip_compress'] = 'Paki failid Gzip formaati';
$lang['Select_file'] = 'Vali fail';
$lang['Start_Restore'] = 'Alusta Taastamist';

$lang['Restore_success'] = 'Andmebaas on edukalt taastatud. Sinu andmebaas peaks olema samas seisus nagu ta oli su viimase Varukoopia ajal.';
$lang['Backup_download'] = 'Su allalaadimine algab peatselt, palun oota.';
$lang['Backups_not_supported'] = 'Sinu andmebaas ei toeta Varukoopiate tegemist. Vabandame!';

$lang['Restore_Error_uploading'] = 'Tekkis viga faili üleslaadimisel.';
$lang['Restore_Error_filename'] = 'Faili nimega on probleem, palun proovi muud faili või nime.';
$lang['Restore_Error_decompress'] = 'Ei saa lahti pakkida Gzip formaati, palun lae ülesse puhas tekst fail-';
$lang['Restore_Error_no_file'] = 'Ühtegi faili ei laetud üles!';


//
// Auth pages
//
$lang['Select_a_User'] = 'Vali kasutaja';
$lang['Select_a_Group'] = 'Valia grupp';
$lang['Select_a_Forum'] = 'Vali foorum';
$lang['Auth_Control_User'] = 'Kasutajate õigused';
$lang['Auth_Control_Group'] = 'Grupide õigused';
$lang['Auth_Control_Forum'] = 'Foorumite õigused';
$lang['Look_up_User'] = 'Otsi kasutaja';
$lang['Look_up_Group'] = 'Otsi grupp';
$lang['Look_up_Forum'] = 'Otsi foorum';

$lang['Group_auth_explain'] = 'Siin sa saad muuta õigusi ja moderaatori staatust tervele kasutajate gruppile. NB! Kui kasutajal on eraldi antud õigus midagi modereerida vms. , siis need õigused jäävad talle endiselt alles. Sind hoiatatakse kui selline juhus tekib.';
$lang['User_auth_explain'] = 'Siin sa saad muuta õigusi ja moderaatori staatust kindlale kasutajale. NB! Kui kasutaja kuulub gruppi, siis selle grupi õigusega võib ta endiselt kirjutada foorumitesse, kustutada teemasi jne. Kui selline juhus tekib siis seda öeldakse.';
$lang['Forum_auth_explain'] = 'Siin sa saad muuta foorumi seadeid. ET mis tasemega kasutajad saavad seda vaadata, modereerida jne.';

$lang['Simple_mode'] = 'Tavaline Mode';
$lang['Advanced_mode'] = 'Täpsem Mode';
$lang['Moderator_status'] = 'Moderaatori staatus';

$lang['Allowed_Access'] = 'Lubatud juurdepääs';
$lang['Disallowed_Access'] = 'Keelatud juurdepääs';
$lang['Is_Moderator'] = 'On Moderaator';
$lang['Not_Moderator'] = 'Ei ole Moteraator';

$lang['Conflict_warning'] = 'Administreerimis konflikt! HOIATUS!';
$lang['Conflict_access_userauth'] = 'Sellel kasutajal on endiselt juurdepääs sellele foorumile oma kasutajte gruppi kaudu. Sa võib-olla tahad muuta grupi õigusi või eemaldada see kasutaja sealt grupist. Grupid, mis annavad õigusi(ja foorumid mida nad mõjutavad) on allpool ära toodud.';
$lang['Conflict_mod_userauth'] = 'Sellel kasutajal on endiselt moderaatori õigused sellele foorumile oma kasutajate grupi kaudu. Sa võibolla tahad muuta grupi õigusi või eemaldada see kasutaja sealt grupist. Grupid, mis annavad õigusi (ja foorumid mida nad mõjutavad) on allpool ära toodud.';

$lang['Conflict_access_groupauth'] = 'Järgmistel kasutajatel on endiselt õigused nende kasutajte grupi kaudu. Sa võibolla tahad neid muuta. Kõik on ära toodud all nimekirjas.';
$lang['Conflict_mod_groupauth'] = 'Antud kasutajatel on endiselt modereerimis õigused osades foorumites. Kõik vajalik on ära toodud all nimekirjas';

$lang['Public'] = 'Avalik';
$lang['Private'] = 'Isiklik';
$lang['Registered'] = 'Registreerunutele';
$lang['Administrators'] = 'Administraatoritele';
$lang['Hidden'] = 'Peidetud';


// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'KÕIK';
$lang['Forum_REG'] = 'REG';
$lang['Forum_PRIVATE'] = 'PRIV';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_ADMIN'] = 'ADMIN';

$lang['View'] = 'Vaata';
$lang['Read'] = 'Loe';
$lang['Post'] = 'Postita';
$lang['Reply'] = 'Vasta';
$lang['Edit'] = 'Muuda';
$lang['Delete'] = 'Kustuta';
$lang['Sticky'] = 'Kleeps';
$lang['Announce'] = 'Teavita';
$lang['Vote'] = 'Hääleta';
$lang['Pollcreate'] = 'Loo hääletus';

$lang['Permissions'] = 'Õigused';
$lang['Simple_Permission'] = 'Lihtõigused';

$lang['User_Level'] = 'Kasutaja level';
$lang['Auth_User'] = 'Kasutaja';
$lang['Auth_Admin'] = 'Administraator';
$lang['Group_memberships'] = 'Katuajate grupi liikmed';
$lang['Usergroup_members'] = 'Sellel grupil on järgmised liikmed';

$lang['Forum_auth_updated'] = 'Foorumi õigused muudetud';
$lang['User_auth_updated'] = 'Kasutaja õigused muudetud';
$lang['Group_auth_updated'] = 'Grupi õigused muudetud';

$lang['Auth_updated'] = 'Õigused on muudetud';
$lang['Click_return_userauth'] = 'Vajuta %ssiia%s et minna tagasi kasutajate õiguste lehele.';
$lang['Click_return_groupauth'] = 'Vajuta %ssiia%s et minna tagasi grupi õiguste lehele.';
$lang['Click_return_forumauth'] = 'Vajuta %ssiia%s et minna tagasi foorumi õiguste lehele.';


//
// Banning
//
$lang['Ban_control'] = 'Bannide juhtimine';
$lang['Ban_explain'] = 'Siin sa saad juhtida kasutajate bannimist. Sa saad bannida kas kasutajanime, ip aadressi jne. Niimoodi keelad tal isegi jõudmise su foorumi avalehele. Et ära hoida ühe kasutaja topelt registreerimist võid sa ka bannida tema emaili!';
$lang['Ban_explain_warn'] = 'NB! Kui sa bannid mingi ip vahemiku siis baasi lisatakse kõik IP aadressid eraldi. Palun ürita seda listi hoida väiksena, veel parem lisa ainult üks ip aadress.';

$lang['Select_username'] = 'Vali kasutajanimi';
$lang['Select_ip'] = 'Vali ip IP';
$lang['Select_email'] = 'Vali Emaili aadress';

$lang['Ban_username'] = 'Banni üks või rohkem kasutajanimesi';
$lang['Ban_username_explain'] = 'Sa võid ka korraga bannide mitut kasutajat';

$lang['Ban_IP'] = 'Banni üks või rohkem ip aadressi või teenusepakkuja';
$lang['IP_hostname'] = 'IP addressid või teenusepakkuja nimed';
$lang['Ban_IP_explain'] = 'Et ära märkida mitmeid ip aadressid või teenusepakkujad, eralda need komaga.';

$lang['Ban_email'] = 'Banni üks või mitu e-maili aadressi';
$lang['Ban_email_explain'] = 'Et bannida mitmeid emaile, eralda need komadega.';

$lang['Unban_username'] = 'Eemalda bann ühelt või mitmelt kasutajalt';
$lang['Unban_username_explain'] = 'Sa võid eemaldada ka banni mitmelt korraga hoides all ctrl.';

$lang['Unban_IP'] = 'Eemalda bann ühelt või mitmelt ip aadressilt';
$lang['Unban_IP_explain'] = 'Sa võid eemaldada ka banni mitmelt korraga hoides all ctrl.';

$lang['Unban_email'] = 'Eemalda bann ühelt või mitmelt emaili aadresssilt';
$lang['Unban_email_explain'] = 'Sa võid eemaldada ka banni mitmelt korraga hoides all ctrl.';

$lang['No_banned_users'] = 'Ei ole ühtegi bannitud kasutajat';
$lang['No_banned_ip'] = 'Ei ole ühtegi bannitud ip-d';
$lang['No_banned_email'] = 'Ei ole ühtegi bannitud e-maili';

$lang['Ban_update_sucessful'] = 'Bannitute listi uuendati edukalt!';
$lang['Click_return_banadmin'] = 'Vajuta %ssiia%s et minna tagasi bannide juhtimisele';



//
// Configuration
//
$lang['General_Config'] = 'Üldine konfiguratsioon';
$lang['Config_explain'] = 'Alumine form laseb sul muuta üldist seadistust. Muude asjade muutmiseks kasuta vasakul olevat menüüd.';

$lang['Click_return_config'] = 'Vajuta %ssiia%s et minna tagasi Üldiste Seadistuste lehele';

$lang['General_settings'] = 'Üldised forumi seadistused';
$lang['Server_name'] = 'Domeeni nimi';
$lang['Server_name_explain'] = 'Domeen, kus see foorum asetseb';
$lang['Script_path'] = 'Foorumi kaust';
$lang['Script_path_explain'] = 'Kaust kus foorum asub domeeni suhtes.';
$lang['Server_port'] = 'Serveri Port';
$lang['Server_port_explain'] = 'Port, kus su server jookseb. Enamasti 80, muuda ainult siis, kui sa tead, et see ei ole nii.';
$lang['Site_name'] = 'Lehekülje nimi';
$lang['Site_desc'] = 'Lehekülje kirjeldus';
$lang['Board_disable'] = 'Sulge foorum';
$lang['Board_disable_explain'] = 'See teeb foorumi kasutajatele kinniseks. NB! Ära välja logi, sa ei saa enam sisse logida!';
$lang['Acct_activation'] = 'Ava kontode aktivatsioon';
$lang['Acc_None'] = 'puudub'; // These three entries are the type of activation
$lang['Acc_User'] = 'kasutaja';
$lang['Acc_Admin'] = 'admin';

$lang['Abilities_settings'] = 'Kasutajate ja foorumi põhilised seaded';
$lang['Max_poll_options'] = 'Maksimum arv küsitluse vastuseid';
$lang['Flood_Interval'] = 'Postituste interval';
$lang['Flood_Interval_explain'] = 'Sekundites, kui kaua peab kasutaja ootama, et saaks teha uue postituse';
$lang['Board_email_form'] = 'Kasutajate emailimine foorumi kaudu';
$lang['Board_email_form_explain'] = 'kasutajad võivad saata emaile selle foorumi kaudu';
$lang['Topics_per_page'] = 'Teemasi lehe peale';
$lang['Posts_per_page'] = 'Postitusi lehe peale';
$lang['Hot_threshold'] = 'Postitusi, et teema muutuks populaarseks';
$lang['Default_style'] = 'Vaikimisi Stiil';
$lang['Override_style'] = 'Kasutaja stiilist üle kirjutamine';
$lang['Override_style_explain'] = 'Asenda kasutaja valitud stiil igal juhul vaikimisi stiiliga.';
$lang['Default_language'] = 'Vaikimisi keel';
$lang['Date_format'] = 'Kuupäeva formaat';
$lang['System_timezone'] = 'Süsteemi ajatsoon';
$lang['Enable_gzip'] = 'Luba GZip pakkimine';
$lang['Enable_prune'] = 'Võimalda foorumi auto-puhastamine';
$lang['Allow_HTML'] = 'Võimalda HTML';
$lang['Allow_BBCode'] = 'Võimalda BBKood';
$lang['Allowed_tags'] = 'Võimalda HTML tagid';
$lang['Allowed_tags_explain'] = 'Eralda tagid komadega';
$lang['Allow_smilies'] = 'Võimalda emotsioonid';
$lang['Smilies_path'] = 'Emotsioonide kaust';
$lang['Smilies_path_explain'] = 'Asukoht foorumi kausta suhtes. Näide: images/smiles';
$lang['Allow_sig'] = 'Võimalda allkirjastamine';
$lang['Max_sig_length'] = 'Max. allkirja pikkus';
$lang['Max_sig_length_explain'] = 'Max. arv tähti kasutaja allkirjas';
$lang['Allow_name_change'] = 'Võimalda kasutajanime muutmist';
$lang['Avatar_settings'] = 'Avatari seadistused';
$lang['Allow_local'] = 'Võimalda galerii avatarid';
$lang['Allow_remote'] = 'Võimalda kaug-avatarid';
$lang['Allow_remote_explain'] = 'Avatarist link teisel lehel. näide www.hot.ee/gretler/avatar.jpg';
$lang['Allow_upload'] = 'Võimalda avataride üleslaadimine';
$lang['Max_filesize'] = 'Max. avatari suurus';
$lang['Max_filesize_explain'] = 'Avataride üleslaadimiseks.';
$lang['Max_avatar_size'] = 'Max. avatari dimensioon';
$lang['Max_avatar_size_explain'] = '(Kõrgus ja laius pixlites)';
$lang['Avatar_storage_path'] = 'Avataride kaust';
$lang['Avatar_storage_path_explain'] = 'Avataride kaust, näide: images/avatars';
$lang['Avatar_gallery_path'] = 'Avataride galerii kaust';
$lang['Avatar_gallery_path_explain'] = 'galerii kaust, näide images/avatars/gallery';
$lang['COPPA_settings'] = 'COPPA seaded';
$lang['COPPA_fax'] = 'COPPA Faksi number';
$lang['COPPA_mail'] = 'COPPA E-maili Address';
$lang['COPPA_mail_explain'] = 'See on aadress, kuhu vanemad peaksid saatma täidetud formi, aga siin foorumis on see maha võetud';
$lang['Email_settings'] = 'E-maili seaded';
$lang['Admin_email'] = 'Adminni email';
$lang['Email_sig'] = 'E-maili allkiri';
$lang['Email_sig_explain'] = 'See tekst lisatakse kõigile väljaminevatele emaili aadressidele';
$lang['Use_SMTP'] = 'Kasuta SMTP e-maili';
$lang['Use_SMTP_explain'] = 'Vali see, kui sa tahad või pead kasutama serverit mailide välja saatmiseks mail() funktsiooni asemel.';
$lang['SMTP_server'] = 'SMTP Serveri aadress';
$lang['SMTP_username'] = 'SMTP kasutaja';
$lang['SMTP_username_explain'] = 'Ainult siis sisesta kasutaja nimi, kui su server seda nõuab';
$lang['SMTP_password'] = 'SMTP parool';
$lang['SMTP_password_explain'] = 'Ainult siis sisesta parool kui su server seda nõuab';
$lang['Disable_privmsg'] = 'Privaat sõnumid';
$lang['Inbox_limits'] = 'Max postitusi INBOXis';
$lang['Sentbox_limits'] = 'Max postitusi SENTBOXis';
$lang['Savebox_limits'] = 'Max postiusi SAVABOXis';
$lang['Cookie_settings'] = 'Küpsiste seaded';
$lang['Cookie_settings_explain'] = 'Need detailid kirjeldavad, kuidas küpsised saavad olema saadetud su kasutajate brauseritesse. Need peaksid olema hetkel õiged näitajad. kui on vajalik, siis muuda neid, aga ettevaatlikult. Ebakorrektne muutmine võib põhjustada selle, et kasutajad ei saa enam sisse logida.';
$lang['Cookie_domain'] = 'Küpsiste domeen';
$lang['Cookie_name'] = 'Küpsise nimi';
$lang['Cookie_path'] = 'Küpsise tee';
$lang['Cookie_secure'] = 'Küpsiste turvalisus';
$lang['Cookie_secure_explain'] = 'Kui su server jookseb SSL kaudu, siis vali see valik, muul juhul jäta valimata.';
$lang['Session_length'] = 'Sessiooni pikkus [ sekundites ]';


//
// Forum Management
//

$lang['Forum_admin'] = 'Foorumi Seaded';
$lang['Forum_admin_explain'] = 'Selle paneeli kaudu saad luua, kustutada, muuta jpm. foorumites';
$lang['Edit_forum'] = 'Muuda Foorumit';
$lang['Create_forum'] = 'Tee uus foorum';
$lang['Create_category'] = 'Tee uus kategooria';
$lang['Remove'] = 'Eemalda';
$lang['Action'] = 'Olek';
$lang['Update_order'] = 'Uuenda';
$lang['Config_updated'] = 'Foorumi seadistused on edukalt uuendatud';
$lang['Edit'] = 'Muuda';
$lang['Delete'] = 'Kustuta';
$lang['Move_up'] = 'liiguta ülespoole';
$lang['Move_down'] = 'liiguta allapoole';
$lang['Resync'] = 'Resync';
$lang['No_mode'] = 'Ühtegi MODE´t ei muudetud';
$lang['Forum_edit_delete_explain'] = 'All olev vorm lubab sul muuta põhilisi näitajaid. Muude asjade muutmiseks kasuta vasakul olevat menüüd.';
$lang['Move_contents'] = 'liiguta kogu sisu';
$lang['Forum_delete'] = 'Kustuta foorum';
$lang['Forum_delete_explain'] = 'All olev vorm lubab sul foorumi kustutada ja otsustada kuhu sa tahad kogu selle sisu panna';
$lang['Status_locked'] = 'Lukus';
$lang['Status_unlocked'] = 'Avatud';
$lang['Forum_settings'] = 'Üldised foorumi seadistused';
$lang['Forum_name'] = 'Foorumi nimi';
$lang['Forum_desc'] = 'Kirjeldus';
$lang['Forum_status'] = 'Foorumi staatus';
$lang['Forum_pruning'] = 'Auto-puhastus';
$lang['prune_freq'] = 'Kontrolli teema vanust iga';
$lang['prune_days'] = 'Eemalda teemad, kuhu pole tehtud uusi postitusi';
$lang['Set_prune_data'] = 'Sa oled auto puhastuse küll sisse lülitanud, aga sa ei märkinud, kui tihti ja milliste parameetrite järgi seda teha tuleb. Palun mine tagasi ja paranda viga';
$lang['Move_and_Delete'] = 'Liiguta ja kustuta';
$lang['Delete_all_posts'] = 'Kustuta kõik postitused';
$lang['Nowhere_to_move'] = 'pole kuhugi liigutada';
$lang['Edit_Category'] = 'Muuda kategoorja';
$lang['Edit_Category_explain'] = 'Kasuta seda vormi et muuta kategrooja nime';
$lang['Forums_updated'] = 'Foorumi ja kategooria uuendati edukalt.';
$lang['Must_delete_forums'] = 'Sa pead enne kustutama kõik foorumid, kui saad kustutada seda kategooriat';
$lang['Click_return_forumadmin'] = 'Vajuta %ssiia%s et minna tagasi foorumi seadistuste lehele';


//
// Smiley Management
//
$lang['smiley_title'] = 'Emtsioonide seaded';
$lang['smile_desc'] = 'Siin lehel sa saad seadistada emotsioone mida kasutajad saavad kasutada oma postitustes ja privaat teadetes';
$lang['smiley_config'] = 'Emotsiooni seaded';
$lang['smiley_code'] = 'Emotsiooni kood';
$lang['smiley_url'] = 'Emotsiooni fail';
$lang['smiley_emot'] = 'Emotsiooni nimi';
$lang['smile_add'] = 'Lisa uus emotsioon';
$lang['Smile'] = 'Emotsioon';
$lang['Emotion'] = 'Smaili';
$lang['Select_pak'] = 'Vali PACK(.pak) fail';
$lang['replace_existing'] = 'Asenda hetkel olev emotsioon';
$lang['keep_existing'] = 'Jäta hetkel olemas oleva emot. alles';
$lang['smiley_import_inst'] = 'Sa peaksid unzippima oma smiley paki ja üles laadima kõik failid õigesse Smiley kataloogi installimiseks. Siis valmia korrektse informatsiooni siin vormis et importida smily pack.';
$lang['smiley_import'] = 'Emotsiooni paki Import';
$lang['choose_smile_pak'] = 'Vali Emot. paki .pak fail';
$lang['import'] = 'Impordi emotsioonid';
$lang['smile_conflicts'] = 'Mida tuleks teha, kui tekivad vastuolud.';
$lang['del_existing_smileys'] = 'kustuta olemas olevad emot. enne importi';
$lang['import_smile_pack'] = 'Impordi emot. pakk.';
$lang['export_smile_pack'] = 'Tee uus emot pakk';
$lang['export_smiles'] = 'Et teha emot. pakk hetkel instaleeritud emotsioonidest klikki %ssiin%s et allalaadida smiles.pak fail. Nimeta see fail kohaselt olles kindel et failile jääb .pak laiend. Siis tee uus zip fail, mis sisaldab kõiki neid emotsioone plus siis see .pak fail.';
$lang['smiley_add_success'] = 'Emotsioonid lisati edukalt.';
$lang['smiley_edit_success'] = 'Emotsioonid uuendati edukalt.';
$lang['smiley_import_success'] = 'Emot. pakk importiti edukalt.';
$lang['smiley_del_success'] = 'Emotsioon kustutati edukalt.';
$lang['Click_return_smileadmin'] = 'Vajuta %ssiia%s, et minna tagasi emotsioonide juhtimis lehele.';


//
// User Management
//
$lang['User_admin'] = 'Kasutaja juhtimine';
$lang['User_admin_explain'] = 'Siin sa saad muuta kasutaja informatsiooni ja osasi spetsiifilisi võimalusi. Et muuta kasutaja õigusi kasuta Grupide juhtimist ja Kasutajate õiguste paneele.';
$lang['Look_up_user'] = 'Otsi kasutaja üles';
$lang['Admin_user_fail'] = 'Kasutaja profiili muutmine ebaõnnestus!';
$lang['Admin_user_updated'] = 'Kasutaja profiil uuendati edukalt!';
$lang['Click_return_useradmin'] = 'Vajuta %ssiia%s, et minna tagasi kasutajate juhtimis lehele.';
$lang['User_delete'] = 'Kustuta see kasutaja';
$lang['User_delete_explain'] = 'Vajuta siia, et kustuta see kasutaja, seda ei saa tagasi muuta.';
$lang['User_deleted'] = 'Kasutaja kustutati edukalt.';
$lang['User_status'] = 'Kasutaja on aktiivne';
$lang['User_allowpm'] = 'Saab saata privaat sõnumeid';
$lang['User_allowavatar'] = 'Võib näidata avatare';
$lang['Admin_avatar_explain'] = 'Siin sa saad näha ja kustutada kasutaja avatari.';
$lang['User_special'] = '"ainult adminnile" väljad';
$lang['User_special_explain'] = 'Neid välju ei saa kasutajad ise muuta';

//
// Group Management
//
$lang['Group_administration'] = 'Grupide juhtimine';
$lang['Group_admin_explain'] = 'Siin paneelil sa saad juhtida kasutajategruppe, sa saad neid kustutada, luua ja muuta. Sa võid neid avada ja sulgeda ja palju muud.';
$lang['Error_updating_groups'] = 'Grupide muutmisel tekkis viga.';
$lang['Updated_group'] = 'Grupp uuendati edukalt';
$lang['Added_new_group'] = 'Uus grupp loodi edukalt.';
$lang['Deleted_group'] = 'Grupp kustutai edukalt';
$lang['New_group'] = 'Tee uus grupp.';
$lang['Edit_group'] = 'Muuda grupp';
$lang['group_name'] = 'Grupi nimi';
$lang['group_description'] = 'Grupi kirjeldus';
$lang['group_moderator'] = 'Grupi moderaator';
$lang['group_status'] = 'Grupi staatus';
$lang['group_open'] = 'Ava grupp';
$lang['group_closed'] = 'Suletud grupp';
$lang['group_hidden'] = 'Peidetud grupp';
$lang['group_delete'] = 'Kustuta grupp';
$lang['group_delete_check'] = 'Kustuta see grupp';
$lang['submit_group_changes'] = 'Uuenda';
$lang['reset_group_changes'] = 'Taasta';
$lang['No_group_name'] = 'Sa pead ära märkima sellele grupile ka nime.';
$lang['No_group_moderator'] = 'Sa pead lisama sellele grupile moderaatori';
$lang['No_group_mode'] = 'Sa pead märkima sellele grupile oleku, avatud/suletud';
$lang['No_group_action'] = 'Käsklust ei ole antud';
$lang['delete_group_moderator'] = 'Kustuta grupi vana moderaator?';
$lang['delete_moderator_explain'] = 'Kui sa muudad selle grupi moderaatorit siis tee siia kasti linnuke. Muul juhul ära tee midagi ja sellest liikmest saab selle grupi tavaliige.';
$lang['Click_return_groupsadmin'] = 'Vajuta %ssiia%s, et minna tagasi grupi juhtimis lehele';
$lang['Select_group'] = 'Vali grupp';
$lang['Look_up_group'] = 'Otsi grupp üles';



//
// Prune Administration
//
$lang['Forum_Prune'] = 'Foorumi puhastus';
$lang['Forum_Prune_explain'] = 'See kustutab teemad, milledesse pole sinu poolt määratud päevade jooksul uusi postitusi tehtud. Kui sa ei sisesta päevade arvu, kustutatakse kõik teemad. See ei eemalda teemasid, kus on aktiivne küsitlus, samuti ei kustuta see teadaandeid. Need teemad tuleb käsitsi kustutada.';
$lang['Do_Prune'] = 'Puhasta';
$lang['All_Forums'] = 'Kõik foorumid';
$lang['Prune_topics_not_posted'] = 'Puhasta teemad, kuhu pole vastatud viimasel ... päeval';
$lang['Topics_pruned'] = 'Teemad puhastatud';
$lang['Posts_pruned'] = 'Postitused puhastatud';
$lang['Prune_success'] = 'Kõik foorumid puhastati edukalt.';


//
// Word censor
//
$lang['Words_title'] = 'Tsensuur';
$lang['Words_explain'] = 'Siit paneelist saad sa lisada, muuta, ja eemaldada sõnu, mis tsenseeritakse foorumis automaatselt. Lisaks ei saa kasutajad registreerida kasutajanime, mis sisaldab neid sõnu. Tärnid (*) on lubatud sõnaväljal, nt *pass* tsenseerib ka sõna "hundipassikontroll", pass* tsenseeriks ka sõna "passikontroll", *pass tsenseeriks sõna "hundipass".';
$lang['Word'] = 'Sõna';
$lang['Edit_word_censor'] = 'Muuda tsensuuri';
$lang['Replacement'] = 'Asendus';
$lang['Add_new_word'] = 'Lisa uus sõna';
$lang['Update_word'] = 'Uuenda tsensuuri';

$lang['Must_enter_word'] = 'Sa pead sisestama sõna ja selle asenduse';
$lang['No_word_selected'] = 'Muutmiseks pole sõna valitud';

$lang['Word_updated'] = 'Valitud tsensuur uuendatud';
$lang['Word_added'] = 'Tsenseeritav sõna lisatud';
$lang['Word_removed'] = 'Tsenseeritav sõna eemaldatud';

$lang['Click_return_wordadmin'] = 'Vajuta %ssiia%s et minna tagasi Tsensuuri algusesse';


//
// Mass E-mail
//
$lang['Mass_email_explain'] = 'Siit saad sa saata e-maili kas kõigile kasutajatele või mingi kindla grupi kasutajatele. Seda tehes saadetakse e-mail administraatori aadressile ja kirja pimekoopia kõigile kasutajatele. Kui sa saadad kirja suurele kasutajagrupile, siis ole kannatlik ja ära katkesta laadimist poolepealt. Mass e-maili saadetaksegi kaua aega, sulle antakse märku, kui see valmis on';
$lang['Compose'] = 'Kirjuta';

$lang['Recipients'] = 'Saajad';
$lang['All_users'] = 'Kõik kasutajad';

$lang['Email_successfull'] = 'Sinu teade on saadetud';
$lang['Click_return_massemail'] = 'Vajuta %ssiia%s et minna Mass e-maili algusesse';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Tasemete  Administratsioon';
$lang['Ranks_explain'] = 'Siin saad sa lisada, muuta, vaadata ja kustutada tasemeid. Võid luua ka eritasemed, mida saad kasutajale omistada kasutajate õiguste paneelis.';

$lang['Add_new_rank'] = 'Lisa uus tase';

$lang['Rank_title'] = 'Taseme pealkiri';
$lang['Rank_special'] = 'Määra eritase';
$lang['Rank_minimum'] = 'Minimum Postitusi';
$lang['Rank_maximum'] = 'Maximum Postitusi';
$lang['Rank_image'] = 'Taseme pilt (Sama mis phpBB2 juurkaust)';
$lang['Rank_image_explain'] = 'Kasuta seda, et valida väike pilt, mis kaasneb selle tasemega.';

$lang['Must_select_rank'] = 'Sa pead valima taseme';
$lang['No_assigned_rank'] = 'Eritasemeid pole';

$lang['Rank_updated'] = 'Tase on edukalt uuendatud';
$lang['Rank_added'] = 'Tase on edukalt lisatud';
$lang['Rank_removed'] = 'Tase on edukalt kustutatud';
$lang['No_update_ranks'] = 'Tase kustutati edukalt, kuid ei uuendatud kasutajakontosid, kes on sellel tasemel. Nendel kasutajakontodel pead sa taseme käsitsi muutma.';

$lang['Click_return_rankadmin'] = 'Vajuta %ssiia%s, et minna tagasi Tasemete Administratsiooni';


//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Kasutajanimede keelamine';
$lang['Disallow_explain'] = 'Siia saad sa lisada kasutajanimesid, mida ei lubata kasutada. Keelatud kasutajanimed võivad sisaldada tärne (*). Sa ei saa keelata kasutajanime, mis on juba registreeritud, enne tuleb see nimi kustutada ja siis alles keelata.';

$lang['Delete_disallow'] = 'Kustuta';
$lang['Delete_disallow_title'] = 'Eemalda keelatud kasutajanimi';
$lang['Delete_disallow_explain'] = 'Sa saad keelatud kasutajanime eemaldada, valides selle nimekirjast ja vajutades submit nupule';

$lang['Add_disallow'] = 'Lisa';
$lang['Add_disallow_title'] = 'Lisa keelatud kasutajanimi';
$lang['Add_disallow_explain'] = 'Sa saad kasutajanime keelatamisel kasutada ka tärni (*), mis vastab ükskõik mis tähele.';

$lang['No_disallowed'] = 'Keelatud kasutajanimesid pole';

$lang['Disallowed_deleted'] = 'Keelatud kasutajanimi eemaldati.';
$lang['Disallow_successful'] = 'Keelatud kasutajanimi lisatud';
$lang['Disallowed_already'] = 'Sisestatud nime ei ole võimalik keelata. See on kas juba keelatud, esineb tsenseeritud sõnades, või on olemas sellenimeline kasutaja';

$lang['Click_return_disallowadmin'] = 'Vajuta %ssiia%s et minna Kasutajanimede keelamise algusesse';


//
// Styles Admin
//
$lang['Styles_admin'] = 'Stiilide Administratsioon';
$lang['Styles_explain'] = 'Siin saad sa lisada, eemaldada ja muuta stiile (põhjad ja teemad) mida saavad kasutajad valida';
$lang['Styles_addnew_explain'] = 'Järgnev nimekiri sisaldab kõiki teemasid, mis on saadaval olemasolevatele põhjadele. Siin nimekirjas olevaid asju pole veel phpBB andmebaasi installitud. Teema installimiseks kliki installeerimise lingil';

$lang['Select_template'] = 'Vali teema';

$lang['Style'] = 'Stiil';
$lang['Template'] = 'Põhi';
$lang['Install'] = 'Installeeri';
$lang['Download'] = 'Lae alla';

$lang['Edit_theme'] = 'Muuda teemat';
$lang['Edit_theme_explain'] = 'Allolevas vormis saab valitud teemade seadeid muuta.';

$lang['Create_theme'] = 'Loo teema';
$lang['Create_theme_explain'] = 'Kasuta allolevad vormi, et luua uus teema valitud teema. Värve sisestades (milleks sa peaksid kasutama 16 süsteemi arve) ei tohi sa kasutada märki #, nt.. CCCCCC on lubatud, #CCCCCC aga mitte';

$lang['Export_themes'] = 'Ekspordi teema';
$lang['Export_explain'] = 'Siin saad sa eksportida teema andmed valitud põhjale. Vali allolevast nimekirjast põhi ja skript loob teema konfiguratsiooni faii ning püüab seda salvestada valitud põhjade kausta. Kui see ise ei saa faili salvestada, annab see sulle võimaluse see alla laadida. Et skript saaks antud faili salvestada, pead sa andma kirjutamisloa veebiserveri põhjade kaustale. Lisainfo jaoks vaata phpBB 2 kasutaja juhendit.';

$lang['Theme_installed'] = 'Valitud teema instlalitud.';
$lang['Style_removed'] = 'Valitud teema andmebaasist eemaldatud. Et seda stiili arvutist täielikult kustutada, pead sa kustutama põhjade kaustas oleva stiilifaili.';
$lang['Theme_info_saved'] = 'Teema info valitud põhjale on salvestatud. Nüüd sa peaksid muutma faili theme_info.cfg (võimalusel ka põhjade kausta) ainult loetavaks(read-only)';
$lang['Theme_updated'] = 'Valitud teema uuendatud. Nüüd tuleks eksportida uue teema seaded.';
$lang['Theme_created'] = 'Teema loodud. Nüüd peaksid sa selle teema eksportima teema konfiguratsioonifaili, et see turvaliselt säilitada või seda mujal kasutada.';

$lang['Confirm_delete_style'] = 'Oled sa kindel, et soovid antud stiili kustutada?';

$lang['Download_theme_cfg'] = 'Eksportija ei saanud kirutada teema infofaili. Vajuta allolevale nupule, et see fail oma brauseriga alla laadida. Kui fail on alla laetud, siis tõsta see kausta, kus asuvad põhjad (templates). Siis võid sa need failid kasutamiseks pakkida või mujal kasutada, kui sa soovid.';
$lang['No_themes'] = 'Valitud teemale pole ühtegi teemat lisatud. Et luua uut teemat, kliki vasakul olevas paneelis linki Loo uus';
$lang['No_template_dir'] = 'Ei õnnestunud avad põhjade kausta. See võib olla veebiserverile lugematu või pole seda olemas';
$lang['Cannot_remove_style'] = 'Sa ei saa valitud stiili eemalda, kuna see on praegu foorumi vaikimisi stiil. Palun  muuda vaikimisi stiili ja proovi uuuesti.';
$lang['Style_exists'] = 'Sellise nimega stiil on juba olemas. Mine tagasi ja vali mõni muu nimi.';

$lang['Click_return_styleadmin'] = 'Vajuta %ssiia%s et minna tagasi Stiilide Administreerimise lehele';

$lang['Theme_settings'] = 'Teema seaded';
$lang['Theme_element'] = 'Teema Element';
$lang['Simple_name'] = 'Lihtne nimi';
$lang['Value'] = 'Väärtus';
$lang['Save_Settings'] = 'Salvesta seaded';

$lang['Stylesheet'] = 'CSS Stiilileht';
$lang['Background_image'] = 'Taustapilt';
$lang['Background_color'] = 'Taustavärv';
$lang['Theme_name'] = 'Teema nimi';
$lang['Link_color'] = 'Lingi värv';
$lang['Text_color'] = 'Teksti värv';
$lang['VLink_color'] = 'Külastatud lingi värv';
$lang['ALink_color'] = 'Aktiivse lingi värv';
$lang['HLink_color'] = 'Hover lingi värv';
$lang['Tr_color1'] = 'Tabeli rea värv 1';
$lang['Tr_color2'] = 'Tabeli rea värv 2';
$lang['Tr_color3'] = 'Tabeli rea värv 3';
$lang['Tr_class1'] = 'Tabeli rea klass 1';
$lang['Tr_class2'] = 'Tabeli rea klass 2';
$lang['Tr_class3'] = 'Tabeli rea klass 3';
$lang['Th_color1'] = 'Tabeli päise värv 1';
$lang['Th_color2'] = 'Tabeli päise värv 2';
$lang['Th_color3'] = 'Tabeli päise värv 3';
$lang['Th_class1'] = 'Tabeli päise klass 1';
$lang['Th_class2'] = 'Tabeli päise klass 2';
$lang['Th_class3'] = 'Tabeli päise klass 3';
$lang['Td_color1'] = 'Tablei lahtir(celli) värv 1';
$lang['Td_color2'] = 'Tablei lahtir(celli) värv 2';
$lang['Td_color3'] = 'Tablei lahtir(celli) värv 3';
$lang['Td_class1'] = 'Tablei lahtir(celli) klass 1';
$lang['Td_class2'] = 'Tablei lahtir(celli) klass 2';
$lang['Td_class3'] = 'Tablei lahtir(celli) klass 3';
$lang['fontface1'] = 'Kirja tüüp 1';
$lang['fontface2'] = 'Kirja tüüp 2';
$lang['fontface3'] = 'Kirja tüüp 3';
$lang['fontsize1'] = 'Kirja suurus 1';
$lang['fontsize2'] = 'Kirja suurus 2';
$lang['fontsize3'] = 'Kirja suurus 3';
$lang['fontcolor1'] = 'Kirja värv 1';
$lang['fontcolor2'] = 'Kirja värv 2';
$lang['fontcolor3'] = 'Kirja värv 3';
$lang['span_class1'] = 'Ajavahemiku(span) klass 1';
$lang['span_class2'] = 'Ajavahemiku(span) klass 2';
$lang['span_class3'] = 'Ajavahemiku(span) klass 3';
$lang['img_poll_size'] = 'Hääletuse pildi suurus [px]';
$lang['img_pm_size'] = 'Privaatsõnumi Staatuse suurus [px]';

//
// Install Process
//
$lang['Welcome_install'] = 'Teretulemast phpBB 2 Installeerimisele';
$lang['Initial_config'] = 'Põhikonfiguratsioon';
$lang['DB_config'] = 'Andmebaasi konfiguratsioon';
$lang['Admin_config'] = 'Administraatori konfiguratsioon';
$lang['continue_upgrade'] = 'Kui sa oled konfiguratsioonifaili oma arvutisse laadinud, siis võid sa vajutada\'Jätka Uendamist\' nuppu allpool et jätkata uuenddamise protsessi.  Palun oota konfiguratsioonifaili üleslaadimisega seni, kuni uuendamine on lõpetatud.';
$lang['upgrade_submit'] = 'Jätka uuendamist';

$lang['Installer_Error'] = 'Installeerimise käigus on tekkinud viga';
$lang['Previous_Install'] = 'Tuvastatud on eelnev installeerimine';
$lang['Install_db_error'] = 'Andmebaasi uuendamisel tekkis viga';

$lang['Re_install'] = 'Su eelnev installatsioon on veel aktiivne. <br /><br />Kui sa tahad phpBB 2-e reinstalleerida, siis vajuta allolevale Jah nupule. Selle tegemine kustutab kõik eenevad andmed, varukoopiaid ei teha! Administraatori kasutajanimi ja parool, millega sa end foorumisse sisse oled loginud, taastatakse pärast reinstalleerimist, ühtegi teist seadet alles ei jää. <br /><br />Mõtle hoolikalt järele, enne kui Jah vajutad!';

$lang['Inst_Step_0'] = 'Aitäh, et oled valinud phpBB 2-e. Et seda installeerimist lõpetada, märgi palun ära allpool nõutud üksikasjad. Andmebaas, millesse sa installeerima hakkad, peaks enne olemas olema. Kui sa installeerid admebaasi, mis kasutab ODBC-d, nt MS Access, siis peaksid sa enne jätkamist looma sellele DSN-i.';

$lang['Start_Install'] = 'Alusta Installeerimist';
$lang['Finish_Install'] = 'Lõpeta Installeerimine';

$lang['Default_lang'] = 'Foorumi vaikimisi keel';
$lang['DB_Host'] = 'Andmebaasi serveri hostinimi/DSN';
$lang['DB_Name'] = 'Sinu andmebaasi nimi';
$lang['DB_Username'] = 'Andmebaasi kasutajanimi';
$lang['DB_Password'] = 'Andmebaasi parool';
$lang['Database'] = 'Sinu andmebaas';
$lang['Install_lang'] = 'Vali installerimiseks keel';
$lang['dbms'] = 'Andmebaasi tüüp';
$lang['Table_Prefix'] = 'Prefiks andmebaasi tabelitele';
$lang['Admin_Username'] = 'Administraatori kasutajanimi';
$lang['Admin_Password'] = 'Administraatori parool';
$lang['Admin_Password_confirm'] = 'Administraatori parool [ Kinnita ]';

$lang['Inst_Step_2'] = 'Administraatori kasutajanimi on loodud.  Peamine installeerimine on valmis. Nüüd viiakse sind uut installeerimist administreerima. Vaata kindlasti üle Üldine Konfiguratsioon, et teha vajalikud muudatused. Aitäh, et valisid phpBB 2-e.';

$lang['Unwriteable_config'] = 'Su konfiguratsioonifail on hetkel kirjutuskaitstud. Selle koopia laetakse alla, kui sa vajutad allolevale nupule. See fail tuleks panna sammasse kausta, kus on phpBB 2. Kui see on tehtud, peaks sa sisse logima adminstraatori kasutajanime ja parooliga, mille sa said eelmises vormis ning üle vaatama Administratsioonipaneeli (vastav link ilmub iga lehekülje alla äärde, kui sa oled end sisse loginud), et kontrollida peamisi seadeid. Aitäh, et valisid phpBB 2-e.';
$lang['Download_config'] = 'Lae alla konfiguratsioon';

$lang['ftp_choose'] = 'Vali allalaadimise meetod.';
$lang['ftp_option'] = '<br />Kuna FTP laiendid on selles PHP versioonis lubatud, võidakse sulle pakkuda võimalust proovida konfiguratsiooni faili FTP kaudu paika seada.';
$lang['ftp_instructs'] = 'Sa tegid valiku, et soovid automaatselt vajalikud failid FTP kaudu phpBB 2-e kontole kanda.  Palun sisesta vajalik info, et seda protsessi lihtsustada. Note that the FTP path should be the exact path via ftp to your phpBB2 installation as if you were ftping to it using any normal client.';
$lang['ftp_info'] = 'Sisesta oma FTP info';
$lang['Attempt_ftp'] = 'Püüa konfiguratsioonifaili FTP-ga paika panna';
$lang['Send_file'] = 'Saada see fail mulle ja seadistan selle FTP kaudu käsitsi.';
$lang['ftp_path'] = 'FTP teerada phpBB 2-e juurde';
$lang['ftp_username'] = 'Su FTP kasutajanimi';
$lang['ftp_password'] = 'Su FTP parool';
$lang['Transfer_config'] = 'Alusta laadimist';
$lang['NoFTP_config'] = 'FTP kaudu konfiguratsioonifaili paika panemine ebaõnnestus. Palun lae see fail alla ja pane käsitsi vastavasse kataloogi.';

$lang['Install'] = 'Installeeri';
$lang['Upgrade'] = 'Uuenda';

$lang['Install_Method'] = 'Vali installeerimise meetod';
$lang['Install_No_Ext'] = 'Sinu serveri PHP konfiguratsioon ei toeta valitud andmebaasi tüüpi.';
$lang['Install_No_PCRE'] = 'phpBB2 nõuab Perliga sobivat Tavaliste Laiendite Moodulit, mida sinu PHP konfiguratsioon ei paista toetavat.';

//
// That's all Folks!
// -------------------------------------------------
?>