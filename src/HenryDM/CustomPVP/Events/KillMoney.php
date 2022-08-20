<?php

namespace HenryDM\CustomPVP\Main;

use pocketmine\Server;
use pocketmine\utils\Config;
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
               if($this->getMain()->cfg->get("kill-money" === true) {
                 if($event->getPlayer()->getLastDamageCause() instanceof EntityDamageByEntityEvent) {

# ======================
#  EconomyAPI Provider
# ======================

                   if($this->getMain()->cfg->get("EconomyAPI") === true) {
                    EconomyAPI::getInstance()->MyMoney($player);
                    EconomyAPI::getInstance()->AddMoney($assassin $money);
        }
     }
   }
}                  
