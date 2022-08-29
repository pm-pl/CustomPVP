<?php

namespace HenryDM\CustomPVP\KillEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;

class KillEXP implements Listener {
    
    public function __construct(private Main $main) {
        $this->main = $main;
    }
    
    public function onKill(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $xp = $this->getMain()->cfg->get("xp-amount");
        $damageCause = $player->getLastDamageCause();
        if($this->getMain()->cfg->get("kill-exp") === true) {
            if (in_array($worldName, $this->getMain()->cfg->get("kill-xp-worlds"))) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $damageCause->getDamager();
                    if ($damager instanceof Player) {
                        $player->getXpManager()->addXpLevels($damager, $xp);
                    }
                }
            }
        }
    }

    public function getMain(): Main{
        return $this->main;
    }
}
