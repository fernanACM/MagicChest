<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\entities;

use pocketmine\entity\Entity;
use pocketmine\entity\EntitySizeInfo;

use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;

use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\nbt\tag\CompoundTag;

use pocketmine\entity\Location;

class TextEntity extends Entity{

    /**
     * @param Location $location
     * @param CompoundTag|null $nbt
     */
    public function __construct(Location $location, ?CompoundTag $nbt){
        parent::__construct($location, $nbt);
    }

    /**
     * @return string
     */
    public static function getNetworkTypeId(): string{
        return EntityIds::PLAYER;
    }

    /**
     * @return EntitySizeInfo
     */
    public function getInitialSizeInfo(): EntitySizeInfo{
        return new EntitySizeInfo(0.0, 0.0);
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    public function initEntity(CompoundTag $nbt): void{
        parent::initEntity($nbt);

        $this->setScale(0.001);
        $this->setNoClientPredictions();

        $this->setNameTagVisible();
        $this->setNameTagAlwaysVisible();

        $this->getNetworkProperties()->setFloat(EntityMetadataProperties::BOUNDING_BOX_WIDTH, 0.0);
        $this->getNetworkProperties()->setFloat(EntityMetadataProperties::BOUNDING_BOX_HEIGHT, 0.0);
    }

    /**
     * @param EntityDamageEvent $source
     * @return void
     */
    public function attack(EntityDamageEvent $source): void{
        $source->cancel();
    }

    /**
     * @return float
     */
    public function getInitialGravity(): float{ return 0.0; }

    /**
     * @return float
     */
    public function getInitialDragMultiplier(): float{ return 0.0; }
}