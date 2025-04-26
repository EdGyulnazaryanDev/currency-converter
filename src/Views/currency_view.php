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
<h1>Currency Exchange Rates</h1>
<a href="/visitors">Visitors</a>

<form action="/base" method="post">
    <label for="currency">Base Currency:</label>
    <select name="currency" id="currency">
        <?php foreach ($rates as $currency => $rate): ?>
            <option value="<?= $currency ?>" <?= $currency === $baseCurrency ? 'selected' : '' ?>>
                <?= $currency ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Change</button>
</form>

<table>
    <thead>
    <tr>
        <th>Currency</th>
        <th>Rate</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rates as $currency => $rate): ?>
        <tr>
            <td><?= $currency ?></td>
            <td><?= number_format($rate, 6) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>