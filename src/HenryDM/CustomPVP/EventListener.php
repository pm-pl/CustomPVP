<?php
declare(strict_types=1);

namespace HenryDM\CustomPVP;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;
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
             if($this->main->getConfig()->get("cooldown") === true) {
		$event->setAttackCooldown($event->getAttackCooldown() - $this->main->getConfig()->get("cooldown-time"));
	}
	
#==========================
#        KnockBack
#==========================

	public function onEntity(EntityDamageByEntityEvent $event) : void {	
             if($this->main->getConfig()->get("knockback") === true) {
		$event->setKnockBack($this->main->getConfig()->get("knockback-level") * $event->getKnockBack());
		
	}

#==========================
#     Restore Health
#==========================

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
