<?php
require 'FootballData.php';

$api = new FootballData();

// الحصول على تاريخ اليوم
$today = date('Y-m-d');

// الحصول على تاريخ الغد
$tomorrow = date('Y-m-d', strtotime('+1 day'));

// استدعاء دالة جلب المباريات اليومية
$matchesToday = $api->findMatchesForDateRange($today, $today);

// استدعاء دالة جلب المباريات القادمة
$matchesTomorrow = $api->findMatchesForDateRange($tomorrow, $tomorrow);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's and Upcoming Matches</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #0056b3;
            color: #fff;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .match-section {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Today's and Upcoming Matches</h1>

        <!-- عرض المباريات اليوم -->
        <div class="match-section">
            <h2>Today's Matches</h2>
            <?php if (!empty($matchesToday->matches)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Match Time (UTC)</th>
                        <th>Competition</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matchesToday->matches as $match): ?>
                    <tr>
                        <td><?php echo $match->homeTeam->name; ?></td>
                        <td><?php echo $match->awayTeam->name; ?></td>
                        <td><?php echo date('H:i', strtotime($match->utcDate)); ?></td>
                        <td><?php echo $match->competition->name; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No matches scheduled for today.</p>
            <?php endif; ?>
        </div>

        <!-- عرض المباريات القادمة -->
        <div class="match-section">
            <h2>Upcoming Matches</h2>
            <?php if (!empty($matchesTomorrow->matches)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Match Time (UTC)</th>
                        <th>Competition</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matchesTomorrow->matches as $match): ?>
                    <tr>
                        <td><?php echo $match->homeTeam->name; ?></td>
                        <td><?php echo $match->awayTeam->name; ?></td>
                        <td><?php echo date('H:i', strtotime($match->utcDate)); ?></td>
                        <td><?php echo $match->competition->name; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No matches scheduled for tomorrow.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
