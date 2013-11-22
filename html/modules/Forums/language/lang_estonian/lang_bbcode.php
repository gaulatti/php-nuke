<?php
/***************************************************************************
 *                         lang_bbcode.php [english]
 *                            -------------------
 *   begin                : Wednesday Oct 3, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: lang_bbcode.php,v 1.3 2001/12/18 01:53:26 psotfx Exp $
 *
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
 
// 
// To add an entry to your BBCode guide simply add a line to this file in this format:
// $faq[] = array("question", "answer");
// If you want to separate a section enter $faq[] = array("--","Block heading goes here if wanted");
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put double quotes (") in your BBCode guide entries, if you absolutely must then escape them ie. \"something\"
//
// The BBCode guide items will appear on the BBCode guide page in the same order they are listed in this file
//
// If just translating this file please do not alter the actual HTML unless absolutely necessary, thanks :)
//
// In addition please do not translate the colours referenced in relation to BBCode any section, if you do
// users browsing in your language may be confused to find they're BBCode doesn't work :D You can change
// references which are 'in-line' within the text though.
//
 
$faq[] = array("--","Sissejuhatus");
$faq[] = array("Mis on BBCode?", "BBCode on eriline HTML-i kasutusviis. selle, kas saad oma postis BBCode-i kasutada määrab kindlaks administraator. Lisaks saad sa BBCode-i keelata iga postituse korral eraldi postitusvormist. BBCode sarnaneb stiililt HTML-ile, käsud on suletud &lt; ja &gt; asemel kantsulgudesse [ ] ning see mis ja kuidas kuvatakse on paremini kontrollitav. Sõltuvalt sellest, millist ğablooni sa kasutad, võid märgata, et BBCode-i kasutamine on muudetud palju lihtsamaks postitusvormis olevate nuppudega. Kuid ka sel juhul võid järgnevast juhust kasulikke mõtteid leida.");

$faq[] = array("--","Teksti vormistamine");
$faq[] = array("Kuidas luua rasvast, kursiivis või allajoonitud teksti", "BBCode sisaldab käske, mis võimaldavad kiiresti muuta teksti algelist kujundust. Selleks on järgnevad võimalused: <ul><li>Et muuta teksti rasvaseks sulgege ta <b>[b][/b]</b> käsuga, näiteks<br /><br /><b>[b]</b>Tere<b>[/b]</b><br /><br />on <b>Tere</b></li><li>Allajoonimiseks kasuta <b>[u][/u]</b> käsku, näiteks:<br /><br /><b>[u]</b>Tere hommikut<b>[/u]</b><br /><br />tulemuseks <u>Tere hommikut</u></li><li>Kursiivi jaoks kasutage <b>[i][/i]</b> käsku, näiteks<br /><br />See on <b>[i]</b>mõnus!<b>[/i]</b><br /><br />tulemuseks See on <i>mõnus!</i></li></ul>");
$faq[] = array("Kuidas muuta teksti värvi ja suurust", "Teksti värvi ja suuruse muutmiseks saab kasutada järgnevaid käske. Pidage meeles, et kuvatava lõplik väljanägemine sõltub  vaataja brauserist ja seadetest: <ul><li>Teksti värvi saab muuta sidudes ta <b>[color=][/color]</b> käsuga. Te võite määrat tuntumaid värve nime pidi (inglise keeles) (näiteks red, blue, yellow, etc.) või siis heksadeemilise kolmeosalise (?) koodiga, näiteks #FFFFFF, #000000. Näide: et luua punast teksti võib kasutada:<br /><br /><b>[color=red]</b>Tere!<b>[/color]</b><br /><br />või<br /><br /><b>[color=#FF0000]</b>Tere!<b>[/color]</b><br /><br />mõlemal juhul on tulemuseks <span style=\"color:red\">Tere!</span></li><li>Teksti suuruse muutmine käib sarnaselt kasutades <b>[size=][/size]</b> käsku. See käsk on sõltuvuses kasutatavast ğabloonist, kuid soovitatav on arvuline väärtus, mis viitab teksti suurusele pikslites, alustades numbrist 1 (liiga väike, et seda isegi näha) kuni numbrini 29 (väga suur). Näiteks:<br /><br /><b>[size=9]</b>VÄIKE<b>[/size]</b><br /><br />on reeglina <span style=\"font-size:9px\">VÄIKE</span><br /><br />samas:<br /><br /><b>[size=24]</b>SUUR!<b>[/size]</b><br /><br />on <span style=\"font-size:24px\">SUUR!</span></li></ul>");
$faq[] = array("Kas ma saan siduda erinevaid kujunduskäske?", "Jah, see on võimalik - et püüda tähelepanu võite kirjutada:<br /><br /><b>[size=18][color=red][b]</b>VAATA SIIA!<b>[/b][/color][/size]</b><br /><br />, mis kuvatakse kui <span style=\"color:red;font-size:18px\"><b>VAATA SIIA!</b></span><br /><br />Samas pole soovitav enamikku teksti sellises vormingus kuvada! Pidage meeles, et teate saatja kohus on hoolitseda selle eest,et käsud saaks ka kinni pandud. Näiteks see on vale:<br /><br /><b>[b][u]</b>See on vale<b>[/b][/u]</b>");

$faq[] = array("--","Viitamine ja kindlate mõõtmetega tekst");
$faq[] = array("Viitamine teatele vastates", "Tekstile viitamiseks on kaks viisi, sõnalise viitega ja ilma.<ul><li>Kui te kasutate teate juures olevat Vasta viitega nuppu, siis pannakse originaaltekst teie teatesse kaasa kui <b>[quote=\"\"][/quote]</b> osa. See võimaldab teil viidata mõnele inimesele või millele iganes soovite! Näiteks, et viidata tekstile, mida härra Tamm kirjutas, siis sisestage:<br /><br /><b>[quote=\"härra Tamm\"]</b>härra Tamme tekst<b>[/quote]</b><br /><br />automaatselt kuvatakse - härra Tamm kirjutas: - enne tema tekstiks märgitud osa. Pidage meeles kaldkriipsud \"\" nime ümber, millele te viitate, <b>on</b> vajalikus.</li><li>Teine meetod võimaldab teil viidata millelegi nö pimesi. Selleks pange tekst <b>[quote][/quote]</b> käsu vahele. Kui vaatate teadet on seal lihtsalt - Viide: ja tekstis viidatava tekst.</li></ul>");
$faq[] = array("Kindlate mõõtmetega teksti kuvamine", "Kui peate kuvama koodi või midagi muud, mis nõuab kindlat omadust, näiteks Courier tüüpi fonti, peaksite ta panema <b>[code][/code]</b> käsu vahele, näiteks<br /><br /><b>[code]</b>echo \"See on kood\";<b>[/code]</b><br /><br />Kõik vormistamine, mida kasutatakse<b>[code][/code]</b> taastatakse kui te seda hiljem vaatate.");

$faq[] = array("--","Üldised nimekirjad");
$faq[] = array("Korrastamata nimekirja loomine", "BBCode võimaldab kahte sorti nimekirju, korrastatud ja korrastamata. NAd on võrdväärsed HTML-i nimekirjadega. Korrastamata nimekiri paigutab nimekirja osad üksteise alla, märgistades nende alguse vastava märgiga. Et luua korrastamata nimekirja kasutage <b>[list][/list]</b> käsku ja ja määrake iga nimekirja osa algus <b>[*]</b> käsuga. Näiteks oma lemmikvärvide reastamiseks kasuta:<br /><br /><b>[list]</b><br /><b>[*]</b>Punane<br /><b>[*]</b>Sinine<br /><b>[*]</b>Kollane<br /><b>[/list]</b><br /><br />Tulemuseks oleks järgmine nimekiri:<ul><li>Punane</li><li>Sinine</li><li>Kollane</li></ul>");
$faq[] = array("Korrastatud nimekirja loomine", "Teine nimekirja tüüp, korrastatud nimekiri, annab sulle võimaluse kontrollida, mis pannakse nimekirjaosade ette. Korrastatud nimekirja loomiseks kasutage <b>[list=1][/list]</b> käsku, et luua nummerdatud nimekiri või <b>[list=a][/list]</b> käsku, et luua tähestiku järjekorras olev nimekiri. Nagu ka korrastamata nimekirjas, eraldage osised <b>[*]</b> käsuga. Näiteks:<br /><br /><b>[list=1]</b><br /><b>[*]</b>Mine poodi<br /><b>[*]</b>Osta uus arvuti<br /><b>[*]</b>Vannu, kui arvuti lakkab töötamast<br /><b>[/list]</b><br /><br />tulemuseks:<ol type=\"1\"><li>Mine poodi</li><li>Osta arvuti</li><li>Vannu, kui arvuti lakkab töötamast</li></ol>Tähestiku järjekorras oleva nimekirja loomiseks kirjuta:<br /><br /><b>[list=a]</b><br /><b>[*]</b>Esimene<br /><b>[*]</b>Teine<br /><b>[*]</b>Kolmas<br /><b>[/list]</b><br /><br />tulemus<ol type=\"a\"><li>Esimene</li><li>Teine</li><li>Kolmas</li></ol>");

$faq[] = array("--", "Linkide loomine");
$faq[] = array("Teisele leheküljele linkimine", "PhpBB BBCode toetab erinevaid viise, kuidas luua URI-sid (Uniform Resource Indicators, paremini tuntud kui URL-id).<ul><li>Esimene võimalus on kasutada <b>[url=][/url]</b> käsku, kõik mis jääb pärast = kuvatakse kui URL-i. Näiteks lingi phpBB.com-i võib teha nii:<br /><br /><b>[url=http://www.phpbb.com/]</b>Külasta phpBB-d!<b>[/url]</b><br /><br />Tulemuseks oleks järgmine link, <a href=\"http://www.phpbb.com/\" target=\"_blank\">Külastage phpBB-d!</a> Link avaneb uues aknas, nii et kasutaja saab jätkata foorumi uurimist.</li><li>Kui soovite, et URL ise oleks näha kui link, siis tehke nii:<br /><br /><b>[url]</b>http://www.phpbb.com/<b>[/url]</b><br /><br />Tulemuseks oleks järgmine link, <a href=\"http://www.phpbb.com/\" target=\"_blank\">http://www.phpbb.com/</a></li><li>Lisaks on phpBB-s võimalus, mida kutsutakse <i>Maagiliseks lingiks</i>, see muudab iga korrektsel kujul oleva URL-i lingiks, ilma et te peaksite mingeid käske kasutama või isegi 'http://' algusse lisama. Näiteks kirjutades www.phpbb.com oma teatesse on automaatselt tulemuseks <a href=\"http://www.phpbb.com/\" target=\"_blank\">www.phpbb.com</a> kui teie teated vaadatakse.</li><li>Sama kehtib ka e-posti aadressite kohta, te võite kas e-posti aadressi täpselt määramata :<br /><br /><b>[email]</b>no.one@domain.adr<b>[/email]</b><br /><br />mille tulemuseks oleks <a href=\"emailto:no.one@domain.adr\">no.one@domain.adr</a> või te võite lihtsalt kirjutada no.one@domain.adr oma teatesse ja see muudetakse teate vaatamise korral automaatselt lingiks.</li></ul>Nagu ka teiste BBCode-i käskudega saab ka URL-e siduda teiste käskudega, näiteks:<b>[img][/img]</b> (vaata järgmist), <b>[b][/b]</b>, jne. Vormingu käskude puhul on teie ülesandeks pöörata tähelepanu sellele, et käskudel oleks kah lõpp, näiteks:<br /><br /><b>[url=http://www.phpbb.com/][img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/url][/img]</b><br /><br /><u>pole</u> õige ja võib viia teie teate kustutamiseni.");

$faq[] = array("--", "Piltide kuvamine teates");
$faq[] = array("Pildi lisamine teatele", "PhpBB BBCode sisaldab käsku millega lisada teatele pilte. Selle käsu puhul tuleb tähelepanu pöörata kahele väga tähtsale asjaolule; paljud kasutajad ei pea piltiderohkeid teateid maitsekateks ja kuvatava pilt peab eelnevalt olemas internetis kättesaadav (pole kasu kui pilt on olemas teie arvutis, välja arvatud juhul kui teie arvuti on veebiserver!). PhpBB ei suuda praegu pilte talletada (PhpBB järgmises versioonis on nee võimalused loodetavasti olemas). Et pilti kuvada pead te pildile viitava URL-i ümbritsema käsuga <b>[img][/img]</b>. Näiteks:<br /><br /><b>[img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/img]</b><br /><br />Nagu URL-i osast teada saate te siduda pildi <b>[url][/url]</b> käsuga, näiteks <br /><br /><b>[url=http://www.phpbb.com/][img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/img][/url]</b><br /><br />Tulemus:<br /><br /><a href=\"http://www.phpbb.com/\" target=\"_blank\"><img src=\"http://www.phpbb.com/images/phplogo.gif\" border=\"0\" alt=\"\" /></a><br />");

$faq[] = array("--", "Muud teemad");
$faq[] = array("Kas ma saan luua omi käske?", "Ei, phpBB 2.0 ei võimalda seda. Kohandatavad BBCode käsud on olemas järgmises suuremas foorumi versioonis");

//
// This ends the BBCode guide entries
//

?>