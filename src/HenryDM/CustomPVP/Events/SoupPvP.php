<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerItemUseEvent;

use pocketmine\item\ItemFactory;

use HenryDM\CustomPVP\Main;

class SoupPvP implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onPlayerInteract(PlayerItemUseEvent $event) : void {
        if($this->getMain()->cfg->get("soup-pvp") === true) {
            $player = $event->getPlayer();
            $item = $event->getItem();
            $health = $player->getHealth();
            $maxhealth = $player->getMaxHealth();
            if ($player->getInventory()->getItemInHand()->getId() == $this->main->getConfig()->get("soup-id")) {
                if ($health == $maxhealth) {
                    $event->cancel();	
                } else {
                    $player->setHealth($health + $this->getMain()->cfg->get("regenerate-level"));
		    $player->sendActionBarMessage($this->getMain()->cfg->get("soup-message"));
                    $player->getInventory()->removeItem(ItemFactory::getInstance()->get($item->getId(), 0, 1));
	       }
	    }
        }
    }


    public function getMain() : Main {
        return $this->main;
    }
}
