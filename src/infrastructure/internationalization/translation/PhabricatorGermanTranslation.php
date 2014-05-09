<?php

final class PhabricatorGermanTranslation extends PhabricatorTranslation {

  final public function getLanguage() {
    return 'de';
  }

  public function getName() {
    return 'Deutsch';
  }

  public function getTranslations() {
    return
      PhabricatorEnv::getEnvConfig('translation.override');
  }

  final public function getTranslator() {
    return new PhabricatorGettextTranslator("de_DE");
  }

}
