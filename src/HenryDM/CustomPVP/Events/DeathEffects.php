<?php

namespace HenryDM\CustomPVP\Events;

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

    public function onPlayerDeath(PlayerDeathEvent $event)
    {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        # Effect settings
        $id = $this->getMain()->cfg->getNested("effect.id");
        $duration = $this->getMain()->cfg->getNested("effect.duration");
        $level = $this->getMain()->cfg->getNested("effect.level");
        $particle = $this->getMain()->cfg->getNested("effect.particle");

        if ($this->getMain()->cfg->get("death-effects") === true) {
            if ($damageCause instanceof EntityDamageByEntityEvent) {
                $damager = $damageCause->getDamager();
                if ($damager instanceof Player) {
                    if (in_array($worldName(), $this->getMain()->cfg->get("effect-worlds"))) {
                        $player->getEffects()->add(new EffectInstance(EffectIdMap::getInstance()->fromId($id), $duration, $level, $particle));

                    }
                }
            }

        }
    }

    public function getMain(): Main{
        return $this->main;
    }
}
