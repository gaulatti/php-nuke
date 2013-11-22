<?php
/***************************************************************************
 *                          lang_faq.php [english]
 *                            -------------------
 *   begin                : Wednesday Oct 3, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: lang_faq.php,v 1.4 2001/12/15 16:42:08 psotfx Exp $
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
// To add an entry to your FAQ simply add a line to this file in this format:
// $faq[] = array("question", "answer");
// If you want to separate a section enter $faq[] = array("--","Block heading goes here if wanted");
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put double quotes (") in your FAQ entries, if you absolutely must then escape them ie. \"something\"
//
// The FAQ items will appear on the FAQ page in the same order they are listed in this file
//

$faq[] = array("--","Sisselogimine ja liitumine");
$faq[] = array("Miks ma ei saa sisse logida?", "Olete liitunud? Selleks, et sisse logida tuleb kõigepealt liituda. On teid foorumilt eemaldatud (sellisel juhul saate te vastava teate)? Kui nii on juhtunud, siis te peaksite ühendust võtma foorumi administraatoriga, et uurida välja eemaldamise põhjus. Kui olete liitunud ja pole eemaldatud, siis kontrollige veelkord üle oma kasutajanimi ja parool. Tavaliselt peitub viga viimases, kui ei, siis pöörduge foorumi administraatori poole.");
$faq[] = array("Miks ma peaks liituma?", "Te ei pea seda tingimata tegema, foorumi administraatori otsustada, kas saate liitumata postitada teateid. Kuna liitumine annab teile juurdepääsu lisavõimalustele, mis ei ole külalistele kättesaadavad (näiteks kindlad kasutaja pildid, erasõnumite saatmine ja saamine, kasutajatele e-kirjade saatmine,kasutajagruppidesse kuulumine jne). Liitumine võtab vaid mõne hetke ja on seda väärt.");
$faq[] = array("Miks mind logitakse automaatselt välja?", "Kui te ei tee linnukest <i>Logi mind automaatselt sisse</i> kasti, siis jääte sisselogituks vaid lehekülje kasutamise ajaks. See väldib teie kasutajakonto kuritarvitamist teiste poolt. Et automaatselt sisse logida teosta vastav valik sisselogimisel, see pole aga soovitav kui kasutate foorumit avalikust arvutist, näiteks raamatukogus, internetikohvikus, ülikooli arvutiklassis, jne.");
$faq[] = array("Kuidas ma saaks vältida oma kasutajanime sattumist foorumilolijate nimekirja?", "Oma profiilis leiate valiku <i>Varja minu foorumilolekut</i>, kui lülitate selle <i>sisse</i>, on teid näha ainult administraatorile ja iseendale. Teid loetakse kui varjatud kasutajat.");
$faq[] = array("Ma unustasin oma parooli!", "Ärge sattuge paanikasse! Kuigi teie parooli ei saa taastada, saab määrata teile uue parooli. Selleks minge sisselogimis lehele ja valige sealt <u>Olen unustanud oma parooli</u>, järgige instruktsioone ja peaksite peagi foorumil tagasi olema.");
$faq[] = array("Liitusin kunagi, kuid ei saa enam sisse logida?!", "Tõenäolisemad põhjused on; sisestasite vale kasutajanime ja parooli (vaadake need üle e-kirjast, mis teile liitumise puhul saadeti) või administraator on mingil põhjusel teie kasutajakonto kustutanud. Proovige uuesti registreeruda või võtke ühendust administraatoriga.");


$faq[] = array("--","Kasutaja eelistused ja seaded");
$faq[] = array("Kuidas saan ma oma seadeid muuta?", "Kõiki teie seaded (juhul kui olete liitunud) on salvestatud andmebaasi. Et neid muuta, vajutage linki <u>Profiil</u> (tavaliselt nähtaval lehe ülaosas). Sealt saate muuta kõiki oma seadeid");
$faq[] = array("Aeg pole õige!", "Üsnagi tõenäoliselt on aeg õige, aga viga võib olla selles, et ajavöönd erineb sellest, kus te viibite. Kui viga paistab selles olevat, siis muutke oma profiili alt ajavöönd õigeks.");
$faq[] = array("Muutsin ajatsooni, kuid aeg on ikka vale!", "Kui olete veendunud, et ajavöönd on õige, aga kell on vale, siis võib põhjus peituda suve- ja talveaja erinevuses. Kahjuks ei ole antud foorum võimeline selle muutusega kaasas käima.");
$faq[] = array("Minu keelt pole nimekirjas!", "Kõige tõenäolisemalt ei ole administraator seda keelt paigaldanud (või see on veel tõlkimata). Pöörduge oma murega administraatori poole");
$faq[] = array("Kuidas saan ma panna oma nime alla pildi?", "Kasutajanime all olevaid pilte võib olla kahte tüüpi. Esimene on seotud teie tiitliga viitamaks selle, kui palju te olete foorumile teateid postitanud või milline on teie staatus foorumil (tavaliselt tärnid või kuubikud). Selle all on suurem pilt, mida tuntakse 'Avatari' nime all, reeglina on see igal kasutajal erinev. Foorumi administraatorile jääb otsustada, kas 'avatarid' on lubatud ja kui on, siis mil moel. Kui sa ei saa 'avatare' kasutada, siis see on administraatori otsust, kuid te võite alati tema poole pöörduda sellekohase küsimusega.");
$faq[] = array("Kuidas ma saan muuta oma tiitlit?", "Reeglina ei saa te ühtegi tiitli sõnastust otseselt mõjutada (tiitlid ilmuvad teie kasutajanime all postitatud teemades või teie infolehel). Enamik foorumeid kasutab tiitleid, et viidata palju kasutaja on postitanud või siis tema erilise staatusele, näiteks moderatooritel ja administratoritel võivad olla erilised tiitlid. Ei ole mõtteks parema tiitli saamise eesmärgil postitada suurt hulka sisu vaeseid teateid - tulemuseks on administraatori/moderaatori sekkumine ja efekt saab olema oodatust vastupidine.");
$faq[] = array("Kui vajutan kasutaja e-posti linki, siis palutakse mul sisse logida?", "Ainult liitunud kasutajad saavad kasutada foorumisse sisse ehitatud e-posti klienti (kui administraator on selle valiku võimaldanud). Põhjus selleks on soov vältida e-posti kliendi kuritarvitamist.");


$faq[] = array("--","Teadete postitamisega seotud küsimused");
$faq[] = array("Kuidas ma saan foorumisse teadet postitada?", "Vajutage vastavale nupule kas siis foorumi- või teemalehel. Võibolla peate te teate postitamiseks liituma, omale saadaolevaid võimalusi võite te näha lehe alumises ääres vasakul paiknevas nimekirjas (<i>Te saate postitada uusi teateid, Te saate küsitlusel hääletada, jne.<i> nimekiri)");
$faq[] = array("Kuidas ma saan oma teadet muuta või kustutada?", "Kui te pole foorumi moderaator või administraator, siis saate muuta ja kustuda vaid enda teateid. Te saate teated muuta (mõnel juhul võib teadet muuta vaid piiratud aja jooksul) vajutades <i>muuda</i> nuppu asjasse puutuva teate juures.  Kui keegi on juba teatele vastanud, siis leiate väikse kirje teate all, kui pöördute tagasi teate juurde - seal on kirjas mitu korda ja kunas viimati muutmine toimus. See kirje ilmub ainult siis kui keegi on eelnevalt teatele vastanud või muutjaks on moderaator/administraator  (nemad peaksid ka jätma teate, milles seletavad muutmise põhjusi). Tähele tuleks panna ka asjaolu, et tavakasutajad ei saa teated kustutada, kui selle on vastatud.");
$faq[] = array("Kuidas ma saan oma teatele allkirja lisada?", "Selleks, et teatele allkirja lisada, tuleb viimane kõigepealt luua, seda saab teha oma profiilist. Kui allkiri on olemas, siis saate postitusvormis teha linnuke <i>Lisa allkiri</i> kasti, et lisada teatele allkirja. Allkirja saab ka kõigile teadetele vaikimisi lisada, kui märgistate nii vastava valiku oma profiilis (teile jääb iga individuaalse teate postitamise korral võimalus allkirjast loobuda eemaldades linnuke <i>Lisa allkiri</i> kastist)");
$faq[] = array("Kuidas ma saan algatada küsitlust?", "Küsitluste algatamine on lihte - kui postitad teema (või muudate teema esimest teadet, kui teil on selleks õigus) peaksite te nägema <i>Lisa küsitlus</i> vormi, mis asu põhi postitusvormi all (kui te seda ei näe, siis arvatavasti puuduvad teil õigused küsitluse algatamiseks). Te peaksite sisestama küsitluse pealkirja ja vähemalt kaks vastusevarianti (selleks, et määrata vastusevarianti sisestage see vastavale reale ja kasutage<i>Lisa vastusevariant</i> nuppu. Küsitlusele saab ka määrata ajalimiidi, 0 tähendab piiramatut aega. Valikuvõimaluste arv võib olla piiratud, selle määrab foorumi administraator");
$faq[] = array("Kuidas ma saan küsitlust muuta või kustutada?", "Nagu ka teadetega, saab küsitlust muuta või kustutada postitaja, moderaator või siis administraator. Selleks, et küsitlust muuta, vajuta teema esimest teadet(küsitlus on alati sellega seotud). Kui keegi pole veel hääletanud, siis saavad kasutajad muuta või kustutada oma küsitlust ja lisada või eemaldada vastusevariante. Samas kui keegi on hääletanud, saavad küsitlust muuta või kustutada vaid moderaatorid ja administraatorid. Selle reegli abil välditakse küsitlustulemuste mõjutamist mõnede variantide eemaldamisega küsitluse keskel");
$faq[] = array("Miks ma ei pääse foorumile ligi?", "Mõned foorumid võivad olla seotud kindlate kasutajate ja gruppidega. Selleks, et kinnises foorumis teateid näha, lugeda ja postitada on vaja vastavaid õigusi. Selleks on vajalik foorumi moderaatori või administraatori kinnitus, täpsema info saamiseks võtke nendega ühendust.");
$faq[] = array("Miks ma ei saa küsitlustel hääletada?", "Ainult liitunud kasutajad saavad küsitlustel hääletada. Kui olete liitunud, kuid ikkagi ei saa hääletada, siis puuduvad teie kasutajal selleks vastavad õigused.");


$faq[] = array("--","Kujundamine ja teemade tüübid");
$faq[] = array("Mis on BBCode?", "BBCode on spetsiaalne HTML-i kasutusviis, selle kasutamise võimalus sõltub administraatorist (ning seda saab keelata iga postituse kohta eraldi postitusvormist). BBCode on iseenesest sarnane HTML-ile, käsud suletakse kantsulgudesse [ ja ] koonussulgude  &lt; ja &gt; asemel ning ta pakub paremat kontrolli selle üle mida ja kuidas kuvatakse. Enama informatsiooni saamiseks vaata BBCode-i õpetust, mis on kättesaadav postitusvormist.");
$faq[] = array("Kas ma saan HTML-i kasutada?", "See sõltub sellest, kas administraator lubab seda. Isegi kui HTML on lubatud, ei pruugi enamik käske töötada. See on nii <i>turvalisuse tagamiseks</i>, sobimatud HTML käsud võiksid väärata foorumi väljanägemist ja eesmärke. Kui HTML on lubatud, siis saab seda iga posti kohta eraldi keelata postitusvormist.");
$faq[] = array("Mis on 'emotsioonid'?", "Emotsioonid on väikesed graafilised pildid, mida saab kasutada, et näidata oma tundeid. Emotsioonid kutsutakse esile lihtsa koodiga [näiteks :) tähendab rõõmu ja :( kurbust]. Täielik kasutada olev emotsioonide valik on näha postitusvormis. Ärge emotsioonidega liiale minge, kuna nad võivad muuta teate halvasti loetavaks ning paremal juhul eemaldab moderaator liigsed emotsioonid, halvemal juhul terve teie teate.");
$faq[] = array("Kas ma saan teatesse pilte panna?", "Pildid on teadetes näha. Kuna aga puudub vahend piltide üleslaadimiseks, siis te peate pildid linkima avalikult kättesaadavast serverist (näiteks http://www.mingi-koht.net/minu-pilt.gif). Te ei saa linkida pilte, mis asuvad teie arvutis (väljaarvatud juhul, kui te olete avaliku serverina funktsioneeriva masina taga), samuti ei saa kuvada pilte, mis asuvada parooliga kaitstud keskkondades (näiteks hotmail-i või mail.ee kirjakastis, parooliga kaitstud lehel jne). Pildi kuvamiseks kasutada vastavat BBCode-i [img] käsku või HTML-i (kui see on lubatud).");
$faq[] = array("Mis on teadaanded?", "Teadaanded sisaldavad tavaliselt tähtsat informatsiooni, mida tuleks lugeda esimesel võimalusel. Teadaanne ilmub iga lehe ülaossa, mis asuvad foorumis kuhu teadaanne postitati. See, kes saab ja kes ei saa teadaandeid postitada, sõltub administraatorist.");
$faq[] = array("Mille poolest erinevad kleepsud?", "Kleepsud kuvatakse ainult foorumi esimesel teadaannete alla ja seda ainult foorumi esimesel lehel. Väga tihti sisaldavad nad tähtsat informatsiooni ning neid tuleks lugeda. Nagu ka teadaannete puhuk, on foorumi administraator see, kes paneb paika, kellel on õigusi kleepse postitada ja kellel pole..");
$faq[] = array("Miks mõned teemad on kinni?", "Teemasid pannakse kinni moderaatori või administraatori soovil. Kinnistele teemadele ei saa vastata ja kõik selle teemaga seotud küsitlused lõppevad. Teema kinnipanemiseks võib olla mitmeid eri põhjusi.");


$faq[] = array("--","Kasutaja tasemed ja grupid");
$faq[] = array("Mis tähendab administraator?", "Administraatorid on inimesed, kellel on antud kõrgeim võim foorumi üle. Need inimesed kontrollivad kõik foorumi töö tahke, muuhulgas õiguste jagamist, kasutajate eemaldamist, kasutajagruppide loomist, moderaatoriõiguste andmist jne. Neil on ka moderaatoritele kuuluvad õigused.");
$faq[] = array("Mis tähendab moderaator?", "Moderaatorid on kasutajad (või kasutajate grupid) hoolitseda selle eest, et foorumi töö sujuks tõrgeteta. Nende võimuses on teateid muuta ja kustutada ning teemasid poolitada, liigutada, kinni panna ja lahti teha enda poolt modereeritavas foorumis. Reeglina püüavad moderaatorid ohjata <i>teema väliseid<i> teateid või sobimatuid kommentaare.");
$faq[] = array("Mis on kasutajagrupid?", "Kasutajagrupid on üks viis mida foorumi administraator saab kasutada kasutajate organiseerimiseks. Iga kasutaja võib kuuluda mitmesse erinevasse gruppi (mõnel foorumil võib see olla teisiti) ja igale grupile saab anda erinevaid juurdepääsu õigusi. Sel viisil on administraatoritel lihtne määrata mitmeid kasutajaid foorumi moderaatoriteks, tagada neile juurdepääs erafoorumitele jne.");
$faq[] = array("Kuidas ma saan mingi kasutajagrupiga liituda?", "Et mingi kasutajagrupiga liituda vajutage kasutajagruppide lingile lehe ülaosas (täpne asukoht sõltub kasutatavast ğabloonist). Sealt saate te vaadata kõiki kasutajagruppe. Mitte kõik grupid pole <i>Juurdepääsuks avatud</i>, mõned on suletud ja osadel on varjatud liikmelisus. Sel juhul peab grupi moderaator suu soovi heaks kiitma või tagasi lükata.");
$faq[] = array("Kuidas ma saan mingi kasutajagrupi moderaatoriks?", "Kasutajagruppe loob algselt foorumi administraator, tema määrab ka kindlaks moderaatori(d). Kui soovite luua kasutajagruppi, siis peaksite kõigepealt administraatori pool pöörduma, näiteks saatke talle erasõnum.");


$faq[] = array("--","Erasõnumid (es)");
$faq[] = array("Ma ei saa erasõnumeid saata!", "Selleks võib olla kolm erinevat põhjust; Te pole liitunud või sisse loginud, administraator on terves foorumis keelanud erasõnumite saatmise või foorumi administraator hoiab teid sõnumeid saamast. Viimasel juhul peaksite te välja uurima, miks see nii on.");
$faq[] = array("Ma mulle saadetakse soovimatuid erasõnumeid!", "Kui te saate soovimatuid kirju ühelt või mitmelt kasutajalt, siis teata sellest foorumi administraatori, kelle võimuses on muuhulgas terve erasõnumisüsteemi peatamine.");
$faq[] = array("Keegi sellest foorumist on saatnud mulle rämpsposti või ahistava sisuga e-kirja!", "Seda on ääretult kurb kuulda. Selle foorumi e-posti klient omab võimalusi, et tuvastada sellise teo sooritanud isikuid. Te peaksid terve saadud e-kirja koopia edasi saatma foorumi administraatorile, eriti tähtis on kirja kaasata 'headerid' (need kujutavad endast detailset informatsiooni kirja saatja kohta). Siis saame me midagi ette võtta, et selline tegu ei korduks.");

//
// These entries should remain in all languages and for all modifications
//
$faq[] = array("--","phpBB 2-ga seonduv");
$faq[] = array("Kes kirjutas selle teadetetahvli?", "Selle tarkvara (algsel kujul) on loodud, välja lastud ja autoriõigusega kaitstud <a href=\"http://www.phpbb.com/\" target=\"_blank\">phpBB Group-i poolt</a>. See on kõigile kättesaadav GNU Üldise Avaliku Litsentsi alusel ja seda võib vabalt jagada, täpsema info saamiseks külasta linki");
$faq[] = array("Miks ei ole x võimalus saadaval?", "See tarkvara kirjutati ja litsentseeriti phpBB Group-i poolt. Kui te tunnete, et midagi vajab lisamist, siis külastage aadressi phpbb.com ja vaata, mida phpbb Group sellest arvab. Palun ärge postitage uusi lisavõimaluste palveid phpbb.com foorumile, Group kasutab SourceForge-i uute võimaluste loomisega kaasneva koormusega toimetulekuks. Palun vaata foorumid läbi ja veendu selles, et sinu poolt soovitava lisavõimalus suhtes pole juba seisukohta võetud.");
$faq[] = array("Kelle poole pean ma pöörduma seoses ahistava sisuga e-kirjadega?", "Te peaksite võtma ühendust foorumi administraatoriga. Kui sa ei leia administraatorit, siis võta ühendust moderaatoritega ja uuri nende käest kuidas esimesega ühendust saada. Kui te ikka ei saa vastust, siis peaksite ühendust võtma domeeni omanikuga (tehke whois otsing) või kui foorum töötab tasuta teenuselt (näiteks yahoo, free.fr, f2s.com, jne), siis võtke ühendust sealse juhatuse või kuritarvitamisega tegeleva osakonnaga. Palun võtke teadmiseks, et phpBB Group-il ei kontrolli olukorda mittemingil moel ja ei saa pidada vastutavaks kuidas, kus või kelle poolt seda foorumit kasutatakse. PhpBB Group-iga ühendusevõtmine seoses mõne õigusliku (cease and desist, liable, defamatory comment, etc.) juhtumiga, mis ei oel otseselt seotud phpbb.com veebilehega või konkreetselt phpBB tarkvara puudutava küsimusega, ei oma mingit mõtet. Kui te saadate phpBB Group-ile kirja seoses kolmanda osapoole kohta, siis tõenäoliselt saadetakse teile lühike vastus või ei vastata üldse.");

//
// This ends the FAQ entries
//

?>