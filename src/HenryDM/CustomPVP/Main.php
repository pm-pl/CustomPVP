<?php

namespace HenryDM\CustomPVP;

# =======================
#    Pocketmine Class
# =======================

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

# =======================
#      Custom Events
# =======================

use HenryDM\CustomPVP\Events\CustomEvents\AttackCooldown;
use HenryDM\CustomPVP\Events\CustomEvents\HealthRestore;
use HenryDM\CustomPVP\Events\CustomEvents\KnockBack;
use HenryDM\CustomPVP\Events\CustomEvents\LeechingMode;
use HenryDM\CustomPVP\Events\CustomEvents\SoupPvP;

# =======================
#      Death Events
# =======================

use HenryDM\CustomPVP\Events\DeathEvents\DeathClear;
use HenryDM\CustomPVP\Events\DeathEvents\DeathEffects;
use HenryDM\CustomPVP\Events\DeathEvents\DeathKick;
use HenryDM\CustomPVP\Events\DeathEvents\DeathMessage;

# =======================
#      Kill Events
# =======================

use HenryDM\CustomPVP\Events\KillEvents\KillEXP;
use HenryDM\CustomPVP\Events\KillEvents\KillMoney;
use HenryDM\CustomPVP\Events\KillEvents\KillParticles;
use HenryDM\CustomPVP\Events\KillEvents\KillReward;
use HenryDM\CustomPVP\Events\KillEvents\KillSound;

# =======================
#    Moderation Events
# =======================

use HenryDM\CustomPVP\Events\ModerationEvents\AntiFlight;
use HenryDM\CustomPVP\Events\ModerationEvents\AntiPvP;
use HenryDM\CustomPVP\Events\ModerationEvents\PingKick;

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
        return $this->cfg;
    }
}