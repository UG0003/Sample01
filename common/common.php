<?php
    function sanitize($before){
        if(is_array($before)){
            $after = array();
            foreach($before as $key => $value){
                $after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
            }
            return $after;
        }else{
            return htmlspecialchars($before,ENT_QUOTES,'UTF-8');
        }
    }
?>
