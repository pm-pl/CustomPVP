<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDeathEvent;

use pocketmine\world\particle\CriticalParticle;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\particle\FlameParticle;
use pocketmine\world\particle\HeartParticle;
use pocketmine\world\particle\LavaParticle;
use pocketmine\world\particle\PortalParticle;
use pocketmine\world\particle\RedstoneParticle;
use pocketmine\world\particle\SnowballPoofParticle;

use HenryDM\CustomPVP\Main;


class Particles implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(EntityDeathEvent $event) {
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $position = $entity->getPosition();    
        if ($this->getMain()->cfg->get("kill-particles") === true) {
            if (in_array($world->getFolderName(), $this->getMain()->cfg->get("particle-worlds"))) {
                if($this->getMain()->cfg->get("critical-particle") === true) {
                    $world->addParticle($position, new CriticalParticle(1));
                    $world->addParticle($position, new CriticalParticle(1));
                    $world->addParticle($position->add(1, 0, 0), new CriticalParticle(1));
                    $world->addParticle($position->add(0, 1, 0), new CriticalParticle(1));
                    $world->addParticle($position->add(0, 0, 1), new CriticalParticle(1));
	        }

                if($this->getMain()->cfg->get("explode-particle") === true) {
                    $world->addParticle($position, new ExplodeParticle());
                    $world->addParticle($position, new ExplodeParticle());
                    $world->addParticle($position->add(1, 0, 0), new ExplodeParticle());
                    $world->addParticle($position->add(0, 1, 0), new ExplodeParticle());
                    $world->addParticle($position->add(0, 0, 1), new ExplodeParticle());
	        }

                if($this->getMain()->cfg->get("flame-particle") === true) {
                    $world->addParticle($position, new FlameParticle());
                    $world->addParticle($position, new FlameParticle());
                    $world->addParticle($position->add(1, 0, 0), new FlameParticle());
                    $world->addParticle($position->add(0, 1, 0), new FlameParticle());
                    $world->addParticle($position->add(0, 0, 1), new FlameParticle());
	        }

                if($this->getMain()->cfg->get("heart-particle") === true) {
                    $world->addParticle($position, new HeartParticle(1));
                    $world->addParticle($position, new HeartParticle(1));
                    $world->addParticle($position->add(1, 0, 0), new HeartParticle(1));
                    $world->addParticle($position->add(0, 1, 0), new HeartParticle(1));
                    $world->addParticle($position->add(0, 0, 1), new HeartParticle(1));
		}

                if($this->getMain()->cfg->get("lava-particle") === true) {
                    $world->addParticle($position, new LavaParticle());
                    $world->addParticle($position, new LavaParticle());
                    $world->addParticle($position->add(1, 0, 0), new LavaParticle());
                    $world->addParticle($position->add(0, 1, 0), new LavaParticle());
                    $world->addParticle($position->add(0, 0, 1), new LavaParticle());
		}

                if($this->getMain()->cfg->get("nether-particle") === true) {
                    $world->addParticle($position, new PortalParticle());
                    $world->addParticle($position, new PortalParticle());
                    $world->addParticle($position->add(1, 0, 0), new PortalParticle());
                    $world->addParticle($position->add(0, 1, 0), new PortalParticle());
                    $world->addParticle($position->add(0, 0, 1), new PortalParticle());
		}

                if($this->getMain()->cfg->get("redstone-particle") === true) {
                    $world->addParticle($position, new RedstoneParticle(3));
                    $world->addParticle($position, new RedstoneParticle(3));
                    $world->addParticle($position->add(1, 0, 0), new RedstoneParticle(3));
                    $world->addParticle($position->add(0, 1, 0), new RedstoneParticle(3));
                    $world->addParticle($position->add(0, 0, 1), new RedstoneParticle(3));
		}

                if($this->getMain()->cfg->get("snow-particle") === true) {
                    $world->addParticle($position, new SnowballPoofParticle());
                    $world->addParticle($position, new SnowballPoofParticle());
                    $world->addParticle($position->add(1, 0, 0), new SnowballPoofParticle());
                    $world->addParticle($position->add(0, 1, 0), new SnowballPoofParticle());
                    $world->addParticle($position->add(0, 0, 1), new SnowballPoofParticle());
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}