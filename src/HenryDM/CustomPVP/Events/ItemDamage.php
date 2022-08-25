<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\item\ItemFactory;

use HenryDM\CustomPVP\Main;

class ItemDamage implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDamage(EntityDamageEvent $event) : void {
        // SOON
    }

    public function getMain() : Main {
        return $this->main;
    }
}