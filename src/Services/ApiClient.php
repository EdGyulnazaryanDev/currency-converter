<?php
namespace CurrencyService\Services;

use CurrencyService\Exceptions\ApiException;

class ApiClient
{
    private const API_URL = 'https://api.frankfurter.app/';

    public function get(string $endpoint, array $params = []): array
    {
        $url = self::API_URL . $endpoint;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            dd(('API request failed: ' . curl_error($ch)));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            dd("API returned HTTP code: $httpCode");
        }

        curl_close($ch);

        return json_decode($response, true) ?? [];
    }
}