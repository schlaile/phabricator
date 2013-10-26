<?php

final class PhabricatorGermanTranslation
  extends PhabricatorBaseEnglishTranslation {

  final public function getLanguage() {
    return 'de';
  }

  public function getName() {
    return 'Deutsch';
  }

  public function getTranslations() {
    return
      PhabricatorEnv::getEnvConfig('translation.override') +
      parent::getTranslations();
  }

  final public function getTranslator() {
    return new PhabricatorGettextTranslator("de_DE");
  }

}
