<?php

namespace HenryDM\CustomPVP\ModerationEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerToggleSprintEvent;
use pocketmine\player\Player;

class AntiSprint implements Listener {

    public function __construct (private Main $main) {
        $this->main = $main;
    }

    public function onSprint(PlayerToggleSprintEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        if($this->getMain()->cfg()->get("anti-sprint") === true) {
            if(in_array($worldName, $this->getMain()->cfg->get("anti-sprint-worlds"))) {
                if ($this->getMain()->cfg->get("anti-sprint-alert") === true) {
                    if ($player->isSprinting()) {
                        $player->setSprinting(false);
                        $player->sendActionBarMessage($this->getMain()->cfg->get("anti-sprint-message"));
                        $event->cancel();                        
                    }
                }
            }
        }
    }
    
    public function getMain() : Main {
        return $this->main;
    }
}