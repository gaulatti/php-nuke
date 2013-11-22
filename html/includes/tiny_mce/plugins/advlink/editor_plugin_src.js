/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('advlink', 'albanian,arabic,brazilian,catala,chinese,czech,danish,dutch,english,euskara,finnish,french,galego,german,greek,hungarian,icelandic,indonesian,italian,macedonian,norwegian,polish,portuguese,romanian,russian,slovak,slovenian,spanish,swedish,thai,turkish,ukrainian,vietnamese');

/**
 * Insert link template function.
 */
function TinyMCE_advlink_getInsertLinkTemplate() {
    var template = new Array();
    template['file']   = '../../plugins/advlink/link.htm';
    template['width']  = 440;
    template['height'] = 420;

    // Language specific width and height addons
    template['width']  += tinyMCE.getLang('lang_insert_link_delta_width', 0);
    template['height'] += tinyMCE.getLang('lang_insert_link_delta_height', 0);

    return template;
} 