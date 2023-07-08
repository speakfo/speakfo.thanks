<?php

declare(strict_types=1);

namespace Speakfo\Thanks\Contract;

// нужно, чтобы потом можно было менять на лету хранилище (в идеале описать return DTO, чтобы не зависеть от формата отдачи данных)
interface EntityRepositoryContract
{
    public static function getById(int $id);
    public static function getList(array $params);
    public static function add(array $data);
    public static function update(int $id, array $data);
    public static function delete(int $id);
}