<?php

declare(strict_types=1);

namespace Speakfo\Thanks\Entity;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

class UserTable extends DataManager
{
    /**
     * Название таблицы
     */
    public static function getTableName(): string
    {
        return 'user';
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

            //обязательная строка с длиной не более 255 символов
            (new StringField('name', [
                'required' => true,
                'validation' => function () {
                    return [
                        new LengthValidator(null, 255),
                    ];
                },
            ])),
        ];
    }
}
