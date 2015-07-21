<?php

final class PhabricatorGettextTranslator
extends PhutilCustomTranslator {
  public function __construct($lang) {
    $root = dirname(phutil_get_library_root('phabricator'));
    $root = $root.'/resources/internationalization/mo/';
    bindtextdomain("phabricator", $root);
    bind_textdomain_codeset("phabricator", 'UTF-8');
    setlocale(LC_MESSAGES, $lang);
    setlocale(LC_TIME, $lang);
  }

  final public function translate($text) {
    return dgettext("phabricator", $text);
  }
  
  final public function plural_translate($text, $variant) {
    $t = $text;
    if (is_array($t[0])) {
      $t = $t[0];
    }

    if (is_int($variant)) {
      $r = dngettext("phabricator", $t[0], $t[1], $variant);
    } else {
      $r = dgettext("phabricator", $t[0]);
    }

    return $r;
  }
}


?>
