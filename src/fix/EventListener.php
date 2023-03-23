<?php

namespace fix;

use fix\Main;

use pocketmine\event\Listener;

use pocketmine\player\Player;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerChatEvent;

class EventListener implements Listener {

    public Main $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $event) : void {
        $player = $event->getPlayer();
        $event->setJoinMessage("");
        $this->plugin->getServer()->broadcastMessage("§8(§a+§8)§e " . $player->getName() . "§7 Joined the server.");
        $this->plugin->prot[] = $player->getName();
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
        $player->getEffects()->clear();
        $player->extinguish();
        $player->setFlying(false);
        $player->setAllowFlight(false);
        Main::useKitManager()->gKitLobby($player);
    }

    public function onQuit(PlayerQuitEvent $event) : void {
        $player = $event->getPlayer();
        $event->setQuitMessage("");
        $this->plugin->getServer()->broadcastMessage("§8(§c-§8)§e " . $player->getName() . "§7 I left the server.");
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
        $player->getEffects()->clear();
        $player->extinguish();
        $player->setFlying(false);
        $player->setAllowFlight(false);

    }

    public function onDrop(PlayerDropItemEvent $event) : void {
        $player = $event->getPlayer();
        if (in_array ($player->getName(), $this->plugin->prot)) {
            $event->cancel();
        }
        return;
    }

    public function onBreak(BlockBreakEvent $event) : void {
        $player = $event->getPlayer();
        if (in_array ($player->getName(), $this->plugin->prot)) {
            $event->cancel();
        }
        return;
    }

    public function onPlace(BlockPlaceEvent $event) : void {
        $player = $event->getPlayer();
        if (in_array ($player->getName(), $this->plugin->prot)) {
            $event->cancel();
        }
        return;
    }

    public function ColoChatEvent(PlayerChatEvent $event): void {
        $player = $event->getPlayer();
        $msg = $event->getMessage();

        $vip = "";
        $fix = mb_strlen($msg) - 1;
        $colores = ["§1", "§2", "§3", "§4", "§5", "§6", "§7", "§8", "§9", "§a", "§b", "§c", "§d", "§e", "§f", "§g"];

        $fac = 0;
        $type = 0;
        while ($fac <= $fix)
         {
            $vip .= $colores[$type] . $msg[$fac];
            $fac++;
            $type++;
            if ($type == count($colores)) {
                $type = 0;
            }
        }
        if (in_array ($player->getName(), $this->plugin->chatcolor)) {
            $event->setMessage(str_replace($msg, "$vip", $msg));
        }    
    }

    public function onUse(PlayerItemUseEvent $event) : void {
        $player = $event->getPlayer();
        $usage = $event->getItem()->getCustomName();
        if($usage === "§eGames"){
            if(!$player->hasPermission("games.item")){
                $player->sendMessage("§cInsufficient permissions to execute this action");
                $event->cancel();
                return;
            }
            Main::useItemForms()->GamesForm($player);
            $event->cancel();
        }
        if($usage === "§5Cosmeticos"){
            if(!$player->hasPermission("cosmeticos.item")){
                $player->sendMessage("§cInsufficient permissions to execute this action");
                $event->cancel();
                return;
            }
            Main::useItemForms()->CosmeticosForm($player);
            $event->cancel();
        }

        if($usage === "§2Info"){
            if(!$player->hasPermission("info.item")){
                $player->sendMessage("§cInsufficient permissions to execute this action");
                $event->cancel();
                return;
            }
            Main::useItemForms()->InfoForm($player);
            $event->cancel();
        }

        if($usage === "§cReport"){
            if(!$player->hasPermission("report.item")){
                $player->sendMessage("§cInsufficient permissions to execute this action");
                $event->cancel();
                return;
            }
            Main::useItemForms()->ReportForm($player);
            $event->cancel();
        }
    }

}