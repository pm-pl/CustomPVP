<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;

class AttackCooldown implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) {

# =============================================     
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
# =============================================

        if($this->main->cfg->get("attack-cooldown") === true) {
            if(in_array($worldName, $this->main->cfg->get("attack-cooldown-worlds", []))) {
                $event->setAttackCooldown($event->getAttackCooldown() - $this->main->cfg->get("attack-cooldown-time"));
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}