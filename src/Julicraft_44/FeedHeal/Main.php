<?php

declare(strict_types=1);

namespace Julicraft_44\FeedHeal;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\event\Listener;


class Main extends PluginBase implements Listener {
	
	public function onEnable() {
		$this->saveDefaultConfig();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if($this->getConfig()->get("version") !== 1.2) {
			$this->getLogger()->critical("The version of the config is outdated.");
			rename("plugin_data/FeedHeal/config.yml", "plugin_data/FeedHeal/config.yml.old");
		}
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $lable, array $args): bool {
			if($cmd->getName() == "heal") {
					if($sender instanceof Player) {
					if($sender->hasPermission("feedheal.heal")) {
				
					if(!isset($args[0])) {
					
					$send_name = $sender->getName();
					
					$sender->setHealth($sender->getMaxHealth());
					
					$msg = $this->getConfig()->get("success-heal");
					$msg = str_replace("%send_name", "$send_name", $msg);
					$sender->sendMessage($msg);
					
					} else {
					
						$target = $this->getServer()->getPlayer($args[0]);
						if($target === null || !$target->isOnline()) {
								$sender->sendMessage($this->getConfig()->get("not-found"));
								return false;
						} else {
					
							$send_name = $sender->getName();
							$tar_name = $target->getName();
					
							$target->setHealth($target->getMaxHealth());
					
							$msg = $this->getConfig()->get("success-target-heal");
							$msg = str_replace("%send_name", "$send_name", $msg);
							$msg = str_replace("%tar_name", "$tar_name", $msg);
							$target->sendMessage($msg);
					
							$msg = $this->getConfig()->get("success-sender-heal");
							$msg = str_replace("%send_name", "$send_name", $msg);
							$msg = str_replace("%tar_name", "$tar_name", $msg);
							$sender->sendMessage($msg);
						}		
					}
					return true;
					
					} else {
						$sender->sendMessage($this->getConfig()->get("no-permission"));
					}
					} else {
						$sender->sendMessage("Please run this command In-Game");
					}
					
					
			}elseif ($cmd->getName() == "feed") {
					if($sender instanceof Player) {
					if($sender->hasPermission("feedheal.feed")) {
				
					if(!isset($args[0])) {
					
					$send_name = $sender->getName();
					
					$sender->setFood($sender->getMaxFood());
					$sender->setSaturation(20);
					
					$msg = $this->getConfig()->get("success-feed");
					$msg = str_replace("%send_name", "$send_name", $msg);
					$sender->sendMessage($msg);
					
					} else {
					
						$target = $this->getServer()->getPlayer($args[0]);
						if($target === null || !$target->isOnline()) {
								$sender->sendMessage($this->getConfig()->get("not-found"));
								return false;
						} else {
					
							$send_name = $sender->getName();
							$tar_name = $target->getName();
					
							$target->setFood($target->getMaxFood());
					
							$msg = $this->getConfig()->get("success-target-feed");
							$msg = str_replace("%send_name", "$send_name", $msg);
							$msg = str_replace("%tar_name", "$tar_name", $msg);
							$target->sendMessage($msg);
					
							$msg = $this->getConfig()->get("success-sender-feed");
							$msg = str_replace("%send_name", "$send_name", $msg);
							$msg = str_replace("%tar_name", "$tar_name", $msg);
							$sender->sendMessage($msg);
						}		
					}
					return true;
					
					} else {
						$sender->sendMessage($this->getConfig()->get("no-permission"));
					}
					} else {
						$sender->sendMessage("Please run this command In-Game");
					}
			}
			return true;
	}
}
