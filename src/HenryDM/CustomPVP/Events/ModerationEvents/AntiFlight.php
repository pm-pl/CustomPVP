<?php

namespace HenryDM\CustomPVP\Events\ModerationEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\player\Player;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class AntiFlight implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) {

# ===============================================        
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
# ===============================================

        if($this->main->cfg->get("anti-flight") === true) {
            if(in_array($worldName, $this->main->cfg->get("anti-flight-worlds", []))) {
                if($event instanceof EntityDamageByEntityEvent) {
                    $damager = $event->getDamager();
                    if(!$damager instanceof Player) return;
                    if($damager->isCreative()) return;
                    if($damager->getAllowFlight() === true) {
                        $damager->setFlying(false);
                        $damager->setAllowFlight(false);
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
