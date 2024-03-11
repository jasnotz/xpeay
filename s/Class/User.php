<?php
    class User {
        public function get_user($name) {
            $query = "SELECT * FROM msg_board where name = '$name' LIMIT 1";
            $DB = new DB();
            $result = $DB->read($query);

            if ($result) {
                return $result[0];
            } else {
                return false;
            }
        }
    }