[![](https://poggit.pmmp.io/shield.state/MagicChest)](https://poggit.pmmp.io/p/MagicChest)

[![](https://poggit.pmmp.io/shield.api/MagicChest)](https://poggit.pmmp.io/p/MagicChest)

# MagicChest

A MagicChest full of special and random items. Only servers PocketMine-MP 5.0

![1750733594209](https://github.com/user-attachments/assets/f48f90ff-785c-4f3c-9287-b4532548099e)

<a href="https://discord.gg/YyE9XFckqb"><img src="https://img.shields.io/discord/837701868649709568?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

### 🌍 Wiki
* Check our plugin [wiki](https://github.com/fernanACM/MagicChest/wiki) for features and secrets in the...

### 💡 Implementations
* [X] Configuration
* [x] Keys in config.yml
* [x] Loot system
* [x] Reward system

### 💾 Config 
```yaml
#  __  __                   _           ____   _                    _   
# |  \/  |   __ _    __ _  (_)   ___   / ___| | |__     ___   ___  | |_ 
# | |\/| |  / _` |  / _` | | |  / __| | |     | '_ \   / _ \ / __| | __|
# | |  | | | (_| | | (_| | | | | (__  | |___  | | | | |  __/ \__ \ | |_ 
# |_|  |_|  \__,_|  \__, | |_|  \___|  \____| |_| |_|  \___| |___/  \__|
#                   |___/
#           by fernanACM

# Chest refill system with random items. Easy to set up and fun. Only 
# for PocketMine-MP 5.0 servers.

# DO NOT TOUCH!!
config-version: "1.0.0"

# Languages
# "eng", // English
# "spa", // Spanish
# "ger", // German
# "indo", // Indonesian
# "vie" // Vietnamese
language: eng

# Prefix plugin
Prefix: "&l&f[&9MC&f]&8»&r "

# ====(SETTINGS)====
Settings:
  MagicChest:
    # It's time to fill the magic chest:
    # 300 => 5 minutes
    refill-interval: 300
    # ====(LOOT)====
    Loot:
      # Minimum amount of loot in the chest.
      min: 4
      # Maximum amount of loot in the chest.
      max: 6
    # ====(BROADCAST)====
    Broadcast:
      # Enter the number of seconds the announcer 
      # will be active. If you have no idea what 
      # it's for, leave it as is.
      times: [1, 2, 3, 4, 5, 60, 3600, 10800, 86400, 2592000]
```

### 🌐 MultiLanguage
| Language | Translated by |
|----------|---------------|
| English | [fernanACM](https://github.com/fernanACM) |
| Spanish | [fernanACM](https://github.com/fernanACM) |
| Indonesian | MagicChest |
| German | MagicChest |
| Vietnamese | MagicChest |

### 📢 Report bug
* If you find any bugs in this plugin, please let me know via: [issues](https://github.com/fernanACM/MagicChest/issues)

### 📞 Contact
| Redes | Tag | Link |
|-------|-------------|------|
| YouTube | fernanACM | [YouTube](https://www.youtube.com/channel/UC-M5iTrCItYQBg5GMuX5ySw) | 
| Discord | fernanACM#5078 | [Discord](https://discord.gg/YyE9XFckqb) |
| GitHub | fernanACM | [GitHub](https://github.com/fernanACM)
| Poggit | fernanACM | [Poggit](https://poggit.pmmp.io/ci/fernanACM)
****

### ✔ Credits
| Authors | Github | Lib |
|---------|--------|-----|
| Vecnavium | [Vecnavium](https://github.com/Vecnavium) | [FormsUI](https://github.com/Vecnavium/FormsUI/tree/master/) |
| CortexPE | [CortexPE](https://github.com/CortexPE) | [Commando](https://github.com/CortexPE/Commando/tree/master/) |
| Muqsit | [Muqsit](https://github.com/Muqsit) | [SimplePacketHandler](https://github.com/Muqsit/SimplePacketHandler) |
| Muqsit | [Muqsit](https://github.com/Muqsit) | [InvMenu](https://github.com/Muqsit/InvMenu) |
| DaPigGuy | [DaPigGuy](https://github.com/DaPigGuy) | [libPiggyUpdateChecker](https://github.com/DaPigGuy/libPiggyUpdateChecker) |
****
