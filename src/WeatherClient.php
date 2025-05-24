<?php

namespace App;

class WeatherClient
{
    private string $apiUrl = "https://api.openweathermap.org/data/2.5/weather";
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = $_ENV['OPENWEATHER_API_KEY'] ?? '';
        if (empty($this->apiKey)) {
            throw new \Exception("API key is not set in the environment variables.");
        }
    }

    public function fetchWeatherData(string $city): array
    {
        $url = "{$this->apiUrl}?q=" . urlencode($city) . "&units=metric&appid={$this->apiKey}";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new \Exception("cURL Error: " . curl_error($curl));
        }

        curl_close($curl);

        $data = json_decode($response, true);

        if (isset($data['cod']) && $data['cod'] !== 200) {
            throw new \Exception("API Error: " . ($data['message'] ?? 'Unknown error'));
        }

        return $data;
    }
}