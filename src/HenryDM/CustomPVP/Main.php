<?php

namespace HenryDM\CustomPVP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\utils\Config;

use HenryDM\CustomPVP\Events\SoupPvP;

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

    /*** @var Main|null */
    private static Main|null $instance;

    const VERSION = "3.2.0";

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveResource("config.yml");
        $this->cfg = $this->getConfig(); 
        $this->initConfig();

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
        return $this->cfg;
    }
}