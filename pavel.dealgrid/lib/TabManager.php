<?php
namespace Pavel\Dealgrid;

use Bitrix\Main;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class TabManager
{
    public static function onTabsInit(Event $event)
    {
        $params = $event->getParameters();
        $tabs = $params['tabs'];
        $entityId = (int)$params['entityId'];

        $tabs[] = [
            'id' => 'pavel_dealgrid',
            'name' => Loc::getMessage('PAVEL_DEALGRID_TAB_NAME'),
            'loader' => [
                'serviceUrl' => '/bitrix/admin/deal_grid.php?deal_id=' . $entityId,
            ],
            'enabled' => true,
        ];

        return new EventResult(EventResult::SUCCESS, ['tabs' => $tabs], 'crm');
    }
}
