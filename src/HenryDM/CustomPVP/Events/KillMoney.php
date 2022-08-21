<?php

namespace HenryDM\CustomPVP\Main;

use HenryDM\CustomPVP\Main;
use pocketmine\Server;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\world\World;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;

class KillMoney implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onPlayerDeath(PlayerDeathEvent $event) : void {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $money = $this->getMain()->cfg->get("money-value");
        $damager = $player->getLastDamageCause()->getDamager();
        if($this->getMain()->cfg->get("kill-money") === true) {
            if($event->getPlayer()->getLastDamageCause() instanceof EntityDamageByEntityEvent) , $this->getMain()->cfg->get("money-worlds"))) {
                if(in_array($worldName, $this->getMain()->cfg->get("money-worlds"))) {
                    if($this->getMain()->cfg->get("economy-provider") === "EconomyAPI") {
                        EconomyAPI::getInstance()->myMoney($player);
                        EconomyAPI::getInstance()->addMoney($damager, $money);
                    }

                    if($this->getMain()->cfg->get("economy-provider") === "BedrockEconomy") {
                        BedrockEconomyAPI::legacy()->getPlayerBalance($player);
                        BedrockEconomyAPI::legacy()->addToPlayerBalance($assassin, $money);
                     }
                 }
             }
         }
     }

    public function getMain() : Main {
        return $this->main;
    }
}                  
