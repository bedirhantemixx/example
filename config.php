<?php
// Hata raporlamayı açarak, olası sorunları net bir şekilde görmemizi sağlar.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Sitenin ana URL'sini tanımla
define('BASE_URL', 'http://localhost:8888/frc_rookieverse');

/**
 * Veritabanına bağlanmak için GÜVENLİ ve HATALARI GÖSTEREN fonksiyon.
 * @return PDO Veritabanı bağlantı objesi
 */
function connectDB() {
    // MAMP için standart bağlantı ayarları
    $dsn = "mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=frc_rookieverse;charset=utf8mb4";
    $user = 'root';
    $pass = 'root'; // MAMP varsayılan şifresi
    
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        // Yeni bir veritabanı bağlantısı oluştur ve geri döndür
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        // EĞER BAĞLANTI BAŞARISIZ OLURSA, ekrana anlasılır bir hata mesajı yaz ve işlemi durdur.
        // "500 Internal Server Error" yerine bu mesajı göreceksin.
        die("<h1>Veritabanı Bağlantı Hatası!</h1><p>Mesaj: " . $e->getMessage() . "</p><p><b>Kontrol Et:</b><br>1. MAMP sunucun (Apache & MySQL) çalışıyor mu?<br>2. `config.php` dosyasındaki veritabanı adı (`frc_rookieverse`) doğru mu?</p>");
    }
}
?>