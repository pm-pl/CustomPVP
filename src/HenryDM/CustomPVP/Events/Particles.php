<?php

namespace HenryDM\customPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\world\World;
use pocketmine\event\PlayerDeathEvent;
use pocketmine\world\particle\Particle;

class Particle implements Listener {

private $main;
 
         public function __construct(Main $main) {
            $this->main = $main;
	}

               public function onPlayerDeath(PlayerDeathEvent $event) { 
                 $world = $player()->getWorld();
                 $player = $event()->getPlayer();
                 $position = $player()->getPosition();
                 $config = $this->main->getConfig()->get();


  }
}
