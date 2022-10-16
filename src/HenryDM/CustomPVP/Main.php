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
    DeathKick,
    DeathMessage
};

# Kill Events

use HenryDM\CustomPVP\Events\KillEvents\{
    KillEXP,
    KillMoney,
    KillSound
};

# Moderation Events

use HenryDM\CustomPVP\Events\ModerationEvents\{
    AntiFlight,
    AntiPvP
};

class Main extends PluginBase implements Listener {

    /*** @var Main|null */
    private static Main|null $instance;

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveResource("config.yml");
        $this->cfg = $this->getConfig();

        $events = [
            AttackCooldown::class,
            HealthRestore::class,
            KnockBack::class,
            LeechingMode::class,
            SoupPvP::class,
            DeathClear::class,
            DeathKick::class,
            DeathMessage::class,
            KillEXP::class,
            KillMoney::class,
            KillParticles::class,
            KillSound::class,
            AntiFlight::class,
            AntiPvP::class,
            PingKick::class
        ];
        foreach($events as $ev) {
            $this->getServer()->getPluginManager()->registerEvents(new $ev($this), $this);
        }
    }

    public function onLoad() : void {
        self::$instance = $this;
    }

    public function getInstance() : Main {
        return self::$instance;
    }
}