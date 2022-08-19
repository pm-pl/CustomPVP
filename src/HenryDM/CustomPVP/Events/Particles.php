<?php

namespace HenryDM\customPVP\Events;

use pocketmine\event\Listener;
use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\world\World;
use pocketmine\event\PlayerDeathEvent;
use pocketmine\world\particle\Particle;
use pocketmine\wolrd\particle\InkParticle;

class Particles implements Listener {
 
        public function __construct(private Main $main) {
            $this->main = $main;
	}

               public function onPlayerDeath(PlayerDeathEvent $event) { 
                 $world = $player()->getWorld();
                 $player = $event()->getPlayer();
                 $position = $player()->getPosition();
  
          
                   if($config("particle") == true) {
                    if(in_array($event->getPlayer()->getWorld()->getFolderName(), $this->main->cfg->get("particle-worlds"))){
                     $world->addParticle($position, $this->main->cfg->get("particle-name")(1));
                     $world->addParticle($position, new InkParticle(1));
                     $world->addParticle($position->add(1, 0, 0), new InkParticle(1));
                     $world->addParticle($position->add(0, 1, 0), new InkParticle(1));
                     $world->addParticle($position->add(0, 0, 1), new InkParticle(1));
            }
        } 
    }
}
