<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntity;
use pocketmine\world\World;
use pocketmine\player\Player;
use pocketmine\event\Listener;

use onebone\economyapi\EconomyAPI;
use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;

class KillMoney implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }
         
           public function onPlayerDeath(PlayerDeathEvent $event) {
             $player = $event->getPlayer();
             $world = $player->getWorld()->getFolderName();
             $config = $this->getMain()->cfg->get();
             $money = $config("money-value");
             $xp = $player->getXpManager();
             $xpvalue = $config("xp-value");
             $assassin->getLastDamageCause->getDamager();
             if(in_array($world, $config("money-worlds"))) {
                if($player->getLastDamageCause instanceof EntityDamageByEntityEvent) {
 
                  if($config("EconomyAPI") === true) {
                    EconomyAPI::getInstance()->myMoney($player);
                    EconomyAPI::getInstance()->addMoney($assassin, $money);

                  if($config("BedrockEconomy") === true) {
                     BedrockEconomyAPI::legacy()->getPlayerBalance($player);
                     BedrockEconomyAPI::legacy()->addToPlayerBalance($assassin, $money);

                   if($config("XP") === true) {
                     $xp->addXp($assassin, $xpvalue);
                 }
              }
           }
        }
     }
  }            public function getMain() : Main {
              return $this->main;
   }
}
