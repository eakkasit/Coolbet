<?php

/**
 * wp_trim_words preserves HTML tags
 */
function wonderplugin_gallery_wp_trim_words( $text, $num_words = 55, $more = null ) {
	if ( null === $more ) {
		$more = __( '&hellip;' );
	}

	$original_text = $text;

	if ( strpos( _x( 'words', 'Word count type. Do not translate!' ), 'characters' ) === 0 && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
		$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
		preg_match_all( '/./u', $text, $words_array );
		$words_array = array_slice( $words_array[0], 0, $num_words + 1 );
		$sep = '';
	} else {
		$words_array = preg_split( "/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY );
		$sep = ' ';
	}

	if ( count( $words_array ) > $num_words ) {
		array_pop( $words_array );
		$text = implode( $sep, $words_array );
		$text = $text . $more;
	} else {
		$text = implode( $sep, $words_array );
	}

	return apply_filters( 'wp_trim_words', $text, $num_words, $more, $original_text );
}

function wonderplugin_gallery_wp_check_filetype_and_ext($data, $file, $filename, $mimes) {

	$filetype = wp_check_filetype( $filename, $mimes );

	return array(
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename']
	);
}

function wonderplugin_dirtoarray($dir, $recursive) {

	if (!is_readable($dir) || !file_exists($dir))
		return -1;
	
	$result = array();

	$cdir = scandir($dir);
	foreach ($cdir as $key => $value)
	{
		if (!in_array($value,array(".","..")))
		{
			if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
			{
				if ($recursive)
				{
					$result[$value] = wonderplugin_dirtoarray($dir . DIRECTORY_SEPARATOR . $value, $recursive);
				}
				else
				{
					$result[] = $value;
				}
			}
		}
	}
	 
	return $result;
}