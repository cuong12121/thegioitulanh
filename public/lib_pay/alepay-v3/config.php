<?php

//Thông tin cấu hình
define('URL_DEMO', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']);
define('URL_CALLBACK', URL_DEMO . '/result.php'); // URL đón nhận kết quả 
//Alepay cung cấp 

 $config = array(
    "apiKey" => "RpMkK0JfiwhEWdfjA6TZi7qKRvoKrz", //Là key dùng để xác định tài khoản nào đang được sử dụng.
    "encryptKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDejJkDxom33dul1nlfLP2ScA6V/i57+8Bqee8p9Gc4fYYJbvEAZQPjN4RRuszDvQrogx/jNEowq+JuHXE8nFXsd6MNdcV+A3f80xFsnmvcMvBIdiMDuYYoopL6f4XjRHGZZouN8mcMc9ZvVVWLS3x2Umyt84beNQDhIAhPD9LocQIDAQAB", //Là key dùng để mã hóa dữ liệu truyền tới Alepay.
    "checksumKey" => "d7hEU8EAha7ReAtgnmpDbfjpbKgdvx", //Là key dùng để tạo checksum data.
    "callbackUrl" => URL_CALLBACK,
    "env" => "test",
); 
/// key test live nội bộ
// $config = array(
//     "apiKey" => "imt4pZsjbCDE2ioVxnQs71wzNv4TZW", //Là key dùng để xác định tài khoản nào đang được sử dụng.
//     "encryptKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCVdQKI15hS23XGT9DBQzIardNBBCPa86XeEhMzP2TKKi737SBUXg+z/o3BNhcFZRdTsL5uQpAmBEP3IJYEvclOGgOyWBbpjUf0MXENexaXB9gX9fI/bEiso7k0shBdi8dZt1FdabX/NSTzM+WcQElgLYgXnlwoyCiyzOFL60V4BwIDAQAB", //Là key dùng để mã hóa dữ liệu truyền tới Alepay.
//     "checksumKey" => "5iaPavRj8FQXb6eXCj7gFcXC43jsg5", //Là key dùng để tạo checksum data. 
//     "callbackUrl" => URL_CALLBACK,
//     "env" => "live",
// );
?>