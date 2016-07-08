<?php

class NodePortsHandler {

    public function smartyNodePorts(Smarty $hook_data) {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSCustomersAgePlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        $custom_templates_dir = ConfigHelper::getConfig('phpui.custom_templates_dir');
        if (!empty($custom_templates_dir) && file_exists($plugin_templates . DIRECTORY_SEPARATOR . $custom_templates_dir) && !is_file($plugin_tempaltes . DIRECTORY_SEPARATOR . $custom_templates_dir)) {
            $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSCustomersAgePlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $custom_templates_dir;
        } array_unshift($template_dirs, $plugin_templates);
        $hook_data->setTemplateDir($template_dirs);
        return $hook_data;
    }

    public function nodeInfoBeforeDisplay(array $hook_data = array()) {
            $hook_data['nodeinfo']['ports'] = array(80, 5555, 55555);
            $hook_data['nodeinfo']['public_ports'] = array(80, 5555, 55555);
        return $hook_data;
    }

}
?>