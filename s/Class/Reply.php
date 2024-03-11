<?php
    class Reply{
        private $error = "";

        public function create_post($data, $files) {
            if (!empty($data['name']) || !empty($data['message']) || !empty($files['file']['name'])) {
                $myimage = "";
                $has_image = 0;

                if (!empty($files['file']['name'])) {
                    $folder = "reply/" . $files . $data['message'] . $files . $data['name'] . $files . "/";
                        // create folder
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }

                        $image_class = new Image();


                        $myimage = $folder . $image_class->generate_filename(15) . ".jpg";
                        move_uploaded_file($_FILES['file']['tmp_name'], $myimage);

                    $has_image = 1;
                }
                $name = addslashes($data['name']);
                $message = addslashes($data['message']);
                $my_post_id = $_GET['number'];
                $query = "INSERT INTO s_reply (name, message, image, has_image, my_post_id) VALUES ('$name', '$message', '$myimage', '$has_image', '$my_post_id')";

                $DB = new DB();
                $DB->save($query);
            } else {
                $this->error = "Blank is not allowed";
            }
            return $this->error;
        }

        public function get_posts() {
            $my_post_id = $_GET['number'];
            $query = "SELECT * FROM s_reply WHERE my_post_id = '$my_post_id' ORDER BY number";
            $DB = new DB();
            $result = $DB->read($query);

            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
        public function get_one_post($number)
        {
    
            if(!is_numeric($number)){
    
                return false;
            }
    
            $query = "select * from posts where number = '$number' limit 1";
    
            $DB = new Database();
            $result = $DB->read($query);
    
            if($result)
            {
                return $result[0];
            }else
            {
                return false;
            }
        }
    }