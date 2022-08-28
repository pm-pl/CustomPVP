<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\world\World;

class KnockBack implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onEntity(EntityDamageByEntityEvent $event) : void {	

        if($this->getMain()->cfg->get("pvp-knockback") === true) {
            if(in_array($worldName, $this->getMain()->cfg->get("knockback-worlds"))) {
            $event->setKnockBack($this->getMain()->cfg->get("knockback-level") * $event->getKnockBack());
          }
       }
    }
    public function getMain() : Main {
        return $this->main;
    }	 	
}