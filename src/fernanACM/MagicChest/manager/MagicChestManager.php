<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\manager;

use pocketmine\Server;

use pocketmine\utils\SingletonTrait;

use fernanACM\MagicChest\MagicChest as MC;

use fernanACM\MagicChest\tile\MagicTile;

use fernanACM\MagicChest\language\LangKey;
use fernanACM\MagicChest\language\Language;

final class MagicChestManager{
    use SingletonTrait{
        setInstance as protected;
        reset as protected;
    }

    public function __construct(){
        self::setInstance($this);
    }

    /**
     * @return void
     */
    public function refill(bool $refillMsg = true): void{
        $checkMsg = false;
        foreach(Server::getInstance()->getWorldManager()->getWorlds() as $world){
            foreach($world->getLoadedChunks() as $ckunks){
                foreach($ckunks->getTiles() as $tile){
                    if(!$tile instanceof MagicTile){
                        continue;
                    }
                    $min = intval(MC::getInstance()->config->getNested("Settings.MagicChest.Loot.min"));
                    $max = intval(MC::getInstance()->config->getNested("Settings.MagicChest.Loot.max"));
                    $tile->getInventory()->setContents([]);
                    foreach(MC::getInstance()->getLootManager()->getRandomItems(rand($min, $max)) as $item){
                        $tile->getInventory()->setItem(rand(0, 27), $item);
                    }
                    if(!$checkMsg){
                        if($refillMsg) $this->broadcaster();
                    }
                    $checkMsg = true;
                }
            }
        }
    }

    /**
     * @return void
     */
    public function broadcaster(): void{
        Server::getInstance()->broadcastMessage(MC::getPrefix(). Language::getMessage(LangKey::SUCCESS_REFILL));
    }

    /**
     * @param integer $time
     * @return void
     */
    public function checkTime(int $time): void{
        if(in_array($time, $this->getTimes())){
            $timer = $this->convertSecondsToTime($time);
            Server::getInstance()->broadcastMessage(MC::getPrefix(). Language::getMessage(LangKey::SUCCESS_CHECK_TIME), ["{TIME}" => $timer]);
        }
    }

    /**
     * @param integer $seconds
     * @return string
     */
    protected function convertSecondsToTime(int $seconds): string{
        $months = intdiv($seconds, 2592000);
        if($months > 0){
            return $months . " " . Language::getMessage(LangKey::CHECK_TIME_MONTHS);
        }
    
        $days = intdiv($seconds, 86400);
        if($days > 0){
            return $days . " " . Language::getMessage(LangKey::CHECK_TIME_DAYS);
        }
    
        $hours = intdiv($seconds, 3600);
        if($hours > 0){
            return $hours . " " . Language::getMessage(LangKey::CHECK_TIME_HOURS);
        }
    
        $minutes = intdiv($seconds, 60);
        if($minutes > 0){
            return $minutes . " " . Language::getMessage(LangKey::CHECK_TIME_MINUTES);
        }
        return $seconds . " " . Language::getMessage(LangKey::CHECK_TIME_SECONDS);
    }    

    /**
     * @return int[]
     */
    protected function getTimes(): array{
        return array_map("intval", MC::getInstance()->config->getNested("Settings.MagicChest.Broadcast.times", []));
    }
}