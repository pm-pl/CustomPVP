<?php

namespace HenryDM\CustomPVP\Events\KillEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use HenryDM\CustomPVP\Utils\PluginUtils;

use pocketmine\player\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class KillSound implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {

# =====================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
# =====================================================

        if($this->main->cfg->get("kill-sound") === true) {
            if(in_array($worldName, $this->main->cfg->get("kill-sound-worlds", []))) {
                if($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $damageCause->getDamager();
                    if($damager instanceof Player) {
                        PluginUtils::playSound($player, $this->main->cfg->get("kill-sound-name"), 1, 1);
                    }
                }
            }
        }
    }

    public function getMain(): Main {
        return $this->main;
    }
}    