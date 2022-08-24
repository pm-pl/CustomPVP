<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\world\World;
use pocketmine\player\Player;
use pocketmine\item\Item;
use pocketmine\item\Sword;
use pocketmine\item\Axe;
use pocketmine\item\ItemFactory;

class ItemDamage implements Listener {

    public function __construct(private Main $main) {
   
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

 # ================
 #   Wooden Sword 
 # ================

                    if($damaged->getInventory()->getItemInHand()->getId() == Item::WOODEN_SWORD) {
                       $event->setDamage($this->getMain()->cfg->get("wooden-sword"));

            }

 # ================
 #   Stone Sword 
 # ================

                    if($damaged->getInventory()->getItemInHand()->getId() == Item::STONE_SWORD) {
                       $event->setDamage($this->getMain()->cfg->get("stone-sword"));

            }

 # ================
 #   Iron Sword 
 # ================

                    if($damaged->getInventory()->getItemInHand()->getId() == Item::IRON_SWORD) {
                       $event->setDamage($this->getMain()->cfg->get("wooden-sword"));

            }

 # ================
 #   Golden Sword 
 # ================
                    if($damaged->getInventory()->getItemInHand()->getId() == Item::GOLDEN_SWORD) {
                       $event->setDamage($this->getMain()->cfg->get("wooden-sword"));

            }

 # ================
 #  Diamond Sword 
 # ================
                    if($damaged->getInventory()->getItemInHand()->getId() == Item::DIAMOND_SWORD) {
                       $event->setDamage($this->getMain()->cfg->get("wooden-sword"));

            }

 # ================
 #    Wooden Axe
 # ================

                    if($damaged->getInventory()->getItemInHand()->getId() == Item::WOODEN_AXE) {
                       $event->setDamage($this->getMain()->cfg->get("wooden-axe"));

            }

 # ================
 #    Stone Axe
 # ================
                    if($damaged->getInventory()->getItemInHand()->getId() == Item::STONE_AXE) {
                       $event->setDamage($this->getMain()->cfg->get("stone-axe"));

            }

 # ================
 #     Iron Axe
 # ================

                    if($damaged->getInventory()->getItemInHand()->getId() == Item::IRON_AXE) {
                       $event->setDamage($this->getMain()->cfg->get("iron-axe"));

            }

 # ================
 #   Diamond Axe
 # ================

                    if($damaged->getInventory()->getItemInHand()->getId() == Item::DIAMOND_AXE) {
                       $event->setDamage($this->getMain()->cfg->get("diamond-axe"));

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
