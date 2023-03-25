<?php

namespace fix\Utils;

use pocketmine\player\Player;

use pocketmine\item\ItemFactory;

class KitManager {

    public function __construct() {}

    public function gKitLobby(Player $player) {
        $games = ItemFactory::getInstance()->get(345, 0, 1);
        $games->setCustomName(("§eGames§1"));

        $cosmeticos = ItemFactory::getInstance()->get(378, 0, 1);
        $cosmeticos->setCustomName(("§5Cosmeticos§1"));

        $rpt = ItemFactory::getInstance()->get(339, 0, 1);
        $rpt->setCustomName(("§cReport§1"));

        $info = ItemFactory::getInstance()->get(340, 0, 1);
        $info->setCustomName(("§2Info§1"));

        $player->getInventory()->setItem(0, $games);
        $player->getInventory()->setItem(4, $cosmeticos);
        $player->getInventory()->setItem(7, $rpt);
        $player->getInventory()->setItem(8, $info);
    }
}