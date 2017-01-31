<?php

// Get current language
$locale = pll_current_language();

// PO file translations
if ( file_exists( WP_LANG_DIR . '/themes/twentyfifteen-child-fr_FR.mo' ) && $locale === 'fr' ) {
    load_textdomain( 'twentyfifteen-child', WP_LANG_DIR . '/themes/twentyfifteen-child-fr_FR.mo' );
}
