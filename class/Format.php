<?php

class Format {

    public function formatUtf($data){
        $newData = $data;
        return utf8_encode($newData);
    }
}

?>