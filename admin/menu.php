<?php

declare(strict_types=1);

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$aMenu = [
    // тут можно добавить страницу в меню у административной панели (для статистики)
];

return $aMenu;
