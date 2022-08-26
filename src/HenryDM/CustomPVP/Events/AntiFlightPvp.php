<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

use HenryDM\CustomPVP\Main;

class AntiFlightPvp implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) : void {
        $entity = $event->getEntity();
        $damager = $event->getDamager();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        if ($this->getMain()->cfg->getNested("antipvpflight", true)) {
            if (in_array($worldName, $this->getMain()->cfg->getNested("antiflight-worlds", []))) {
                if (!$damager instanceof Player) return;
                if ($damager->isCreative()) return;
                if ($damager->getAllowFlight(true)) {
                    $damager->setFlying(false);
                    $damager->setAllowFlight(false);
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
