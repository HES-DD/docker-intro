<?php

$db = new \PDO(
    'mysql:host=my_mysql_db;dbname=superdb;charset=utf8mb4',
    "hansi",
    "datwirdschonsischersein123!"
);


$db->exec("CREATE TABLE IF NOT EXISTS `rezepte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zutaten` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

try {
    $db->exec("INSERT INTO `rezepte` (`id`, `name`, `zutaten`) VALUES
        (1, 'Kartoffelsalat', 'Kartoffeln, Salz, Pfeffer, Essig, Öl, Zwiebeln'),
        (2, 'Nudelsalat', 'Nudeln, Salz, Pfeffer, Essig, Öl, Zwiebeln, Tomaten'),
        (3, 'Käsespätzle', 'Spätzle, Käse, Salz, Pfeffer, Zwiebeln, Butter');");
} catch (\PDOException $e) {
    // do nothing
}

$results = $db->query("SELECT * FROM `rezepte`");

$spalten = [
    'id' => 'ID',
    'name' => 'Name',
    'zutaten' => 'Zutaten'
];

?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hansis Lieblingsrezepte</title>

    <style>
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <table>
        <thead>
        <tr>
            <?php
                foreach ($spalten as $name) {
                    echo '<th>', htmlspecialchars($name), '</th>';
                }
            ?>
        </tr>
        </thead>
        <tbody>
            <?php

                foreach($results as $result) {
                    echo '<tr>';

                    foreach ($spalten as $schluessel => $name) {
                        echo '<td>', htmlspecialchars($result[$schluessel]), '</td>';
                    }

                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</body>
</html>

