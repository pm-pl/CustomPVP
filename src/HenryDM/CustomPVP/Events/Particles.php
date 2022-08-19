<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;
use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\world\World;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\world\particle\Particle;
use pocketmine\wolrd\particle\InkParticle;

class Particles implements Listener {
 
        public function __construct(private Main $main) {
            $this->main = $main;
	}

               public function onPlayerDeath(PlayerDeathEvent $event) { 
                 $player = $event->getPlayer();
                 $world = $player->getWorld();
                 $position = $player->getPosition();
  
          
                   if($this->main->cfg->get("particle") == true) {
                    if(in_array($world->getFolderName(), $this->main->cfg->get("particle-worlds"))){
                     $world->addParticle($position, $this->main->cfg->get("particle-name")(1));
                     $world->addParticle($position, new InkParticle(1));
                     $world->addParticle($position->add(1, 0, 0), new InkParticle(1));
                     $world->addParticle($position->add(0, 1, 0), new InkParticle(1));
                     $world->addParticle($position->add(0, 0, 1), new InkParticle(1));
            }
        } 
    }
}
