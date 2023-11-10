<?php 

if (! function_exists('time2sec')) {
    function time2sec($str_time)
    {
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 3600 + $minutes*60;
        return $time_seconds ; 
    }
}



if (! function_exists('sec2HrMin')) {
    function sec2HrMin($seconds)
    {
          $hours = intval($seconds / (60*60));
          $mins  = ($seconds - ($hours*60*60))/60;
          
          return $hours > 0  ? $hours.'ч '.$mins.'мин':  $mins.'мин';
    }
}


