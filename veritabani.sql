

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `categories` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;


INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Web Tasarım'),
(2, 'SEO'),
(3, 'Kira'),
(4, 'Fatura'),
(5, 'Muhasebe Aidatı'),
(6, 'Alışveriş'),
(7, 'Reklam'),
(8, 'İçerik'),
(9, 'Hosting'),
(10, 'Ev Aidatı'),
(12, 'Web Yazılım');


CREATE TABLE `customers` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `phone` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `tax_no` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `tax_office` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;


INSERT INTO `customers` (`id`, `title`, `phone`, `email`, `tax_no`, `tax_office`, `address`, `status`) VALUES
(1, 'Demet Yavuz', '+908516662705', 'yavuzdemet@example.com', NULL, NULL, 'Dağınık Evler Bulvarı No:971 Akkuş, Ordu', 1),
(2, 'Kadir Özdemir', '+908516521743', 'kadir_ozdemir@example.com', NULL, NULL, 'Demirtaş Sokağı No:290 Ilgın, Konya', 1),
(3, 'Yakup Aksoy', '+908512790621', 'yakup_aksoy645@example.com', NULL, NULL, 'Erguvan Caddesi No:585 Küre, Kastamonu', 1),
(4, 'Öznur Yıldız', '+908517792663', 'yildizoznur414@example.com', NULL, NULL, 'Rumeli Caddesi No:309 Sapanca, Sakarya', 1),
(5, 'Nilgün Köse', '+908513136496', 'kosenilgun@example.com', NULL, NULL, 'Doğuş Caddesi No:92 Sultangazi, İstanbul', 1),
(6, 'Sevim Acar', '+908513053193', 'sevim_acar948@example.com', NULL, NULL, 'Kastamonu Caddesi No:176 Doğanyurt, Kastamonu', 1),
(7, 'Yunus Korkmaz', '+908515752577', 'yunus_korkmaz@example.com', NULL, NULL, 'Yenidoğan Mahallesi No:130 İmamoğlu, Adana', 1),
(8, 'Murat Kaya', '+908511161385', 'kayamurat@example.com', NULL, NULL, 'Edebiyat Bulvarı No:856 Özvatan, Kayseri', 1),
(9, 'Serkan Polat', '+908519144433', 'serkan_polat@example.com', NULL, NULL, 'Hac Sokağı No:960 Eceabat, Çanakkale', 1),
(10, 'İbrahim Polat', '+908514940143', 'ibrahim_polat658@example.com', NULL, NULL, 'Malatyalılar Sokağı No:493 Altınekin, Konya', 1),
(14, 'Piasoft', '05413731437', 'info@piasoft.com.tr', NULL, NULL, 'İçerenköy mah. Adem sok. No : 54 / B', 1);


CREATE TABLE `finances` (
  `id` int NOT NULL,
  `u_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `category_id` int NOT NULL,
  `method_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `event_type` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `adddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;



INSERT INTO `finances` (`id`, `u_id`, `customer_id`, `category_id`, `method_id`, `price`, `event_type`, `description`, `adddate`) VALUES
(2, 1, 6, 8, 2, 1000.00, 1, 'içerik ücreti alındı.', '2023-09-06 07:20:30'),
(3, 1, 6, 9, 4, 1000.00, 1, 'yıllık hosting ödemesi alındı.', '2023-09-12 15:59:40'),
(4, 1, 10, 1, 4, 3000.00, 1, 'web sitesi revize ücreti alındı.', '2023-09-10 13:47:40'),
(5, 1, 2, 1, 2, 2500.00, 1, 'yeni web sitesi için taksit ödemsi alındı', '2023-09-02 22:15:20'),
(6, 1, 7, 1, 4, 2000.00, 1, 'web sitesi revize ücreti alındı.', '2023-09-11 08:59:59'),
(7, 1, 1, 7, 4, 1641.00, 1, 'google adsense ödemesi alındı.', '2023-09-13 12:00:46'),
(8, 1, 3, 1, 2, 1000.00, 1, 'yeni web sitesi için taksit ödemsi alındı.', '2023-09-03 06:13:22'),
(9, 1, 2, 5, 4, 2500.00, 0, '1500 TL borç kaldı.', '2023-09-01 10:43:30'),
(10, 1, 3, 4, 2, 467.00, 0, 'cPanel Lisans Ücreti', '2023-09-02 13:35:24'),
(11, 1, 4, 9, 2, 1000.00, 1, 'Web tasarım ücreti alındı.', '2023-09-03 18:16:30'),
(12, 1, 4, 1, 2, 1000.00, 1, 'yeni web sitesi için taksit ödemesi alındı.', '2023-09-04 14:15:09'),
(13, 1, 1, 9, 4, 7000000.00, 1, 'yıllık hosting ödemesi alındı.', '2023-09-04 12:18:43'),
(14, 1, 5, 1, 2, 2000.00, 1, 'yeni web sitesi için taksit ödemesi alındı.', '2023-09-05 12:17:30'),
(15, 1, 7, 1, 4, 5000.00, 1, 'yeni web sitesi için taksit ödemesi alındı.', '2023-09-07 17:30:19'),
(16, 1, 8, 1, 4, 1500.00, 1, 'yeni web sitesi için taksit ödemesi alındı.', '2023-09-08 15:49:27'),
(17, 1, 9, 1, 4, 3000.00, 1, 'yeni web sitesi için taksit ödemesi alındı.', '2023-09-09 13:43:40'),
(18, 1, 10, 8, 3, 12000.00, 1, NULL, '2023-09-13 18:27:56'),
(19, 1, 1, 5, 2, 12312321.00, 1, '123213', '2023-09-13 18:48:02'),
(20, 1, 1, 4, 2, 100.00, 1, NULL, '2024-04-22 17:11:19'),
(22, 1, 14, 1, 2, 10000.00, 0, NULL, '2024-04-23 17:55:45');


CREATE TABLE `methods` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;


INSERT INTO `methods` (`id`, `title`) VALUES
(1, 'Kredi Kartı'),
(2, 'Nakit'),
(3, 'Çek/Senet'),
(4, 'Banka Havalesi');



CREATE TABLE `reminders` (
  `id` int NOT NULL,
  `finance_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `reminder_date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;


CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `phone` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `uniqid` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;



INSERT INTO `users` (`id`, `fullname`, `phone`, `email`, `password`, `uniqid`, `status`) VALUES
(1, 'Enes Yalçın', '0541 373 1437', 'admin@admin.com', '40f5888b67c748df7efba008e7c2f9d2', '63754e7f172f9', 1);


ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `methods`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


ALTER TABLE `finances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;


ALTER TABLE `methods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `reminders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;