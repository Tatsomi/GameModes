<?php

declare(strict_types=1);

namespace Tatsomi\GameModes;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

    protected function onEnable(): void
    {
        $this->getLogger()->notice("Plugin is enable!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch($command->getName()){
            case "gms":
                if($sender instanceof Player){
                    $sender->setGamemode(GameMode::SURVIVAL);
                }
                return true;
            case "gmc":
                if($sender instanceof Player){
                    $sender->setGamemode(GameMode::CREATIVE);
                }
                return true;
            case "gmsp":
                if($sender instanceof Player){
                    $sender->setGamemode(GameMode::SPECTATOR);
                }
                return true;
            case "gma":
                if($sender instanceof Player){
                    $sender->setGamemode(GameMode::ADVENTURE);
                }
                return true;
        }
        return false;
    }
}
