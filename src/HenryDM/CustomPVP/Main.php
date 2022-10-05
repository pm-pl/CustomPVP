<?php

namespace HenryDM\CustomPVP;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\Config;

# Custom Events

use HenryDM\CustomPVP\Events\CustomEvents\{
    AttackCooldown,
    HealthRestore,
    KnockBack,
    LeechingMode,
    SoupPvP
};

# Death Events

use HenryDM\CustomPVP\Events\DeathEvents\{
    DeathClear,
    DeathEffects,
    DeathKick,
    DeathMessage
};

# Kill Events

use HenryDM\CustomPVP\Events\KillEvents\{
    KillEXP,
    KillMoney,
    KillParticles,
    KillReward,
    KillSound
};

# Moderation Events

use HenryDM\CustomPVP\Events\ModerationEvents\{
    AntiFlight,
    AntiPvP,
    PingKick
};

class Main extends PluginBase implements Listener {

    /*** @var Main|null */
    private static Main|null $instance;

    const VERSION = "4.0.0";

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveResource("config.yml");
        $this->cfg = $this->getConfig(); 
        $this->initConfig();

        $events = [
            AttackCooldown::class,
            HealthRestore::class,
            KnockBack::class,
            LeechingMode::class,
            SoupPvP::class,
            DeathEffects::class,
            DeathClear::class,
            DeathKick::class,
            DeathMessage::class,
            KillEXP::class,
            KillMoney::class,
            KillParticles::class,
            KillReward::class,
            KillSound::class,
            AntiFlight::class,
            AntiPvP::class,
            PingKick::class
        ];
        foreach($events as $ev) {
            $this->getServer()->getPluginManager()->registerEvents(new $ev($this), $this);
        }
    }

    private function initConfig() : void {
        if (empty($this->cfg->getNested("config-version"))) return;
        if (($this->cfg->getNested("config-version")) < Main::VERSION) {
            $this->getLogger()->warning("Your configuration is outdate! Please consider update.");
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_outdate.yml");
        }
    }

    public function onLoad() : void {
        self::$instance = $this;
    }

    public function getInstance() : Main {
        return self::$instance;
    }

    public function getMainConfig() : Config {
        return new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }
}