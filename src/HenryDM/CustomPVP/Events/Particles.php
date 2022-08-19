<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
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
                $position = $entity()->getPosition();
                   if($this->getConfig()->get("kill-particles") === Activate) {
                     if(in_array($player()->getWorld()->getFolderName(), $this->main->getConfig()->get("particle-worlds"))) {

                        $world->addParticle($position, new CriticalParticle(1));
                        $world->addParticle($position, new CriticalParticle(1));
                        $world->addParticle($position->add(1, 0, 0), new CriticalParticle(1));
                        $world->addParticle($position->add(0, 1, 0), new CriticalParticle(1));
                        $world->addParticle($position->add(0, 0, 1), new CriticalParticle(1));
             }
         }
    } 
}
