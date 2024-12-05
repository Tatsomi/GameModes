<?php

declare(strict_types=1);

namespace Tatsomi\GameModes;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase
{
    public Config $config;

    protected function onEnable(): void
    {
        $this->getLogger()->notice("Enabled");

        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if ($command->getName() == "gms") {
            if ($sender instanceof Player) {
                $sender->setGamemode(GameMode::SURVIVAL);
                $sender->sendMessage($this->getConfig()->get("gms.success"));
            }
        }
        if ($command->getName() == "gmc") {
            if ($sender instanceof Player) {
                $sender->setGamemode(GameMode::CREATIVE);
                $sender->sendMessage($this->getConfig()->get("gmc.success"));
            }
        }
        if ($command->getName() == "gmsp") {
            if ($sender instanceof Player) {
                $sender->setGamemode(GameMode::SPECTATOR);
                $sender->sendMessage($this->getConfig()->get("gmsp.success"));
            }
        }
        if ($command->getName() == "gma") {
            if ($sender instanceof Player) {
                $sender->setGamemode(GameMode::ADVENTURE);
                $sender->sendMessage($this->getConfig()->get("gma.success"));
            }
        }
        if ($command->getName() == "gmui") {
            if ($sender instanceof Player) {
                $this->gmUI($sender);
            }
        }
        return false;
    }

    public function gmUI(Player $player): void
    {
        $form = new SimpleForm(function (Player $player, ?int $data) {
            if ($data !== null) {
                if ($data == 0) {
                    $player->setGamemode(GameMode::SURVIVAL());
                    $player->sendMessage($this->config->get("gms.success"));
                } elseif ($data == 1) {
                    $player->setGamemode(GameMode::CREATIVE());
                    $player->sendMessage($this->config->get("gmc.success"));
                } elseif ($data == 2) {
                    $player->setGamemode(GameMode::SPECTATOR());
                    $player->sendMessage($this->config->get("gmsp.success"));
                } elseif ($data == 3) {
                    $player->setGamemode(GameMode::ADVENTURE());
                    $player->sendMessage($this->config->get("gma.success"));
                }
            }
        });

        $form->setTitle($this->config->get("title"));
        $form->setContent($this->config->get("content"));
        $form->addButton($this->config->get("button0"));
        $form->addButton($this->config->get("button1"));
        $form->addButton($this->config->get("button2"));
        $form->addButton($this->config->get("button3"));

        $form->sendToPlayer($player);

    }
}
