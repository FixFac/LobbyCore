<?php

namespace fix;

use fix\Utils\KitManager;
use fix\Utils\ItemForms;
use fix\Utils\Sounds;
use fix\EventListener;

use fix\commands\{MeCommand, SayCommand, TransferCommand};

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Server;

class Main extends PluginBase
{
    public $chatcolor = [];

    public Config $config;

    private static $instance;

    public static function setInstance() : Main {
        return self::$instance;
    }

    public function onLoad() : void {
        self::$instance = $this;
    }


    public function onEnable(): void
    {
        $this->getLogger()->info("plugin created by FixFac ");
        
        $commandMap = $this->getServer()->getCommandMap();
        $commandMap->unregister($commandMap->getCommand("me"));
        $commandMap->unregister($commandMap->getCommand("say"));
        
        $this->loadEvents();
        $this->loadCommands();
        $this->loadFiles();
    }

    public function loadEvents() : void {
        $events = [
            EventListener::class
        ];

        foreach($events as $ev) {
            $this->getServer()->getPluginManager()->registerEvents(new $ev($this), $this);
        }
    }

    private function loadCommands(): void {
        $cmd = [
            new MeCommand($this),
            new SayCommand($this),
            new TransferCommand($this)
        ];
        $this->getServer()->getCommandMap()->registerAll("fixfac", $cmd);
    }

    public function loadFiles() : void {
        $this->saveResource("config.yml");
        
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public static function useSounds() : Sounds {
        return new Sounds();
    }

    public static function useKitManager() : KitManager {
        return new KitManager();
    }

    public static function useItemForms() : ItemForms {
        return new ItemForms();
    }
}