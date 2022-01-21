<?php

declare(strict_types=1);

namespace tal\antiloginforger;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\plugin\PluginBase;

class AntiLoginForger extends PluginBase implements Listener
{

    /** @var string[] $allowedAddresses **/
    public array $allowedAddresses = [];

    public function onEnable() : void
    {
        $this->allowedAddresses = $this->getConfig()->get("allowed_addresses");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDataPacketReceive(DataPacketReceiveEvent $event) : void
    {
        $packet = $event->getPacket();
        $player = $event->getPlayer();
        if ($packet instanceof LoginPacket) {
            if (!in_array($packet->clientData["ServerAddress"], $this->allowedAddresses, true)) {
                $player->kick("Unexpected server address (possible impersonation attempt)", false);
            }
        }
    }

}
