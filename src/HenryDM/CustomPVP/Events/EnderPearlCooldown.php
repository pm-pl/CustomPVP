<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\item\EnderPearl;

use HenryDM\CustomPVP\Main;

use function time;

class EnderPearlCooldown implements Listener {

    private array $cooldowns = [];

//     public function __construct(private Main $main) {
//         $this->main = $main;
//     }

//     public function onQuit(PlayerQuitEvent $event) {
//         $player = $event->getPlayer();
//         if (isset($this->cooldowns[$player->getName()])) {
//             unset ($this->cooldowns[$player->getName()]);
//         }
//     }

//     public function onInteract(PlayerInteractEvent $event) {
//         $player = $event->getPlayer();
//         $item = $event->getItem();

//         if ($item instanceof EnderPearl) {
//             if (isset($this->cooldowns[$player->getName()]) and time() - $this->cooldowns[$player->getName()] < $this->getMain()->cfg->get("cooldowns-time")) {
//                 $event->cancel();
//                 $time = $this->getMain()->cfg->get("cooldowns-time") - (time() - $this->cooldowns[$player->getName()]);
//                 $player->sendMessage(str_replace("{time}", $time, $this->getMain()->cfg->get("cooldown-message")));
//             } else {
//                 $this->cooldowns[$player->getName()] = (time() - $this->getMain()->cfg->get("cooldowns-time"));
//             }
//         }
//     }

//     public function getMain() : Main {
//         return $this->main;
//     }
}