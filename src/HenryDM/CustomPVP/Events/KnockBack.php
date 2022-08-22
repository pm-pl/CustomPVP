<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;

use HenryDM\CustomPVP\Main;

class KnockBack implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
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