<?php

function getFirstYear() {
    global $LMS, $SMARTY, $DB, $SESSION;
    $firstYear = $DB->GetOne('SELECT MIN( creationdate ) FROM customers');
    return $firstYear;
}

function addedCustomers($year) {
    global $LMS, $SMARTY, $DB, $SESSION;
    $newcustomers = $DB->GetAll('
    SELECT COUNT(id) AS customers, MONTH(FROM_UNIXTIME(creationdate)) as month
    FROM customers
    WHERE deleted=0 AND YEAR(FROM_UNIXTIME(creationdate))=' . $year . ' 
    GROUP BY MONTH(FROM_UNIXTIME(creationdate))
    ');
    return $newcustomers;
}

function deletedCustomers($year) {
    global $LMS, $SMARTY, $DB, $SESSION;
    $deletedcustomers = $DB->GetAll('
    SELECT COUNT(id) AS customers, MONTH(FROM_UNIXTIME(moddate)) as month
    FROM customers
    WHERE deleted=1 AND YEAR(FROM_UNIXTIME(moddate))=' . $year . ' 
    GROUP BY MONTH(FROM_UNIXTIME(moddate))
    ');
    return $deletedcustomers;
}

if (!$_GET['year'] > 0)
    $_GET['year'] = date("Y", time());

$added = addedCustomers($_GET['year']);
$deleted = deletedCustomers($_GET['year']);

for ($m = 0; $m < 12; $m++) {
    $balance[] = array('month' => $m + 1, 'customers' => $added[$m]['customers'] - $deleted[$m]['customers']);
}

for ($m = 0; $m < 12; $m++) {
    $customers[] = array(
        'month' => $m + 1,
        'added' => $added[$m]['customers'],
        'deleted' => $deleted[$m]['customers'],
        'balance' => $balance[$m]['customers']
    );
}

$SMARTY->assign('customers', $customers);
$SMARTY->assign('firstYear', date("Y", getFirstYear()));
$SMARTY->assign('currentYear', date("Y", time()));
$SMARTY->display('balanceconnections.html');
?>
