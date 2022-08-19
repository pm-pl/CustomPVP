<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Cooldown implements Listener {

private $main;

	public function __construct(Main $main) {
		$this->main = $main;
	}
         	public function onDamage(EntityDamageEvent $event) : void {
             if($this->main->getConfig()->get("cooldown") === true) {
		           $event->setAttackCooldown($event->getAttackCooldown() - $this->main->getConfig()->get("cooldown-time"));
	}
    }
	/**
	 * @return Main
	 */
	public function getMain(): Main {
          return $this->main;
	}	 	
}	
