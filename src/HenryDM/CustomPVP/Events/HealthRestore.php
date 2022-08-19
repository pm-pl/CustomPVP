<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class HealthRestore implements Listener {

private $main;

	public function __construct(Main $main) {
		$this->main = $main;
	}
             public function onPlayerDeath(PlayerDeathEvent $event) : void{ 
              if($this->main->getConfig()->get("restore-health") === true) {
                $cause = $event->getPlayer()->getLastDamageCause();
                 if($cause instanceof EntityDamageByEntityEvent){
                   $damager = $cause->getDamager();
                    if($damager instanceof Player){
                       if(in_array($event->getPlayer()->getWorld()->getFolderName(), $this->main->getConfig()->get("restore-worlds"))){
                          $damager->setHealth($damager->getMaxHealth());
                  }
              }
          }			
       }
    }	
}
