<?php

namespace HenryDM\CustomPVP\CustomEvents;

use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;

use pocketmine\item\Item;

use HenryDM\CustomPVP\Main;

class ItemCooldown implements Listener{

     public function __construct(private Main $main){
        $this->main = $main;
    }

    # PlayerItemUseEvent | It will not allow the player to use the item 
    # when it is on cooldown.
    public function onUse(PlayerItemUseEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        $Itemcheck = $this->ItemCheck($player, $item);

        if($event->isCancelled()){
            return null;
        }
  
        if($Itemcheck !== null){
            $event->cancel();
        }
    }

    # PlayerInteractEvent | It will not allow the player to interact by 
    # pressing a block while it is on cooldown.
    public function onInteract(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        $action = $event->getAction();
        $Itemcheck = $this->ItemCheck($player, $item);

        if($event->isCancelled()){
          return null;
        }
    
        if($action !== PlayerInteractEvent::RIGHT_CLICK_BLOCK){
          return null;
        }
    
        if($Itemcheck !== null){
          $event->cancel();
        }
    }

    # Add the cooldown to the player through this feature.
    public function PlayerCooldown(Player $player, Item $item){
        $filePlayer = new Config($this->main->getDataFolder() . "players/" . DIRECTORY_SEPARATOR . $player->getName(), Config::YAML);
        $ID = $item->getId().":".$item->getMeta();
    
        if(!$filePlayer->exists($ID)){
          $this->SaveCooldown($player, $item);
          return null;
        }
    
        $time = $filePlayer->get($ID);
        if($time < time()){
          $this->SaveCooldown($player, $item);
          return null;
        }
    
        $va = $time - time();
        return $va;
    }

    # Verify that the configuration works correctly.
    public function ItemCheck(Player $player, Item $item){
        $ID = $item->getId().":".$item->getMeta();
        $config = $this->main->cfg->get("Item-Cooldown");

        if(!file_exists($this->main->getDataFolder() . "players/" . strtolower($player->getName()))){
            $this->GenerateFilePlayer($player);
            $this->SaveCooldown($player, $item);
            return null;
        }

        if(in_array($player->getWorld()->getFolderName(), $this->main->cfg->get("Item-cooldown-worlds"))){
            return null;
        }
    
        if(!isset($config[$ID])){
          return null;
        }
    
        if(!is_numeric($config[$ID])){
          $this->main->getLogger()->warning("§c$ID cooldown is not numeric! Change the settings.");
          return null;
        }
    
        $cooldown = $this->PlayerCooldown($player, $item);
        if($cooldown !== null){
          $main = (int)$cooldown;
          $seconds = $main % 60;
          $player->sendMessage(str_replace(["{SECONDS}"], [$seconds], $this->main->cfg->get("Item-cooldown-message")));
          return " ";
        }
        return null;
    }

    # Save player information.
    public function SaveCooldown(Player $player, Item $item){
        $filePlayer = new Config($this->main->getDataFolder() . "players/" . DIRECTORY_SEPARATOR . $player->getName(), Config::YAML);
        $ID = $item->getId().":".$item->getMeta();
        $config = $this->main->cfg->get("Item-Cooldown");
        $time = time() + $config[$ID];
        $filePlayer->set($ID, $time);
        $filePlayer->save();
    }

    # Generates a file with the player's name when 
    # entering the server, this is used to save the cooling information of 
    # the elements that the player owns.
    public function GenerateFilePlayer(Player $player){
        new Config($this->main->getDataFolder() . "players/" . DIRECTORY_SEPARATOR . $player->getName(), Config::YAML);
    }

    public function getMain(): Main{
        return $this->main;
    }
}
