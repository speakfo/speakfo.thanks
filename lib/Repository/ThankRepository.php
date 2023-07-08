<?php

declare(strict_types=1);

namespace Speakfo\Thanks\Repository;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\ORM\Data\DeleteResult;
use Bitrix\Main\ORM\Data\UpdateResult;
use Bitrix\Main\ORM\Query\Result;
use Bitrix\Main\SystemException;
use Exception;
use Speakfo\Thanks\Contract\EntityRepositoryContract;
use Speakfo\Thanks\Entity\ThankTable;

class ThankRepository implements EntityRepositoryContract
{

    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public static function getById(int $id): Result
    {
        return ThankTable::getById($id);
    }

    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public static function getList(array $params): Result
    {
        return ThankTable::getList($params);
    }

    /**
     * @throws Exception
     */
    public static function add(array $data): AddResult
    {
        // тут, желательно добавлять связь через set, но опять же ограничен во времени :)
        return ThankTable::add($data);
    }

    /**
     * @throws Exception
     */
    public static function update(int $id, array $data): UpdateResult
    {
        // тут, желательно обновлять связь через set, но опять же ограничен во времени :)
        return ThankTable::update($id, $data);
    }

    /**
     * @throws Exception
     */
    public static function delete(int $id): DeleteResult
    {
        return ThankTable::delete($id);
    }
}