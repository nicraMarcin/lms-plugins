<?php

/**
 * EndingAgreementsPlugin
 * 
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class EndingAgreementsPlugin extends LMSPlugin {
	const PLUGIN_NAME = 'EndingAgreementsPlugin';
	const PLUGIN_DESCRIPTION = 'Lista kończących się umów.';
	const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
	const PLUGIN_DIRECTORY_NAME = 'EndingAgreementsPlugin';
        const PLUGIN_TEMPLATE_NAME = 'bclean';

    public function registerHandlers()
    {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'EndingAgreementsHandler',
                'method' => 'menuEndingAgreements'
            ),
            'smarty_initialized' => array(
                'class' => 'EndingAgreementsHandler',
                'method' => 'smartyEndingAgreements'
            ),
            'modules_dir_initialized' => array(
                'class' => 'EndingAgreementsHandler',
                'method' => 'modulesDirEndingAgreements'
            ),
        );
    }
}
