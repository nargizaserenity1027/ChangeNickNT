<?php

namespace Name;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Name extends PluginBase implements Listener{
    public $prefix = ": ";
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        if ($command->getName() == "nick") {
            if(isset($args[0])){
                $sender->sendMessage("§lник өзгертілді");
                $sender->setDisplayName("{$args[0]}");
                $sender->setNameTag("{$args[0]}: ник өзгертілді");
               
            }
        }
        return true;   
    }
    public function onChat(PlayerChatEvent $event) {
        $player = $event->getPlayer();
        $msg = $event->getMessage();
        $nameTag = $player->getNameTag();
        $exploding = explode(":", $nameTag);
        $name = $exploding[0];
        $player->setNameTag("§l" . $name . $this->prefix . "§b" . "{$msg}");
        $event->setFormat("§l" . $name . $this->prefix . "§b" . "{$msg}");
    }
}