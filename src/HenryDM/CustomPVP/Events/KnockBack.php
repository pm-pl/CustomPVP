<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class KnockBack implements Listener {

private $main;

	public function __construct(Main $main) {
		$this->main = $main;
	}
	          public function onEntity(EntityDamageByEntityEvent $event) : void {	
             if($this->main->getConfig()->get("knockback") === true) {
		            $event->setKnockBack($this->main->getConfig()->get("knockback-level") * $event->getKnockBack());
	      }
    }
	/**
	 * @return Main
	 */
	public function getMain(): Main {
          return $this->main;
	}	 	
}	
