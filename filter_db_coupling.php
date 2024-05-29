function create_rapport($type_attaque) {
        $internaute_info = null;

        $ip_info = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp"));  

        if($ip_info && $ip_info->geoplugin_countryName != null){
            $internaute_info = array(
                'type_attaque' => $type_attaque,
                'ip' => $ip_info->geoplugin_request,
                'country' => $ip_info->geoplugin_countryName,
                'country_code' => $ip_info->geoplugin_countryCode,
                'latitude' => $ip_info->geoplugin_latitude,
                'longitude' => $ip_info->geoplugin_longitude,
                'timezone' => $ip_info->geoplugin_timezone,
                'continent_name' => $ip_info->geoplugin_continentName,
                'continent_code' => $ip_info->geoplugin_continentCode,
                'date_rapport' => date('Y-m-d H:i:s', time())
            );
            $bdd = new PDO('mysql:host=localhost;dbname=rapport_attaque', 'root', '');
            $sql = "INSERT INTO rapport VALUES 
                    (null, :type_attaque, :ip, :country, 
                    :country_code, :latitude, :longitude,
                    :timezone, :continent_name, :continent_code,
                    :date_rapport)";
            $bdd->prepare($sql)->execute($internaute_info);
        }
}
