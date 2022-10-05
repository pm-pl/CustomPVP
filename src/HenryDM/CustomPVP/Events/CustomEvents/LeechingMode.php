<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use pocketmine\event\Listener;

use pocketmine\player\Player;

use pocketmine\event\entity\EntityDamageByEntityEvent;

use HenryDM\CustomPVP\Main;

class LeechingMode implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageByEntityEvent $event) : void {
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        if ($this->getMain()->getMainConfig()->getNested("leeching-mode", true)) {          
            if ($entity instanceof Player) {
                if (in_array($world->getFolderName(), $this->getMain()->getMainConfig()->getNested("leeching-worlds", []))) {
                    $entity->setHealth($entity->getHealth() + $this->getMain()->getMainConfig()->getNested("leeching-level"));
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}