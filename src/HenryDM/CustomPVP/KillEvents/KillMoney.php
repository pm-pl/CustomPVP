<?php

namespace HenryDM\CustomPVP\KillEvents;

# pocketmine Lib
use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

# LibEco
use davidglitch04\libEco\libEco;


class KillMoney implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) : void {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        $amount = $this->getMain()->cfg->get("money-value");
        if ($this->getMain()->cfg->get("kill-money") === true) {
            if (in_array($worldName, $this->getMain()->cfg->get("money-worlds"))) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $damageCause->getDamager();
                    if ($damager instanceof Player) {
                        libEco::addMoney($damager, $amount);
                        if ($this->getMain()->cfg->get("money-reduce") === true) {
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
