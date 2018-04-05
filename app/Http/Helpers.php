<?php

/**
* Return an array of adverts for a page.
*/
function getArrayOfAdverts($page_id)
{
    $adverts = \App\Models\PageAdvert::where("page_id", $page_id)
    ->get();

    $page_adverts = [];

    foreach ($adverts as $advert) {
        if (isset($advert->advert)) {
            $new[$advert->slug] = [
        "image" => $advert->advert->image,
        "url" => $advert->advert->url
      ];
        }
    }

    if (!empty($new)) {
        array_push($page_adverts, $new);
    }

    return $page_adverts;
}
