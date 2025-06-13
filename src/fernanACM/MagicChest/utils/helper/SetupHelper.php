<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\utils\helper;

use pocketmine\player\Player;

use pocketmine\event\player\PlayerInteractEvent;

use pocketmine\event\block\BlockBreakEvent;

use pocketmine\entity\Location;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

use pocketmine\block\Block;
use pocketmine\block\tile\Chest;
use pocketmine\block\VanillaBlocks;

use pocketmine\nbt\tag\CompoundTag;

use fernanACM\MagicChest\MagicChest as MC;

use fernanACM\MagicChest\const\NBTConst;
use fernanACM\MagicChest\entities\TextEntity;
use fernanACM\MagicChest\utils\PluginUtils;

use fernanACM\MagicChest\language\LangKey;
use fernanACM\MagicChest\language\Language;

use fernanACM\MagicChest\tile\MagicTile;

final class SetupHelper{

    /** @var string[] $setup */
    protected static array $setup = [];

    /**
     * @param Player $player
     * @param Block $block
     * @param BlockBreakEvent
     * @return void
     */
    public static function addTile(Player $player, Block $block, BlockBreakEvent $event): void{
        if(!self::inSetupMode($player)){
            return;
        }

        $position = $block->getPosition();
        $world = $position->getWorld();
        $tile = $world->getTile($block->getPosition());
        if($tile instanceof MagicTile){
            return;
        }
        
        if(!$tile instanceof Chest){
            return;
        }

        $newTile = new MagicTile($world, $position);
        $tile->close();
        $world->addTile($newTile);
        $pos = [$position->x, $position->y, $position->z];
        // SPAWN ENTITY [TEXT ENTITY]
        $location = new Location(intval($pos[0])+0.5, intval($pos[1])+1, intval($pos[2])+0.5, $world, 0.0, 0.0);
        MC::getInstance()->getEntityManager()->create($location);
        Language::getPlayerMessage($player, LangKey::SUCCESS_MAGIC_CHEST_SET, [
            "{X}" => intval($position->x), "{Y}" => intval($position->y), "{Z}" => intval($position->z), "{WORLD}" => $world->getFolderName()], false);
        PluginUtils::PlaySound($player, "random.pop", 1, 3.4);
        self::exitSetupMode($player);
        $event->cancel();
    }

    /**
     * @param Player $player
     * @param Block $block
     * @param PlayerInteractEvent
     * @return void
     */
    public static function removeTile(Player $player, Block $block, PlayerInteractEvent $event): void{
        if(!$player->getInventory()->getItemInHand()->equals(self::removeWand())){
            return;
        }

        if($event->getAction() !== PlayerInteractEvent::RIGHT_CLICK_BLOCK){
            return;
        }

        $position = $block->getPosition();
        $world = $position->getWorld();

        $tile = $world->getTile($block->getPosition());
        if(!$tile instanceof MagicTile){
            return;
        }

        $tile->close();
        $world->removeTile($tile);
        # // DESPAWN ENTITY [TEXT ENTITY]
        $entity = $world->getNearestEntity($position, 1.5, TextEntity::class);
        if($entity instanceof TextEntity){
            $entity->flagForDespawn();
        }
        $event->cancel();
        $world->setBlock($position, VanillaBlocks::AIR());
    }

    /**
     * @return Item
     */
    public static function removeWand(): Item{
        $item = VanillaItems::BLAZE_ROD();
        $item->setNamedTag(CompoundTag::create()->setString(NBTConst::MAGIC_CHEST, NBTConst::REMOVE));
        $item->setCustomName(Language::getMessage(LangKey::ITEM_NAME));
        return $item;
    }

    /**
     * @param Player $player
     * @return boolean
     */
    public static function inSetupMode(Player $player): bool{
        return isset(self::$setup[$player->getXuid()]);
    }

    /**
     * @param Player $player
     * @param boolean $msg
     * @return void
     */
    public static function toggleSetupMode(Player $player, bool $msg = true): void{
        if(self::inSetupMode($player)){
            self::exitSetupMode($player, $msg);
        }else self::setSetupMode($player, $msg);
    }

    /**
     * @param Player $player
     * @param boolean $msg
     * @return void
     */
    public static function setSetupMode(Player $player, bool $msg = true): void{
        if(self::inSetupMode($player)) return;
        self::$setup[$player->getXuid()] = true;
        if($msg) Language::isSuccess($player, LangKey::SUCCESS_ENTER_SETUP_MODE);
    }

    /**
     * @param Player $player
     * @param boolean $msg
     * @return void
     */
    public static function exitSetupMode(Player $player, bool $msg = true): void{
        if(!self::inSetupMode($player)) return;
        unset(self::$setup[$player->getXuid()]);
        if($msg) Language::isSuccess($player, LangKey::SUCCESS_EXIT_SETUP_MODE);
    }

    /**
     * Get all Player Xuid
     * 
     * @return string[]
     */
    public static function getAllSetupMode(): array{
        return array_keys(self::$setup);
    }
}