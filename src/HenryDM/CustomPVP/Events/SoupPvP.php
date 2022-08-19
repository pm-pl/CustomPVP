<?php

namespace HenryDM\CustomPVP\Events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\item\ItemFactory;
use HenryDM\CustomPVP\Main;

class SoupPvP implements Listener {

private $main;

	public function __construct(Main $main) {
		$this->main = $main;
	}

        public function onPlayerInteract(PlayerItemUseEvent $event) : void {

        if ($event->getAction() === PlayerInteractEvent::LEFT_CLICK_AIR, $event->getAction() === PlayerInteractEvent::LEFT_CLICK_BLOCK, $event->getAction() === PlayerInteractEvent::RIGHT_CLICK_AIR, $event->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK) {
          if($this->main->getConfig()->get("soup-pvp") === true) {
            $player = $event->getPlayer();
            $item = $event->getItem();
            $health = $player->getHealth();
              if($player->getInventory()->getItemInHand()->getId() == $this->main->getConfig()->get("soup-id")) {
                if($player->getHealth() == $player->getMaxHealth()) {
                  $event->cancel();	
                } else { 
                    $player->setHealth($health + $this->main->getConfig()->get("regenerate-level"));
		    $player->sendActionBarMessage($this->main->getConfig()->get("soup-message"));
                    $player->getInventory()->removeItem(ItemFactory::getInstance()->get($item->getId(), 0, 1));
	         }
	     }
        }
    }
}
