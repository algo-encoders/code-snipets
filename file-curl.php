<?php

function downloadUrlToFile($url, $outFileName)
{   
    if(is_file($url)) {
        copy($url, $outFileName); 
    } else {
        $options = array(
          CURLOPT_FILE    => fopen($outFileName, 'w'),
          CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
          CURLOPT_URL     => $url
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }
}

echo downloadUrlToFile('https://sparkai.azurewebsites.net/wp-content/ai1wm-backups/sparkai.azurewebsites.net-20220311-061155-773.wpress', 'sparkai.azurewebsites.net-20220311-061155-773.wpress');

exit;
