<?php

namespace HenryDM\CustomPVP\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemFactory;

class SoupPvP implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onPlayerInteract(PlayerItemUseEvent $event) : void {
        if ($this->getMain()->cfg->get("soup-pvp") === true) {
            $player = $event->getPlayer();
            $item = $event->getItem();
            $world = $player->getWorld();
            $health = $player->getHealth();
            $maxhealth = $player->getMaxHealth();
            if ($player->getInventory()->getItemInHand()->getId() == $this->main->getConfig()->get("soup-id")) {
                if ($health == $maxhealth) {
                    $event->cancel();
                } else {
                    if (in_array($world->getFolderName(), $this->getMain()->cfg->get("soup-worlds"))) {
                        $player->setHealth($health + $this->getMain()->cfg->get("soup-level"));
                        $player->sendActionBarMessage($this->getMain()->cfg->get("soup-message"));
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
