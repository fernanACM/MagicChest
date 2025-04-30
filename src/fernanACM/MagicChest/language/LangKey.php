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

final class LangKey{

    // ERROR
    public const ERROR_NO_PERMISSION = "Messages.error.no-permission";
    public const ERROR_FULL_INVENTORY = "Messages.error.full-inventory";

    // SUCCESS
    public const SUCCESS_MAGIC_CHEST_SET = "Messages.success.magic-chest-set";
    public const SUCCESS_ENTER_SETUP_MODE = "Messages.success.enter-setup-mode";
    public const SUCCESS_EXIT_SETUP_MODE = "Messages.success.exit-setup-mode";
    public const SUCCESS_CHECK_TIME = "Messages.success.check-time";
    public const SUCCESS_REFILL = "Messages.success.refill";
    public const SUCCESS_REFILL_BY_PLAYER = "Messages.success.refill-by-player";

    // MAGIC CHEST
    public const MAGIC_CHEST_NAME = "MagicChest.name";
    public const CHECK_TIME_HOURS = "MagicChest.CheckTime.hours";
    public const CHECK_TIME_MINUTES = "MagicChest.CheckTime.minutes";
    public const CHECK_TIME_SECONDS = "MagicChest.CheckTime.seconds";
    public const CHECK_TIME_DAYS = "MagicChest.CheckTime.days";
    public const CHECK_TIME_MONTHS = "MagicChest.CheckTime.months";

    // GENERAL - FORM [SETUP]
    public const SETUP_FORM_CONTENT = "Form.setup.content";
    public const SETUP_FORM_TOGGLE1_BUTTON = "Form.setup.toggle1-button"; // ENABLE
    public const SETUP_FORM_TOGGLE2_BUTTON = "Form.setup.toggle2-button"; // DISABLE
    public const SETUP_FORM_REMOVE_BUTTON = "Form.setup.remove-button";
    public const SETUP_FORM_LOOT_BUTTON = "Form.setup.loot-button";
    public const SETUP_FORM_CLOSE_BUTTON = "Form.setup.close-button";

     // ITEM
     public const ITEM_NAME = "Item.name";

     // LOOT
     public const SAVED_INVENTORY = "Item.saved-inventory";
}