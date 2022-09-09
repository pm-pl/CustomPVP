<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemFactory;

class Soup implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onPlayerInteract(PlayerItemUseEvent $event) : void {
# ============================================        
        $player = $event->getPlayer();
        $item = $event->getItem();
		$worldName = $event->getPlayer()->getWorld()->getDisplayName();
		$worlds = $this->getConfig()->get("soup-worlds", []);
        $health = $player->getHealth();
        $maxhealth = $player->getMaxHealth();
# ============================================
        if ($this->getMain()->getConfig()->get("soup-pvp") === true) {
            if ($player->getInventory()->getItemInHand()->getId() == $this->main->getConfig()->get("soup-id")) {
                if ($health == $maxhealth) {
                    $event->cancel();
                } else {
                    if (in_array($worldName, $worlds, true)) {
                        $player->setHealth($health + $this->getMain()->cfg->get("soup-heart"));
                        $player->senPopup($this->getMain()->cfg->get("soup-message"));
                        $player->getInventory()->removeItem(ItemFactory::getInstance()->get($item->getId(), 0, 1));
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
