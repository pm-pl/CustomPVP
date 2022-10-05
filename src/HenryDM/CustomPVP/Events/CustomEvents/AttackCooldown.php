<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;

use HenryDM\CustomPVP\Main;

class AttackCooldown implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) {
        $world = $entity->getWorld();
        if ($this->getMain()->getMainConfig()->getNested("attack-cooldown", true)) {
            if (in_array($world->getFolderName(), $this->getMain()->getMainConfig()->getNested("attack-cooldown-worlds", []))) {
                $event->setAttackCooldown($event->getAttackCooldown() - $this->getMain()->getMainConfig()->getNested("attack-cooldown-time"));
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}