<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Exchange Rates</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
<h1>Visitors</h1>
<a href="/">Rates Page</a>
<table>
    <thead>
    <tr>
        <th>IP</th>
        <th>Browser</th>
        <th>Visited At</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($visitors as $visitor): ?>
        <tr>
            <?php
//            dd($visitor);
            ?>
            <td><?= htmlspecialchars($visitor->getIpAddress()) ?></td>
            <td><?= htmlspecialchars($visitor->getUserAgent()) ?></td>
            <td><?= $visitor->getVisitTime()->format('Y-m-d H:i:s') ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>