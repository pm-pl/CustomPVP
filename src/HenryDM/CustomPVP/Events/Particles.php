<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;
use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\world\World;
use pocketmine\event\EntityDeathEvent;
use pocketmine\world\particle\Particle;
use pocketmine\world\particle\CriticalParticle;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\particle\FlameParticle;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\world\particle\HeartParticle;
use pocketmine\world\particle\LavaDripParticle;
use pocketmine\world\particle\LavaParticle;
use pocketmine\world\particle\PortalParticle;
use pocketmine\world\particle\RedstoneParticle;
use pocketmine\world\particle\SnowballPoofParticle;


class Particles implements Listener {

private $main;
 
         public function __construct(Main $main) {
            $this->main = $main;
	}

               public function onEntityDeath(EntityDeathEvent $event) { 
                 $world = $entity()->getWorld();
                 $entity = $event()->getEntity();
                 $position = $entity()->getPosition();
                 $config = $this->main->getConfig();
          
                   if($config("particle") == true) {
                    if(in_array($event->getEntity()->getWorld()->getFolderName(), $this->main->getConfig()->get("particle-worlds"))){
                      if($config("critical-particle") == true) {
                     $world->addParticle($position, new AngryVillagerParticle(1));
                     $world->addParticle($position, new AngryVillagerParticle(1));
                     $world->addParticle($position->add(1, 0, 0), new AngryVillagerParticle(1));
                     $world->addParticle($position->add(0, 1, 0), new AngryVillagerParticle(1));
                     $world->addParticle($position->add(0, 0, 1), new AngryVillagerParticle(1));
               }
            }
        } 
    }
}
