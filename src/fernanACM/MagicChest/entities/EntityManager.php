<?php

declare(strict_types=1);

namespace fernanACM\MagicChest\entities;

use pocketmine\Server;

use pocketmine\utils\SingletonTrait;

use pocketmine\math\Vector3;

use pocketmine\entity\Human;
use pocketmine\entity\Location;

use pocketmine\entity\EntityDataHelper as Helper;
use pocketmine\entity\EntityFactory;

use pocketmine\world\World;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;

final class EntityManager{
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
    public function init(): void{
        EntityFactory::getInstance()->register(TextEntity::class, function(World $world, CompoundTag $nbt): TextEntity{
            return new TextEntity(Helper::parseLocation($nbt, $world), $nbt);
        }, ["TextEntity"]);
    }

    /**
     * @param Vector3 $position
     * @param Vector3|null $motion
     * @param float $yaw
     * @param float $pitch
     * @return CompoundTag
     */
    protected function createBaseNBT(Vector3 $position, ?Vector3 $motion = null, float $yaw = 0.0, float $pitch = 0.0): CompoundTag{
        return CompoundTag::create()->setTag("Pos", new ListTag([
                new DoubleTag($position->x),
                new DoubleTag($position->y),
                new DoubleTag($position->z)
            ]))->setTag("Motion", new ListTag([
                new DoubleTag(!is_null($motion) ? $motion->x : 0),
                new DoubleTag(!is_null($motion)? $motion->y : 0),
                new DoubleTag(!is_null($motion) ? $motion->z : 0)
            ]))->setTag("Rotation", new ListTag([
                new FloatTag($yaw),
                new FloatTag($pitch)
            ]));
    }

    /**
     * @param Location $location
     * @return void
     */
    public function create(Location $location): void{
        $entity = new TextEntity($location, $this->createBaseNBT($location));
        $entity->spawnToAll();
    }

    public function remove(Location $location): void{
    }
}