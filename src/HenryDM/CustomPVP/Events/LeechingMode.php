<?php

namespace HenryDM\CustomPVP\Events;

use HennryDM\CustomPVP\Main;
use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;

class LeechingMode implements Listener { 

	public function __construct(private Main $main) {
		$this->main = $main;
	}

      public function onDamage(EntityDamageByEntityEvent $event) {
       $player = $event->getEntity(); 
        if($this->getMain()->cfg->get("leeching-mode") === true) {
          if($player->getHealth() == $player->getMaxHealth()) {
            $event->cancel();	 
         } else { 
             if(in_array($player()->getWorld()->getFolderName(), $this->getMain()->cfg->get("leeching-worlds"))) {
               $player->setHealth($player->getHealth + $this->getMain()->cfg->get("leeching-level"));
            }
         }
      }
   }
}
