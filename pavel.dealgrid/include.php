<?php
use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;

Loader::registerAutoLoadClasses(
    'pavel.dealgrid',
    [
        'Pavel\\Dealgrid\\Model\\RecordTable' => 'lib/Model/RecordTable.php',
        'Pavel\\Dealgrid\\TabManager' => 'lib/TabManager.php',
    ]
);

EventManager::getInstance()->addEventHandler(
    'crm',
    'OnEntityDetailsTabsInitialized',
    ['Pavel\\Dealgrid\\TabManager', 'onTabsInit']
);
