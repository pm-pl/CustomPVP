<?php
namespace HenryDM\CustomPVP;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use HenryDM\CustomPVP\EventListener;
use HenryDM\CustomPVP\Events\Message;

class Main extends PluginBase implements Listener {
	
	private static $instance;
	
	public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
	$this->saveDefaultConfig();
	$this->saveResource("config.yml");
	self::$instance = $this;
      }

       public function onDisable() : void{
       $this->getConfig()->save();
      }
	
	public static function getInstance() : Main {
		return self::$instance;
	}
}
