<?php
$rb_domain = 'crb';
$rb_locale = get_locale();
$rb_locale = apply_filters( 'plugin_locale', $rb_locale, $rb_domain );
$rb_mofile = $rb_locale . '.mo';
$rb_lang_dir = CARBON_PLUGIN_ROOT . DIRECTORY_SEPARATOR . 'lang';
load_textdomain( 'crb', $rb_lang_dir . DIRECTORY_SEPARATOR . $rb_mofile );