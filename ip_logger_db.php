<?php
// Datenbankverbindungsinformationen aus Umgebungsvariablen lesen
$servername = getenv("PLESK_DB_HOST");
$username = getenv("PLESK_DB_USER");
$password = getenv("PLESK_DB_PASSWORD");
$dbname = getenv("PLESK_DB_NAME");

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich hergestellt wurde
if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// IP-Adresse des Besuchers abrufen
$ip = $_SERVER['REMOTE_ADDR'];

// Zeitstempel erstellen
$timestamp = date("Y-m-d H:i:s");

// User-Agent-Informationen abrufen
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// IP-Adresse, Zeitstempel und User-Agent in die Datenbank einfügen
$sql = "INSERT INTO access_logs (ip_address, timestamp, user_agent) VALUES ('$ip', '$timestamp', '$user_agent')";

if ($conn->query($sql) === TRUE) {
    echo "Daten erfolgreich in die Datenbank eingefügt";
} else {
    echo "Fehler beim Einfügen der Daten in die Datenbank: " . $conn->error;
}

// Verbindung schließen
$conn->close();
?>
