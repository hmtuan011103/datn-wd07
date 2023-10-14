<?php

use Illuminate\Support\Carbon;

if (!function_exists('helperFormatTime')) {
     function helperFormatTime($parameter)
     {
          if ($parameter) {
               return Carbon::parse($parameter)->format('H:i:s d/m/Y');
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



