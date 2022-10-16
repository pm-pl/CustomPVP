<?php

namespace HenryDM\CustomPVP\Events\CustomEvents;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\LegacyStringToItemParser;

class SoupPvP implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onInteract(PlayerItemUseEvent $event) {

# ============================================        
        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand()->getId();
        $soup = $this->main->cfg->get("soup-pvp-id");
        $health = $player->getHealth();
        $maxhealth = $player->getMaxHealth();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $item = LegacyStringToItemParser::getInstance()->parse($soup);
        $message = $this->main->cfg->get("soup-pvp-consume-message");
# ============================================

        if($this->main->cfg->get("soup-pvp") === true) {
            if($hand === $soup) {
                if($health < $maxhealth) {
                    if(in_array($worldName, $this->main->cfg->get("soup-pvp-worlds", []))) {
                        $player->setHealth($health + $this->main->cfg->get("soup-pvp-hearts"));
                        $player->getInventory()->removeItem($item->setCount(1));

                        if($this->main->cfg->get("soup-pvp-message") === true) {
                            $player->sendPopup($message);
                        }
                    }
                } else {
                    $event->cancel();
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}