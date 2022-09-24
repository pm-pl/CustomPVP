<?php

namespace HenryDM\CustomPVP\Events\ModerationEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;
use pocketmine\Server;

class PingKick implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) {

# =========================================================================        
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
# =========================================================================

        if ($this->getMain()->cfg->getNested("ping-kick") === true) {
            if (in_array($worldName, $this->getMain()->cfg->getNested("ping-kick-worlds", []))) {
                if ($event instanceof EntityDamageByEntityEvent) {
                    $damager = $event->getDamager();
                    if (!$damager instanceof Player) return;
                       if ($player->getNetworkSession()->getPing() >= $this->getMain()->cfg->getNested("ping-kick-max-ping")) {
                           $player->kick($this->getMain()->cfg->getNested("ping-kick-message"));   
                        }
                    }
                }
            }
        }                    
    }

    public function getMain() : Main {
        return $this->main;
    }
}