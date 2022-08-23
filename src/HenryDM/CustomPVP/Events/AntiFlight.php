<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\player\Player;
use pocketmine\world\World;

class AntiFlight implements Listener {

    public function onDamage(EntityDamageByEntityEvent $event) { 
        $player = $event->getPlayer();
        $damager = $event->getDamager();
        $world = $event->$player->getWorld();
        if($this->getMain()->cfg->get("Anti-Flight") === true) {
            if (in_array($world->getFolderName(), $this->getMain()->cfg->get("antiflight-worlds"))) {
            $damager->setFlying(false);
            }
        }
    }
}
