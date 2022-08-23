<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\player\Player;
use pocketmine\world\World;

class DeathEffects implements Listener { 

    public function __construct(private Main $main) {
        $this->main = $main;
    }
      
    public function onPlayerDeath(PlayerDeathEvent $event) { 
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damager = $damageCause->getDamager();
        $damageCause = $player->getLastDamageCause();
        if($player instanceof Player) {
            if($this->getMain()->cfg->get("death-effects") === true) { 
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    if ($damager instanceof Player) {
                        if(in_array($worldName(), $this->getMain()->cfg->get("effect-worlds"))) {
                            $player->addEffect(new EffectInstance(Effect::getEffect(Effect::$this->getMain()->cfg->get("effect-name")), $this->getMain()->cfg->get("efffect-duration")* 1, 1, true));             
                    
                        }                        
                    }
                }
            }
        }
    }
    
    public function getMain() : Main {
        return $this->main;
    }
}
