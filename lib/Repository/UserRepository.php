<?php

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
use Speakfo\Thanks\Entity\UserTable;

class UserRepository implements EntityRepositoryContract
{
    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public static function getById(int $id): Result
    {
        return UserTable::getById($id);
    }

    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public static function getList(array $params): Result
    {
        return UserTable::getList($params);
    }

    /**
     * @throws Exception
     */
    public static function add(array $data): AddResult
    {
        return UserTable::add($data);
    }

    /**
     * @throws Exception
     */
    public static function update(int $id, array $data): UpdateResult
    {
        return UserTable::update($id, $data);
    }

    /**
     * @throws Exception
     */
    public static function delete(int $id): DeleteResult
    {
        return UserTable::delete($id);
    }
}