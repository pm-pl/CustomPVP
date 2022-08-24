<?php

namespace HenryDM\CustomPVP\Events;

use HenryDM\CustomPVP\Main;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class LeechingMode implements Listener
{

    public function __construct(private Main $main)
    {

    }

    public function onDamage(EntityDamageByEntityEvent $event): void
    {
        if ($this->getMain()->cfg->get("leeching-mode") === true) {
            $entity = $event->getEntity();
            if ($entity instanceof Player) {
                if (in_array($entity->getWorld()->getFolderName(), $this->getMain()->cfg->get("leeching-worlds"))) {
                    $entity->setHealth($entity->getHealth() + $this->getMain()->cfg->get("leeching-level"));
                }
            }
        }
    }

    public function getMain(): Main
    {
        return $this->main;
    }
}