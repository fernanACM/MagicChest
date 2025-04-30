<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

declare(strict_types=1);

namespace fernanACM\MagicChest\permissions;

final class Perms{

    public const MAIN_COMMAND = "magicchest.cmd.acm";

    public const SETUP_SUBCOMMAND = "magicchest.setup.cmd.acm";
    public const LOOT_SUBCOMMAND = "magicchest.loot.cmd.acm";
    public const REFILL_SUBCOMMAND = "magicchest.refill.cmd.acm";

    public const USE_REMOVER_WAND = "magicchest.use.remover.wand.acm";
}