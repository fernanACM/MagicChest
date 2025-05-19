<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\tile;

use fernanACM\MagicChest\const\DataConst;
use pocketmine\block\tile\Chest;

use pocketmine\world\World;

use pocketmine\math\Vector3;

use pocketmine\nbt\tag\CompoundTag;

use fernanACM\MagicChest\const\NBTConst;

use fernanACM\MagicChest\language\LangKey;
use fernanACM\MagicChest\language\Language;

class MagicTile extends Chest{

    /**
     * @param World $wolrd
     * @param Vector3 $vector
     */
    public function __construct(World $wolrd, Vector3 $vector){
        parent::__construct($wolrd, $vector);
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    public function addAdditionalSpawnData(CompoundTag $nbt): void{
        parent::addAdditionalSpawnData($nbt);
        $nbt->setString(self::TAG_ID, NBTConst::MAGIC_CHEST);
        $nbt->setString(self::TAG_CUSTOM_NAME, Language::getMessage(LangKey::MAGIC_CHEST_NAME));
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    public function readSaveData(CompoundTag $nbt): void{
        parent::readSaveData($nbt);
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    protected function writeSaveData(CompoundTag $nbt): void{
        parent::writeSaveData($nbt);
        $nbt->setString(NBTConst::MAGIC_CHEST, NBTConst::MAGIC_CHEST);
    }
}