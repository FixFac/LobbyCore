<?php

namespace fix\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use fix\Main;

class MeCommand extends Command implements PluginOwned {

    public function __construct(private Main $plugin){
        parent::__construct("me", "Send Featured Global Message", "/me (text) ");
        $this->setPermission("me.command");
    }

    public function getOwningPlugin() : Main{
		return $this->plugin;
	}

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender->hasPermission("me.command")){
            $sender->sendMessage("§cInsufficient permissions to execute this action");
            return false;
        }

            $msg = "§8[§c" . $sender->getName() . "§8]§r " . " ";
            foreach($args as $arg){
                $msg .= $arg . " ";
            }
            $this->plugin->getServer()->broadcastMessage($msg);
            return true;
    }
}