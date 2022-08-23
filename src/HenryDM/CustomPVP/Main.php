<?php

namespace HenryDM\CustomPVP;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

use HenryDM\CustomPVP\EventListener;
use HenryDM\CustomPVP\Events\Cooldown;
use HenryDM\CustomPVP\Events\KnockBack;
use HenryDM\CustomPVP\Events\LeechingMode;
use HenryDM\CustomPVP\Events\HealthRestore;
use HenryDM\CustomPVP\Events\Message;
use HenryDM\CustomPVP\Events\Particles;
use HenryDM\CustomPVP\Events\SoupPvP;
use HenryDM\CustomPVP\Events\KillMoney;
use HenryDM\CustomPVP\Events\KillReward;
use HenryDM\CustkomPVP\Events\KillSound;

class Main extends PluginBase implements Listener {
	
    private static Main $instance;
    public Config $cfg;	

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents(new Cooldown($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new KnockBack($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new LeechingMode($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new HealthRestore($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Message($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Particles($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new SoupPvP($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new KillMoney($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new KillReward($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new KillSound($this), $this);
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml");
    }

    public function onLoad() : void {
        self::$instance = $this;
    }
	
    public static function getInstance() : Main {
        return self::$instance;
    }
}
