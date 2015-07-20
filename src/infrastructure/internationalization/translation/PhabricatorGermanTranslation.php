<?php

final class PhabricatorGermanTranslation extends PhutilTranslation {

  public function getLocaleCode() {
    return 'de_DE';
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
