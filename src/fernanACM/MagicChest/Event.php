<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest;

use pocketmine\event\Listener;

use pocketmine\event\block\BlockBreakEvent;

use pocketmine\event\player\PlayerInteractEvent;

use fernanACM\MagicChest\utils\helper\SetupHelper;

use fernanACM\MagicChest\tile\MagicTile;

class Event implements Listener{

    /**
     * @param PlayerInteractEvent $event
     * @return void
     */
    public function onInteract(PlayerInteractEvent $event): void{
        $block = $event->getBlock();
        $tile = $block->getPosition()->getWorld()->getTile($block->getPosition());

        if($tile instanceof MagicTile){
            SetupHelper::removeTile($event->getPlayer(), $block, $event);
        }
    }

    /**
     * @param BlockBreakEvent $event
     * @return void
     */
    public function onBreak(BlockBreakEvent $event): void{
        $block = $event->getBlock();
        $tile = $block->getPosition()->getWorld()->getTile($block->getPosition());

        if($tile instanceof MagicTile){
            $event->cancel();
        }
        SetupHelper::addTile($event->getPlayer(), $block, $event);
    }
}