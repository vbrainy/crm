<?php
$db_hostname = 'db_host_name';
$db_database = 'db_name';
$db_username = 'db_usrname';
$db_password = 'db_pass';
$db_server = new mysqli('localhost', 'airtelcr_airtelc', 'makings12', 'airtelcr_airtelcrm');
//$db_server = new mysqli('localhost', 'root', '', 'noemdek_airtelcrm');
if ($db_server->connect_errno) die('Error: ' . $db_server->connect_error);

function importContacts($columns, $rows) {
    global $db_server;

    // remove empty rows
    foreach ($rows as $key=>$row) {
        if (!$row['First Name'] || $row['First Name'] == '' || !$row['Last Name'] || $row['Last Name'] == '') {
            unset($rows[$key]);
        }
    }


    $tableColumns = array(
        'Contact ID' => 'id',
        'First Name' => 'first_name',
        'Last Name' => 'last_name',
        'Title' => 'title',
        'Address' => 'address',
        'City' => 'city_id',
        'State' => 'state_id',
        'Country' => 'country_id',
        'Job Position' => 'job_position',
        'Official Phone' => 'phone',
        'Mobile Phone' => 'mobile',
        'Email' => 'email',
        'Company' => 'company'
    );

    $columnTable = array_flip($tableColumns);

    $cities = array();
    $states = array();
    $countries = array();
    foreach ($rows as $row) {
        $cities["'" . $row['City'] . "'"] = 0;
        $states["'" . $row['State'] . "'"] = 0;
        $countries["'" . $row['Country'] . "'"] = 0;
    }

    $citiesQueryIn = implode(',', array_keys($cities));
    $getCities = $db_server->query("SELECT id, name FROM cities WHERE name IN ($citiesQueryIn)");
    if ($getCities) {
        while ($city = $getCities->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['City'] == $city['name']) {
                    $rows[$key]['City'] = $city['id'];
                }
            }
        }
    }

    $statesQueryIn = implode(',', array_keys($states));
    $getStates = $db_server->query("SELECT id, name FROM states WHERE name IN ($statesQueryIn)");
    if ($getStates) {
        while ($state = $getStates->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['State'] == $state['name']) {
                    $rows[$key]['State'] = $state['id'];
                }
            }
        }
    }

    $countriesQueryIn = implode(',', array_keys($countries));
    $getCountries = $db_server->query("SELECT id, name FROM countries WHERE name IN ($countriesQueryIn)");
    if ($getCountries) {
        while ($country = $getCountries->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Country'] == $country['name']) {
                    $rows[$key]['Country'] = $country['id'];
                }
            }
        }
    }

    // get all company references from file
    $allCompanies = array();
    foreach ($rows as $row) {
        $company = "'" . $row['Company'] . "'";
        if ($row['Company'] && !array_key_exists($company, $allCompanies)) {
            $allCompanies[$company] = 0;
        }
    }

    $companiesQueryIn = implode(',', array_keys($allCompanies));
    $getCompaniesInDb = $db_server->query("SELECT id, name FROM company WHERE name IN ($companiesQueryIn)");

    if ($getCompaniesInDb) {
        while ($company = $getCompaniesInDb->fetch_assoc()) {
            $allCompanies["'" . $company['name'] . "'"] = $company['id'];
        }
    }

    // insert missing companies
    $hasRef = false;
    $insertRefSql = "INSERT INTO company (name) VALUES ";
    foreach ($allCompanies as $name => $id) {
        if (!$id) {
            $insertRefSql .= "($name),";
            $hasRef = true;
        }
    }

    // update ids in company list
    if ($hasRef) {
        $db_server->query(rtrim($insertRefSql, ","));
        $getCompaniesInDb = $db_server->query("SELECT id, `name` FROM company WHERE `name` IN ($companiesQueryIn)");
        while ($company = $getCompaniesInDb->fetch_assoc()) {
            $allCompanies["'" . $company['company_name'] . "'"] = $company['customer_id'];
        }
    }

    // update company id in row
    foreach ($rows as $key=>$row) {
        $id = 0;
        if ($row['Company']) {
            $id = $allCompanies["'" . $row['Company'] . "'"];
        }
        $rows[$key]['Company'] = $id;
    }

    $lastId = $db_server->query("SELECT id FROM customer ORDER BY id DESC LIMIT 1");
    if ($lastId && $lastId->num_rows > 0) {
        $id = $lastId->fetch_assoc();
        $id = $id['id'];
    } else {
        $id = 0;
    }


    // find rows to update and remove them from rows
    $findSql = "SELECT id, first_name, last_name FROM customer WHERE ";
    for ($i = 0; $i < count($rows); $i++) {
        $findBy = array('first_name' => $rows[$i][$columnTable['first_name']], 'last_name' => $rows[$i][$columnTable['first_name']]);
        $firstname = "'" . $rows[$i][$columnTable['first_name']] . "'";
        $lastname = "'". $rows[$i][$columnTable['last_name']] . "'";

        if (!$rows[$i][$columnTable['first_name']] && !$rows[$i][$columnTable['last_name']]) continue;

        $findSql .= "(first_name = $firstname OR last_name = $lastname) OR ";
    }

    $existing = $db_server->query(rtrim($findSql, ' OR '));
    if ($existing) {
        while ($existingRow = $existing->fetch_assoc()) {
            for ($i = 0; $i < count($rows); $i++) {
                if ($rows[$i][$columnTable['last_name']] == $existingRow['last_name'] && $rows[$i][$columnTable['first_name']] == $existingRow['first_name']) {
                    $rows[$i]['id'] = $existingRow['id'];
                }
            }
        }
    }

    $noRowsForInsert = true;
    $lastId = $id + 1;
    $contactsInsertQuery = "INSERT INTO customer (id, first_name, last_name, title, address, city_id, state_id, country_id, job_position, phone, mobile, email, company) VALUES ";

    $copy = $rows;
    foreach ($copy as $row) {
        // skip if no name
        if (!$row[$columnTable['first_name']] && !$row[$columnTable['last_name']]) continue;
        if (isset($row['id']) && $row['id']) {
            continue; // has id so it's for update
        }
        $noRowsForInsert = false;

        $valuesSql = "(";

        // id
        $valuesSql .= "'" . $lastId . "',";
        $lastId++;

        foreach (array('first_name', 'last_name', 'title', 'address', 'city_id', 'state_id', 'country_id', 'job_position', 'phone', 'mobile', 'email', 'company') as $col) {
           $valuesSql .= "'" . $row[$columnTable[$col]] . "',";
        }

        $contactsInsertQuery .= rtrim($valuesSql, ',') . "),";
    }

    if (!$noRowsForInsert) {
        $inserted = $db_server->query(rtrim($contactsInsertQuery, ','));
        if (!$inserted) {
            return false;
        }
    }

    foreach ($rows as $row) {
        if (!isset($row['id']) || !$row['id']) continue;

        $setSql = "";
        foreach (array('first_name', 'last_name', 'title', 'address', 'city_id', 'state_id', 'country_id', 'job_position', 'phone', 'mobile', 'email', 'company') as $col) {
            $setSql .= "$col = '" . $row[$columnTable[$col]] . "',";
        }
        $setSql = rtrim($setSql,',');

        $query = "UPDATE contact SET $setSql WHERE id = '" . $row['id'] . "'";
        $updated = $db_server->query($query);
    }

    return true;
}

function importCustomers($columns, $rows) {
    global $db_server;

    // remove empty rows
    foreach ($rows as $key=>$row) {
        if (!$row['Company Name'] || $row['Company Name'] == '') {
            unset($rows[$key]);
        }
    }

    $cities = array();
    $states = array();
    $countries = array();
    foreach ($rows as $row) {
        $cities["'" . $row['City'] . "'"] = 0;
        $states["'" . $row['State'] . "'"] = 0;
        $countries["'" . $row['Country'] . "'"] = 0;
    }

    $citiesQueryIn = implode(',', array_keys($cities));
    $getCities = $db_server->query("SELECT id, name FROM cities WHERE name IN ($citiesQueryIn)");
    if ($getCities) {
        while ($city = $getCities->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['City'] == $city['name']) {
                    $rows[$key]['City'] = $city['id'];
                }
            }
        }
    }

    $statesQueryIn = implode(',', array_keys($states));
    $getStates = $db_server->query("SELECT id, name FROM states WHERE name IN ($statesQueryIn)");
    if ($getStates) {
        while ($state = $getStates->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['State'] == $state['name']) {
                    $rows[$key]['State'] = $state['id'];
                }
            }
        }
    }

    $countriesQueryIn = implode(',', array_keys($countries));
    $getCountries = $db_server->query("SELECT id, name FROM countries WHERE name IN ($countriesQueryIn)");
    if ($getCountries) {
        while ($country = $getCountries->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Country'] == $country['name']) {
                    $rows[$key]['Country'] = $country['id'];
                }
            }
        }
    }
    // find verticals
    $verticals = array();
    foreach ($rows as $key=>$row) {
        if ($row['Vertical']) {
            $verticals[$row['Vertical']] = 0;
        } else {
            $rows[$key]['Vertical'] = 0;
        }
    }
    $names = array_keys($verticals);
    $sqlFindVerticals = "SELECT id, vertical_name FROM vertical WHERE vertical_name IN (";
    foreach ($names as $name) {
        $sqlFindVerticals .= "'" . $name . "',";
    }
    $sqlFindVerticals = rtrim($sqlFindVerticals, ',') . ")";
    $existing = $db_server->query($sqlFindVerticals);
    while ($existing && $existingRow = $existing->fetch_assoc()) {
        foreach ($rows as $key => $row) {
            if ($row['Vertical'] == $existingRow['vertical_name']) {
                $rows[$key]['vertical_id'] = $existingRow['id'];
            }
        }
    }

    // find sub verticals
    $subverticals = array();
    foreach ($rows as $key=>$row) {
        if ($row['Sub Vertical']) {
            $subverticals[$row['Sub Vertical']] = 0;
        } else {
            $rows[$key]['Sub Vertical'] = 0;
        }
    }
    $names = array_keys($verticals);
    $sqlFindVerticals = "SELECT id, subvertical_name FROM subverticals WHERE subvertical_name IN (";
    foreach ($names as $name) {
        $sqlFindVerticals .= "'" . $name . "',";
    }
    $sqlFindVerticals = rtrim($sqlFindVerticals, ',') . ")";
    $existing = $db_server->query($sqlFindVerticals);
    while ($existing && $existingRow = $existing->fetch_assoc()) {
        foreach ($rows as $key => $row) {
            if ($row['Sub Vertical'] == $existingRow['subvertical_name']) {
                $rows[$key]['subvertical_id'] = $existingRow['id'];
            }
        }
    }



    // SET CONTACT IDS
    $findSql = "SELECT id, first_name, last_name FROM customer WHERE ";
    foreach ($rows as $row) {
        $findBy = array('first_name' => $row['Main Contact First Name'], 'last_name' => $row['Main Contact Last Name']);
        $firstname = "'" . $row['Main Contact First Name'] . "'";
        $lastname = "'". $row['Main Contact Last Name'] . "'";

        if (!$row['Main Contact First Name'] || !$row['Main Contact Last Name']) continue;

        $findSql .= "(first_name = $firstname OR last_name = $lastname) OR ";
    }
    $existing = $db_server->query(rtrim($findSql, ' OR '));
    if ($existing) {
        while ($existingRow = $existing->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Main Contact Last Name'] == $existingRow['last_name'] && $row['Main Contact First Name'] == $existingRow['first_name']) {
                    $rows[$key]['contact_id'] = $existingRow['id'];
                }
            }
        }
    }

    foreach ($rows as $key=>$row) {
        $row['customer_id'] = 0;
        if (!isset($row['contact_id'])) $rows[$key]['contact_id'] = 0;
        if (!isset($row['subvertical_id'])) $rows[$key]['subvertical_id'] = 0;
        if (!isset($row['vertical_id'])) $rows[$key]['vertical_id'] = 0;
        if (!isset($row['segment_id'])) $rows[$key]['segment_id'] = 0;
    }



    $lastId = $db_server->query("SELECT id FROM company ORDER BY id DESC LIMIT 1");
    if ($lastId && $lastId->num_rows > 0) {
        $id = $lastId->fetch_assoc();
        $id = $id['id'];
    } else {
        $id = 0;
    }


    // find rows to update and remove them from rows
    $findSql = "SELECT id, name FROM company WHERE ";
    foreach ($rows as $row) {
        $findSql .= "name = '". $row['Company Name'] . "' OR ";
    }

    $existing = $db_server->query(rtrim($findSql, ' OR '));
    if ($existing) {
        while ($existingRow = $existing->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Company Name'] == $existingRow['name']) {
                    $rows[$key]['customer_id'] = $existingRow['id'];
                }
            }
        }
    }

    $hasRowsToInsert = false;
    $lastId = $id + 1;
    $insert = "INSERT INTO company (id, name, address, city_id, state_id, country_id, main_contact_person, website, phone, fax, segment_id, subverticals, vertical, register_time) VALUES ";
    foreach ($rows as $row) {
        if (isset($row['customer_id']) && $row['customer_id']) continue; // insert
        $hasRowsToInsert = true;
        $name = $row['Company Name'];
        $address = $row['Address'];
        $city = $row['City'];
        $states = $row['State'];
        $country = $row['Country'];
        $website = $row['Website'];
        $phone = $row['Office Phone'];
        $fax = $row['Office Fax'];
        $segment_id = $row['segment_id'];
        $subverticals_id = $row['subvertical_id'];
        $vert_id = $row['vertical_id'];
        $main_contact_id = $row['contact_id'];
        $time = time();

        $insert .= "(NULL, '$name', '$address', '$city', '$states', '$country', '$main_contact_id', '$website', '$phone', '$fax', '$segment_id', '$subverticals_id', '$vert_id', '$time'),";
    }

    if ($hasRowsToInsert) {
        $inserted = $db_server->query(rtrim($insert, ','));
    }


    foreach ($rows as $row) {
        if (!isset($row['customer_id'])) continue; // update

        $name = $row['Company Name'];
        $address = $row['Address'];
        $city = $row['City'];
        $states = $row['State'];
        $country = $row['Country'];
        $website = $row['Website'];
        $phone = $row['Office Phone'];
        $fax = $row['Office Fax'];
        $segment_id = $row['segment_id'];
        $subverticals_id = $row['subvertical_id'];
        $vert_id = $row['vertical_id'];

        $setSql = "name = '$name', address = '$address', city = '$city', states = '$states', country = '$country', website = '$website', phone = '$phone', fax = '$fax', segment_id = '$segment_id', subverticals_id = '$subverticals_id', subverticals_vertical_id = '$vert_id'";

        $query = "UPDATE company SET $setSql WHERE id = '" . $row['customer_id'] . "'";
        $updated = $db_server->query($query);
    }

    return true;
}



function importLeads($columns, $rows) {
    global $db_server;

    foreach ($rows as $k=>$row) {
        if (!$row['Company Name'] || $row['Company Name'] == '') {
            unset($rows[$k]);
        }
    }

    $companies = array();
    $staffs = array();
    $contacts = array();
    $sources = array();

    foreach ($rows as $key=>$row) {
        $rows[$key]['company_id'] = 0;
        $rows[$key]['staff_id'] = 0;
        $rows[$key]['customer_id'] = 0;
        $rows[$key]['source_id'] = 0;

        $companies[$row['Company Name']] = 0;
        $staffs[$row['Sales User ID']] = 0;
        $contacts[] = array('first_name' => $row['Contact First Name'], 'last_name' => $row['Contact Last Name']);
        $sources[$row['Source']] = 0;
    }

    //  customer reference
    $findSql = "SELECT id, name FROM company WHERE ";
    foreach ($companies as $name => $id) {
        $findSql .= "name = '". $name . "' OR ";
    }

    $existing = $db_server->query(rtrim($findSql, ' OR '));
    if ($existing) {
        while ($existingRow = $existing->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Company Name'] == $existingRow['name']) {
                    $rows[$key]['company_id'] = $existingRow['id'];
                }
            }
        }
    }

    // contacts references
    $findSql = "SELECT id, first_name, last_name FROM customer WHERE ";
    foreach ($contacts as $contact) {
        $findSql .= "(first_name = '". $contact['first_name'] . "' AND last_name = '".$contact['last_name']."') OR ";
    }

    $existing = $db_server->query(rtrim($findSql, ' OR '));
    if ($existing) {
        while ($existingRow = $existing->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Contact First Name'] == $existingRow['first_name'] && $row['Contact Last Name'] == $existingRow['last_name']) {
                    $rows[$key]['customer_id'] = $existingRow['id'];
                }
            }
        }
    }

    // source reference
    $findSql = "SELECT id, source FROM sources WHERE ";
    foreach ($sources as $source => $id) {
        $findSql .= "source = '$source' OR ";
    }

    $existing = $db_server->query(rtrim($findSql, ' OR '));
    if ($existing) {
        while ($existingRow = $existing->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Source'] == $existingRow['source']) {
                    $rows[$key]['source_id'] = $existingRow['id'];
                }
            }
        }
    }



    $lastId = $db_server->query("SELECT id FROM leads ORDER BY id DESC LIMIT 1");
    if ($lastId && $lastId->num_rows > 0) {
        $id = $lastId->fetch_assoc();
        $id = $id['id'];
    } else {
        $id = 0;
    }

    $lastId = $id + 1;
    $insertQuery = "INSERT INTO leads (id, customer, company_name, opportunity, priority, sources, tags, register_time) VALUES ";

    foreach ($rows as $row) {

        $values = array(
            'id' => $lastId,
            'customer' => $row['customer_id'],
            'company_name' => $row['Company'],
            'opportunity' => $row['Opportunity'],
            'priority' => $row['Priority'],
            'sources' => $row['Source'],
            'tags' => $row['Tags'],
            'register_time' => strtotime($row['Intro Date'])
        );
        $lastId++;

        $insertQuery .= '(\'' . implode("','", $values) . '\'),';
    }

    $inserted = $db_server->query(rtrim($insertQuery, ','));
    return $inserted;
}

function importOpportunities($columns, $rows) {
    global $db_server;

    // remove empty rows
    foreach ($rows as $key=>$row) {
        if (!$row['Opportunity'] || $row['Opportunity'] == '') {
            unset($rows[$key]);
        }
    }

    $companies = array();
    $contacts = array();
    $products = array();

    foreach ($rows as $key=>$row) {
        $rows[$key]['customer_id'] = 0;
        $rows[$key]['contact_id'] = 0;
        $rows[$key]['product_id'] = 0;

        $companies[$row['Company Name']] = 0;
        $contacts[] = array('first_name' => $row['Contact First Name'], 'last_name' => $row['Contact Last Name']);
        $products[$row['Product Name']] = 0;
    }
//
//    //  customer reference
//    $findSql = "SELECT customer_id, company_name FROM customer WHERE ";
//    foreach ($companies as $name => $id) {
//        $findSql .= "company_name = '". $name . "' OR ";
//    }
//
//    $existing = $db_server->query(rtrim($findSql, ' OR '));
//    if ($existing) {
//        while ($existingRow = $existing->fetch_assoc()) {
//            foreach ($rows as $key => $row) {
//                if ($row['Company Name'] == $existingRow['company_name']) {
//                    $rows[$key]['customer_id'] = $existingRow['customer_id'];
//                }
//            }
//        }
//    }


    //  product reference
//    $findSql = "SELECT id, product_name FROM products WHERE ";
//    foreach ($products as $name => $id) {
//        $findSql .= "product_name = '". $name . "' OR ";
//    }
//
//    $existing = $db_server->query(rtrim($findSql, ' OR '));
//    if ($existing) {
//        while ($existingRow = $existing->fetch_assoc()) {
//            foreach ($rows as $key => $row) {
//                if ($row['Product Name'] == $existingRow['product_name']) {
//                    $rows[$key]['product_id'] = $existingRow['product_id'];
//                }
//            }
//        }
//    }


    // contacts references
    $findSql = "SELECT id, first_name, last_name FROM customer WHERE ";
    foreach ($contacts as $contact) {
        $findSql .= "(first_name = '". $contact['first_name'] . "' AND last_name = '".$contact['last_name']."') OR ";
    }
    $existing = $db_server->query(rtrim($findSql, ' OR '));
    if ($existing) {
        while ($existingRow = $existing->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Contact First Name'] == $existingRow['first_name'] && $row['Contact Last Name'] == $existingRow['last_name']) {
                    $rows[$key]['customer_id'] = $existingRow['id'];
                }
            }
        }
    }

    $lastId = $db_server->query("SELECT id FROM opportunities ORDER BY id DESC LIMIT 1");
    if ($lastId && $lastId->num_rows > 0) {
        $id = $lastId->fetch_assoc();
        $id = $id['id'];
    } else {
        $id = 0;
    }

    $lastId = $id + 1;
    $insertQuery = "INSERT INTO opportunities (id, opportunity, stages, customer, probability, next_action_title, expected_closing, identified_date, closed_date, priority, tags, lost_reason, internal_notes, register_time) VALUES ";


    foreach ($rows as $row) {

        $values = array(
            'id' => $lastId,
            'opportunity' => $row['Opportunity'],
            'stages' => $row['Stages'],
            'customer' => $row['customer_id'],
            'probability' => $row['Probability'],
            'next_action_title' => $row['Next Action Title'],
            'expected_closing' => $row['expected_closing'],
            'identified_date' => $row['identified_date'],
            'closed_date' => $row['closed_date'],
            'priority' => $row['priority'],
            'tags' => $row['tags'],
            'lost_reason' => $row['lost_reason'],
            'internal_notes' => $row['internal_notes'],
            'register_time' => $row['register_time']
        );
        $lastId++;

        $insertQuery .= '(\'' . implode("','", $values) . '\'),';
    }

    $inserted = $db_server->query(rtrim($insertQuery, ','));
    return $inserted;
}

function importProducts($columns, $rows) {
    global $db_server;


    foreach ($rows as $k=>$row) {
        if (!$row['Product'] || $row['Product'] == '') {
            unset($rows[$k]);
        }
    }

    $names = array();
    foreach ($rows as $row) {
        $names[] = $row['Product'];
    }

    $findSql = "SELECT id, product_name FROM products WHERE product_name IN ('" . implode("','", $names) . "')";
    $existing = $db_server->query($findSql);

    if ($existing) {
        while ($existingRow = $existing->fetch_assoc()) {
            foreach ($rows as $key => $row) {
                if ($row['Product'] == $existingRow['product_name']) {
                    unset($rows[$key]);
                }
            }
        }
    }

    $inserQuery = "INSERT INTO products (product_name, product_type) VALUES ";
    $hasRowsToInsert = false;
    foreach ($rows as $row) {
        if (!$row['Product']) continue;

        $name = $row['Product'];
        $type = $row['Product Type'];
        $inserQuery .= "('$name', '$type'),";
        $hasRowsToInsert = true;
    }
    if ($hasRowsToInsert) {
        $inserQuery = rtrim($inserQuery, ',');
        $db_server->query($inserQuery);
    }

    return true;
}

function importSalesInfo($columns, $rows) {
    global $db_server;


    foreach ($rows as $k => $row) {
        if (!$row['First Name'] || $row['First Name'] == '' || !$row['Last Name'] || $row['Last Name'] == '') {
            unset($rows[$k]);
        }
    }


    $regions = array();
    foreach ($rows as $key=>$row) {
        if ($row['Assigned Region']) {
            $regions[] = $row['Assigned Region'];
        }

        $rows[$key]['region_id'] = 0;
    }


    $contactRows = array();

    foreach ($rows as $row) {
        $contactRows[] = array(
            'First Name' => $row['First Name'],
            'Last Name' => $row['Last Name'],
            'Title' => $row['Title'],
            'Address' => '',
            'City' => '',
            'State' => '',
            'Country' => '',
            'Job Position' => $row['Job Title'],
            'Official Phone' => '',
            'Mobile Phone' => $row['Mobile Phone'],
            'Email' => $row['Email'],
            'Company' => ''
        );
    }

    return importContacts(array(), $contactRows);
}

function importVerticals($columns, $rows) {
    global $db_server;

    foreach ($rows as $k=>$row) {
        if (!$row['Sub vertical'] || $row['Sub vertical'] == '') {
            unset($rows[$k]);
        }
    }

    // remove existing subverticals from rows
    $subverticals = array();
    foreach ($rows as $row) {
        $subverticals[$row['Sub vertical']] = 0;
    }
    $subvertnames = array_keys($subverticals);

    $sqlFindVerticals = "SELECT id, subvertical_name FROM subverticals WHERE subvertical_name IN (";
    foreach ($subvertnames as $name) {
        $sqlFindVerticals .= "'" . $name . "',";
    }
    $sqlFindVerticals = rtrim($sqlFindVerticals, ',') . ")";

    $existing = $db_server->query($sqlFindVerticals);
    while ($existing && $row = $existing->fetch_assoc()) {
        $subvertname = $row['subvertical_name'];
        foreach ($rows as $key=>$row) {
            if ($row['Sub vertical'] == $subvertname) {
                unset($rows[$key]);
            }
        }
    }

    // find verticals
    $verticals = array();
    foreach ($rows as $row) {
        $verticals[$row['Vertical']] = 0;
    }
    $names = array_keys($verticals);

    $sqlFindVerticals = "SELECT id, vertical_name FROM vertical WHERE vertical_name IN (";
    foreach ($names as $name) {
        $sqlFindVerticals .= "'" . $name . "',";
    }
    $sqlFindVerticals = rtrim($sqlFindVerticals, ',') . ")";

    $existing = $db_server->query($sqlFindVerticals);
    while ($existing && $row = $existing->fetch_assoc()) {
        $verticals[$row['vertical_name']] = $row['id'];
    }

    // last vert id
    $lastId = $db_server->query("SELECT id FROM vertical ORDER BY id DESC LIMIT 1");
    if ($lastId && $lastId->num_rows > 0) {
        $lastId = $lastId->fetch_assoc();
        $lastId = $lastId['id'];
    } else {
        $lastId = 0;
    }

    $lastId = $lastId + 1;
    // insert missing verticals
    $insertVert = "INSERT INTO vertical (id, vertical_name) VALUES ";
    foreach ($verticals as $name => $id) {
        if (!$id) {
            $insertVert .= "('$lastId', '$name'),";
            $lastId++;
        }
    }
    $insertVert = rtrim($insertVert, ',');
    $insertedVerts = $db_server->query($insertVert);

    // get inserted verts ids
    $existing = $db_server->query($sqlFindVerticals);
    while ($existing && $row = $existing->fetch_assoc()) {
        $verticals[$row['vertical_name']] = $row['id'];
    }


    // set vert ids in rows
    foreach ($rows as $key=>$row) {
        $id = 0;
        if ($row['Vertical']) {
            $id = $verticals[$row['Vertical']];
        }
        $rows[$key]['Vertical'] = $id;
    }


    // last subvert id
    $lastId = $db_server->query("SELECT id FROM subverticals ORDER BY id DESC LIMIT 1");
    if ($lastId && $lastId->num_rows > 0) {
        $lastId = $lastId->fetch_assoc();
        $lastId = $lastId['id'];
    } else {
        $lastId = 0;
    }

    $lastId = $lastId + 1;
    // insert subverticals
    $insert = "INSERT INTO subverticals (id, subvertical_name, vertical_id) VALUES ";

    foreach ($rows as $row) {
        if (!$row['Sub vertical']) continue;

        $n = $row['Sub vertical'];
        $v = $row['Vertical'];
        $insert .= "('$lastId', '$n', '$v'),";
        $lastId++;
    }

    $inserted = $db_server->query(rtrim($insert, ','));
    return $inserted;
}

