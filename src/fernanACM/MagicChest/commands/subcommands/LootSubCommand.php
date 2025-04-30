<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\commands\subcommands;

use pocketmine\player\Player;

use pocketmine\command\CommandSender;

use CortexPE\Commando\BaseSubCommand;

use fernanACM\MagicChest\MagicChest as MC;
use fernanACM\MagicChest\permissions\Perms;

use fernanACM\MagicChest\language\LangKey;
use fernanACM\MagicChest\language\Language;

use fernanACM\MagicChest\utils\PluginUtils;

class LootSubCommand extends BaseSubCommand{

    public function __construct(){
        parent::__construct("loot", "", []);
        $this->setPermission(Perms::LOOT_SUBCOMMAND);
    }

    /**
     * @return void
     */
    protected function prepare(): void{
        
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
        if(!$sender->hasPermission(Perms::LOOT_SUBCOMMAND)){
            Language::isError($sender, LangKey::ERROR_NO_PERMISSION);
            return;
        }
        MC::getInstance()->getLootManager()->edit($sender);
        PluginUtils::PlaySound($sender, "random.pop", 1, 1);
    }
}