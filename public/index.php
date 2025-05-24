<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\WeatherClient;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$weatherClient = new WeatherClient();

// Get the city from the query string, default to "Copenhagen" if not provided
$city = isset($_GET['city']) && !empty(trim($_GET['city'])) ? trim($_GET['city']) : 'Copenhagen';

try {
    $data = $weatherClient->fetchWeatherData($city);
    $weatherData = [
        'city' => $city,
        'temperature' => $data['main']['temp'] ?? 'N/A',
        'windSpeed' => $data['wind']['speed'] ?? 'N/A',
        'humidity' => $data['main']['humidity'] ?? 'N/A',
        'description' => $data['weather'][0]['description'] ?? 'N/A',
        'icon' => $data['weather'][0]['icon'] ?? '01d',
    ];
} catch (Exception $e) {
    $weatherData = null; // Handle errors gracefully
    $error = "Error: " . $e->getMessage();
}

// Pass $weatherData to the view
include __DIR__ . '/../views/weather.php';