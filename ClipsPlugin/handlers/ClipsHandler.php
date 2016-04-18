<?php

/**
 * ClipsHandler
 *
 */
class ClipsHandler {

    function formatBytes($size, $precision = 2) {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    function getNodeSessions($id) {
        global $DB;
        if ($arr = $DB->GetAll('SELECT nasipaddress, acctstarttime, acctstoptime, acctsessiontime, acctinputoctets, acctoutputoctets, framedipaddress, acctterminatecause FROM radacct WHERE username=? ORDER BY radacctid DESC', array($id))) {
            foreach ($arr as &$item) {
                $item['acctinputoctets'] = $this->formatBytes($item['acctinputoctets']);
                $item['acctoutputoctets'] = $this->formatBytes($item['acctoutputoctets']);
                $item['acctsessiontime'] = date("z \d\\n\i H:i:s", -3600 + $item['acctsessiontime']);
            }
        }
        return $arr;
    }

    function getClipsInfo($mac) {
        global $CONFIG;
        $ssh_host = $CONFIG['clips']['ssh_host'];
        $ssh_user = $CONFIG['clips']['ssh_user'];
        $ssh_pass = $CONFIG['clips']['ssh_pass'];
        $ssh_port = $CONFIG['clips']['ssh_port'];
        $clips_cmd = $CONFIG['clips']['clips_session_info'] . " " . strtolower($mac);

        $methods = array(
            'kex' => 'diffie-hellman-group1-sha1',
            'hostkey' => 'ssh-dss',
            'client_to_server' => array(
                'crypt' => '3des-cbc',
                'mac' => 'hmac-md5',
                'comp' => 'none'),
            'server_to_client' => array(
                'crypt' => '3des-cbc',
                'mac' => 'hmac-md5',
                'comp' => 'none'));

        $ssh_conn = ssh2_connect($ssh_host, $ssh_port, $methods);
        ssh2_auth_password($ssh_conn, $ssh_user, $ssh_pass);
        $stream = ssh2_exec($ssh_conn, $clips_cmd);
        stream_set_blocking($stream, true);
        $return = stream_get_contents($stream);
        fclose($stream);
        return $return;
    }

    function execute($cmd) {
        if (!exec($cmd, $result)) {
            throw new Exception('Empty command or its incorrect.');
        }
        return $result;
    }

    function updateClips($nid) {
        global $DB, $CONFIG;

        $forward_policy_default = $CONFIG['clips']['forward_policy_default'];
        $forward_policy_redirect = $CONFIG['clips']['forward_policy_redirect'];
        $http_redirect = $CONFIG['clips']['http_redirect'];
        $nas_ip = $CONFIG['clips']['nas_ip'];
        $nas_pass = $CONFIG['clips']['nas_pass'];
        $clips_context = $CONFIG['clips']['context'];

        $node = $DB->GetRow("SELECT lower(m.mac) AS mac,t.downceil AS dl_ceil, t.upceil AS up_ceil, CASE WHEN n.access = 0 OR n.warning = 1 THEN 1 ELSE 0 END AS redirect FROM nodeassignments na INNER JOIN assignments a ON (na.assignmentid = a.id) AND ((UNIX_TIMESTAMP() >= datefrom AND UNIX_TIMESTAMP() <= dateto) OR (UNIX_TIMESTAMP() >= datefrom AND dateto = 0)) INNER JOIN tariffs t ON (a.tariffid = t.id) INNER JOIN nodes n ON (na.nodeid = n.id) INNER JOIN macs m ON (m.nodeid = n.id) WHERE n.id = ?;", array($nid));

        if ($node[redirect] == 0) {
            $forwardpolicy = $forward_policy_default;
            $httpredirect = "";
        } else {
            $forwardpolicy = $forward_policy_redirect;
            $httpredirect = $http_redirect;
        }

        $mac = $node[mac];
        $cmd = 'echo "User-Name=' . $mac . ',Qos-Rate-Outbound=' . $node[dl_ceil] . ', Qos-Rate-Inbound=' . $node[up_ceil] . ',Forward-Policy=' . $forwardpolicy . ', HTTP-Redirect-Profile-Name=\'' . $httpredirect . '\', Context-Name=' . $clips_context . '" | radclient -r 1 -x ' . $nas_ip . ':3799 coa ' . $nas_pass;

        try {
            $result = $this->execute($cmd);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $node;
    }

    function deleteClips($nid) {
        global $DB, $CONFIG;

        $nas_ip = $CONFIG['clips']['nas_ip'];
        $nas_pass = $CONFIG['clips']['nas_pass'];

        $node = $DB->GetRow("SELECT lower(m.mac) AS mac FROM nodes n INNER JOIN macs m ON (m.nodeid = n.id) WHERE n.id = ?;", array($nid));
        $mac = $node[mac];
        $cmd = 'echo "User-Name=' . $mac . '" | radclient -r 1 -s -x ' . $nas_ip . ':3799 disconnect ' . $nas_pass;

        try {
            $result = $this->execute($cmd);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        $DB->exec("UPDATE radacct SET acctstoptime=NOW(), acctterminatecause='STATE-CLEARED' WHERE acctstoptime IS NULL AND username = UPPER(?);", array($mac));
        return true;
    }

    public function smartyClips(Smarty $hook_data) {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . ClipsPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        array_unshift($template_dirs, $plugin_templates);
        $hook_data->setTemplateDir($template_dirs);
        return $hook_data;
    }

    public function modulesDirClips(array $hook_data = array()) {
        $plugin_modules = PLUGINS_DIR . DIRECTORY_SEPARATOR . ClipsPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'modules';
        array_unshift($hook_data, $plugin_modules);
        return $hook_data;
    }

    public function nodeInfoBeforeDisplay(array $hook_data = array()) {
        global $LMS, $SESSION;

        $nodeid = $hook_data['nodeinfo']['id'];
        $nodeinfo = $LMS->GetNode($nodeid);
        $hook_data['nodeinfo']['sessions'] = $this->getNodeSessions($nodeinfo['macs'][0]['mac']);

        // SSH CLIPS INFO
        if (isset($_GET['clips'])) {
            $hook_data['nodeinfo']['clips_session_info'] = $this->getClipsInfo($nodeinfo['macs'][0]['mac']);
        }

        // RADCLIENT: COA
        if ($_GET['updatenode'] == 1) {
            $hook_data['nodeinfo']['clips_session_update'] = $this->updateClips($_GET['id']);
        }

        // RADCLIENT: DISCONNECT
        if ($_GET['disconnectnode'] == 1) {
            if ($this->deleteClips($_GET['id'])) {
                $SESSION->redirect('?m=nodeinfo&id=' . $_GET['id']);
            } else {
                echo "deleteclips fail";
            }
        }
        return $hook_data;
    }

}
?>