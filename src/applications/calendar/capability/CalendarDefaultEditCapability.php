<?php

final class CalendarDefaultEditCapability extends PhabricatorPolicyCapability {

  const CAPABILITY = 'calendar.default.edit';

  public function getCapabilityName() {
    return pht('Default Edit Policy');
  }

}
