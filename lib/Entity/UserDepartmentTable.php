<?php

declare(strict_types=1);

namespace Speakfo\Thanks\Entity;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\Validators\ForeignValidator;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\SystemException;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;

Loc::loadMessages(__FILE__);

class UserDepartmentTable extends DataManager
{
    /**
     * Название таблицы
     */
    public static function getTableName(): string
    {
        return 'user_department';
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
                'primary' => true
            ])),

            // пользователь
            (new IntegerField('user_id', [
                'required' => true,
            ])),

            // связь для поля выше
            (new Reference(
                'user',
                UserTable::class,
                Join::on('this.user_id', 'ref.id')
            ))->addValidator(new ForeignValidator(UserTable::getEntity()->getField('id'))),

            // подразделение
            new IntegerField('department_id', [
                'required' => true,
            ]),

            // связь для поля выше
            (new Reference(
                'department',
                DepartmentTable::class,
                Join::on('this.department_id', 'ref.id')
            ))->addValidator(new ForeignValidator(DepartmentTable::getEntity()->getField('id'))),
        ];
    }
}
