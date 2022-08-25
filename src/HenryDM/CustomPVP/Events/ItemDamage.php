<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\world\World;
use pocketmine\player\Player;
use pocketmine\item\Sword;
use pocketmine\item\Axe;
use pocketmine\item\ItemFactory;

class ItemDamage implements Listener {

    public function __construct(private Main $main) {
      $this->main = $main;
    }
   
       public function onDamage(EntityDamageByEntityEvent $event) {
          $entity = $event->getEntity();
          $world = $entity->getWorld();
          $worldName = $world->getFolderName();
          if($event instanceof EntityDamageByEntityEvent) {
             $damaged = $event->getDamager();
             if($damaged instanceof Player) {
                if($this->getMain()->cfg->get("Item-damage") === true) {
                  if(in_array($worldName, $this->getMain()->cfg->get("damage-worlds"))) {

 # =================
 #   Wooden Sword 
 # =================

                    if(($item = $damaged->getInventory()->getItemInHand()->getId()) === ItemFactory::getInstance()->get(268, 0, 1)){
                      $item->setDamage($this->getMain()->cfg->get("wooden-sword"));

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
