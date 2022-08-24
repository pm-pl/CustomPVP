<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class KnockBack implements Listener {

    public function __construct(private Main $main) {

    }

    public function onEntity(EntityDamageByEntityEvent $event) : void {	
        if($this->getMain()->cfg->get("knockback") === true) {
            $event->setKnockBack($this->getMain()->cfg->get("knockback-level") * $event->getKnockBack());
        }
    }

    public function getMain() : Main {
        return $this->main;
    }	 	
}