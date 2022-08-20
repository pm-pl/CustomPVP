<?php

namespace HenryDM\CustomPVP\Utils;

use pocketmine\player\Player;

use pocketmine\network\mcpe\protocol\PlaySoundPacket;

use HenryDM\CustomPVP\Main;

class Utils {

    public function __construct(private Main $main) {
        $this->main = $main;
    }
  
    public function playSound(Player $player, string $soundName = " ", float $volume = 0, float $pitch = 0) {
        $pk = new PlaySoundPacket();
        $pk->x = $player->getPosition()->getX();
        $pk->x = $player->getPosition()->getY();
        $pk->x = $player->getPosition()->getZ();
        $pk->soundName = $soundName;
        $pk->volume = $volume;
        $pk->pitch = $pitch;
        $player->getNetworkSession()->senddataPacket($pk);
    }
}
