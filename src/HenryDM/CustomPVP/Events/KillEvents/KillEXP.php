<?php

namespace HenryDM\CustomPVP\Events\KillEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\player\Player;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;

class KillEXP implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {

# =========================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $xp = $this->main->cfg->get("kill-exp-level");
        $damageCause = $player->getLastDamageCause();
# =========================================================

        if($this->main->cfg->get("kill-exp") === true) {
            if(in_array($worldName, $this->main->cfg->get("kill-exp-worlds", []))) {
                if($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $damageCause->getDamager();
                    if($damager instanceof Player) {
                        $player->getXpManager()->addXpLevels($damager, $xp);
                    }
                }
            }
        }
    }
    
    public function getMain() : Main {
        return $this->main;
    }
}