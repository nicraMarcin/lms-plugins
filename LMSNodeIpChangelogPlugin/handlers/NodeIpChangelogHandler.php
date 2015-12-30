<?php

/**
 * NodeIpChangelogHandler
 *
 */
class NodeIpChangelogHandler
{

    public function menuNodeIpChangelog(array $hook_data = array())
    {
        $nodeipchangelog_submenus = array(
            array(
                'name' => trans('IP change history'),
                'link' => '?m=nodeipchangelog',
                'tip' => trans('IP change history'),
                'prio' => 140,
            ),
        );
        $hook_data['nodes']['submenu'] = array_merge($hook_data['nodes']['submenu'], $nodeipchangelog_submenus);
        return $hook_data;
    }

    public function smartyNodeIpChangelog(Smarty $hook_data)
    {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSNodeIpChangelogPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        array_unshift($template_dirs, $plugin_templates);
        $hook_data->setTemplateDir($template_dirs);
        return $hook_data;
    }

    public function modulesDirNodeIpChangelog(array $hook_data = array())
    {
        $plugin_modules = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSNodeIpChangelogPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'modules';
        array_unshift($hook_data, $plugin_modules);
        return $hook_data;
    }


}
