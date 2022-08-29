<?php

namespace HenryDM\CustomPVP\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\player\Player;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\ItemFactory;

class ItemDamage implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) : void {
        // COMING SOON
    }

    public function getMain() : Main {
        return $this->main;
    }
}