<?php

$chart = $_GET['chart'];

$db_hostname = 'db_host_name';
$db_database = 'db_name';
$db_username = 'db_usrname';
$db_password = 'db_pass';
$db_server = new mysqli('localhost', 'airtelcr_airtelc', 'makings12', 'airtelcr_airtelcrm');
//$db_server = new mysqli('localhost', 'root', '', 'noemdek_airtelcrm');
if ($db_server->connect_errno) die('Error: ' . $db_server->connect_error);


function getLastSixMonths() {
    $first  = strtotime('first day this month');
    $months = array();

    $nextMonth = $first;
    for ($i = 6; $i >= 1; $i--) {
        $monthTime = strtotime("-$i month", $first);
        $months[] = array(
            'start' => $monthTime,
            'end' => strtotime("+1 month", $monthTime),
            'name' => date('M', $monthTime)
        );
        $nextMonth = $monthTime;
    }

    return $months;
}

$lastSixMonths = getLastSixMonths();

$type = '';

if ($chart == 'lead_volume_by_region') {
    $type = 'line';
    $query = "SELECT COUNT(*) as total, regions.region AS grouping
            FROM `leads`
            INNER JOIN company ON leads.customer = company.id 
            INNER JOIN regions ON company.regions = regions.id
            WHERE leads.register_time >= ':start' AND leads.register_time <= ':end'
            GROUP BY regions.id";
}

if ($chart == 'lead_volume_by_segment') {
    $type = 'line';
    $query = "SELECT COUNT(*) as total, segments.segment AS grouping
            FROM `leads`
            INNER JOIN segments ON leads.segment_id = segments.id
            WHERE leads.register_time >= ':start' AND leads.register_time <= ':end'
            GROUP BY segments.id";
}

if ($chart == 'lead_volume_by_source') {
    $type = 'line';
    $query = "SELECT COUNT(*) as total, leads.sources AS grouping
            FROM leads
            WHERE leads.register_time >= ':start' AND leads.register_time <= ':end'
            GROUP BY leads.sources";
}

if ($type == 'line') {

    $lines = array();
    foreach ($lastSixMonths as $month) {
        $start = $month['start'];
        $end = $month['end'];

        $monthQuery = str_replace(':start', $start, $query);
        $monthQuery = str_replace(':end', $end, $monthQuery);

        $result = $db_server->query($monthQuery);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if (isset($lines[$row['grouping']])) {
                    $lines[$row['grouping']][$month['name']] = $row['total'];
                } else {
                    $lines[$row['grouping']] = [$month['name'] => $row['total']];
                }
            }
        }
    }

    $result = array();
    foreach ($lines as $group => $data) {
        $dataSet = array(
            'group' => $group,
            'data' => array()
        );

        foreach ($lastSixMonths as $month) {
            $dataSet['data'][] = array(
                'name' => $month['name'],
                'value' => isset($data[$month['name']]) ? $data[$month['name']] : 0
            );
        }

        $result[] = $dataSet;
    }
}



if ($chart == 'total_value_opportunities_by_region') {
    $type = 'bar';
    $query = "SELECT SUM(opportunities.expected_revenue) AS total, regions.region AS grouping
            FROM opportunities
            INNER JOIN regions ON regions.id = opportunities.region_id
            WHERE opportunities.identified_date >= ':start' AND opportunities.identified_date <= ':end'
            GROUP BY regions.id";
}

if ($chart == 'total_value_opportunities_by_segment') {
    $type = 'bar';
    $query = "SELECT SUM(opportunities.expected_revenue) AS total, segments.segment AS grouping
            FROM opportunities
            INNER JOIN segments ON opportunities.segment_id = segments.id
            WHERE opportunities.identified_date >= ':start' AND opportunities.identified_date <= ':end'
            GROUP BY segments.id";
}


if ($chart == 'average_value_opportunities_by_stage') {
    $type = 'bar';
    $query = "SELECT AVG(opportunities.expected_revenue) AS total, opportunities.stages AS grouping
            FROM opportunities
            WHERE opportunities.identified_date >= ':start' AND opportunities.identified_date <= ':end'
            GROUP BY opportunities.stages";
}

if ($chart == 'average_value_opportunities_by_segment') {
    $type = 'bar';
    $query = "SELECT AVG(opportunities.expected_revenue) AS total, segments.segment AS grouping
            FROM opportunities
            INNER JOIN segments ON opportunities.segment_id = segments.id
            WHERE opportunities.identified_date >= ':start' AND opportunities.identified_date <= ':end'
            GROUP BY segments.id";
}


if ($chart == 'total_value_opportunities_by_stage') {
    $type = 'bar';
    $query = "SELECT SUM(opportunities.expected_revenue) AS total, opportunities.stages AS grouping
            FROM opportunities
            WHERE opportunities.identified_date >= ':start' AND opportunities.identified_date <= ':end'
            GROUP BY opportunities.stages";
}

if ($chart == 'total_opportunities_by_stage') {
    $type = 'bar';
    $query = "SELECT COUNT(*) AS total, opportunities.stages AS grouping
            FROM opportunities
            WHERE opportunities.identified_date >= ':start' AND opportunities.identified_date <= ':end'
            GROUP BY opportunities.stages";
}

if ($type == 'bar') {

	$filter = '1m';
	$start = strtotime("-1 months");
	$end = time();

	if (isset($_GET['filter'])) {
		$filter = $_GET['filter'];
	}

	if ($filter == '3m') {
		$start = strtotime("-3 months");
	}

	if ($filter == '6m') {
		$start = strtotime("-6 months");
	}

	if ($filter == '9m') {
		$start = strtotime("-9 months");
	}

	if ($filter == '1y') {
		$start = strtotime("-1 years");
	}

	if ($filter == 'All') {
		$start = 0;
	}

	$startDate = date('Y-m-d', $start);
	$endDate = date('Y-m-d', $end);

	if ($start !== 0) {
		$query = str_replace(':start', $startDate, $query);
		$query = str_replace(':end', $endDate, $query);
	} else {
		$query = str_replace("WHERE opportunities.identified_date >= ':start' AND opportunities.identified_date <= ':end'", '', $query);
	}
//print_r($query);die;
    $results = $db_server->query($query);
    $data = array();
    if ($results) {
        while ($row = $results->fetch_assoc()) {
            $data[] = array('name' => $row['grouping'], 'value' => round($row['total'], 2));
        }
    }
    $result = array('data' => $data);
}

echo json_encode($result);