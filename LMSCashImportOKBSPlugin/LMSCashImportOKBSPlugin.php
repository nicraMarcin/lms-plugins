<?php

/**
 * LMSCashImportOKBSPlugin
 * 
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class LMSCashImportOKBSPlugin extends LMSPlugin {

    const PLUGIN_NAME = 'LMS CashImportOKBS Plugin';
    const PLUGIN_DESCRIPTION = 'Import wyciągów z Orzesko-Knurowskiego Banku Spółdzielczego.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'LMSCashImportOKBSPlugin';
    const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers() {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'CashImportOKBSHandler',
                'method' => 'menuCashImportOKBS'
            ),
            'smarty_initialized' => array(
                'class' => 'CashImportOKBSHandler',
                'method' => 'smartyCashImportOKBS'
            ),
            'modules_dir_initialized' => array(
                'class' => 'CashImportOKBSHandler',
                'method' => 'modulesDirCashImportOKBS'
            ),
        );
    }

}
