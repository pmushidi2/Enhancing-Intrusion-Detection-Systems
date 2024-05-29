$dbh = new PDO('mysql:host=localhost;dbname=rapport_attaque', 'root', '');
        $sth = $dbh->prepare("SELECT * FROM rapport");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function afficher_rapport() {
        $data = get_rapport();
        $i = 1;
        foreach($data as $rapport) {
            echo '
            <tr>
                <td>'.$i.'</td>
                <td>'.$rapport['type_attaque'].'</td>
                <td>'.$rapport['ip'].'</td>
                <td>'.$rapport['country'].'</td>
<td>'.$rapport['country_code'].'</td>
                <td>'.$rapport['latitude'].'</td>
                <td>'.$rapport['longitude'].'</td>
                <td>'.$rapport['timezone'].'</td>
                <td>'.$rapport['continent_name'].'</td>
                <td>'.$rapport['continent_code'].'</td>
                <td>'.$rapport['date_rapport'].'</td>
            </tr>
            ';
            $i++;
        }
    }
