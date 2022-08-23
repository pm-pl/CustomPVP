<?php

namespace HenryDM\CustomPVP\Utils;

use pocketmine\player\Player;

use onebone\economyapi\EconomyAPI;
use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;

use HenryDM\CustomPVP\Main;

class EconomyManager {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function addMoney(int $value = 0, Player $player) {
        if ($this->getMain()->cfg->get("economy-provider") === "EconomyAPI" || $this->getMain()->cfg->get("economy-provider") === "economyapi") {
            EconomyAPI::getInstance()->addMoney($player, (int) $value);
        } else if ($this->getMain()->cfg->get("economy-provider") === "BedrockEconomy" || $this->getMain()->cfg->get("economy-provider") === "bedrockeconomy") {
            BedrockEconomyAPI::legacy()->addToPlayerBalance($player, (int) $value);
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}