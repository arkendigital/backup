<?php

/**
* Return an array of adverts for a page.
*/
function getArrayOfAdverts($page_id)
{
    $adverts = \App\Models\PageAdvert::where("page_id", $page_id)
                                        ->whereHas("advert", function ($query) {
                                            $query->where("start_date", "<=", now())
                                                    ->where("end_date", ">=", now())
                                                    ->where("active", 1);
                                        })
                                        // ->where("start_date", "<=", now())
                                        // ->where("end_date", ">=", now())
                                        ->get();
                                        
    $page_adverts = [];
    
    foreach ($adverts as $advert) {
        $advert->advert->trackImpression();
        $advert->advert->trackUniqueImpression();

        if (isset($advert->advert)) {
            $new[$advert->slug] = [
                "image" => $advert->advert->image,
                "url" => $advert->advert->tracking_url
            ];
        }
    }

    if (!empty($new)) {
        array_push($page_adverts, $new);
    }

    return $page_adverts;
}
