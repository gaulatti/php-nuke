function embedFlash(pathCompleto,pelicula,ancho,alto){
	  document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'+ancho+'" height="'+alto+'" title="PhpNuke">');
		document.write('<param name="movie" value="'+pathCompleto+pelicula+'.swf" />');
		document.write('<param name="quality" value="high" />');
		document.write('<param name="wmode" value="transparent" />');
		document.write('<embed src="'+pathCompleto+pelicula+'.swf" width="'+ancho+'" height="'+alto+'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent"></embed>');
	  document.write('</object>');
}