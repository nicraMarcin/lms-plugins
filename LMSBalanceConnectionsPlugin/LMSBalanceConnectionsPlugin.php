<?php

/**
 * LMSBalanceConnectionsPlugin
 *
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class LMSBalanceConnectionsPlugin extends LMSPlugin {

    const PLUGIN_NAME = 'LMS BalanceConnections Plugin';
    const PLUGIN_DESCRIPTION = 'Bilans ilość dodanych oraz usunięty klientów w ujęciu miesięcznym.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'LMSBalanceConnectionsPlugin';
    const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers() {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'BalanceConnectionsHandler',
                'method' => 'menuBalanceConnections'
            ),
            'smarty_initialized' => array(
                'class' => 'BalanceConnectionsHandler',
                'method' => 'smartyBalanceConnections'
            ),
            'modules_dir_initialized' => array(
                'class' => 'BalanceConnectionsHandler',
                'method' => 'modulesDirBalanceConnections'
            ),
        );
    }

}
