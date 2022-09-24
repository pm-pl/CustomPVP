<?php

namespace HenryDM\CustomPVP\Events\KillEvents;

# pocketmine Lib
use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\player\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

# LibEco
use davidglitch04\libEco\libEco;


class KillMoney implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) : void {

# =================================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        $amount = $this->getMain()->cfg->getNested("money-value");
# =================================================================

        if ($this->getMain()->cfg->getNested("kill-money") === true) {
            if (in_array($worldName, $this->getMain()->cfg->getNested("kill-money-worlds", []))) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $damageCause->getDamager();
                    if ($damager instanceof Player) {
                        libEco::addMoney($damager, $amount);
                        if ($this->getMain()->cfg->getNested("reduce-money") === true) {
                            libEco::reduceMoney($player, $amount, static function (bool $success): void {
                            });
                        }
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
