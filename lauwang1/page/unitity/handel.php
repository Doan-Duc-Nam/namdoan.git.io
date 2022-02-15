<?php
    function getPost ($value) {
        if(isset($_POST[$value])) {
            $result = $_POST[$value];
            return $result;
        }
    }

    function getGet ($value) {
        if(isset($_GET[$value])) {
            $result = $_GET[$value];
            return $result;
        }
    }

    function random_name_photo ($name) {
        $numberRandom = (int)rand(0,10);
        $date = date("d-m-Y H:i:s");
        $repeatName = str_repeat($name, $numberRandom);

        return md5(md5($repeatName).$date);
    }