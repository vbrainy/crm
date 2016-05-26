<?php

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

$db_hostname = 'db_host_name';
$db_database = 'db_name';
$db_username = 'db_usrname';
$db_password = 'db_pass';
$db_server = new mysqli('localhost', 'airtelcr_airtelc', 'makings12', 'airtelcr_airtelcrm');
//$db_server = new mysqli('localhost', 'root', '', 'noemdek_airtelcrm');

if ($db_server->connect_errno) die('Error: ' . $db_server->connect_error);

$query = "SELECT
op.id as ID,
company.name as CompanyName,
regions.region as Region,
segments.segment as Segment,
vertical.vertical_name as Vertical,
subverticals.subvertical_name as SubVertical,
op.stages as SalesStage,
op.probability as Probability,
'' as Capacity,
'' as Unit,
'' as QTY,
'' as NRC,
'' as UnitMRC,
'' as TotalMRC,
'' as ARC,
op.identified_date as IdentifiedDate,
op.closed_date as ClosedDate,
DATEDIFF(op.identified_date, op.closed_date) as Duration,
'' as Ageing,
customer.first_name as ContactFirstName,
customer.last_name as ContactLastName,
customer.email as ContactEmail

FROM opportunities op
LEFT JOIN customer ON customer.id = op.customer
LEFT JOIN company ON customer.company = company.id
LEFT JOIN regions ON op.region_id = regions.id
LEFT JOIN segments ON op.segment_id = segments.id

LEFT JOIN vertical ON op.vertical_id = vertical.id
LEFT JOIN subverticals ON op.subvertical_id = subverticals.id
";

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    if (!$_GET['start_date']) {
        $start = '0000-00-00';
    } else {
        $start = $_GET['start_date'];
    }
    if (!$_GET['end_date']) {
        $end = date('Y-m-d');
    } else {
        $end = $_GET['end_date'];
    }
    $query .= " WHERE identified_date >= '" . $start . "' AND identified_date <= '" . $end . "'";
}

$results = $db_server->query($query);

if ($results) {
    $rows = array();
    while ($row = $results->fetch_assoc()) { $rows[] = $row; }

    $headers = array();
    $fields = array();
    foreach ($rows as $row) {
        if (!count($headers)) {
            $headers = array_keys($row);
        }

        if ($row['IdentifiedDate'] != '0000-00-00') {
            $row['IdentifiedDate'] = date('m/d/y', strtotime($row['IdentifiedDate']));
        } else {
            $row['IdentifiedDate'] = '-';
        }
        if ( $row['ClosedDate'] != '0000-00-00') {
            $row['ClosedDate'] = date('m/d/y', strtotime($row['ClosedDate']));
        } else {
            $row['ClosedDate'] = '-';
        }

        if ($row['IdentifiedDate'] != '0000-00-00' && $row['ClosedDate'] != '0000-00-00') {
            $row['Duration'] = round((strtotime($row['ClosedDate']) - strtotime($row['IdentifiedDate'])) / 86400);
        }

        $fields[] = array_values($row);
    }

    fputcsv($output, $headers);

    foreach ($fields as $fieldset) {
        fputcsv($output, $fieldset);
    }
} else {
    die('Error connecting to database');
}