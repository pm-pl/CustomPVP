<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\entity\Entity;
use pocketmine\player\Player;
use pocketmine\world\Position;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\world\particle\CriticalParticle;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\particle\FlameParticle;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\world\particle\HeartParticle;
use pocketmine\world\particle\LavaDripParticle;
use pocketmine\world\particle\PortalParticle;
use pocketmine\world\particle\RedstoneParticle;
use pocketmine\world\particle\SnowballPoofParticle;


class Particles implements Listener {
 
         public function __construct(private Main $main) {
            $this->main = $main;
	}

              public function onDeath(EntityDeathEvent $event) {
                  $entity = $event()->getEntity();
                  $world = $entity()->getWorld();
                   if($this->main->getConfig()->get("kill-particles") === true) {
                     if(in_array($player()->getWorld()->getFolderName(), $this->main->getConfig()->get("particle-worlds"))) {

                        $world->addParticle($entity()->getPosition(), new CriticalParticle(1));
                        $world->addParticle($entity()->getPosition(), new CriticalParticle(1));
                        $world->addParticle($entity()->getPosition()->add(1, 0, 0), new CriticalParticle(1));
                        $world->addParticle($entity()->getPosition()->add(0, 1, 0), new CriticalParticle(1));
                        $world->addParticle($entity()->getPosition()->add(0, 0, 1), new CriticalParticle(1));
             }
         }
    } 
}
