<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;

use HenryDM\CustomPVP\Main;

class AttackCooldown implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) : void {
        if ($this->getMain()->cfg->getNested("attack-cooldown", true)) {
            $event->setAttackCooldown($event->getAttackCooldown() - $this->getMain()->cfg->getNested("cooldown-time"));
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
