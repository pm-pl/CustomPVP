<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;
use pocketmine\item\ItemFactory;

class KillReward implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        if ($this->getMain()->cfg->getNested("kill-rewards", true)) {
            if (in_array($worldName, $this->getMain()->cfg->get("rewards-worlds", []))) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $damageCause->getDamager();
                    if ($damager instanceof Player) {
                        foreach ($this->getMain()->cfg->get("rewards-items", []) as $item) {
                            $reward = ItemFactory::getInstance()->get($item["id"], $item["damage"], $item["count"]);
                            $reward->setCustomName($item["name"]);
                            $damager->getInventory()->setItem($item["slots"], $reward);
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
