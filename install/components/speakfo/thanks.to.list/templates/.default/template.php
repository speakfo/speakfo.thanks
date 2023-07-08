<?php

declare(strict_types=1);

/** @var array $arResult */
/** @global CMain $APPLICATION */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?>

<h1>Список тех, кому сказали спасибо, с количеством благодарностей.</h1>

<div>
    <form id="thanks_to" action="">
        <?php if (isset($arResult['DEPARTMENTS']) && !empty($arResult['DEPARTMENTS'])): ?>
            <div>
                <labet>Подразделение</labet>
                <select name="department" id="">
                    <option value="0" <?= !isset($_REQUEST['department']) ? 'selected' : '' ?> >Нет</option>
                    <?php foreach ($arResult['DEPARTMENTS'] as $department): ?>
                        <option <?= (isset($_REQUEST['department']) && $_REQUEST['department'] === $department['id']) ? 'selected' : '' ?> value="<?= $department['id'] ?>"><?= $department['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <br>
        
        <div>
            <label for="date_from">От - </label>
            <input value="<?= $_REQUEST['date_from'] ?>" name="date_from" type="date">
            &nbsp;
            <label for="date_to">до - </label>
            <input value="<?= $_REQUEST['date_to'] ?>" name="date_to" type="date">
        </div>

        <br>

        <div>
            <button type="submit">Применить</button>
            &nbsp;
            <button id="thanks_to_reset" type="reset">Сбросить</button>
        </div>
    </form>
</div>

<br><br>

<?php if (isset($arResult['ITEMS']) && !empty($arResult['ITEMS'])): ?>
    <table>
        <thead>
        <tr>
            <th>Пользователь</th>
            <th>Количество благодарностей</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arResult['ITEMS'] as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['thanks'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div>
        Подходящих пользователей не нашлось
    </div>
<?php endif; ?>

<?
$APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "",
    [
        "NAV_OBJECT" => $arResult['NAV'],
    ],
    false
);
?>