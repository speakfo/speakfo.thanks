<?php

declare(strict_types=1);

namespace Speakfo\Thanks\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

class DepartmentTable extends DataManager
{
    /**
     * Название таблицы
     */
    public static function getTableName(): string
    {
        return 'department';
    }

    /**
     * Создаем поля таблицы
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return [
            // autocomplete с первичным ключом
            (new IntegerField('id', [
                'autocomplete' => true,
                'primary' => true
            ])),

            (new IntegerField('name', [
                'required' => true,
            ])),

            (new IntegerField('parent')),
        ];
    }
}
