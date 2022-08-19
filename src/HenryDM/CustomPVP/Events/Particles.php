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

private $main;
 
         public function __construct(Main $main) {
            $this->main = $main;
	}

               public function onPlayerDeath(PlayerDeathEvent $event) { 
                 $world = $player()->getWorld();
                 $player = $event()->getPlayer();
                 $position = $player()->getPosition();
                 $config = $this->main->getConfig();
          
                   if($config("particle") == true) {
                    if(in_array($event->getPlayer()->getWorld()->getFolderName(), $this->main->getConfig()->get("particle-worlds"))){
                     $world->addParticle($position, new $config->get("particle-name")(1));
                     $world->addParticle($position, new InkParticle(1));
                     $world->addParticle($position->add(1, 0, 0), new InkParticle(1));
                     $world->addParticle($position->add(0, 1, 0), new InkParticle(1));
                     $world->addParticle($position->add(0, 0, 1), new InkParticle(1));
            }
        } 
    }
}
