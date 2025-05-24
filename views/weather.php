<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom, #87CEEB, #f0f8ff);
            color: #333;
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        header {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }
        footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
        section {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        table {
            margin: 20px auto;
            text-align: left;
            width: auto;
        }
        th, td {
            padding: 5px 10px;
        }
        th {
            text-align: left;
            font-weight: bold;
        }
        img {
            display: block;
            margin: 0 auto 20px auto;
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
<header>
    <h1>How's the weather?</h1>
    <form method="GET" action="/">
        <input type="text" name="city" placeholder="Enter city" required>
        <button type="submit">Let's check</button>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </form>
</header>
<?php if (isset($weatherData)): ?>
    <section>
        <h2><?= htmlspecialchars(mb_convert_case($weatherData['city'], MB_CASE_TITLE, "UTF-8")) ?></h2>
        <img src="http://openweathermap.org/img/wn/<?= htmlspecialchars($weatherData['icon'] ?? '01d') ?>@2x.png" alt="Weather Icon">
        <table>
            <tr>
                <th>Temperature:</th>
                <td><?= htmlspecialchars($weatherData['temperature']) ?>°C</td>
            </tr>
            <tr>
                <th>Weather:</th>
                <td><?= htmlspecialchars($weatherData['description']) ?></td>
            </tr>
            <tr>
                <th>Humidity:</th>
                <td><?= htmlspecialchars($weatherData['humidity']) ?>%</td>
            </tr>
            <tr>
                <th>Wind Speed:</th>
                <td><?= htmlspecialchars($weatherData['windSpeed']) ?> m/s</td>
            </tr>
        </table>
    </section>
<?php elseif (isset($error)): ?>
    <section>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    </section>
<?php endif; ?>
<footer>
    <p>Weather data provided by OpenWeatherMap</p>
</footer>
</body>
</html>