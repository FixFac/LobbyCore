<?php

namespace fix\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use fix\Main;

class SayCommand extends Command implements PluginOwned {

    public function __construct(private Main $plugin){
        parent::__construct("say", "Send Featured Global Message", "/say (text) ");
        $this->setPermission("say.command");
    }

    public function getOwningPlugin() : Main{
		return $this->plugin;
	}

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender->hasPermission("say.command")){
            $sender->sendMessage("§cInsufficient permissions to execute this action");
            return false;
        }

            $msg = "§8[§d" . $sender->getName() . "§8]§r " . " ";
            foreach($args as $arg){
                $msg .= $arg . " ";
            }
            $this->plugin->getServer()->broadcastMessage($msg);
            return true;
    }
}