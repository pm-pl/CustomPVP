<?php

namespace HenryDM\CustomPVP\Events\DeathEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\data\bedrock\EffectIdMap;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\player\Player;
use pocketmine\world\World;

class DeathEffects implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) : void {

# =========================================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        $id = $this->getMain()->cfg->getNested("effect.id");
        $duration = $this->getMain()->cfg->getNested("effect.duration");
        $level = $this->getMain()->cfg->getNested("effect.level");
        $particles = $this->getMain()->cfg->getNested("effect.particle");
# =========================================================================

        if ($this->getMain()->cfg->getNested("death-effects") === true) {
            if ($damageCause instanceof EntityDamageByEntityEvent) {
                $damager = $damageCause->getDamager();
                if ($damager instanceof Player) {
                    if (in_array($worldName, $this->getMain()->cfg->getNested("effect-worlds", []))) {
                        $player->getEffects()->add(new EffectInstance(EffectIdMap::getInstance()->fromId($id), $duration, $level, $particles));

                    }
                }
            }

        }
    }

    public function getMain(): Main{
        return $this->main;
    }
}
