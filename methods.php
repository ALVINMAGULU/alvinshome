<?php
function booleaner($string){
       if($string == "0"){
           return false;
       }else if($string == "1"){
           return true;
       }
   }

public static function convert_to_utf8($dat)
   {
      if (is_string($dat)) {
         return utf8_encode($dat);
      } elseif (is_array($dat)) {
         $ret = [];
         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_to_utf8($d);

         return $ret;
      } elseif (is_object($dat)) {
         foreach ($dat as $i => $d) $dat->$i = self::convert_to_utf8($d);

         return $dat;
      } else {
         return $dat;
      }
   }
   ?>
