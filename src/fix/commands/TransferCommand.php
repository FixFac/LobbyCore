<?php

namespace fix\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\network\mcpe\protocol\TransferPacket;
use pocketmine\plugin\PluginOwned;

use fix\Main;

class TransferCommand extends Command implements PluginOwned {

    public function __construct(private Main $plugin){
        parent::__construct("transfer", "Transfer to another server with the ip", "/transfer (server) ");
        $this->setPermission("transfer.command");
    }

    public function getOwningPlugin() : Main{
		return $this->plugin;
	}

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(count($args) < 2) {
            $sender->sendMessage("§cusage: /transfer (server) (port)");
            return false;
        }
        $address = array_shift($args);
        $port = array_shift($args);

        $player = $sender instanceof Player ? $sender : null;
        if(!$player instanceof Player) {
            $sender->sendMessage("§cOnly players can run this command.");
            return false;
        }

        $pk = new TransferPacket();
        $pk->address = $address;
        $pk->port = (int) $port;

        $player->getNetworkSession()->sendDataPacket($pk);

        return true;
    }
}