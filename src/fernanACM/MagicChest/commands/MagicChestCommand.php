<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\commands;

use pocketmine\player\Player;

use pocketmine\command\CommandSender;

use CortexPE\Commando\BaseCommand;

use fernanACM\MagicChest\MagicChest as MC;
use fernanACM\MagicChest\permissions\Perms;

use fernanACM\MagicChest\language\LangKey;
use fernanACM\MagicChest\language\Language;

use fernanACM\MagicChest\commands\subcommands\LootSubCommand;
use fernanACM\MagicChest\commands\subcommands\RefillSubCommand;
use fernanACM\MagicChest\commands\subcommands\SetupSubCommand;

use fernanACM\MagicChest\utils\PluginUtils;

class MagicChestCommand extends BaseCommand{

    public function __construct(){
        parent::__construct(MC::getInstance(), "magicchest", "MagicChest by fernanACM", ["mgc"]);
        $this->setPermission(Perms::MAIN_COMMAND);
    }

    /**
     * @return void
     */
    protected function prepare(): void{
        $commands = [new SetupSubCommand, new RefillSubCommand, new LootSubCommand];
        foreach($commands as $command){
            $this->registerSubCommand($command);
        }
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     * @return void
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
        if(!$sender instanceof Player){
            $sender->sendMessage("Use this command in-game");
            return;
        }
        if(!$sender->hasPermission(Perms::MAIN_COMMAND)){
            Language::isError($sender, LangKey::ERROR_NO_PERMISSION);
            return;
        }
        $sender->sendMessage("§l§b»MagicChest«");
        $sender->sendMessage("§7» /magicchest - Command list");
        $sender->sendMessage("§7» /magicchest setup - Setup manage");
        $sender->sendMessage("§7» /magicchest refill - Refill chest");
        $sender->sendMessage("§7» /magicchest loot - Edit loot\n");
        $sender->sendMessage("§l§cYOUTUBE:§r§e fernanACM");
        $sender->sendMessage("§l§9DISCORD:§r§e fernanacm");
        $sender->sendMessage("§l§7GITHUB:§r§e fernanACM");
        PluginUtils::PlaySound($sender, "random.pop2", 1, 1);
    }
}