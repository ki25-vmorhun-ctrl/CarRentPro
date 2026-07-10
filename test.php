<?php

require_once 'includes/db.php';

echo "<h2 style='color:green;'>✅ Підключення до бази даних успішне!</h2>";

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM cars");

$result = $stmt->fetch();

echo "<h3>Автомобілів у базі: " . $result['total'] . "</h3>";

?>