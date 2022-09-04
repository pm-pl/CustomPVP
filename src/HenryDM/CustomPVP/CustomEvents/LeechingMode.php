<?php

namespace HenryDM\CustomPVP\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class LeechingMode implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageByEntityEvent $event) : void {
        if ($this->getMain()->cfg->get("leeching-mode") === true) {
            $entity = $event->getEntity();
            if ($entity instanceof Player) {
                if (in_array($entity->getWorld()->getFolderName(), $this->getMain()->cfg->get("leeching-worlds"))) {
                    $entity->setHealth($entity->getHealth() + $this->getMain()->cfg->get("leeching-level"));
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}