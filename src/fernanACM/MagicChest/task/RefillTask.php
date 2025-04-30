<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\task;

use pocketmine\scheduler\Task;

use fernanACM\MagicChest\MagicChest as MC;

class RefillTask extends Task{

    /** @var int $time */
    protected int $time = 0; 

    /**
     * @param integer $time
     */
    public function __construct(int $time){
        $this->setTime($time);
    }

    /**
     * @return void
     */
    public function onRun(): void{
        MC::getInstance()->getMagicChestManager()->checkTime($this->time);
        $this->time--;
        if($this->getTime() === 0){
            MC::getInstance()->getMagicChestManager()->refill();
            $this->setTime(intval(MC::getInstance()->config->getNested("Settings.MagicChest.refill-interval")));
        }
    }

    /**
     * @return integer
     */
    protected function getTime(): int{
        return $this->time;
    }

    /**
     * @param integer $time
     * @return void
     */
    protected function setTime(int $time): void{
        $this->time = $time;
    }
}