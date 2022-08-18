<?php

namespace HenryDM\CustomPVP;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\world\World;
use HenryDM\CustomPVP\Main;

class EventListener implements Listener {
	
private $main;

	public function __construct(Main $main) {
		$this->main = $main;
	}

#==========================
#        Cooldown
#==========================	
	public function onDamage(EntityDamageEvent $event) : void {
		$event->setAttackCooldown($event->getAttackCooldown() - $this->main->getConfig()->get("cooldown"));
	}
	
#==========================
#        KnockBack
#==========================

	public function onEntity(EntityDamageByEntityEvent $event) : void {	
		$event->setKnockBack($this->main->getConfig()->get("knockback") * $event->getKnockBack());
		
	}

#==========================
#    Restore Health
#==========================

        public function onPlayerDeath(PlayerDeathEvent $event) : void {
         if($this->getConfig()->get("Restore-Helth") === true){
          $damage = $event->getPlayer()->getLastDamageCause();
          $damager = $cause->getDamager();
            if($damage instanceof EntityDamageByEntityEvent) {
             if($damager instanceof Player) {
              if(in_array($event->getPlayer()->getWorld()->getFolderName(), $this->getConfig()->get("Restore-Worlds"))) {
                 $damager->setHealth($damager->getMaxHealth());
                }
	     }
          }			
       }
   }	
}
