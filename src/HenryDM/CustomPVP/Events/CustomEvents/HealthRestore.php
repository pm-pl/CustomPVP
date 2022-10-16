<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\player\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;


class HealthRestore implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {   
        
# ================================================      
        $player = $event->getPlayer();
        $cause = $player->getLastDamageCause();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
# ================================================

        if($this->main->cfg->get("heath-restore") === true) {
            if($cause instanceof EntityDamageByEntityEvent) {
                $damager = $cause->getDamager();
                if($damager instanceof Player) {
                    if(in_array($worldName, $this->main->cfg->get("health-restore-worlds", []))) {
                        $damager->setHealth($damager->getMaxHealth());
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}