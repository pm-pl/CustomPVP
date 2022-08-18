<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\plugin\PluginBase;

class SoupPvP extends PluginBase implements Listener {

    public function onPlayerInteract(PlayerInteractEvent $event) : void {
        if($this->main->getConfig()->get("soup-pvp") === true) {
            $player = $event->getPlayer();
            $item = $event->getItem();
            $health = $player->getHealth();
            if($player->getInventory()->getItemInHand()->getId("459")) {
              if($player->getHealth() == $player->getMaxHealth()) {
                $event->cancel();	
              } else { 
                    $player->setHealth($health + $this->main->getConfig()->get("regenerate-level"));
		    $player->sendActionBarMessage($this->main->getConfig()->get("soup-message"));
                    $player->getInventory()->removeItem(Item::get($item->getId(), 0, 1));
	         }
	     }
        }
    }
}
