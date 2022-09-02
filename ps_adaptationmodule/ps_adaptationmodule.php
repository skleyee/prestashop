<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

class ps_adaptationmodule extends Module
{
    public function __construct()
    {
        $this->name = 'ps_adaptationmodule';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Skley';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => '1.7.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = 'Adaptation Module';
        $this->description = 'AdaptationModule';
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        if (!parent::install() || !$this->registerHook(['CustomForm'])) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function renderList()
    {
        $content = [
            [
                'id_carrier' => 5,
                'name' => 'Lorem ipsum dolor, sit amet, consectetur adipiscing elit. Nunc lacinia in enim iaculis malesuada. Quisque congue ferm',
                'type_name' => 'Azerty',
                'active' => 1,
            ],
            [
                'id_carrier' => 6,
                'name' => 'Lorem ipsum dolor sit amet, consectetur lacinia in enim iaculis malesuada. Quisque congue ferm',
                'type_name' => 'Qwerty',
                'active' => 1,
            ],
            [
                'id_carrier' => 9,
                'name' => "Lorem ipsum dolor sit amet: \ / : * ? \" < > |",
                'type_name' => 'Azerty',
                'active' => 0,
            ],
            [
                'id_carrier' => 3,
                'name' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lacinia in enim iaculis malesuada. Quisque congue ferm',
                'type_name' => 'Azerty',
                'active' => 1,
            ],
        ];

        $fields_list = [
            'id_carrier' => [
                'title' => 'ID',
                'align' => 'center',
                'class' => 'fixed-width-xs',
            ],
            'name' => [
                'title' => 'Name',
            ],
            'type_name' => [
                'title' => 'Type',
                'type' => 'text',
            ],
            'active' => [
                'title' => 'Status',
                'active' => 'status',
                'type' => 'bool',
            ],
        ];

        $helper = new HelperList();
        $helper->shopLinkType = '';
        $helper->simple_header = true;
        $helper->actions = ['edit', 'delete'];
        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->listTotal = count($content);
        $helper->identifier = 'id_carrier';
        $helper->title = 'This is helper list in admin controller view';
        $helper->table = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;

        return $helper->generateList($content, $fields_list);
    }

    public function hookCustomForm()
    {
        return $this->renderList();
    }

    protected function generateControllerURI()
    {
        $router = SymfonyContainer::getInstance()->get('router');

        return $router->generate('start');
    }
}