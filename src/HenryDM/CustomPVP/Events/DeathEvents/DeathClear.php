<?php 

namespace HenryDM\CustomPVP\Events\DeathEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;

class DeathClear implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        if($this->getMain()->getMainConfig()->getNested("death-clear") === true) {
            if (in_array($world->getFolderName(), $this->getMain()->getMainConfig()->getNested("death-clear-worlds"))) {
                if($this->getMain()->getMainConfig()->getNested("death-clear-mode") === "all") {
                    $player->getInventory()->clearAll();
                }

                if($this->getMain()->getMainConfig()->getNested("death-clear-mode") === "armor") {
                    $player->getArmorInventory()->clearAll();
                }
            }
        }
    }

    public function getMain(): Main{
        return $this->main;
    }
}