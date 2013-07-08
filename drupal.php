<?php

require_once('workflows.php');

function query($orig) 
{
    $wf = new Workflows();
    $data = $wf->request('https://api.drupal.org/api/search/autocomplete/24/' . $orig, array(
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36',
    ));
    $items = json_decode($data);
    $results = array();
    foreach ($items as $key => $value) {
        $results[] = array(
            'uid' => $key,
            'arg' => $value,
            'title' => $value,
            //'subtitle' => 'Some item subtitle',
            'icon' => 'druplicon.small.png',
            'valid' => 'yes',
            'autocomplete' => 'autocomplete'
        );
    }
    echo $wf->toxml($results);
}

