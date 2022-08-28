<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;

class PingKick implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) {
        $player = $event->getPlayer();
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        if ($this->getMain()->cfg->get("ping-kick", true)) {
            if (in_array($worldName, $this->getMain()->cfg->get("ping-kick-worlds"))) {
                if ($event instanceof EntityDamageByEntityEvent) {
                    $damager = $event->getDamager();
                    if (!$damager instanceof Player) return;
                       if ($player->getNetworkSession()->getPing() >= $this->getMain()->cfg->get("ping-kick-max")) {
                        $player->kick($$this->getMain()->cfg->get("ping-kick-message"));   
                    }
                }
            }
        }                    
    }

    public function getMain() : Main {
        return $this->main;
    }
}