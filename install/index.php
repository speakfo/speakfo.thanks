<?php

declare(strict_types=1);

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Db\SqlQueryException;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\SystemException;
use Speakfo\Thanks\Entity\UserTable;
use Speakfo\Thanks\Entity\UserDepartmentTable;
use Speakfo\Thanks\Entity\DepartmentTable;
use Speakfo\Thanks\Entity\ThankTable;

Loc::loadMessages(__FILE__);

if (class_exists('speakfo_thanks')) {
    return;
}

class speakfo_thanks extends CModule
{
    /** @var string */
    public $MODULE_ID;

    /** @var string */
    public $MODULE_VERSION;

    /** @var string */
    public $MODULE_VERSION_DATE;

    /** @var string */
    public $MODULE_NAME;

    /** @var string */
    public $MODULE_DESCRIPTION;

    /** @var string */
    public $MODULE_GROUP_RIGHTS;

    /** @var string */
    public $PARTNER_NAME;

    /** @var string */
    public $PARTNER_URI;

    public function __construct()
    {
        $this->MODULE_ID = 'speakfo.thanks';
        $this->MODULE_VERSION = '0.0.1';
        $this->MODULE_VERSION_DATE = '2023-07-05 16:23:14';
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = "Speakfo";
        $this->PARTNER_URI = "https://yandex.ru";
    }

    /**
     * @throws LoaderException
     * @throws SystemException
     * @throws ArgumentException
     */
    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallFiles();
        $this->installDB();
    }

    /**
     * @throws LoaderException
     * @throws ArgumentException
     * @throws SqlQueryException
     * @throws SystemException
     */
    public function doUninstall()
    {
        $this->UnInstallFiles();
        $this->uninstallDB();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    /**
     * @throws LoaderException
     * @throws ArgumentException
     * @throws SystemException
     */
    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            UserTable::getEntity()->createDbTable();
            UserDepartmentTable::getEntity()->createDbTable();
            DepartmentTable::getEntity()->createDbTable();
            ThankTable::getEntity()->createDbTable();
        }
    }

    /**
     * @throws SqlQueryException
     * @throws LoaderException
     * @throws ArgumentException
     * @throws SystemException
     */
    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $connection = Application::getInstance()->getConnection();

            if (Application::getConnection()->isTableExists(Base::getInstance('\Speakfo\Thanks\Entity\UserTable')->getDBTableName())) {
                $connection->dropTable(UserTable::getTableName());
            }

            if (Application::getConnection()->isTableExists(Base::getInstance('\Speakfo\Thanks\Entity\UserDepartmentTable')->getDBTableName())) {
                $connection->dropTable(UserDepartmentTable::getTableName());
            }

            if (Application::getConnection()->isTableExists(Base::getInstance('\Speakfo\Thanks\Entity\DepartmentTable')->getDBTableName())) {
                $connection->dropTable(DepartmentTable::getTableName());
            }

            if (Application::getConnection()->isTableExists(Base::getInstance('\Speakfo\Thanks\Entity\ThankTable')->getDBTableName())) {
                $connection->dropTable(ThankTable::getTableName());
            }
        }
    }

    function InstallFiles(): bool
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/local/modules/speakfo.thanks/install/components",
            $_SERVER["DOCUMENT_ROOT"] . "/local/components", true, true);
        return true;
    }

    function UnInstallFiles(): bool
    {
        DeleteDirFilesEx("/local/components/speakfo");
        return true;
    }
}
