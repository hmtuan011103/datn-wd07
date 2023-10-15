<?php

use Carbon\Carbon;

if (!function_exists('helperFormatTime')) {
     function helperFormatTime($parameter)
     {
          if ($parameter) {
               return Carbon::parse($parameter)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d/m/Y');
          }

          return null;
     }

}

function formatDateTrip($parameter)
     {
          if ($parameter) {
               return Carbon::parse($parameter)->format('d/m/Y');
          }

          return null;
     }

     function formatEditDateTrip($parameter)
     {
          if ($parameter) {
               return Carbon::parse($parameter)->format('Y-m-d');
          }

          return null;
     }



