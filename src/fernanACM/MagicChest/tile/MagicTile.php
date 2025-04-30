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

    /** @var string|null $customName */
    protected ?string $customName = null;

    /** @var int|null $open */
    protected ?int $open = null;

    /**
     * @param World $wolrd
     * @param Vector3 $vector
     */
    public function __construct(World $wolrd, Vector3 $vector){
        parent::__construct($wolrd, $vector);
        if(is_null($this->customName)){
            $this->customName = Language::getMessage(LangKey::MAGIC_CHEST_NAME);
        }
        /*if(is_null($this->open)){
            $this->open = DataConst::UNOPENED_CHEST;
        }*/
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    public function addAdditionalSpawnData(CompoundTag $nbt): void{
        parent::addAdditionalSpawnData($nbt);
        $nbt->setString(self::TAG_ID, NBTConst::MAGIC_CHEST);
        //$nbt->setInt(NBTConst::IS_OPEN, DataConst::UNOPENED_CHEST);
        if(!is_null($this->customName)){
            $nbt->setString(self::TAG_CUSTOM_NAME, $this->customName);
        }
        /*if(!is_null($this->open)){
            $nbt->setInt(NBTConst::IS_OPEN, $this->open);
        }*/
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    public function readSaveData(CompoundTag $nbt): void{
        parent::readSaveData($nbt);
        $this->customName = $nbt->getString(self::TAG_CUSTOM_NAME);
        //$this->open = $nbt->getInt(NBTConst::IS_OPEN);
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    protected function writeSaveData(CompoundTag $nbt): void{
        parent::writeSaveData($nbt);
        $nbt->setString(NBTConst::MAGIC_CHEST, NBTConst::MAGIC_CHEST);
    }

    /**
     * @return string
     */
    public function getCustomName(): string{
        return $this->customName ?? "MagicChest";
    }
}