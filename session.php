<?php
session_start();

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_email'])) {
    // Jeśli nie jest zalogowany, przekieruj go na stronę logowania
    header("Location: login");
    exit();
}
?>