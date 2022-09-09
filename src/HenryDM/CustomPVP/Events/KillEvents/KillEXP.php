<?php

namespace HenryDM\CustomPVP\Events\KillEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\player\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class KillEXP implements Listener {

   public function __construct(private Main $main) {
      $this->main = $main;
  }

    public function onDeath(PlayerDeathEvent $event) {
# ====================================================
      $player = $event->getPlayer();
      $damageCause = $player->getLastDamageCause();
      $damager = $damageCause->getDamager();
      $worlds = $this->getMain()->cfg->get("exp-worlds", []);
      $worldName = $event->getPlayer()->getWorld()->getDisplayName();
      $expvalue = $this->getMain()->cfg->get("exp-value");
# ====================================================
              if($this->getMain()->cfg->get("Kill-exp") === true) {
               if(in_array($worldName, $worlds, true)) {
                  if($damageCause instanceof EntityDamageByEntityEvent) {
                     if($damager instanceof Player) {
                        $player->getXpManager()->addXpLevel($expvalue);
               }
            }
         }
      }
   }

   public function getMain() : Main {
      return $this->main;
  }
}

