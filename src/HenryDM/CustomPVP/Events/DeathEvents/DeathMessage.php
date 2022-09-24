<?php

declare(strict_types=1);

namespace HenryDM\CustomPVP\Events\DeathEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use function str_replace;

use pocketmine\player\Player;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;


class DeathMessage implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) : void {

# ========================================            
        $player = $event->getPlayer();
        $cause = $player->getLastDamageCause();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
# ========================================

        if ($this->getMain()->cfg->getNested("death-message") === true) {
            if ($cause->getCause() == EntityDamageEvent::CAUSE_ENTITY_ATTACK) {
                if ($cause instanceof EntityDamageByEntityEvent) {
                    $damager = $cause->getDamager();
                    if ($damager instanceof Player) {
                        $message = str_replace(["{victim}", "{killer}"], [$event->getPlayer()->getName(), $damager->getName()], $this->getMain()->cfg->getNested("death-message-alert"));
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