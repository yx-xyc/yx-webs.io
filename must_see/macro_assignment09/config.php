<?php
    $path = getcwd().'/databases';
    $db = new SQLite3($path.'/chat.db');
?>