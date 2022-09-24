<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\world\World;

class KnockBack implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onEntity(EntityDamageByEntityEvent $event) : void {	

# =======================================================        
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
# =======================================================

        if($this->getMain()->cfg->get("pvp-knockback") === true) {
            if (in_array($worldName, $this->getMain()->cfg->getNested("pvp-knockback-worlds", []))) {
                $event->setKnockBack($this->getMain()->cfg->getNested("pvp-knockback-level") * $event->getKnockBack());
            }
        }
    }
    public function getMain() : Main {
        return $this->main;
    }	 	
}