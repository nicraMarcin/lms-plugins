<?php

/**
 * LMSIncomePlugin
 * 
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class LMSIncomePlugin extends LMSPlugin {

    const PLUGIN_NAME = 'LMS Income Plugin';
    const PLUGIN_DESCRIPTION = 'Pokazuje przychód z podziałem na dni w wybranym miesiącu lub według miesiący w wybranym roku.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'LMSIncomePlugin';
    const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers() {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'IncomeHandler',
                'method' => 'menuIncome'
            ),
            'smarty_initialized' => array(
                'class' => 'IncomeHandler',
                'method' => 'smartyIncome'
            ),
            'modules_dir_initialized' => array(
                'class' => 'IncomeHandler',
                'method' => 'modulesDirIncome'
            ),
        );
    }

}
