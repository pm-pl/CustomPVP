<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;

class AttackCooldown implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) : void {
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        if ($this->getMain()->cfg->getNested("attack-cooldown", true)) {
            if (in_array($worldName, $this->getMain()->cfg->getNested("cooldown-worlds", []))) {
                $event->setAttackCooldown($event->getAttackCooldown() - $this->getMain()->cfg->getNested("cooldown-time"));
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
