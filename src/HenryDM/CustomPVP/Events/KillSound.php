<?php 

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;
use pocketmine\item\ItemFactory;
use pocketmine\world\World;
use pocketmine\world\sound\Sound;
use pocketmine\world\sound\AnvilUseSound;

class KillSound implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) { 
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $damageCause = $player->getLastDamageCause();
        if ($this->getMain()->cfg->get("kill-sound") === true) {
                
if($this->getMain()->cfg->get("anvil-sound") === true) {
                    $world->addSound($sound, new AnvilUseSound(1));
                    $world->addSound($sound, new AnvilUseSound(1));
                    $world->addSound($sound->add(1, 0, 0), new AnvilUseSound(1));
                    $world->addSound($sound->add(0, 1, 0), new AnvilUseSound(1));
                    $world->addSound($sound->add(0, 0, 1), new AnvilUseSound(1));
	        }
          }
     }

public function getMain() : Main {
        return $this->main;
    }
}    
