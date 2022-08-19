<?php

namespace HenryDM\CustomPVP\Events;

use HennryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;

class LeechingMode implements Listener { 

private $main;

	public function __construct(Main $main) {
		$this->main = $main;
	}

      public function onEntityDamage(EntityDamageByEntityEvent $event) {
       $player = $event->getPlayer();
       $health = $player->getHealth(); 
       $maxhealth = $player->getMaxHealth();
        if($this->main->getConfig()->get("leeching-mode") === true) {
          if($health() === $maxhealth()) {
            $event->cancel();	 
         } else { 
             if(in_array($event->getPlayer()->getWorld()->getFolderName(), $this->main->getConfig()->get("leeching-worlds"))) {
               $player->setHealth($health + $this->main->getConfig()->get("leeching-level"));
            }
         }
      }
   }
}
