<?php

declare(strict_types=1);

namespace Speakfo\Thanks\Entity;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\Validators\ForeignValidator;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

class ThankTable extends DataManager
{
    /**
     * Название таблицы
     */
    public static function getTableName(): string
    {
        return 'thank';
    }

    /**
     * Создаем поля таблицы
     * @throws ArgumentException
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return [
            // autocomplete с первичным ключом
            (new IntegerField('id', [
                'autocomplete' => true,
                'primary' => true,
            ])),

            // обязательное поле даты
            (new DatetimeField('date', [
                'required' => true,
            ])),

            // поле от кого
            (new IntegerField('user_from_id', [
                'required' => true,
            ])),

            // связь с полем выше
            (new Reference(
                'user_from',
                UserTable::class,
                Join::on('this.user_from_id', 'ref.id')
            ))->addValidator(new ForeignValidator(UserTable::getEntity()->getField('id'))),

            // поле кому
            (new IntegerField('user_to_id', [
                'required' => true,
            ])),

            // связь с полем выше
            (new Reference(
                'user_to',
                UserTable::class,
                Join::on('this.user_to_id', 'ref.id')
            ))->addValidator(new ForeignValidator(UserTable::getEntity()->getField('id'))),
        ];
    }
}
