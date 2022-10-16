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

    public function onEntity(EntityDamageByEntityEvent $event) {

# ================================================        
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
# ================================================

        if($this->main->cfg->get("pvp-knockback") === true) {
            if(in_array($worldName, $this->main->cfg->get("pvp-knockback-worlds", []))) {
                $event->setKnockBack($this->main->cfg->get("pvp-knockback-level") * $event->getKnockBack());
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }	 	
}