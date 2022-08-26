<?php

namespace HenryDM\CustomPVP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use HenryDM\CustomPVP\Events\AntiFlightPvp;
use HenryDM\CustomPVP\Events\AttackCooldown;
use HenryDM\CustomPVP\Events\DeathKick;
use HenryDM\CustomPVP\Events\KnockBack;
use HenryDM\CustomPVP\Events\LeechingMode;
use HenryDM\CustomPVP\Events\HealthRestore;
use HenryDM\CustomPVP\Events\Message;
use HenryDM\CustomPVP\Events\Particles;
use HenryDM\CustomPVP\Events\SoupPvP;
use HenryDM\CustomPVP\Events\KillMoney;
use HenryDM\CustomPVP\Events\KillReward;
use HenryDM\CustomPVP\Events\KillSound;

use HenryDM\CustomPVP\task\PingTask;

class Main extends PluginBase implements Listener {

    /*** @var Main */
    private static Main $instance;

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig();

        $events = [
            AntiFlightPvp::class,
            AttackCooldown::class,
            // DeathEffects::class, Does not currently work
            KnockBack::class,
            DeathKick::class,
            LeechingMode::class,
            HealthRestore::class,
            Message::class,
            Particles::class,
            Particles::class,
            SoupPvP::class,
            KillMoney::class,
            KillReward::class,
            KillSound::class
        ];
        foreach($events as $e) {
            $this->getServer()->getPluginManager()->registerEvents(new $e($this), $this);
        }
        $this->getScheduler()->scheduleRepeatingTask(new PingTask($this), 20);
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
