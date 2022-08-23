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
use Pocketmine\world\sound\GhastSound;

class KillSound implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) { 
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $damageCause = $player->getLastDamageCause();
        if ($this->getMain()->cfg->get("kill-sound") === true) {
        if (in_array($world->getFolderName(), $this->getMain()->cfg->get("killsound-worlds"))) {
        if($this->getMain()->cfg->get("anvil-sound") === true) {
                    $world->addSound($position, new AnvilUseSound(1));
                    $world->addSound($position, new AnvilUseSound(1));
                    $world->addSound($position->add(1, 0, 0), new AnvilUseSound(1));
                    $world->addSound($position->add(0, 1, 0), new AnvilUseSound(1));
                    $world->addSound($position->add(0, 0, 1), new AnvilUseSound(1));
	        }

        if($this->getMain()->cfg->get("ghast-sound") === true) {
                    $world->addSound($position, new GhastSound(1));
                    $world->addSound($position, new GhastSound(1));
                    $world->addSound($position->add(1, 0, 0), new GhastSound(1));
                    $world->addSound($position->add(0, 1, 0), new GhastSound(1));
                    $world->addSound($position->add(0, 0, 1), new GhastSound(1));
	        }

	      }
          }
     }

public function getMain() : Main {
        return $this->main;
    }
}    
