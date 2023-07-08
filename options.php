<?php

declare(strict_types=1);

/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
defined('ADMIN_MODULE_NAME') or define('ADMIN_MODULE_NAME', 'speakfo.thanks');

use Bitrix\Main\Localization\Loc;

if (!$USER->isAdmin()) {
    $APPLICATION->authForm('Nope');
}

Loc::loadMessages(__FILE__);

echo Loc::getMessage("WELCOME");
