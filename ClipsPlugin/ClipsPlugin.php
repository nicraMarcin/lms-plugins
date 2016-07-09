<?php

/**
 * ClipsPlugin
 *
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class ClipsPlugin extends LMSPlugin {

    const PLUGIN_NAME = 'ClipsPlugin';
    const PLUGIN_DESCRIPTION = 'Integracja LMS z CLIPS w SmartEdge.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'ClipsPlugin';
    const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers() {
        $this->handlers = array(
            'smarty_initialized' => array(
                'class' => 'ClipsHandler',
                'method' => 'smartyClips'
            ),
            'modules_dir_initialized' => array(
                'class' => 'ClipsHandler',
                'method' => 'modulesDirClips'
            ),
            'nodeinfo_before_display' => array(
                'class' => 'ClipsHandler',
                'method' => 'nodeInfoBeforeDisplay'
            )
        );
    }

}
