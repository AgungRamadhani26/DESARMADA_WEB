<?php
function set_dot($d)
{
   $whole      = floor($d);
   $fraction   = $d - $whole;

   if ($fraction == 0) {
      return @number_format($d, 0, ',', '.');
   } else {
      return number_format($d, 2, ',', '.');
   }
}

function idr($nominal)
{
   return 'Rp ' . set_dot($nominal);
}
