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
             $world = $event->getPlayer()->getWorld()->getFolderName();
             $money = $this->getMain()->cfg->get("money-value");
             $assassin = $player->getLastDamageCause()->getDamager();
               if($this->getMain()->cfg->get("kill-money") === true) {
                if($event->getPlayer()->getLastDamageCause() instanceof EntityDamageByEntityEvent) {
                 if(in_array($entity->getWorld()->getFolderName(), $this->getMain()->cfg->get("money-worlds"))) {

# ======================
#  EconomyAPI Provider
# ======================

                      if($this->getMain()->cfg->get("EconomyAPI") === true) {
                        EconomyAPI::getInstance()->myMoney($player);
                        EconomyAPI::getInstance()->addMoney($assassin, $money);
                    }

# ======================
#   Bedrock Provider
# ======================

                      if($this->getMain()->cfg->get("BedrockEconomy") === true) {
                        BedrockEconomyAPI::legacy()->getPlayerBalance($player);
                        BedrockEconomyAPI::legacy()->addToPlayerBalance($assassin, $money);
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
