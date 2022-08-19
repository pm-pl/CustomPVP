<?php

namespace HenryDM\CustomPVP\Events;

use HennryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;

class LeechingMode implements Listener { 

	public function __construct(private Main $main) {
		$this->main = $main;
	}

        public function onDamage(EntityDamageByEntityEvent $event) : void {
          if($this->main->getConfig()->get("leeching-mode") === true) {
            $player = $event->getPlayer();
                if($player->getHealth() == $player->getMaxHealth()) {
                  $event->cancel();	
                } else { 
                   if(in_array($player()->getWorld()->getFolderName(), $this->main->getConfig()->get("leeching-worlds"))) {
                     $player->setHealth($player->getHealth() + $this->main->getConfig()->get("regenerate-level"));
	       }
	    }
        }
    }
}
