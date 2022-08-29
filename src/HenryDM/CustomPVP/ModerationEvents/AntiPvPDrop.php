<?php 

namespace HenryDM\CustomPVP\ModerationEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\player\Player;

class AntiPvPDrop implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDrop(PlayerDropItemEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        if($this->getMain()->cfg->get("anti-drop") === true) {
            if (in_array($worldName, $this->getMain()->cfg->get("anti-drop-worlds"))) {
                if($this->getMain()->cfg->get("anti-drop-alert") === true) {
                    $player->sendActionBarMessage($this->getMain()->cfg->get("anti-drop-message"));
                    $event->cancel();
                }
            }
        }
    }
    
    public function getMain() : Main {
        return $this->main;
    }
}