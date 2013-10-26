<?php

final class PhabricatorGermanTranslation
  extends PhabricatorBaseGermanTranslation {

  public function getName() {
    return 'Deutsch';
  }

  public function getTranslations() {
    return
      PhabricatorEnv::getEnvConfig('translation.override') +
      parent::getTranslations();
  }

}
