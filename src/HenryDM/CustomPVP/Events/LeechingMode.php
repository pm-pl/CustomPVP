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
       $config = $this->main->getConfig()->get();
       $player = $event->getEntity();
       $health = $player->getHealth(); 
       $maxhealth = $player->getMaxHealth();
        if($config("leeching-mode") === true) {
          if($health() === $maxhealth()) {
            $event->cancel();	 
         } else { 
             if(in_array($player()->getWorld()->getFolderName(), $config("leeching-worlds"))) {
               $player->setHealth($health + $config("leeching-level"));
            }
         }
      }
   }
}
