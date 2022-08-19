<?php
namespace HenryDM\CustomPVP;

# Pocketmine Libs
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

# Plugin Libs
use HenryDM\CustomPVP\EventListener;
use HenryDM\CustomPVP\Events\Cooldown;
use HenryDM\CustomPVP\Events\KnockBack;
use HenryDM\CustomPVP\Events\HealthRestore;
use HenryDM\CustomPVP\Events\Message;
use HenryDM\CustomPvP\Events\Particles;
use HenryDM\CustomPVP\Events\SoupPvP;

class Main extends PluginBase {
	
	private static Main $instance;
	
	public function onEnable() : void {
	$this->getServer()->getPluginManager()->registerEvents(new Cooldown($this), $this);
	$this->getServer()->getPluginManager()->registerEvents(new KnockBack($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new HealthRestore($this), $this);
	$this->getServer()->getPluginManager()->registerEvents(new Message($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Particles($this), $this);
	$this->getServer()->getPluginManager()->registerEvents(new SoupPvP($this), $this);
	$this->saveResource("config.yml");
	self::$instance = $this;
      }
	
	public static function getInstance() : Main {
		return self::$instance;
	}
}
