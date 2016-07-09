<?php

/**
 * NodePortsPlugin
 *
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class NodePortsPlugin extends LMSPlugin {

    const PLUGIN_NAME = 'NodePortsPlugin';
    const PLUGIN_DESCRIPTION = 'Dodatkowe odnośniki przy IP dla różnych usług.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'NodePortsPlugin';
    const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers() {
        $this->handlers = array(
            'smarty_initialized' => array(
                'class' => 'NodePortsHandler',
                'method' => 'smartyNodePorts'
            ),
            'nodeinfo_before_display' => array(
                'class' => 'NodePortsHandler',
                'method' => 'nodeInfoBeforeDisplay'
            )
        );
    }

}
