<?php

/**
 * LMSNodeIpChangelogPlugin
 *
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class LMSNodeIpChangelogPlugin extends LMSPlugin {

    const PLUGIN_NAME = 'LMS NodeIpChangelog Plugin';
    const PLUGIN_DESCRIPTION = 'Logowanie zmian IP za pomocą triggerów (testowane tylko z MySQL).';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'LMSNodeIpChangelogPlugin';
    const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers() {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'NodeIpChangelogHandler',
                'method' => 'menuNodeIpChangelog'
            ),
            'smarty_initialized' => array(
                'class' => 'NodeIpChangelogHandler',
                'method' => 'smartyNodeIpChangelog'
            ),
            'modules_dir_initialized' => array(
                'class' => 'NodeIpChangelogHandler',
                'method' => 'modulesDirNodeIpChangelog'
            ),
        );
    }

}
