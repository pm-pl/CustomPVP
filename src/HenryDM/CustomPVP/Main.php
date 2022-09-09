<?php

namespace HenryDM\CustomPVP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

# In test Class 
use HenryDM\CustomPVP\Events\SoupPvP\Soup;

# Normal classes
use HenryDM\CustomPVP\Events\AntiFlightPvp;
use HenryDM\CustomPVP\Events\AntiPvPWorld;
use HenryDM\CustomPVP\Events\AttackCooldown;
use HenryDM\CustomPVP\Events\DeathEffects;
use HenryDM\CustomPVP\Events\DeathKick;
use HenryDM\CustomPVP\Events\HealthRestore;
# use HenryDM\CustomPVP\Events\ItemDamage;
use HenryDM\CustomPVP\Events\KillMoney;
use HenryDM\CustomPVP\Events\KillParticles;
use HenryDM\CustomPVP\Events\KillReward;
use HenryDM\CustomPVP\Events\KillSound;
use HenryDM\CustomPVP\Events\KnockBack;
use HenryDM\CustomPVP\Events\LeechingMode;
use HenryDM\CustomPVP\Events\Message;
use HenryDM\CustomPVP\Events\PingKick;

class Main extends PluginBase implements Listener {

    /*** @var Main */
    private static Main $instance;

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll(); # In test
        $this->saveResource("SoupPvP.yml"); # In test
        new Config($this->getDataFolder() . "SoupPvP.yml", Config::YAML); # In test

        $events = [
            AntiFlightPvp::class,
            AntiPvPWorld::class,
            AttackCooldown::class,
            DeathEffects::class,
            DeathKick::class,
            HealthRestore::class,
            # ItemDamage::class,
            KillMoney::class,
            KillParticles::class,
            KillReward::class,
            KillSound::class,
            KnockBack::class,
            LeechingMode::class,
            Message::class,
            PingKick::class,
            SoupPvP::class
        ];
        foreach($events as $e) {
            $this->getServer()->getPluginManager()->registerEvents(new $e($this), $this);
        }
    }

    public function onLoad() : void {
        self::$instance = $this;
    }

    public static function getInstance() : Main {
        return self::$instance;
    }

    public function getMainConfig() : Config {
        return $this->cfg;
    }
}
