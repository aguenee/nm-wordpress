<?php

// Get current language
if ( function_exists( pll_current_language ) ) {
	$locale = pll_current_language();
} else {
	$locale = 'fr_FR';
}

// PO file translations
if ( file_exists( WP_LANG_DIR . '/themes/twentyfifteen-child-fr_FR.mo' ) && $locale === 'fr' ) {
    load_textdomain( 'twentyfifteen-child', WP_LANG_DIR . '/themes/twentyfifteen-child-fr_FR.mo' );
}
