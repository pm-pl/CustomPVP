<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use pocketmine\event\Listener;

use pocketmine\player\Player;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

use HenryDM\CustomPVP\Main;

class HealthRestore implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {      
        $player = $event->getPlayer();
        $cause = $player->getLastDamageCause();
        $world = $player->getWorld();
        if ($this->getMain()->getMainConfig()->getNested("heath-restore", true)) {
            if ($cause instanceof EntityDamageByEntityEvent) {
                $damager = $cause->getDamager();
                if ($damager instanceof Player) {
                    if (in_array($wolrd->getFolderName(), $this->getMain()->getMainConfig()->getNested("health-restore-worlds", []))) {
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