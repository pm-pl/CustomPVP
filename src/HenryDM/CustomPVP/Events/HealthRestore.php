<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

use HenryDM\CustomPVP\Main;

class HealthRestore implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onPlayerDeath(PlayerDeathEvent $event) : void { 
        if($this->main->getConfig()->get("restore-health") === true) {
        $player = $event->getPlayer();
        $cause = $player->getLastDamageCause();
            if($cause instanceof EntityDamageByEntityEvent) {
                $damager = $cause->getDamager();
                if($damager instanceof Player) {
                    if(in_array($player->getWorld()->getFolderName(), $this->getMain()->cfg->get("restore-worlds"))) {
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
