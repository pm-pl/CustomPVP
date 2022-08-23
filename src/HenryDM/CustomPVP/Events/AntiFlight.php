<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\entity\Entity;
use pocketmine\world\World;

class AntiFlight implements Listener {

  public function __construct(private Main $main) {
      $this->main = $main;
    }

    public function onDamage(EntityDamageByEntityEvent $event) : void { 
        $entity = $event->getEntity();
        $damaged = $event->getDamager();
        $world = $event->$entity->getWorld();
        if($this->getMain()->cfg->get("Anti-Flight") === true) {
            if (in_array($world->getFolderName(), $this->getMain()->cfg->get("antiflight-worlds"))) {
               $damaged->setFlying(false);
               $damaged->setAllowFlight(false);
            }
        }
    }
    
      public function getMain() : Main {
          return $this->main;
    }	 
}
