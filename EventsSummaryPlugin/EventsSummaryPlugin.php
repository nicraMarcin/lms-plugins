<?php

/**
 * LMSBalanceConnectionsPlugin
 * 
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class EventsSummaryPlugin extends LMSPlugin {

    const PLUGIN_NAME = 'LMS EventsSummary Plugin';
    const PLUGIN_DESCRIPTION = 'Zestawienie spraw do zamknięcia oraz bez przypisanej osoby.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'EventsSummaryPlugin';
    const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers() {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'EventsSummaryHandler',
                'method' => 'menuEventsSummary'
            ),
            'smarty_initialized' => array(
                'class' => 'EventsSummaryHandler',
                'method' => 'smartyEventsSummary'
            ),
            'modules_dir_initialized' => array(
                'class' => 'EventsSummaryHandler',
                'method' => 'modulesDirEventsSummary'
            ),
        );
    }

}
