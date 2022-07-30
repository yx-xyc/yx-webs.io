
<?php
    include('config.php');
    $username = $_POST['username'];
    $sql = "SELECT * FROM records WHERE (username = '$username') ORDER BY date_time desc";
    $results = $db->query($sql);
    $return_array = array();
    while ($row = $results->fetchArray()){
        $result_array = array();
        $result_array['username'] = $row['username'];
        $result_array['game_time'] = $row['game_time'];
        $result_array['date_time'] = $row['date_time'];
        $result_array['hardness'] = $row['hardness'];
        array_push($return_array, $result_array);
    }
    print json_encode($return_array);
    exit();
?>

