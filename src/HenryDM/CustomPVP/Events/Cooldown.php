<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

use HenryDM\CustomPVP\Main;

class Cooldown implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) : void {
        if($this->getMain()->cfg->get("cooldown") === true) {
            $event->setAttackCooldown($event->getAttackCooldown() - $this->getMain()->cfg->get("cooldown-time"));
	}
    }

    public function getMain() : Main {
        return $this->main;
    }	 	
}	
