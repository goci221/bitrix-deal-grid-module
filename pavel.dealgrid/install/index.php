<?php
use Bitrix\Main\ModuleManager;

class pavel_dealgrid extends CModule {
    public $MODULE_ID = 'pavel.dealgrid';

    public function __construct() {
        $this->MODULE_NAME = "Грид в Сделке";
        $this->MODULE_DESCRIPTION = "Модуль добавляет вкладку с гридом в сделку";
        $this->PARTNER_NAME = "Pavel";
        $this->PARTNER_URI = "https://example.com";
        $arModuleVersion = [];
        include(__DIR__.'/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }

    public function DoInstall() {
        ModuleManager::registerModule($this->MODULE_ID);
        RegisterModuleDependences("crm", "onCrmDealDetailTabs", $this->MODULE_ID, "", "", 100);
    }

    public function DoUninstall() {
        ModuleManager::unRegisterModule($this->MODULE_ID);
        UnRegisterModuleDependences("crm", "onCrmDealDetailTabs", $this->MODULE_ID, "", "");
    }
}
