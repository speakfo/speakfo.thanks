<?php

declare(strict_types=1);

use Bitrix\Main\Loader;
use Bitrix\Main\Entity\ExpressionField;
use Bitrix\Main\UI\PageNavigation;
use Speakfo\Thanks\Repository\DepartmentRepository;
use Speakfo\Thanks\Repository\UserRepository;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

Loader::includeModule('speakfo.thanks');

$arItems = [];

$nav = new PageNavigation('page');

$nav->allowAllRecords(true)
    ->setPageSize(5)
    ->initFromUri();

$usersParam = [
    "count_total" => true,
    "offset" => $nav->getOffset(),
    "limit" => $nav->getLimit(),

    'order' => [
        'thanks' => 'desc'
    ],
    'filter' => [

    ],
    'select' => [
        'id',
        'name',
        'thanks',
    ],

    'runtime' => [
        new ExpressionField('thanks', 'COUNT(*)'),
        'thank' => [
            'data_type' => '\Speakfo\Thanks\Entity\ThankTable',
            'reference' => [
                '=this.id' => 'ref.user_from_id'
            ],
            'join_type' => 'left'
        ],
    ],
];

if (isset($_REQUEST['date_from']) && !empty($_REQUEST['date_from'])) {
    $usersParam['filter']['>=thank.date'] = \Bitrix\Main\Type\DateTime::createFromTimestamp(strtotime($_REQUEST['date_from']));
}

if (isset($_REQUEST['date_to']) && !empty($_REQUEST['date_to'])) {
    $usersParam['filter']['<=thank.date'] = \Bitrix\Main\Type\DateTime::createFromTimestamp(strtotime($_REQUEST['date_to']));
}

if (isset($_REQUEST['department']) && !empty($_REQUEST['department'])) {
    $usersParam['runtime']['departments'] = [
        'data_type' => '\Speakfo\Thanks\Entity\UserDepartmentTable',
        'reference' => [
            '=this.id' => 'ref.user_id'
        ],
        'join_type' => 'left'
    ];

    $usersParam['filter']['departments.department_id'] = $_REQUEST['department'];
}

$users = UserRepository::getList($usersParam);

$nav->setRecordCount($users->getCount());

$arResult['NAV'] = $nav;

while ($user = $users->fetch()) {
    $arItems[] = [
        'name' => $user['name'],
        'thanks' => $user['thanks'],
    ];
}

$arDepartments = [];

$departments = DepartmentRepository::getList([
    'select' => ['id', 'name'],
]);

while ($department = $departments->fetch()) {
    $arDepartments[] = [
        'name' => $department['name'],
        'id' => $department['id'],
    ];
}

$arResult['ITEMS'] = $arItems;
$arResult['DEPARTMENTS'] = $arDepartments;

$this->IncludeComponentTemplate();
