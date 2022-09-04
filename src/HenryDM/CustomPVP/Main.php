<?php

namespace HenryDM\CustomPVP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

# Custom Events Libs
use HenryDM\CustomPVP\CustomEvents\AttackCooldown;
use HenryDM\CustomPVP\CustomEvents\HealthRestore;
use HenryDM\CustomPVP\CustomEvents\ItemDamage;
use HenryDM\CustomPVP\CustomEvents\ItemCooldown;
use HenryDM\CustomPVP\CustomEvents\KnockBack;
use HenryDM\CustomPVP\CustomEvents\LeechingMode;
use HenryDM\CustomPVP\CustomEvents\Message;
use HenryDM\CustomPVP\CustomEvents\SoupPvP;

# Kill Events Libs
use HenryDM\CustomPVP\KillEvents\DeathClear;
use HenryDM\CustomPVP\KillEvents\DeathEffects;
use HenryDM\CustomPVP\KillEvents\DeathKick;
use HenryDM\CustomPVP\KillEvents\KillEXP;
use HenryDM\CustomPVP\KillEvents\KillMoney;
use HenryDM\CustomPVP\KillEvents\KillParticles;
use HenryDM\CustomPVP\KillEvents\KillReward;
use HenryDM\CustomPVP\KillEvents\KillSound;

# Moderation Events Libs
use HenryDM\CustomPVP\ModerationEvents\AntiFlightPvp;
use HenryDM\CustomPVP\ModerationEvents\AntiPvPDrop;
use HenryDM\CustomPVP\ModerationEvents\AntiPvPWorld;
use HenryDM\CustomPVP\ModerationEvents\AntiSprint;
use HenryDM\CustomPVP\ModerationEvents\PingKick;

class Main extends PluginBase implements Listener {

    /*** @var Main */
    private static Main $instance;
    /* MultiLanguage support, coming soon..
    public const LANGUAGES = [];
    */

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig();
        $this->loadFolder();

        $events = [
            # ItemDamage::class,
            ItemCooldown::class,
            AntiFlightPvp::class,
            AntiPvPDrop::class,
            AntiPvPWorld::class,
            AntiSprint::class,
            AttackCooldown::class,
            DeathClear::class,
            DeathEffects::class,
            DeathKick::class,
            HealthRestore::class,
            KillEXP::class,
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
    
    public function loadFolder(){
        @mkdir($this->getDataFolder() . "´players");
        @mkdir($this->getDataFolder() . "´CustomEvents");
        @mkdir($this->getDataFolder() . "´KillEvents");
        @mkdir($this->getDataFolder() . "´ModerationEvents");
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
