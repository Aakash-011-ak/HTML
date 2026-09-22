<!DOCTYPE html>
<html>
<head>
    <title>Video Game Catalog</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f4f9; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #4CAF50; color: white; }
        tr:hover { background-color: #f1f1f1; }
    </style>
</head>
<body>

    <h2>Video Game Inventory Catalog</h2>

    <?php
    // Load the XML file
    $xml = simplexml_load_file("games.xml") or die("Error: Cannot load XML file.");

    echo "<table>";
    echo "<tr><th>Game Title</th><th>Genre</th><th>Platform</th><th>Price</th></tr>";

    // Loop through each <game> element and display its details
    foreach ($xml->game as $game) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($game->title) . "</td>";
        echo "<td>" . htmlspecialchars($game->genre) . "</td>";
        echo "<td>" . htmlspecialchars($game->platform) . "</td>";
        echo "<td>$" . htmlspecialchars($game->price) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>

</body>
</html>