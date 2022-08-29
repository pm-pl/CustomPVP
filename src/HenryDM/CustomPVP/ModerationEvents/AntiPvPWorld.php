<?php

namespace HenryDM\CustomPVP\ModerationEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;

class AntiPvPWorld implements Listener {

    public function __construct (private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) {
        $entity = $event->getEntity(); 
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        if($this->getMain()->cfg->get("anti-pvp", true)) {
            if ($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if (!$damager instanceof Player) return;
                   if (in_array($worldName, $this->getMain()->cfg->get("blocked-pvp-worlds"))) {
                    $event->cancel();        
            
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}