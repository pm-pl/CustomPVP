<?php

namespace HenryDM\CustomPVP\Events\DeathEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;
use pocketmine\world\World;

class DeathKick implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {

# ===================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
# ===================================================

        if($this->getMain()->cfg->get("death-kick") === true) {
            if(in_array($worldName, $this->main->cfg->get("death-kick-worlds", []))) { 
                $player->kick($this->main->cfg->get("death-kick-message"));                
            }
        }
    }
    
    public function getMain() : Main {
        return $this->main;
    }
}