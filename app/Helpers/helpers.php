<?php

if (!function_exists('money')) {
    /**
     * Format a given amount to the given currency
     *
     * @param $amount
     * @param \App\Models\Currency $currency
     * @return string
     */
    function money($amount, \App\Models\Currency $currency)
    {
        return $currency->symbol_left . number_format($amount, $currency->decimal_place, $currency->decimal_point,
            $currency->thousand_point) . $currency->symbol_right;
    }
}

if (!function_exists('cdn')) {

    function cdnPath($cdn, $asset) {
        return  "//" . rtrim($cdn, "/") . "/" . ltrim($asset, "/");
    }

    /**
     * Prepend CDN url
     *
     * @param $asset string
     * @param $type [img, asset, pdf]
     * @return string
     */
    function cdn($asset) {
        if (!config('attendize.cdn') || config('attendize.cdn_bypass')) {
            return asset($asset);
        }

        // Get file name incl extension and CDN URLs
        $cdns = config('attendize.cdn');
        $assetName = basename($asset);

        // Remove query string
        $assetName = explode("?", $assetName);
        $assetName = $assetName[0];

        // Select the CDN URL based on the extension
        foreach ($cdns as $types => $cdn) {
            if (preg_match('/^.*\.(' . $types . ')$/i', $assetName)) {
                return cdnPath($cdn, $asset);
            }
        }

         // In case of no match use the last in the array
        end($cdns);

        // In case of no match and the last CDN is empty use origin
        if (key($cdns) == "") {
            return asset($asset);
        }

        return cdnPath(key($cdns), $asset);
    }
};
