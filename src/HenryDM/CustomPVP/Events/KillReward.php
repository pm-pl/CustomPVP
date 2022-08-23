<?php 

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;
use pocketmine\item\ItemFactory;
use pocketmine\world\World;

class KillReward implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) { 
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $damageCause = $player->getLastDamageCause();
        if ($config("kill-reward") === true) {
                if ($damageCause instanceof EntityDamageByEntityEvent) {
                    if ($damager instanceof Player) {
                        if ($player->getInventory()->getItemInHand()->getId() === $this->getMain()->cfg->get("reward-id")) {
                            if (in_array($world->getFolderName(), $this->getMain()->cfg->get("rewards-worlds"))) {
                                $player->getInventory()->addItem(ItemFactory::getInstance()->get($item->getId(), 0, 1));

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