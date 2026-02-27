<?php

namespace Fly;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("Fly plugin enabled!");
    }

    public function onDisable(): void {
        $this->getLogger()->info("Fly plugin disabled!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() !== "fly") {
            return false;
        }

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cThis command can only be used in-game.");
            return true;
        }

        if (!$sender->hasPermission("fly.use")) {
            $sender->sendMessage("§cYou do not have permission to use this command.");
            return true;
        }

        if (!isset($args[0])) {
            $sender->sendMessage("§eUsage: §a/fly on §eor §a/fly off");
            return true;
        }

        switch (strtolower($args[0])) {
            case "on":
                $sender->setAllowFlight(true);
                $sender->setFlying(true);
                $sender->sendMessage("§aFlight enabled.");
                break;

            case "off":
                $sender->setFlying(false);
                $sender->setAllowFlight(false);
                $sender->sendMessage("§cFlight disabled.");
                break;

            default:
                $sender->sendMessage("§eUsage: §a/fly on §eor §a/fly off");
                break;
        }

        return true;
    }
}
