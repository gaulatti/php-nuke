/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('advimage', 'albanian,arabic,brazilian,catala,chinese,czech,danish,dutch,english,euskara,finnish,french,galego,german,greek,hungarian,icelandic,indonesian,italian,macedonian,norwegian,polish,portuguese,romanian,russian,slovak,slovenian,spanish,swedish,thai,turkish,ukrainian,vietnamese');

/**
 * Insert image template function.
 */
function TinyMCE_advimage_getInsertImageTemplate() {
    var template = new Array();

    template['file']   = '../../plugins/advimage/image.htm';
    template['width']  = 430;
    template['height'] = 380; 

    // Language specific width and height addons
    template['width']  += tinyMCE.getLang('lang_insert_image_delta_width', 0);
    template['height'] += tinyMCE.getLang('lang_insert_image_delta_height', 0);

    return template;
}

/**
 * Setup content function.
 */
function TinyMCE_advimage_handleEvent(editor_id, body, doc) {
	// Convert all links to absolute

	alert(editor_id + "," + body.innerHTML);
}
