<?php

/**
 * LMSCusomersAgePlugin
 *
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class LMSCustomersAgePlugin extends LMSPlugin {

    const PLUGIN_NAME = 'LMS CustomersAge Plugin';
    const PLUGIN_DESCRIPTION = 'Rozkład wieku klientów.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'LMSCustomersAgePlugin';
    const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers() {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'CustomersAgeHandler',
                'method' => 'menuCustomersAge'
            ),
            'smarty_initialized' => array(
                'class' => 'CustomersAgeHandler',
                'method' => 'smartyCustomersAge'
            ),
            'modules_dir_initialized' => array(
                'class' => 'CustomersAgeHandler',
                'method' => 'modulesDirCustomersAge'
            ),
        );
    }

}
