<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\forms\type;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\SingletonTrait;

use Vecnavium\FormsUI\SimpleForm;

use fernanACM\MagicChest\MagicChest as MC;

use fernanACM\MagicChest\language\LangKey;
use fernanACM\MagicChest\language\Language;
use fernanACM\MagicChest\permissions\Perms;
use fernanACM\MagicChest\utils\helper\SetupHelper as SH;

use fernanACM\MagicChest\utils\PluginUtils;

final class SetupForm{
    use SingletonTrait{
        setInstance as protected;
        reset as protected;
    }

    public function __construct(){
        self::setInstance($this);   
    }

    /**
     * @param Player $player
     * @return void
     */
    public function open(Player $player): void{
        $inSetupMode = SH::inSetupMode($player);
        $form = new SimpleForm(function(Player $player, $data): void{
            if(is_null($data)){
                PluginUtils::PlaySound($player, "random.pop2", 1, 5.3);
                return;
            }
            switch($data){
                case 0: // ENTER / LEAVE SETUP MODE
                    SH::toggleSetupMode($player);
                    PluginUtils::PlaySound($player, "random.pop", 1, 5.3);
                break;

                case 1: // REMOVE WAND
                    $wand = SH::removeWand();
                    if(!$player->getInventory()->canAddItem($wand)){
                        Language::isError($player, LangKey::ERROR_FULL_INVENTORY);
                        return;
                    }
                    $player->getInventory()->addItem($wand);
                    PluginUtils::PlaySound($player, "random.pop", 1, 5.3);
                break;

                case 2: // LOOT
                    if(!$player->hasPermission(Perms::LOOT_SUBCOMMAND)){
                        Language::isError($player, LangKey::ERROR_NO_PERMISSION);
                        return;
                    }
                    MC::getInstance()->getLootManager()->edit($player);
                    PluginUtils::PlaySound($player, "random.pop", 1, 5.3);
                break;

                case 3: // CLOSE
                    PluginUtils::PlaySound($player, "random.pop2", 1, 5.3);
                break;
            }
        });
        $form->setTitle(TF::colorize("&l&9MAGIC CHEST"));
        $form->setContent(Language::getPlayerMessage($player, LangKey::SETUP_FORM_CONTENT));
        if($inSetupMode){
            $form->addButton(Language::getPlayerMessage($player, LangKey::SETUP_FORM_TOGGLE1_BUTTON),0,"textures/ui/icon_agent"); // ENABLE
        }else $form->addButton(Language::getPlayerMessage($player, LangKey::SETUP_FORM_TOGGLE2_BUTTON),0,"textures/ui/icon_agent"); // DISABLE
        $form->addButton(Language::getPlayerMessage($player, LangKey::SETUP_FORM_REMOVE_BUTTON),0,"textures/items/blaze_rod");
        $form->addButton(Language::getPlayerMessage($player, LangKey::SETUP_FORM_LOOT_BUTTON),0,"textures/ui/icon_blackfriday");
        $form->addButton(Language::getPlayerMessage($player, LangKey::SETUP_FORM_CLOSE_BUTTON),0,"textures/ui/cancel");
        $player->sendForm($form);
    }
}