<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

class MaxPingKick implements Listener {

public function __construct(private Main $main) {
    $this->main = $main;
}

public function onRun : void {

 }
}