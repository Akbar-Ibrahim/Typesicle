<?php

function getHashtags($content) {
   
   preg_match_all("/#\S+/",$content, $matches, PREG_OFFSET_CAPTURE);
    
   $values=[];
   foreach( $matches[0] as $match){

         array_push($values,$match[0]);
   }


   return $values;
}



?>