<?php
namespace Pavel\Dealgrid\Model;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\DatetimeField;

class RecordTable extends DataManager {
    public static function getTableName() {
        return 'pavel_dealgrid_records';
    }

    public static function getMap() {
        return [
            new IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new IntegerField('DEAL_ID'),
            new StringField('NAME'),
            new DatetimeField('CREATED_AT')
        ];
    }
}
