<?php

namespace HenryDM\CustomPVP\Events\KillEvents;

use HenryDM\CustomPVP\Main;
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

class KillParticles implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(EntityDeathEvent $event) {

# =========================================================
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $worldName = $world->getFolderName();
        $position = $entity->getPosition();
# =========================================================
        
        if($this->main->cfg->get("kill-particles") === true) {
            if(in_array($worldName, $this->main->cfg->get("kill-particles-worlds", []))) {
                if($this->main->cfg->get("critical-particle") === true) {
                    $world->addParticle($position, new CriticalParticle(1));
                    $world->addParticle($position, new CriticalParticle(1));
                    $world->addParticle($position->add(1, 0, 0), new CriticalParticle(1));
                    $world->addParticle($position->add(0, 1, 0), new CriticalParticle(1));
                    $world->addParticle($position->add(0, 0, 1), new CriticalParticle(1));
                }

                if($this->main->cfg->get("explode-particle") === true) {
                    $world->addParticle($position, new ExplodeParticle());
                    $world->addParticle($position, new ExplodeParticle());
                    $world->addParticle($position->add(1, 0, 0), new ExplodeParticle());
                    $world->addParticle($position->add(0, 1, 0), new ExplodeParticle());
                    $world->addParticle($position->add(0, 0, 1), new ExplodeParticle());
                }

                if($this->main->cfg->get("flame-particle") === true) {
                    $world->addParticle($position, new FlameParticle());
                    $world->addParticle($position, new FlameParticle());
                    $world->addParticle($position->add(1, 0, 0), new FlameParticle());
                    $world->addParticle($position->add(0, 1, 0), new FlameParticle());
                    $world->addParticle($position->add(0, 0, 1), new FlameParticle());
                }

                if($this->main->cfg->get("heart-particle") === true) {
                    $world->addParticle($position, new HeartParticle(1));
                    $world->addParticle($position, new HeartParticle(1));
                    $world->addParticle($position->add(1, 0, 0), new HeartParticle(1));
                    $world->addParticle($position->add(0, 1, 0), new HeartParticle(1));
                    $world->addParticle($position->add(0, 0, 1), new HeartParticle(1));
                }

                if($this->main->cfg->get("lava-particle") === true) {
                    $world->addParticle($position, new LavaParticle());
                    $world->addParticle($position, new LavaParticle());
                    $world->addParticle($position->add(1, 0, 0), new LavaParticle());
                    $world->addParticle($position->add(0, 1, 0), new LavaParticle());
                    $world->addParticle($position->add(0, 0, 1), new LavaParticle());
                }

                if ($this->main->cfg->get("portal-particle") === true) {
                    $world->addParticle($position, new PortalParticle());
                    $world->addParticle($position, new PortalParticle());
                    $world->addParticle($position->add(1, 0, 0), new PortalParticle());
                    $world->addParticle($position->add(0, 1, 0), new PortalParticle());
                    $world->addParticle($position->add(0, 0, 1), new PortalParticle());
                }

                if ($this->main->cfg->get("redstone-particle") === true) {
                    $world->addParticle($position, new RedstoneParticle(3));
                    $world->addParticle($position, new RedstoneParticle(3));
                    $world->addParticle($position->add(1, 0, 0), new RedstoneParticle(3));
                    $world->addParticle($position->add(0, 1, 0), new RedstoneParticle(3));
                    $world->addParticle($position->add(0, 0, 1), new RedstoneParticle(3));
                }

                if ($this->main->cfg->get("snow-particle") === true) {
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