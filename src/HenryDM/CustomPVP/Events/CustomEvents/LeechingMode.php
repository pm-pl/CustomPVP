<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\player\Player;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class LeechingMode implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageByEntityEvent $event) {

# ================================================        
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
# ================================================

        if($this->main->cfg->get("leeching-mode") === true) {          
            if($entity instanceof Player) {
                if(in_array($worldName, $this->main->cfg->get("leeching-mode-worlds", []))) {
                    $entity->setHealth($entity->getHealth() + $this->main->cfg->get("leeching-mode-level"));
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}