<?php

namespace HenryDM\CustomPVP\Events\KillEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class KillEXP implements Listener {

    public function onDeath(PlayerDeathEvent $event) {
# ====================================================
      $player = $event->getPlayer();
      $damageCause = $player->getLastDamageCause();
      $damager = $damageCause->getDamager();
      $worlds = $this->getMain()->cfg->get("soup-worlds", []);
      $worldName = $event->getPlayer()->getWorld()->getDisplayName();
      $xpvalue = $this->getMain()->cfg->get("xp-value");
# ====================================================
              if ($this->getMain()->cfg->get("Kill-exp") === true) {
               if (in_array($worldName, $worlds, true)) {
                  if($damageCause instanceof EntityDamageByEntityEvent) {
                     if($damager instanceof Player) {
                        $addXpLevel($damager, $xpvalue);
               }
            }
         }
      }
   }
}

