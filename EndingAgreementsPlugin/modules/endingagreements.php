<?php

$expire_after_periods = array(
    604800 => trans('week'),
    2678400 => trans('month'),
    8035200 => trans('quarter'),
    16070400 => trans('half year'),
    32140800 => trans('year'),
);

$now = time();

if (isset($_GET['expires_after'])) {
    $expires_after = $_GET['expires_after'];
    $end_time = $now + $expires_after;

    if (isset($_GET['doc_type'])) {
        $doc_type = $_GET['doc_type'];
        $sql_doc_type = "AND type=$doc_type";
    }
    $where = "WHERE todate>0 $sql_doc_type AND todate BETWEEN $now AND $end_time";
} else {
    $where = "WHERE todate>0 AND todate<$now";
}

$sql = "SELECT docid, type, customerid, name,address, FROM_UNIXTIME(todate, '%Y-%m-%d') AS todate
        FROM documentcontents
        LEFT JOIN documents
        ON documentcontents.docid=documents.id $where";

$contracts = $DB->GetAll($sql);

if (is_array($contracts)) {
    $i = 0;
    foreach ($contracts as $item) {
        foreach ($DOCTYPES as $key => $value) {
            if ($item['type'] == $key) {
                $contracts[$i]['typedescription'] = $value;
            } else {
                $contracts[$i]['typedescription'] = $item['type'];
            }
        }
        $i++;
    }
}

$SMARTY->assign('doc_types', $DOCTYPES);
$SMARTY->assign('expire_after_periods', $expire_after_periods);
$SMARTY->assign('selected_expires_after', $expires_after);
$SMARTY->assign('selected_doc_type', $doc_type);
$SMARTY->assign('count_contracts', count($contracts));
$SMARTY->assign('contracts', $contracts);
$SMARTY->display('endingagreements.html');
?>
