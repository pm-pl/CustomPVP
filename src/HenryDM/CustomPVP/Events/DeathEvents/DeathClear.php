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

# ============================================      
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $wold->getFolderName();
# ============================================

        if($this->getMain()->getMainConfig()->getNested("death-clear") === true) {
            if(in_array($worldName, $this->main->cfg->get("death-clear-worlds", []))) {                
                $player->getInventory()->clearAll();
                $player->getArmorInventory()->clearAll();
            }
        }
    }

    public function getMain(): Main{
        return $this->main;
    }
}