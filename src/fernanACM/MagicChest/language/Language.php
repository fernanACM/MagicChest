<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\language;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat;

use fernanACM\MagicChest\MagicChest as MC;
use fernanACM\MagicChest\utils\PluginUtils;
use fernanACM\MagicChest\language\LanguageManager;

final class Language{

    /**
     * @param Player $player
     * @param string $key
     * @param array $replaces
     * @return string
     */
    public static function getPlayerMessage(Player $player, string $key, array $replaces = []): string{
        $messageArray = LanguageManager::getInstance()->getConfig()->getNested($key, []);
        if(!is_array($messageArray)){
            $messageArray = [$messageArray];
        }
        $message = implode("\n", $messageArray);
        foreach($replaces as $search => $replace){
            $message = str_replace($search, (string)$replace, $message);
        }
        return PluginUtils::codeUtil($player, $message);
    }

    /**
     * @param string $key
     * @param array $replaces
     * @return string
     */
    public static function getMessage(string $key, array $replaces = []): string{
        $messageArray = LanguageManager::getInstance()->getConfig()->getNested($key, []);
        if(!is_array($messageArray)){
            $messageArray = [$messageArray];
        }
        $message = implode("\n", $messageArray);
        foreach($replaces as $search => $replace){
            $message = str_replace($search, (string)$replace, $message);
        }
        return TextFormat::colorize($message);
    }

    /**
     * @param Player $player
     * @param string $key
     * @param array $replaces
     * @param boolean $sound
     * @return void
     */
    public static function isError(Player $player, string $key, array $replaces = [], bool $sound = true): void{
        $player->sendMessage(MC::getPrefix().self::getPlayerMessage($player, $key, $replaces));
        if($sound) PluginUtils::PlaySound($player, "mob.villager.no");
    }

    /**
     * @param Player $player
     * @param string $key
     * @param array $replaces
     * @param boolean $sound
     * @return void
     */
    public static function isSuccess(Player $player, string $key, array $replaces = [], bool $sound = true): void{
        $player->sendMessage(MC::getPrefix().self::getPlayerMessage($player, $key, $replaces));
        if($sound) PluginUtils::PlaySound($player, "mob.villager.yes");
    }
}