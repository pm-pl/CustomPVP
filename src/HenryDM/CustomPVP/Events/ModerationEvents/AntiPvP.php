<?php

namespace HenryDM\CustomPVP\Events\ModerationEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;

class AntiPvP implements Listener {

    public function __construct (private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) {

# ==========================================        
        $entity = $event->getEntity(); 
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
# ==========================================  

        if($this->main->cfg->get("anti-pvp") === true) {
            if($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if(!$damager instanceof Player) return;
                if(in_array($worldName, $this->main->cfg->get("anti-pvp-worlds", []))) {
                    $event->cancel();        
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}