-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2019 at 06:35 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `area` text COLLATE utf8_bin NOT NULL,
  `city` text COLLATE utf8_bin NOT NULL,
  `zip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `area`, `city`, `zip`) VALUES
(1, '131, Dhanmondi', 'Dhaka', 1229),
(2, 'Mirpur 10', 'Dhaka', 1772),
(3, 'Mirpur 2', 'Dhaka', 1223),
(4, 'Uttora', 'Dhaka', 1233);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `name`, `password`, `created_at`, `updated_at`) VALUES
('admin', 'Electro', '123', '2018-08-28', '2018-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Computer', 'PC, Laptop', '2019-02-09', '2019-02-09'),
(2, 'Smart Phone', 'All smartphones', '2019-02-09', '2019-02-09'),
(3, 'Headphone', 'All headphones', '2019-02-09', '2019-02-09'),
(4, 'Camera', 'All cameras', '2019-02-09', '2019-02-09'),
(5, 'Powerbank', 'All powerbanks', '2019-02-09', '2019-02-09'),
(6, 'Gaming', 'All gaming accessories', '2019-02-09', '2019-02-09'),
(7, 'Tab', 'All tabs', '2019-02-09', '2019-02-09'),
(8, 'Smartwatch', 'All smartwatches', '2019-02-09', '2019-02-09'),
(9, 'Speaker', 'All speakers', '2019-02-09', '2019-02-09'),
(10, 'Accessory', 'All accessories', '2019-02-09', '2019-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `image_name` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `colors` text COLLATE utf8_bin NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `tag` text COLLATE utf8_bin NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image_name`, `description`, `colors`, `price`, `discount`, `tag`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Apple MacBook Pro (2018)', '1.jpg', '<div class=\"ng-scope\">\r\n<p>Processor - Six Core Intel Core i7<br />Processor Clock Speed - 2.2-4.1GHz<br />Display Size - 15.4\"<br />RAM - 16GB<br />RAM Type - DDR4 2400MHz (Onboard)<br />Storage - 256GB SSD</p>\r\n</div>', '#c0c0c0', 214200, 205000, 'New', 1, '2019-02-09', '2019-02-09'),
(3, 'HP Probook X360 440 G1', '1.jpg', '<div class=\"ng-scope\">\r\n<p>Generation - 8th Gen<br />Processor - Intel Core i7 8550U<br />Processor Clock Speed - 1.80-4.0GHz<br />Display Size - 14\"<br />RAM - 8GB<br />RAM Type - DDR4<br />Storage - 512GB SSD<br />Operating System - Free Dos</p>\r\n</div>', '#000000', 94920, 91000, 'New', 1, '2019-02-09', '2019-02-09'),
(4, 'Apple iPad Pro', '1.jpg', '<div class=\"ng-scope\">\r\n<p>Model - Apple iPad Pro 11 Inch WiFi+Cellular<br />Processor Type - A12X Bionic chip<br />Internal Memory - 256GB<br />Display Type - Liquid Retina display<br />Display Size - 11\"<br />Screen Resolution - 2388 x 1668<br />Connectivity - Wi-Fi, Bluetooth 5.0, USB, GPS</p>\r\n</div>', '#c0c0c0', 115500, 111000, 'Hot', 7, '2019-02-09', '2019-02-09'),
(5, 'Google Pixel 3 (64 GB)', '1.jpg', '<div class=\"ng-scope\">\r\n<ul class=\"i8Z77e\">\r\n<li class=\"TrT0Xe\">Processor: Qualcomm Snapdragon 845 2.5 GHz quad-core.</li>\r\n<li class=\"TrT0Xe\">Display: 5.5 inch, 2160x1080-pixel</li>\r\n<li class=\"TrT0Xe\">Operating system: Android 9 Pie.</li>\r\n<li class=\"TrT0Xe\">RAM: 4GB LPDDR4.</li>\r\n<li class=\"TrT0Xe\">Storage: 64GB internal.</li>\r\n<li class=\"TrT0Xe\">Cameras: 12.2-megapixel rear f/1.8 dual-pixel</li>\r\n</ul>\r\n</div>', '#ff80ff,#c0c0c0,#000000', 71900, 71000, 'New', 2, '2019-02-09', '2019-02-09'),
(6, 'Samsung Galaxy Note 9', '1.jpg', '<div class=\"ng-scope\">\r\n<ul class=\"i8Z77e\">\r\n<li class=\"TrT0Xe\">CPU: Qualcomm Snapdragon 845.</li>\r\n<li class=\"TrT0Xe\">Memory: 6/8GB.</li>\r\n<li class=\"TrT0Xe\">Storage: 128.</li>\r\n<li class=\"TrT0Xe\">MicroSD storage: Up to 512GB.</li>\r\n<li class=\"TrT0Xe\">Screen size: 6.4 inches.</li>\r\n<li class=\"TrT0Xe\">Resolution: 2960 x 1440.</li>\r\n<li class=\"TrT0Xe\">Connectivity: Bluetooth 5, NFC.</li>\r\n<li class=\"TrT0Xe\">Battery: 4,000mAh</li>\r\n</ul>\r\n</div>', '#0080c0,#000000,#804040', 95000, 94000, 'Hot', 2, '2019-02-09', '2019-02-10'),
(8, 'A4tech Bloody G437', '1.jpg', '<ul class=\"i8Z77e\">\r\n<li>Driver Unit: 40 mm Neodymium Magnet</li>\r\n<li>Frequency Response: 20-20000 Hz</li>\r\n<li>Sensitivity: 100 dB</li>\r\n<li>Impedance: 32 ohm</li>\r\n</ul>', '#000000', 3000, 2290, 'Hot', 3, '2019-02-09', '2019-02-12'),
(11, 'Canon EOS 6D Mark II', '1.jpg', '<p>Model - Canon 6D Mark II<br />Mega Pixels - 26.2 Megapixels<br />Lens Mount - Canon EF Lens<br />Processor - DIGIC 7<br />Sensor Type - CMOS Senso</p>', '#000000', 105530, 101000, 'Hot', 4, '2019-02-09', '2019-02-09'),
(12, 'Nikon D7200 Camera', '1.jpg', '<p>Model - Nikon D7200<br />Effective Pixels - 24.2 Megapixels<br />Lens Mount - AF-S 18-140mm<br />Processor - Expeed 4<br />Sensor Type - CMOS Sensor<br />Screen Type - TFT LCD<br />Screen Size - 3.2\"</p>', '#000000', 78850, 75000, 'New', 4, '2019-02-09', '2019-02-09'),
(15, 'Canon PowerShot SX730', '1.jpg', '<p>Model - Canon PowerShot SX730 HS<br />Resolution (MP) - 20.3 Mega pixels<br />Display (Inch) - 3\" TFT Color LCD Display<br />Optical Zoom (X) - 40x<br />Battery - NB-13L Battery</p>', '#000000', 31500, 30000, 'New', 4, '2019-02-09', '2019-02-09'),
(16, 'Microsoft Xbox One', '1.jpg', '<ul>\r\n<li>Seamless profile and controller pairing</li>\r\n<li>Responsive thumbsticks</li>\r\n<li>Triggers and bumpers are designed for quick access</li>\r\n<li>Menu and View buttons quick for easy navigation</li>\r\n<li>Remap buttons through the Xbox Accessories App</li>\r\n</ul>', '#000000', 5100, 4300, 'Gaming', 6, '2019-02-09', '2019-02-09'),
(17, 'Logitech Wireless F710', '1.jpg', '<p>Model - Logitech F710<br />Type - Gamepad</p>', '#004080,#c0c0c0', 5000, 4500, 'New', 6, '2019-02-09', '2019-02-09'),
(18, 'ADATA 20100 mAh', '1.jpg', '<ul>\r\n<li>Battery type: Rechargeable Lithium-ion battery</li>\r\n<li>Special features: Dual USB ports</li>\r\n<li>Other features: 20100 mAh. LED Flashlight</li>\r\n<li>Input: DC 5V/2A</li>\r\n<li>Output: DC 5V/2.1A max</li>\r\n</ul>', '#000000', 2500, 1999, 'Hot', 5, '2019-02-09', '2019-02-09'),
(19, 'Joyroom ZHI 10000 mAh', '1.jpg', '<ul>\r\n<li>Input：5V 2A</li>\r\n<li>Output：5V 2.1A</li>\r\n<li>Power: 10000 mAh</li>\r\n<li>Digital Display</li>\r\n<li>LED Lighting</li>\r\n</ul>', '#0000ff,#000000', 3300, 2999, 'Hot', 5, '2019-02-09', '2019-02-09'),
(20, 'Astrum 10000mAh', '1.jpg', '<ul>\r\n<li>Battery: 10000mAh capacity li-polymer</li>\r\n<li>Connectors: 2 x USB Port</li>\r\n<li>Ouput: 1 - 5V 1A / 2 - 5V 2.1A</li>\r\n<li>Input: 5V 2A</li>\r\n</ul>', '#000000', 1500, 1500, 'New', 5, '2019-02-09', '2019-02-09'),
(21, 'Mi 10000 mAh v2', '1.jpg', '<ul>\r\n<li><span class=\"a-list-item\">10000mAH lithium-polymer battery</span></li>\r\n<li><span class=\"a-list-item\">Dual USB Output, Two- way Quick Charge</span></li>\r\n<li><span class=\"a-list-item\">Material: Aluminium Alloy + CNC Edge</span></li>\r\n<li class=\"\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.4bd16c33R4IjnQ\">Temperature Resistance</li>\r\n<li class=\"\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i1.4bd16c33R4IjnQ\">Protection from Short Circuit</li>\r\n<li class=\"\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i2.4bd16c33R4IjnQ\">Reset Mechanism</li>\r\n</ul>', '#000000,#808080', 1300, 1199, 'Hot', 5, '2019-02-09', '2019-02-09'),
(22, 'Apple Watch Series 4', '1.jpg', '<p>Model - Apple Watch Series 4<br />Watch Dimension - 40 x 34 x 10.7mm<br />Display Size - 1.57\"<br />Connectivity - WiFi, Bluetooth, GPS</p>', '#000000', 44300, 43999, 'Hot', 8, '2019-02-09', '2019-02-12'),
(23, 'Mi Amazfit Bip', '1.jpg', '<div class=\"short-description\">\r\n<div class=\"std\">Model - Mi Amazfit Bip<br />Display Size - 1.28\"<br />Connectivity - WiFi, Bluetooth, GPS</div>\r\n</div>', '#000000', 6100, 5999, 'New', 8, '2019-02-09', '2019-02-09'),
(24, 'Garmin fenix 5 Sapphire', '1.jpg', '<ul>\r\n<li>Display: 1.2&rdquo; (240 x 240)</li>\r\n<li>Display type: Sunlight-visible, transflective memory-in-pixel (MIP)</li>\r\n<li>Memory: 64MB</li>\r\n<li>Lens Material: chemically strengthened glass or sapphire crystal</li>\r\n<li>Bezel Material: Stainless steel</li>\r\n<li>Strap material: silicone</li>\r\n</ul>', '#000000', 45000, 43000, 'Smartwatch', 8, '2019-02-09', '2019-02-09'),
(25, 'Beats PILL Plus', '1.jpg', 'SKU: RAMBPSHSP\r\n\r\nBrand: Beats\r\n\r\nActive 2-way crossove', '#000000,#ff0000,#c0c0c0', 21000, 20000, 'Speaker', 9, '2019-02-09', '2019-02-12'),
(26, 'JBL Omni 50+', '1.jpg', '<p>&lt;h2&gt;Model - JBL by Harman/Kardon Omni 50+&lt;br /&gt;Type - Wireless HD Indoor/Outdoor Speaker with Rechargeable Battery&lt;/h2&gt;</p>', '#000000', 46730, 45000, 'Speaker', 9, '2019-02-10', '2019-02-12'),
(27, 'Edifier S350DB 2.1', '1.jpg', '<p>Model - Edifier S350DB<br />Type - Modern Powered Bluetooth Bookshelf Speaker<br />Channel - 2.1<br />RMS/Channel (Watt) - 15Watt x 2 (Treble) + 25Watt x 2 (midrange and bass)<br />RMS/Subwoofer (Watt) - 70Watt</p>', '#000000', 31500, 30000, 'Speaker', 9, '2019-02-10', '2019-02-10'),
(28, 'JBL Xtreme 2 Portable', '1.jpg', '<p>Model - JBL Xtreme 2<br />Type - Portable Bluetooth Speaker<br />Lithium-ion Polymer 36Wh (Equivalent to 3.7V 10000mAh)<br />Wirelessly connect<br />2 smartphones or tablets<br />charges device via an USB port</p>', '#400080', 25400, 24000, 'Hot', 9, '2019-02-10', '2019-02-10'),
(30, 'APPLE Magic Mouse 2', '1.jpg', '<p>Model - APPLE Magic Mouse 2<br />Type - Magic Mouse<br />Connectivity - Wireless<br />Rechargable</p>', '#000000', 11050, 11000, 'Mouse', 10, '2019-02-10', '2019-02-10'),
(31, 'Rapoo 3600 Silent', '1.jpg', '<ul>\r\n<li>Connection: 2.4GHz Wireless</li>\r\n<li>Tracking method: Optical</li>\r\n<li>Keys amount: 3&nbsp;</li>\r\n<li>Keys travel: 0.8mm</li>\r\n<li>Acceleration: 20G</li>\r\n<li>Resolution: 1000DPI</li>\r\n<li>Voltage: 1.5V</li>\r\n</ul>', '#000000', 1050, 999, 'Mouse', 10, '2019-02-10', '2019-02-10'),
(34, 'Corsair STRAFE Mechanical', '1.jpg', '<p>Model - Corsair STRAFE Mechanical<br />Type - RED LED Backlight Gaming Keyboard<br />Interface - USB</p>', '#ff0000', 11000, 10500, 'Keyboard', 10, '2019-02-10', '2019-02-10'),
(35, 'APPLE MAGIC KEYBOARD', '1.jpg', 'APPLE MAGIC KEYBOARD (MLA22ZA/A, MLA22LL/A)', '#c0c0c0', 9700, 9500, 'Keyboard', 10, '2019-02-10', '2019-02-10'),
(36, 'MSI GT75VR 7RE TITAN', '1.jpg', '<p>Generation - 7th Gen<br />Processor - Intel Core i7 7820HK<br />Processor Clock Speed - 2.90-3.90GHz<br />Display Size - 17.3\"<br />RAM - 32GB<br />RAM Type - DDR4 2400MHz<br />Storage - 1TB HDD + 256GB NVMe SSD</p>', '#808080', 254630, 245000, 'Laptop', 1, '2019-02-10', '2019-02-10'),
(37, 'Asus ROG G752VS(KBL)', '1.jpg', '<p>Generation - 7th Gen<br />Processor - Intel Core i7 7700HQ<br />Processor Clock Speed - 2.80GHz<br />Display Size - 17.3\"<br />RAM - 32GB<br />RAM Type - DDR4<br />HDD - 2TBHDD+512GB SSD<br />Operating System - Endless</p>', '#808080', 231420, 224000, 'Hot', 1, '2019-02-10', '2019-02-10'),
(38, 'Microsoft Surface Pro', '1.jpg', '<p>Generation - 8th Gen<br />Processor - Intel Core i7 8650U<br />Processor Clock Speed - 1.90-4.20GHz<br />Display Size - 12.3\"<br />RAM - 16GB<br />Storage - 512GB SSD<br />Operating System - Windows 10 Home</p>', '#c0c0c0,#8080ff', 202650, 195000, 'Tab', 7, '2019-02-10', '2019-02-10'),
(39, 'HP Spectre 13-V113TU', '1.jpg', '<p>Model - HP Spectre 13-V113TU<br />Processor - Intel Core i5 7200U<br />Generation - 7th Gen<br />Processor Clock Speed - 2.50-3.10GHz<br />Display Size - 13.3\"<br />RAM - 8GB<br />RAM Type - LPDDR3 1866 On-Board</p>', '#000000', 126300, 123000, 'New', 1, '2019-02-10', '2019-02-10'),
(40, 'Asus GL503VM Core i7', '1.jpg', '<p>Generation - 7th Gen<br />Processor - Intel Core i7 7700HQ<br />Processor Clock Speed - 2.80GHz<br />Display Size - 15.6\"<br />RAM - 16GB<br />RAM Type - DDR4</p>', '#000000', 157920, 154500, 'Laptop', 1, '2019-02-10', '2019-02-10'),
(41, 'asus zenfone 5z', '1.jpg', '<p>Dimensions 153 x 75.7 x 7.9 mm</p>\r\n<p>Weight 155 g (5.47 oz)</p>\r\n<p>Hybrid Dual SIM</p>\r\n<p>DISPLAY Type IPS LCD</p>\r\n<p>Resolution 1080 x 2246 pixels,</p>\r\n<p>18.7:9 ratio (~402 ppi density) OS Android 8.0 (Oreo)</p>\r\n<p>Chipset Qualcomm SDM845 Snapdragon 845</p>\r\n<p>GPU Adreno 630</p>', '#000000,#c0c0c0', 49000, 48000, 'Hot', 2, '2019-02-10', '2019-02-10'),
(42, 'Skullcandy Over-Ear', '1.jpg', '<ul>\r\n<li>Type: Over-Ear</li>\r\n<li>Connection Type: Bluetooth&reg; or Wired</li>\r\n<li>Battery Life: Up to 40 Hours</li>\r\n<li>Rapid Charge: 10 Min = 3 Hours of Play</li>\r\n<li>Noise Isolation: Passive</li>\r\n<li>Driver Size: 40mm</li>\r\n</ul>', '#000000', 14000, 13900, 'Hot', 3, '2019-02-10', '2019-02-10'),
(43, 'Microlab Outlander', '1.jpg', '<ul>\r\n<li>Bluetooth Profiles: HSP, HFP, A2DP, AVRCP</li>\r\n<li>Frequency Response: 20 Hz - 20 kHz&nbsp;&nbsp;</li>\r\n<li>Sound pressure level: 115 &plusmn; 3 dB</li>\r\n<li>Impedance: 32 &Omega;</li>\r\n<li>Wireless Range: 10m</li>\r\n<li>Talk Time: 22H</li>\r\n<li>Standby Time: 900 hours</li>\r\n<li>Music Play Time: 20 hours</li>\r\n</ul>', '#000000', 9200, 9100, 'Speaker', 3, '2019-02-10', '2019-02-10'),
(44, 'DualShock 4 Wireless', '1.jpg', 'SKU HRDDASCPLU\r\n\r\nWeight 0.2100\r\n\r\nBrand Sony', '#ff0000', 3699, 3500, 'Gaming', 6, '2019-02-10', '2019-02-10'),
(45, 'Huawei MediaPad T3', '1.jpg', '<p>Model - Huawei MediaPad T3 10<br />Processor Type - Qualcomm MSM8917 Quad Core A53<br />RAM - 2GB<br />Processor Speed - 1.4GHz<br />Internal Memory - 16GB ROM<br />Display Type - IPS display<br />Display Size - 9.6\"<br />Screen Resolution - 1280 x 800</p>', '#000000', 19900, 18900, 'New', 7, '2019-02-10', '2019-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` text COLLATE utf8_bin NOT NULL,
  `order_status` text COLLATE utf8_bin NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `product_id`, `order_status`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '3:1:#000000:1', 'Delivered', 91000, '2019-02-02 07:32:33', '2019-02-11'),
(2, 2, '5:1:#c0c0c0:1,30:2:#000000:2', 'Delivered', 93000, '2019-02-11 14:12:27', '2019-02-11'),
(3, 2, '22:1:#000000:1', 'Delivered', 43999, '2019-02-07 16:29:16', '2019-02-11'),
(4, 3, '18:2:#000000:1,38:1:#8080ff:2,30:1:#000000:3', 'On Process', 209998, '2019-02-06 12:05:30', '2019-02-11'),
(5, 4, '12:1:#000000:2,17:1:#c0c0c0:3', 'On Process', 79500, '2019-02-11 16:56:54', '2019-02-11'),
(6, 4, '5:1:#c0c0c0:1', 'Cancel', 71000, '2019-02-11 17:07:40', '2019-02-11'),
(7, 4, '1:1:#c0c0c0:1', 'Placed', 205000, '2019-02-05 12:24:53', '2019-02-11'),
(8, 2, '20:1:#000000:1,25:1:#000000:2', 'Delivered', 21500, '2019-02-13 09:51:07', '2019-02-11'),
(9, 2, '27:1:#000000:1', 'Delivered', 30000, '2019-02-10 07:33:46', '2019-02-11'),
(10, 2, '44:1:#ff0000:1', 'Cancel', 3500, '2019-02-11 17:09:12', '2019-02-11'),
(11, 2, '28:1:#400080:1', 'On Process', 24000, '2019-02-11 17:09:49', '2019-02-11'),
(12, 2, '34:1:#ff0000:1', 'Delivered', 10500, '2019-02-05 04:55:26', '2019-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `prev_password` text COLLATE utf8_bin,
  `address_id` int(11) NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `prev_password`, `address_id`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Ariful Alam', 'a@gmail.com', '12345', NULL, 1, '01711001133', '2019-02-09', '2019-02-09'),
(2, 'Shakib Mostahid', 'b@gmail.com', '12345', NULL, 2, '01922991100', '2019-02-11', '2019-02-11'),
(3, 'Nishat Ashraf', 'c@gmail.com', '12345', NULL, 3, '01899001144', '2019-02-11', '2019-02-11'),
(4, 'Ayomi Hridy', 'd@gmail.com', '12345', NULL, 4, '0111111111', '2019-02-11', '2019-02-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`(250));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
