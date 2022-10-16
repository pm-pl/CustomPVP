<?php

declare(strict_types=1);

namespace HenryDM\CustomPVP\Events\DeathEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\player\Player;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;


class DeathMessage implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {

# ========================================            
        $player = $event->getPlayer();
        $cause = $player->getLastDamageCause();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $message = str_replace(["{victim}", "{killer}"], [$event->getPlayer()->getName(), $damager->getName()], $this->main->cfg->get("death-message-alert"));
# ========================================

        if($this->main->cfg->get("death-message") === true) {
            if($cause->getCause() === EntityDamageEvent::CAUSE_ENTITY_ATTACK) {
                if($cause instanceof EntityDamageByEntityEvent) {
                    $damager = $cause->getDamager();
                    if ($damager instanceof Player) {
                        $event->setDeathMessage($message);
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}