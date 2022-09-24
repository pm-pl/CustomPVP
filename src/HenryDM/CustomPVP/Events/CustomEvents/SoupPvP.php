<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemFactory;

class SoupPvP implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onPlayerInteract(PlayerItemUseEvent $event) : void {

# ============================================        
        $player = $event->getPlayer();
        $item = $event->getItem();
	    $worldName = $event->getPlayer()->getWorld()->getDisplayName();
	    $worlds = $this->getMain()->cfg->getNested("soup-pvp-worlds", []);
        $health = $player->getHealth();
        $maxhealth = $player->getMaxHealth();
# ============================================

        if ($this->getMain()->getConfig()->get("soup-pvp") === true) {
            if ($player->getInventory()->getItemInHand()->getId() == $this->getMain()->cfg()->getNested("soup-pvp-id")) {
                if ($health == $maxhealth) {
                    $event->cancel();
                } else {
                    if (in_array($worldName, $worlds) === true) {
                                $player->setHealth($health + $this->getMain()->cfg->get("soup-hearts"));
                                $player->getInventory()->removeItem(ItemFactory::getInstance()->get($item->getId(), 0, 1));
                                if($this->getMain()->cfg->getNested("soup-consume-message") === true) {
                                    if($this->getMain()->cfg->getNested("soup-consume-message-type-popup") === true) {
                                        $player->sendPopup($this->getMain()->cfg->get("soup-message"));
                                    } else {
                                        $player->sendMessage($this->getMain()->cfg->get("soup-message"));
                                    }
                                }
                            }
                        }
                    }
                }
            }

    public function getMain() : Main {
        return $this->main;
    }
}