<?php

declare(strict_types=1);

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;

use HenryDM\CustomPVP\Main;

use function str_replace;

class Message implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) : void {
        if($this->getMain()->cfg->get("message") === true) {		
            $player = $event->getPlayer();
            $cause = $player->getLastDamageCause();
            if($player instanceof Player) {
                switch ($cause->getCause()) {
                    case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
                        if($cause instanceof EntityDamageByEntityEvent) {
                            $damager = $cause->getDamager();
                            if($damager instanceof Player) {
                                $message = str_replace(["{victim}", "{killer}"], [$event->getPlayer()->getName(), $damager->getName()], $this->getMain()->cfg->get("kill-message"));
                                $event->setDeathMessage($message);
                            }
                        }
                    break;
	        }
            } 
        } 
    }

    public function getMain() : Main {
        return $this->main;
    }
}
