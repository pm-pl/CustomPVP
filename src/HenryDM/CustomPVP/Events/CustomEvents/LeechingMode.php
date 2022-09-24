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

    public function onDamage(EntityDamageByEntityEvent $event) : void {

# ==============================================            
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
# ===============================================  

        if ($this->getMain()->cfg->getNested("leeching-mode") === true) {          
            if ($entity instanceof Player) {
                if (in_array($worldName, $this->getMain()->cfg->getNested("leeching-worlds", []))) {
                    $entity->setHealth($entity->getHealth() + $this->getMain()->cfg->getNested("leeching-level"));
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}