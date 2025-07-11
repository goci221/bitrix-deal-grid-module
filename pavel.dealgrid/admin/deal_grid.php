<?php
use Bitrix\Main\Loader;
use Bitrix\Main\UI\Filter\Options;
use Bitrix\Main\UI\PageNavigation;
use Pavel\Dealgrid\Model\RecordTable;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

Loader::includeModule('pavel.dealgrid');

$filterOption = new Options("deal_grid");
$filterData = $filterOption->getFilter([]);
$nav = new PageNavigation("nav");
$nav->allowAllRecords(true)->setPageSize(10)->initFromUri();

$query = RecordTable::query()->setSelect(['*'])->setOffset($nav->getOffset())->setLimit($nav->getLimit());

if (!empty($filterData['NAME'])) {
    $query->whereLike('NAME', "%{$filterData['NAME']}%");
}

$result = $query->exec();
$data = [];
while ($row = $result->fetch()) {
    $data[] = $row;
}
$nav->setRecordCount($query->queryCountTotal());

$APPLICATION->IncludeComponent(
    "bitrix:main.ui.grid",
    "",
    [
        "GRID_ID" => "deal_grid",
        "COLUMNS" => [
            ["id" => "ID", "name" => "ID", "default" => true],
            ["id" => "DEAL_ID", "name" => "ID сделки", "default" => true],
            ["id" => "NAME", "name" => "Имя", "default" => true],
            ["id" => "CREATED_AT", "name" => "Создано", "default" => true],
        ],
        "ROWS" => array_map(fn($item) => ["data" => $item], $data),
        "NAV_OBJECT" => $nav,
        "PAGE_SIZES" => [[ "NAME" => "10", "VALUE" => "10" ], [ "NAME" => "20", "VALUE" => "20" ]],
        "SHOW_ROW_CHECKBOXES" => false,
        "SHOW_GRID_SETTINGS_MENU" => true,
        "SHOW_NAVIGATION_PANEL" => true,
        "SHOW_PAGINATION" => true,
        "SHOW_TOTAL_COUNTER" => true,
    ]
);
