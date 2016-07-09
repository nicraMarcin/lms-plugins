<?php

class EndingAgreementsHandler {

    public function menuEndingAgreements(array $hook_data = array()) {
        $customers_submenus = array(
            array(
                'name' => trans('Ending agreements'),
                'link' => '?m=endingagreements',
                'tip' => trans('Ending agreements'),
                'prio' => 150,
            ),
        );
        $hook_data['customers']['submenu'] = array_merge($hook_data['customers']['submenu'], $customers_submenus);
        return $hook_data;
    }

    public function smartyEndingAgreements(Smarty $hook_data) {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . EndingAgreementsPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        if (!empty(EndingAgreementsPlugin::PLUGIN_TEMPLATE_NAME) && file_exists($plugin_templates . DIRECTORY_SEPARATOR . EndingAgreementsPlugin::PLUGIN_TEMPLATE_NAME) && !is_file($plugin_templates . DIRECTORY_SEPARATOR . EndingAgreementsPlugin::PLUGIN_TEMPLATE_NAME)) {
            $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . EndingAgreementsPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . EndingAgreementsPlugin::PLUGIN_TEMPLATE_NAME;
        }
        array_unshift($template_dirs, $plugin_templates);
        $hook_data->setTemplateDir($template_dirs);
        return $hook_data;
    }

    public function modulesDirEndingAgreements(array $hook_data = array()) {
        $plugin_modules = PLUGINS_DIR . DIRECTORY_SEPARATOR . EndingAgreementsPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'modules';
        array_unshift($hook_data, $plugin_modules);
        return $hook_data;
    }

}
