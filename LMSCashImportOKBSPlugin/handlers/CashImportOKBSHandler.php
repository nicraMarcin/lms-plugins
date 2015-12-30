<?php

/**
 * CashImportOKBSHandler
 *
 */
class CashImportOKBSHandler
{

    public function menuCashImportOKBS(array $hook_data = array())
    {
        $cashimportokbs_submenus = array(
            array(
                'name' => trans('Import OKBS'),
                'link' => '?m=cashimportokbs',
                'tip' => trans('Import OKBS'),
                'prio' => 150,
            ),
        );
        $hook_data['finances']['submenu'] = array_merge($hook_data['finances']['submenu'], $cashimportokbs_submenus);
        return $hook_data;
    }

    public function smartyCashImportOKBS(Smarty $hook_data)
    {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSCashImportOKBSPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        array_unshift($template_dirs, $plugin_templates);
        $hook_data->setTemplateDir($template_dirs);
        return $hook_data;
    }

    public function modulesDirCashImportOKBS(array $hook_data = array())
    {
        $plugin_modules = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSCashImportOKBSPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'modules';
        array_unshift($hook_data, $plugin_modules);
        return $hook_data;
    }


}
