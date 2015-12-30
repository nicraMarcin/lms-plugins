<?php

/*
 *  LMS version 1.11-git
 *
 *  Copyright (C) 2001-2013 LMS Developers
 *
 *  Please, see the doc/AUTHORS for more information about authors!
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License Version 2 as
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
 *  USA.
 *
 *  $Id$
 */

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

    public function registerHandlers()
    {
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
