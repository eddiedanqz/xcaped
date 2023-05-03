<?php
namespace App\Actions;

class GetDistanceAction
{
 public function execute($lat = 5.8, $lng = -0.25): string
 {
    $distanceString = "( 6371 * acos( cos( radians($lat) ) * cos( radians( address_latitude ) ) * cos( radians( address_longitude )".
                            "- radians($lng) ) + sin( radians($lat) ) * sin( radians( address_latitude ) ) ) )";

    return $distanceString;
 }

}

?>
