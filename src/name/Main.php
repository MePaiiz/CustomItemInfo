<?php

namespace name;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\scheduler\Task;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\math\Vector2;
use pocketmine\utils\Random;
use pocketmine\item\Item;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\network\protocol\ExplodePacket;
use pocketmine\network\protocol\Info;
use pocketmine\network\protocol\PlayerActionPacket;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDespawnEvent;
use pocketmine\event\entity\EntityInventoryChangeEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerMoveEvent;
class Main extends PluginBase implements Listener {

	function onEnable ()
	{
		Server::getInstance()->getPluginManager()->registerEvents($this,$this);
		$this->name = [276 => "Test Sword"];
		$this->lore = [276 => "Test Lore"];
	}

	function onItem (EntityInventoryChangeEvent $event)
	{
		if (!$event->getEntity() instanceof Player) return false;
		$item = $event->getNewItem();
		if (isset($this->name[$item->getId()])) {
			$tag = "§r".$this->name[$item->getId()];
			$lore = "§r".$this->lore[$item->getId()];
			$item->setCustomName($tag);
			$event->setNewItem($item);
			$item->setLore([$lore]);
		}
	}
}