<?php

namespace HenryDM\CustomPVP\Events;

# Plugin and pocketmine event libs
use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\entity\Entity;
use pocketmine\player\Player;
use pocketmine\world\Position;
use pocketmine\event\entity\EntityDeathEvent;

# Pocketmine Particles Libs
use pocketmine\world\particle\CriticalParticle;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\particle\FlameParticle;
use pocketmine\world\particle\HeartParticle;
use pocketmine\world\particle\LavaParticle;
use pocketmine\world\particle\PortalParticle;
use pocketmine\world\particle\RedstoneParticle;
use pocketmine\world\particle\SnowballPoofParticle;


class Particles extends PluginBase implements Listener {
 
         public function __construct(private Main $main) {
            $this->main = $main;
	}

              public function onPlayerDeath(EntityDeathEvent $event) {
                  $entity = $event->getEntity();
                  $world = $entity->getWorld();
		  $position = $entity()->getPosition();    
                   if($this->main->getConfig()->get("kill-particles") === true) {
                     if(in_array($world->getFolderName(), $this->main->getConfig()->get("particle-worlds"))) {

                        if($this->main->getConfig()->get("critical-particle") === true) {
                          $world->addParticle($position(), new CriticalParticle(1));
                          $world->addParticle($position(), new CriticalParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new CriticalParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new CriticalParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new CriticalParticle(1));
	        }
                        if($this->main->getConfig()->get("explode-particle") === true) {
                          $world->addParticle($position(), new ExplodeParticle(1));
                          $world->addParticle($position(), new ExplodeParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new ExplodeParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new ExplodeParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new ExplodeParticle(1));
		}
                        if($this->main->getConfig()->get("explode-particle") === true) {
                          $world->addParticle($position(), new ExplodeParticle(1));
                          $world->addParticle($position(), new ExplodeParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new ExplodeParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new ExplodeParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new ExplodeParticle(1));
		}
                        if($this->main->getConfig()->get("flame-particle") === true) {
                          $world->addParticle($position(), new FlameParticle(1));
                          $world->addParticle($position(), new FlameParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new FlameParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new FlameParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new FlameParticle(1));
		}
                        if($this->main->getConfig()->get("heart-particle") === true) {
                          $world->addParticle($position(), new HeartParticle(1));
                          $world->addParticle($position(), new HeartParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new HeartParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new HeartParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new HeartParticle(1));
		}
                        if($this->main->getConfig()->get("lava-particle") === true) {
                          $world->addParticle($position(), new LavaParticle(1));
                          $world->addParticle($position(), new LavaParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new LavaParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new LavaParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new LavaParticle(1));
		}
                        if($this->main->getConfig()->get("nether-particle") === true) {
                          $world->addParticle($position(), new PortalParticle(1));
                          $world->addParticle($position(), new PortalParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new PortalParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new PortalParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new PortalParticle(1));
		}
                        if($this->main->getConfig()->get("nether-particle") === true) {
                          $world->addParticle($position(), new PortalParticle(1));
                          $world->addParticle($position(), new PortalParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new PortalParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new PortalParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new PortalParticle(1));
		}
                        if($this->main->getConfig()->get("redstone-particle") === true) {
                          $world->addParticle($position(), new RedstoneParticle(1));
                          $world->addParticle($position(), new RedstoneParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new RedstoneParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new RedstoneParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new RedstoneParticle(1));
		}
                        if($this->main->getConfig()->get("snow-particle") === true) {
                          $world->addParticle($position(), new SnowballPoofParticle(1));
                          $world->addParticle($position(), new SnowballPoofParticle(1));
                          $world->addParticle($position()->add(1, 0, 0), new SnowballPoofParticle(1));
                          $world->addParticle($position()->add(0, 1, 0), new SnowballPoofParticle(1));
                          $world->addParticle($position()->add(0, 0, 1), new SnowballPoofParticle(1));
		}
             }
         }
    } 
}
