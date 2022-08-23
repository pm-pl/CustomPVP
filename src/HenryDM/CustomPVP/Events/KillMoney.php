<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\event\entity\EntityDamageByEntityEvent;

use HenryDM\CustomPVP\Main;
use HenryDM\CustomPVP\Utils\EconomyManager;

class KillMoney implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        $damager = $damageCause->getDamager();
        if ($this->getMain()->cfg->get("killmoney-enable") === true) {
            if (in_array($worldName, $this->getMain()->cfg->get("killmoney-world"))) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    if ($damager instanceof Player) {
                        EconomyManager::addMoney($this->getMain()->cfg->get("killmoney-price"), $player);
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}