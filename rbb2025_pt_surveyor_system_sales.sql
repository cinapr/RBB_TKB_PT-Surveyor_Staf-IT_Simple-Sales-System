-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 10:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbb2025_pt surveyor_system sales`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `TotalPenjualanSales` (`sales` INT) RETURNS DECIMAL(12,2) DETERMINISTIC BEGIN
    DECLARE total DECIMAL(12,2);
    SELECT SUM(total_harga) INTO total
    FROM Penjualan
    WHERE sales_id = sales AND tanggal = CURDATE();
    RETURN IFNULL(total, 0);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_sales`
--

CREATE TABLE `aktivitas_sales` (
  `aktivitas_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `klien_id` int(11) DEFAULT NULL,
  `tanggal_aktivitas` date DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktivitas_sales`
--

INSERT INTO `aktivitas_sales` (`aktivitas_id`, `sales_id`, `klien_id`, `tanggal_aktivitas`, `deskripsi`) VALUES
(1, 1, 1, '2025-06-20', 'Presentasi produk'),
(2, 1, 2, '2025-06-21', 'Presentasi produk'),
(3, 2, 2, '2025-06-22', 'Demo produk'),
(4, 2, 3, '2025-06-23', 'Tanda-tangan deal penjualan');

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `klien_id` int(11) NOT NULL,
  `nama_klien` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `wilayah_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`klien_id`, `nama_klien`, `alamat`, `wilayah_id`) VALUES
(1, 'PT Klien1', 'Jl. Merdeka No.1', 1),
(2, 'PT Klien2', 'Jl. Indonesia No.2', 2),
(3, 'PT Klien3', 'Jl. Asia-Afrika No.3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `klien_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_harga` decimal(12,2) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `produk_id`, `sales_id`, `klien_id`, `tanggal`, `jumlah`, `total_harga`, `notes`) VALUES
(1, 1, 2, 3, '2025-06-24', 3, 3000000.00, NULL),
(2, 2, 2, 3, '2025-06-24', 3, 3200000.00, 'Diskon 100rb dari negosiasi'),
(3, 6, 2, 3, '2025-06-25', 3, 4500000.00, NULL),
(4, 1, 1, 3, '2025-06-23', 3, 3000000.00, NULL),
(5, 2, 1, 3, '2025-06-23', 3, NULL, 'Diskon 100rb dari negosiasi'),
(6, 6, 1, 3, '2025-06-23', 3, 4500000.00, NULL),
(7, 1, 1, 3, '2025-06-23', 3, 3000000.00, NULL),
(8, 2, 1, 3, '2025-06-23', 3, NULL, 'Diskon 100rb dari negosiasi'),
(9, 6, 1, 3, '2025-06-23', 3, 4500000.00, NULL),
(10, 2, 1, 3, '2025-06-23', 3, NULL, 'Diskon 100rb dari negosiasi'),
(11, 2, 1, 3, '2025-06-23', 3, NULL, 'Diskon 100rb dari negosiasi'),
(12, 6, 1, 3, '2025-06-23', 3, 4500000.00, NULL);

--
-- Triggers `penjualan`
--
DELIMITER $$
CREATE TRIGGER `HitungTotalHarga` BEFORE INSERT ON `penjualan` FOR EACH ROW BEGIN
    DECLARE harga DECIMAL(12,2);  -- ⬅️ Pindahkan ke atas
    IF NEW.notes IS NOT NULL THEN
        SELECT harga INTO harga FROM Produk WHERE produk_id = NEW.produk_id;
        SET NEW.total_harga = harga * NEW.jumlah;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `nama_produk` text NOT NULL,
  `kategori` text DEFAULT NULL,
  `harga` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `nama_produk`, `kategori`, `harga`) VALUES
(1, 'Produk1', 'Kategori1', 1000000),
(2, 'Produk2', 'Kategori1', 1100000),
(3, 'Produk3', 'Kategori1', 1200000),
(4, 'Produk4', 'Kategori2', 1300000),
(5, 'Produk5', 'Kategori2', 1400000),
(6, 'Produk6', 'Kategori2', 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sales_ID` int(11) NOT NULL,
  `nama_sales` text NOT NULL,
  `email` text DEFAULT NULL,
  `telepon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Sales_ID`, `nama_sales`, `email`, `telepon`) VALUES
(1, 'Sales1', 'sales1@ptxyz.co.id', '08123456789'),
(2, 'Sales2', 'sales2@ptxyz.co.id', '08123456789'),
(3, 'Sales3', 'sales3@ptxyz.co.id', '08123456789');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `Wilayah_ID` int(11) NOT NULL,
  `Provinsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`Wilayah_ID`, `Provinsi`) VALUES
(1, 'Nanggroe Aceh Darussalam'),
(2, 'Sumatera Utara'),
(3, 'Sumatera Selatan'),
(4, 'Sumatera Barat'),
(5, 'Bengkulu'),
(6, 'Riau'),
(7, 'Kepulauan Riau'),
(8, 'Jambi'),
(9, 'Lampung'),
(10, 'Bangka Belitung'),
(11, 'Kalimantan Barat'),
(12, 'Kalimantan Timur'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Utara'),
(16, 'Banten'),
(17, 'DKI Jakarta'),
(18, 'Jawa Barat'),
(19, 'Jawa Tengah'),
(20, 'Daerah Istimewa Yogyakarta'),
(21, 'Jawa Timur'),
(22, 'Bali'),
(23, 'Nusa Tenggara Timur'),
(24, 'Nusa Tenggara Barat'),
(25, 'Gorontalo'),
(26, 'Sulawesi Barat'),
(27, 'Sulawesi Tengah'),
(28, 'Sulawesi Utara'),
(29, 'Sulawesi Tenggara'),
(30, 'Sulawesi Selatan'),
(31, 'Maluku Utara'),
(32, 'Maluku'),
(33, 'Papua Barat'),
(34, 'Papua'),
(35, 'Papua Tengah'),
(36, 'Papua Pegunungan'),
(37, 'Papua Selatan'),
(38, 'Papua Barat Daya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas_sales`
--
ALTER TABLE `aktivitas_sales`
  ADD PRIMARY KEY (`aktivitas_id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `klien_id` (`klien_id`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`klien_id`),
  ADD KEY `wilayah_id` (`wilayah_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `klien_id` (`klien_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Sales_ID`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`Wilayah_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas_sales`
--
ALTER TABLE `aktivitas_sales`
  MODIFY `aktivitas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `klien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sales_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas_sales`
--
ALTER TABLE `aktivitas_sales`
  ADD CONSTRAINT `aktivitas_sales_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`Sales_ID`),
  ADD CONSTRAINT `aktivitas_sales_ibfk_2` FOREIGN KEY (`klien_id`) REFERENCES `klien` (`klien_id`);

--
-- Constraints for table `klien`
--
ALTER TABLE `klien`
  ADD CONSTRAINT `klien_ibfk_1` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`Wilayah_ID`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`Sales_ID`),
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`klien_id`) REFERENCES `klien` (`klien_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
