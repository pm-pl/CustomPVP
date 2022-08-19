<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;
use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\world\World;
use pocketmine\event\PlayerDeathEvent;
use pocketmine\world\particle\Particle;
use pocketmine\world\particle\AngryVillagerParticle;
use pocketmine\world\particle\BlockBreakParticle;
use pocketmine\world\particle\BlockForceFieldParticle;
use pocketmine\world\particle\BlockPunchParticle;
use pocketmine\world\particle\BubbleParticle;
use pocketmine\world\particle\CriticalParticle;
use pocketmine\world\particle\DragonEggTeleportParticle;
use pocketmine\world\particle\DustParticle;
use pocketmine\world\particle\EnchantParticle;
use pocketmine\world\particle\EnchantamentTableParticle;
use pocketmine\world\particle\EndermanTeleportParticle;
use pocketmine\world\particle\EntityFlameParticle;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\particle\FlameParticle;
use pocketmine\world\particle\FloatingTextParticle;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\world\particle\HeartParticle;
use pocketmine\world\particle\HugeExplodeParticle;
use pocketmine\world\particle\HugeExplodeSeedParticle;
use pocketmine\world\particle\InkParticle;
use pocketmine\world\particle\InstantEnchantParticle;
use pocketmine\world\particle\ItemBreakParticle;
use pocketmine\world\particle\LavaDripParticle;
use pocketmine\world\particle\LavaParticle;
use pocketmine\world\particle\MobSpawnParticle;
use pocketmine\world\particle\PortalParticle;
use pocketmine\world\particle\PotionSplashParticle;
use pocketmine\world\particle\RainSplashParticle;
use pocketmine\world\particle\RedstoneParticle;
use pocketmine\world\particle\SmokeParticle;
use pocketmine\world\particle\SnowballPoofParticle;
use pocketmine\world\particle\SplashParticle;
use pocketmine\world\particle\SporeParticle;
use pocketmine\world\particle\TerrainParticle;
use pocketmine\world\particle\WaterDripParticle;
use pocketmine\world\particle\WaterParticle;

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
                     $world->addParticle($position, new AngryVillagerParticle(1));
                     $world->addParticle($position, new AngryVillagerParticle(1));
                     $world->addParticle($position->add(1, 0, 0), new AngryVillagerParticle(1));
                     $world->addParticle($position->add(0, 1, 0), new AngryVillagerParticle(1));
                     $world->addParticle($position->add(0, 0, 1), new AngryVillagerParticle(1));
            }
        } 
    }
}
