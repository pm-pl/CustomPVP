<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;

use HenryDM\CustomPVP\Main;

class AntiFlightPvp implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageByEntityEvent $event) : void {
        $entity = $event->getEntity();
        $damaged = $event->getDamager();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        if (!$damaged instanceof Player) return;
        if ($this->getMain()->cfg->getNested("antipvpflight", true)) {
            if (in_array($worldName, $this->getMain()->cfg->getNested("antiflight-worlds", []))) {
                $damaged->setFlying(false);
                $damaged->setAllowFlight(false);
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
