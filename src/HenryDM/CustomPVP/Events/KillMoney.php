<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\event\entity\EntityDamageByEntityEvent;
# LibEco
use davidglitch04\libEco\libEco;

use HenryDM\CustomPVP\Main;


class KillMoney implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        $amount = $this->getMain()->cfg->get("killmoney-price");
        if ($this->getMain()->cfg->get("killmoney-enable") === true) {
            if (in_array($worldName, $this->getMain()->cfg->get("killmoney-world"))) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $event->getDamager();
                    if ($damager instanceof Player) {
                        libEco::addMoney($damager, $amount);
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
