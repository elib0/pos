<?php

if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

$reportdata["title"] = "Aging Invoices";
$reportdata["description"] = "A summary of outstanding invoices broken down into the period of which they are overdue";

$reportdata["tableheadings"][] = "Period";

foreach ($currencies AS $currencyid=>$currencyname) {
    $reportdata["tableheadings"][] = "$currencyname Amount";
}

$totals = array();

for ( $day = 0; $day < 120; $day += 30) {
    $startdate = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$day,date("Y")));
    $enddate = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-($day+30),date("Y")));
    $rowdata = array();
    $rowdata[] = "$day - ".($day+30);
    $currencytotals = array();
    $query = "SELECT tblclients.currency,SUM(tblinvoices.total),(SELECT SUM(amountin-amountout) FROM tblaccounts INNER JOIN tblinvoices ON tblinvoices.id=tblaccounts.invoiceid INNER JOIN tblclients t2 ON t2.id=tblinvoices.userid WHERE tblinvoices.duedate<='$startdate' AND tblinvoices.duedate>='$enddate' AND tblinvoices.status='Unpaid' AND t2.currency=tblclients.currency) FROM tblinvoices INNER JOIN tblclients ON tblclients.id=tblinvoices.userid WHERE tblinvoices.duedate<='$startdate' AND tblinvoices.duedate>='$enddate' AND tblinvoices.status='Unpaid' GROUP BY tblclients.currency";
    $result = mysql_query($query);
    while ($data = mysql_fetch_array($result)) {
        $currencytotals[$data[0]] = $data[1]-$data[2];
    }
    foreach ($currencies AS $currencyid=>$currencyname) {
        $currencyamount = $currencytotals[$currencyid];
        if (!$currencyamount) $currencyamount=0;
        $totals[$currencyid] += $currencyamount;
        $currency = getCurrency('',$currencyid);
        $rowdata[] = formatCurrency($currencyamount);
    }
    $reportdata["tablevalues"][] = $rowdata;
}

$startdate = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-120,date("Y")));
$rowdata = array();
$rowdata[] = "120 +";
$currencytotals = array();
$query = "SELECT tblclients.currency,SUM(tblinvoices.total) FROM tblinvoices INNER JOIN tblclients ON tblclients.id=tblinvoices.userid WHERE tblinvoices.duedate<='$startdate' AND tblinvoices.status='Unpaid' GROUP BY tblclients.currency";
$result = mysql_query($query);
while ($data = mysql_fetch_array($result)) {
        $currencytotals[$data[0]] = $data[1];
}
foreach ($currencies AS $currencyid=>$currencyname) {
        $currencyamount = $currencytotals[$currencyid];
        if (!$currencyamount) $currencyamount=0;
        $totals[$currencyid] += $currencyamount;
        $currency = getCurrency('',$currencyid);
        $rowdata[] = formatCurrency($currencyamount);
}
$reportdata["tablevalues"][] = $rowdata;

$rowdata = array();
$rowdata[] = "<b>Total</b>";
foreach ($currencies AS $currencyid=>$currencyname) {
        $currencytotal = $totals[$currencyid];
        if (!$currencytotal) $currencytotal=0;
        $currency = getCurrency('',$currencyid);
        $rowdata[] = "<b>".formatCurrency($currencytotal)."</b>";
}

$reportdata["tablevalues"][] = $rowdata;

?>