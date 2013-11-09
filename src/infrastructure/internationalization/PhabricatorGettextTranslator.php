<?php

final class PhabricatorGettextTranslator
extends PhutilCustomTranslator {
  public function __construct($lang) {
    $root = dirname(phutil_get_library_root('phabricator'));
    $root = $root.'/resources/internationalization/mo/';
    bindtextdomain("phabricator", $root);
    bind_textdomain_codeset("phabricator", 'UTF-8');
    setlocale(LC_MESSAGES, $lang);
  }

  final public function translate($text) {
    return dgettext("phabricator", $text);
  }
  
  final public function plural_translate($text, $variant) {
    if (is_int($variant)) {
      return dngettext("phabricator", 
                       $text[0][0], $text[0][1], $variant);
    } else {
      return dgettext("phabricator", $text);
    }
  }
}


?>
