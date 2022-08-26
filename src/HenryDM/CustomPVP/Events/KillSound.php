<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use HenryDM\CustomPVP\Utils\Utils;

class KillSound implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) : void {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        if ($this->getMain()->cfg->getNested("killsound-enable", true)) {
            if (in_array($worldName, $this->getMain()->cfg->getNested("killsound-worlds"))) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $damageCause->getDamager();
                    if ($damager instanceof Player) {
                        Utils::playSound($player, $this->getMain()->cfg->getNested("killsound-soundname"), 1, 1);
                    }
                }
            }
        }
    }

    public function getMain(): Main {
        return $this->main;
    }
}    