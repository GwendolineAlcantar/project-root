<?php function perform_http_request($method, $url, $data = false) {
    $curl = curl_init();
    $headers = array(
        'Content-Type:application/json',
        'X-API-KEY: kkkcc4o4gsko8w0wg084k4o8s4wggwcosk8okgw4'
    );

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			}
			
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
			
            break;
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
			}
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //If SSL Certificate Not Available, for example, I am calling from http://localhost URL

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
?>