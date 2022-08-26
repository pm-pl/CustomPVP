<?php

namespace HenryDM\CustomPVP\task;

use pocketmine\Server;

use pocketmine\scheduler\Task;

use pocketmine\player\Player;

use HenryDM\CustomPVP\Main;

class PingTask extends Task {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onRun() : void {
        if ($this->getMain()->cfg->getNested("pingkick-enable", true)) {
            foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                if ($player->getNetworkSession()->getPing() >= $this->getMain()->cfg->getNested("pingkick-max")) {
                    $player->kick($$this->getMain()->cfg->get("kick-message"));
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}