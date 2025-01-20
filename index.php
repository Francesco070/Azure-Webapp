<?php
// Verbindungsaufbau zur Azure SQL-Datenbank
try {
    $conn = new PDO("sqlsrv:server = tcp:gbca1-fra-pal.database.windows.net,1433; Database = gbca1_sqldb_fra_pal", "fpa", "Checco12052007");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fehler beim Verbinden zur SQL-Datenbank: " . $e->getMessage());
}

// Daten aus der Tabelle "Kunden" abrufen
$sql = "SELECT ID, Name, Email, Telefonnummer FROM [dbo].[Kunden]";
$stmt = $conn->prepare($sql);
$stmt->execute();
$kunden = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meine persönliche Webseite</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link rel="icon" href="https://francescopalazzo.blob.core.windows.net/data/Protrait1.jpg">
</head>
<body>
<!-- Header -->
<header class="py-4">
    <div class="container">
        <h1 class="display-4">Willkommen auf meiner Azure WebApp</h1>
    </div>
</header>

<!-- Main Content -->
<main class="container my-5">
    <div class="row">
        <!-- Begrüßung -->
        <div class="col-12 mb-4">
            <h2>Herzlich Willkommen!</h2>
            <p class="lead">Das hier ist meine Azure WebApp Applikation, hier werden die Daten aus einem Blob Storage und SQL-Datenbank geholt.</p>
            <p><a style="color: #cba6f7" href="https://github.com/Francesco070/Azure-Webapp">Link</a> zu GitHUB Repo</p>
        </div>

        <!-- Bild und Tabelle nebeneinander -->
        <div class="col-md-4 mb-4">
            <img src="https://francescopalazzo.blob.core.windows.net/data/Protrait1.jpg" alt="Porträt" class="img-fluid rounded shadow">
        </div>

        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Telefon</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($kunden as $kunde): ?>
                    <tr>
                        <td><?= htmlspecialchars($kunde['ID']) ?></td>
                        <td><?= htmlspecialchars($kunde['Name']) ?></td>
                        <td><?= htmlspecialchars($kunde['Email']) ?></td>
                        <td><?= htmlspecialchars($kunde['Telefonnummer']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
