<?php

namespace HenryDM\CustomPVP\Events;

# pocketmine Lib
use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

# LibEco
use davidglitch04\libEco\libEco;


class KillMoney implements Listener
{

    public function __construct(private Main $main)
    {

    }

    public function onDeath(PlayerDeathEvent $event)
    {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $damageCause = $player->getLastDamageCause();
        $amount = $this->getMain()->cfg->get("killmoney-price");
        if ($this->getMain()->cfg->get("killmoney-enable") === true) {
            if (in_array($worldName, $this->getMain()->cfg->get("killmoney-world"))) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    $damager = $damageCause->getDamager();
                    if ($damager instanceof Player) {
                        libEco::addMoney($damager, $amount);
                        if ($this->getMain()->cfg->get("killmoney-reduce") === true) {
                            libEco::reduceMoney($player, $amount, static function (bool $succsess): void {
                                // NOTHING
                            });
                        }
                    }
                }
            }
        }
    }

    public function getMain(): Main
    {
        return $this->main;
    }
}
