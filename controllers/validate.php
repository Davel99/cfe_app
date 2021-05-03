<?php

class validate {

        protected $email;
        protected $name;
        protected $surname;
        protected $username;
        protected $password;

        public function email($email) {

                $email = trim($email);
                if (empty($email) or!filter_var($email, FILTER_VALIDATE_EMAIL) or!$email) {
                        $this->email = false;
                        return false;
                } else {
                        $this->email = $email;
                        return true;
                }
        }

        public function name($name) {
                $name = trim($name);
                if (empty($name) or is_numeric($name) or preg_match("/[0-9]/", $name)) {
                        $this->name = false;
                        return false;
                } else {
                        $this->name = $name;
                        return true;
                }
        }

        public function surname($surname) {
                $surname = trim($surname);
                if (empty($surname) or is_numeric($surname) or preg_match("/[0-9]/", $surname)) {
                        $this->surname = false;
                        return false;
                } else {
                        $this->surname = $surname;
                        return true;
                }
        }

        public function username($username) {
                $username = trim($username);
                if (empty($username) or strpos($username, " ")) {
                        $this->username = false;
                        return false;
                } else {
                        $this->username = $username;
                        return true;
                }
        }

        public function password($pass) {

                if (empty($pass) or!preg_match("/[0-9]/", $pass) or!preg_match("/[A-Z]/", $pass)) {
                        $this->password = false;
                        return false;
                } else {
                        $this->password = $pass;
                        return true;
                }
        }

        public function array() {
                $data = array();

                if (!empty($this->email) or is_bool($this->email)) {
                        array_push($data, $this->email);
                }
                if (!empty($this->name) or is_bool($this->name)) {
                        array_push($data, $this->name);
                }
                if (!empty($this->surname) or is_bool($this->surname)) {
                        array_push($data, $this->surname);
                }
                if (!empty($this->username) or is_bool($this->username)) {
                        array_push($data, $this->username);
                }
                if (!empty($this->password) or is_bool($this->password)) {
                        array_push($data, $this->password);
                }

                return $data;
        }


        public function verify() {

                $data = $this->array();
                $num = 0;

                if (empty($data)) {
                        return false;
                }



                for ($i = 0; $i < count($data); $i++) {
                        if ($data[$i]) {
                                $num++;
                        }
                }


                if ($num == count($data)) {
                        return true;
                } else {
                        return false;
                }
        }

}

?>
