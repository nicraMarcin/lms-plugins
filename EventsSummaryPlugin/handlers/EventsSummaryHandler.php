<?php

/**
 * BalanceConnectionsHandler
 *
 */
class EventsSummaryHandler
{

    public function menuEventsSummary(array $hook_data = array())
    {
        $EventsSummary_submenus = array(
            array(
                'name' => trans('Events summary'),
                'link' => '?m=eventssummary',
                'tip' => trans('Events summary'),
                'prio' => 80,
            ),
        );
        $hook_data['timetable']['submenu'] = array_merge($hook_data['timetable']['submenu'], $EventsSummary_submenus);
        return $hook_data;
    }

    public function smartyEventsSummary(Smarty $hook_data)
    {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . EventsSummaryPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        array_unshift($template_dirs, $plugin_templates);
        $hook_data->setTemplateDir($template_dirs);
        return $hook_data;
    }

    public function modulesDirEventsSummary(array $hook_data = array())
    {
        $plugin_modules = PLUGINS_DIR . DIRECTORY_SEPARATOR . EventsSummaryPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'modules';
        array_unshift($hook_data, $plugin_modules);
        return $hook_data;
    }


}
