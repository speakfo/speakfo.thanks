<?php

declare(strict_types=1);

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;

try {
    Loader::registerAutoLoadClasses('speakfo.thanks', [
        'Speakfo\Thanks\Entity\DepartmentTable' => 'lib/Entity/DepartmentTable.php',
        'Speakfo\Thanks\Entity\ThankTable' => 'lib/Entity/ThankTable.php',
        'Speakfo\Thanks\Entity\UserDepartmentTable' => 'lib/Entity/UserDepartmentTable.php',
        'Speakfo\Thanks\Entity\UserTable' => 'lib/Entity/UserTable.php',
        'Speakfo\Thanks\Repository\ThankRepository' => 'lib/Repository/ThankRepository.php',
        'Speakfo\Thanks\Repository\UserRepository' => 'lib/Repository/UserRepository.php',
        'Speakfo\Thanks\Repository\DepartmentRepository' => 'lib/Repository/DepartmentRepository.php',
    ]);
} catch (LoaderException $e) {
}
