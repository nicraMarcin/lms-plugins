<?php

class NodePortsHandler {

    public function smartyNodePorts(Smarty $hook_data) {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . NodePortsPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        if (!empty(NodePortsPlugin::PLUGIN_TEMPLATE_NAME) && file_exists($plugin_templates . DIRECTORY_SEPARATOR . NodePortsPlugin::PLUGIN_TEMPLATE_NAME) && !is_file($plugin_templates . DIRECTORY_SEPARATOR . NodePortsPlugin::PLUGIN_TEMPLATE_NAME)) {
            $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . NodePortsPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . NodePortsPlugin::PLUGIN_TEMPLATE_NAME;
        }
        array_unshift($template_dirs, $plugin_templates);
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