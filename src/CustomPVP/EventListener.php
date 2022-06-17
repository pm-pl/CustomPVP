<?php

namespace CustomPVP;

use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use CustomPVP\Main;

class EventListener implements Listener {
	
	private $main;
	
	public function __construct(Main $main) {
		
		$this->main = $main;
		
	}
	
	public function onDamage(EntityDamageEvent $ev) : void {
		
		
		$ev->setAttackCooldown($ev->getAttackCooldown() - $this->main->getConfig()->get("cooldown"));
		
	}
	
	public function onEntity(EntityDamageByEntityEvent $ev) : void {
		
		
		$ev->setKnockBack($this->main->getConfig()->get("knockback") * $ev->getKnockBack());
		
	}
	
}