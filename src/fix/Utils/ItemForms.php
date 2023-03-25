<?php

namespace fix\Utils;

use fix\Main;

use Vecnavium\FormsUI\SimpleForm;
use Vecnavium\FormsUI\CustomForm;
use CortexPE\DiscordWebhookAPI\Embed;
use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\Server;

use pocketmine\event\player\PlayerChatEvent;

class ItemForms {

    public $plugin;
    private $players = [];

    public function __construct(){
        $this->plugin = Main::setInstance();
    }

    public function GamesForm($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player,
                    $this->getPlugin()->config->getNested("command-game1"));
                    Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
                    break;
                case 1:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player,
                    $this->getPlugin()->config->getNested("command-game2"));
                    Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
                    break;
                case 2:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, 
                    $this->getPlugin()->config->getNested("command-game3"));
                    Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
                    break;
                case 3:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, 
                    $this->getPlugin()->config->getNested("command-game4"));
                    Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
                    break;
                case 4:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, 
                    $this->getPlugin()->config->getNested("command-game5"));
                    Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
                    break;
                case 5:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, 
                    $this->getPlugin()->config->getNested("command-game6"));
                    Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
                    break;
                case 6:
                    Main::useSounds()->addSound($player, "note.bell", 1, 1);
                    break;
            }
        });
        $form->setTitle($this->getPlugin()->config->getNested("title-games"));
        $form->setContent($this->getPlugin()->config->getNested("content-games"));
        $form->addButton($this->getPlugin()->config->getNested("button1-games"));
        $form->addButton($this->getPlugin()->config->getNested("button2-games"));
        $form->addButton($this->getPlugin()->config->getNested("button3-games"));
        $form->addButton($this->getPlugin()->config->getNested("button4-games"));
        $form->addButton($this->getPlugin()->config->getNested("button5-games"));
        $form->addButton($this->getPlugin()->config->getNested("button6-games"));
        $form->addButton("Close");
        $form->sendToPlayer($player);
    }

    public function CosmeticosForm($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
			switch($data){
                case 0:
                $this->FlyForm($player);
                Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
                break;
				case 1:
  				$this->SizeForm($player);
  				Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
				break;
				case 2:
  				$this->ColorChatForm($player);
  				Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
                break;
                case 3:
                $this->ncolorsForm($player);
                Main::useSounds()->addSound($player, "bubble.pop", 1, 1);
				break;
                case 4:
                Main::useSounds()->addSound($player, "note.bell", 1, 1);
                break;
			}

		});	
		$form->setTitle($this->getPlugin()->config->getNested("title-cosmeticos"));
        $form->setContent($this->getPlugin()->config->getNested("content-cosmeticos"));
        $form->addButton($this->getPlugin()->config->getNested("button1-cosmeticos"));
        $form->addButton($this->getPlugin()->config->getNested("button2-cosmeticos"));
        $form->addButton($this->getPlugin()->config->getNested("button3-cosmeticos"));
        $form->addButton($this->getPlugin()->config->getNested("button4-cosmeticos"));
        $form->addButton("Close");
        $form->sendToPlayer($player);
	}

    public function FlyForm($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
			switch($data){
                case 0:
                $player->setFlying(true);
                $player->setAllowFlight(true);
                $player->sendMessage("§7You have activated the power to fly");
                Main::useSounds()->addSound($player, "random.drink", 1, 1);
                break;
				case 1:
                $player->setFlying(false);
                $player->setAllowFlight(false);
                $player->sendMessage("§7You have disabled being able to fly");
                Main::useSounds()->addSound($player, "random.drink", 1, 1);
				break;
				case 2:
  				Main::useSounds()->addSound($player, "note.bell", 1, 1);
				break;
			}
		});	
		$form->setTitle("Fly LobbyCore");
        $form->setContent("§7Do you want to activate or deactivate the flight");
        $form->addButton("§aFly On");
        $form->addButton("§cFly Off");
        $form->addButton("Close");
        $form->sendToPlayer($player);
	}

    public function SizeForm($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
			switch($data){
                case 0:
                $player->sendTitle("§aReset");
                $player->setScale("1.0");
                Main::useSounds()->addSound($player, "mob.slime.jump", 1, 1);
                break;
                case 1:
                $player->sendTitle("§9Little");
                $player->setScale("0.4");
                Main::useSounds()->addSound($player, "mob.slime.jump", 1, 1);
                break;
                case 2:
                $player->setScale("0.7");
                $player->sendTitle("§9Medium");
                Main::useSounds()->addSound($player, "mob.slime.jump", 1, 1);
                break;
                case 3:
                $player->setScale("1.7");
                $player->sendTitle("§9high");
                Main::useSounds()->addSound($player, "mob.slime.jump", 1, 1);
                break;
                case 4:
                $player->setScale("2.8");
                $player->sendTitle("§9Enormous");
                Main::useSounds()->addSound($player, "mob.slime.jump", 1, 1);
                break;
                case 5:
                $player->setScale("3.2");
                $player->sendTitle("§9Giant");
                Main::useSounds()->addSound($player, "mob.slime.jump", 1, 1);
                break;
                case 6:
                Main::useSounds()->addSound($player, "note.bell", 1, 1);
                break;
			}
		});	
		$form->setTitle("Size LobbyCore");
        $form->setContent("§7Do you want to activate or deactivate the flight");
        $form->addButton("§aReset");
        $form->addButton("§9Little");
        $form->addButton("§9Medium");
        $form->addButton("§9high");
        $form->addButton("§9Enormous");
        $form->addButton("§9Giant");
        $form->addButton("Close");
        $form->sendToPlayer($player);
	}

    public function ColorChatForm($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
			switch($data){
                case 0:
                if(in_array ($player->getName(), $this->getPlugin()->chatcolor))
                    {
                    $this->getPlugin()->chatcolor[] = $player->getName();
                    $player->sendMessage("§1C§2o§3l§4o§5r§6c§7h§8a§9t§a ON");
                    Main::useSounds()->addSound($player, "mob.village.haggle", 1, 1);
                }else{
                    $this->getPlugin()->chatcolor[] = $player->getName();
                    $player->sendMessage("§1C§2o§3l§4o§5r§6c§7h§8a§9t§a ON");
                    Main::useSounds()->addSound($player, "mob.village.haggle", 1, 1);
                }
                break;
                case 1:
                $player->sendMessage("§1C§2o§3l§4o§5r§6c§7h§8a§9t§c OFF");
                Main::useSounds()->addSound($player, "mob.village.haggle", 1, 1);
                if(in_array ($player->getName(), $this->getPlugin()->chatcolor)) {
                    unset($this->getPlugin()->chatcolor[array_search($player->getName(), $this->getPlugin()->chatcolor)]);
                }
                break;
            }
        });
        $form->setTitle("§1C§2o§3l§4o§5r§6C§7h§8a§9t");
        $form->setContent("§7Enable or disable colorchat");
        $form->addButton("§l§1C§2o§3l§4o§5r§6C§7h§8a§9t §aON");
        $form->addButton("§l§1C§2o§3l§4o§5r§6C§7h§8a§9t §cOFF");
        $form->addButton("Close");
        $form->sendToPlayer($player);
	}
    //Plugin NCorlos
    public function ncolorsForm($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                $player->setDisplayName("§f" . $player->getName() . "§r");
                $player->setNameTag("§f" . $player->getName() . "§r");
                $player->sendMessage("§7Your nick is  §fWhite!");
                Main::useSounds()->addSound($player, "random.toast", 1, 1);
                break;
                case 1:
                $player->setDisplayName("§c" . $player->getName() . "§r");
                $player->setNameTag("§c" . $player->getName() . "§r");
                $player->sendMessage("§7Your nick is §cRed!");
                Main::useSounds()->addSound($player, "random.toast", 1, 1);
                break;
                case 2:
                $player->setDisplayName("§b" . $player->getName() . "§r");
                $player->setNameTag("§b" . $player->getName() . "§r");
                $player->sendMessage("§7Your nick is §bBlue!");
                Main::useSounds()->addSound($player, "random.toast", 1, 1);
                break;
                case 3:
                $player->setDisplayName("§e" . $player->getName() . "§r");
                $player->setNameTag("§e" . $player->getName() . "§r");
                $player->sendMessage("§7Your nick is §eYellow!");
                Main::useSounds()->addSound($player, "random.toast", 1, 1);
                break;
                case 4:
                $player->setDisplayName("§6" . $player->getName() . "§r");
                $player->setNameTag("§6" . $player->getName() . "§r");
                $player->sendMessage("§7Your nick is §6Orange!");
                Main::useSounds()->addSound($player, "random.toast", 1, 1);
                break;                    
                case 5:
                $player->setDisplayName("§d" . $player->getName() . "§r");
                $player->setNameTag("§d" . $player->getName() . "§r");
                $player->sendMessage("§7Your nick is §dPink!");
                Main::useSounds()->addSound($player, "random.toast", 1, 1);
                break;
                case 6:
                Main::useSounds()->addSound($player, "random.toast", 1, 1);
                break;
            }
        });
        $form->setTitle("Ncolors LobbyCore");
        $form->setContent("§7Select the type of color you want for your nick");
        $form->addButton("§fWhite");
        $form->addButton("§cRed");
        $form->addButton("§bBlue");
        $form->addButton("§eYellow");
        $form->addButton("§6Orange");
        $form->addButton("§dPink");
        $form->addButton("Close");
        $form->sendToPlayer($player);
    }

    public function InfoForm($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                $player->sendMessage($this->getPlugin()->config->getNested("info-form-msg"));
                Main::useSounds()->addSound($player, "mob.village.idle", 1, 1);
                break;
                case 1:
                Main::useSounds()->addSound($player, "mob.village.idle", 1, 1);
                break;
            }
        });
        $form->setTitle($this->getPlugin()->config->getNested("info-form-title"));
        $form->setContent($this->getPlugin()->config->getNested("info-form-content"));
        $form->addButton("Close");
        $form->sendToPlayer($player);
        return $form;
    }

    public function ReportForm($player){
        $playerlist = [];
        foreach($this->getPlugin()->getServer()->getOnlinePlayers() as $psf) {
            $playerlist[] = $psf->getName();
        }
        $this->players[$player->getname()] = $playerlist;
        $form = new CustomForm(function (Player $player, array $info = null){
            #
            if($info === null) {
              $player->sendMessage($this->getPlugin()->config->getNested("rpt-report-deny"));
                return true;
            }
            ##WEBHOOK Link#
            $fixweb = new Webhook($this->getPlugin()->config->getNested("rpt-webhook-link"));
            $menssageview = new Message();
            $menssageview->setUsername($this->getPlugin()->config->getNested("rpt-name-Webhook"));
            $menssageview->setAvatarURL($this->getPlugin()->config->getNested("rpt-avatar-webhook"));
            $hola = new Embed();
            $bro = $info[1];
            $hola->setTitle("Report");
            $hola->addField("accused: ", $this->players[$player->getName()][$bro]);
            $hola->addField("witness: ", $player->getName());
            $hola->addField("reason: ", $info[2]);
            $menssageview->addEmbed($hola);
            $fixweb->send($menssageview); 
            $player->sendMessage($this->getPlugin()->config->getNested("rpt-report-accept"));
            foreach($this->getPlugin()->getServer()->getOnlinePlayers() as $player){
            if($player->hasPermission("report.view")){
		    $testigo = $player->getName();
            $player->sendMessage("§8---------------------");
			$player->sendMessage("§7 accused: §c" . $this->players[$player->getName()][$bro]);
			$player->sendMessage("§7 reason: §f" .  $info[2]);
            $player->sendMessage("§7 witness: §b" . $testigo);
            $player->sendMessage("§8---------------------");
            Main::useSounds()->addSound($player, "firework.large_blast", 1, 1);
				
			}}
        });
        $form->setTitle($this->getPlugin()->config->getNested("rpt-title-form"));
        $form->addLabel($this->getPlugin()->config->getNested("rpt-info-form"));
        $form->addDropdown("Players: ", $this->players[$player->getName()]);
        $form->addInput("type:", "Reason", "Hacks? Fly?");
        $form->sendToPlayer($player);
        return $form;
       }

    public function getPlugin() : Main {
        return $this->plugin;
    }


}