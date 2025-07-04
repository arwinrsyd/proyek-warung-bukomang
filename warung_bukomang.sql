-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 05:53 AM
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
-- Database: `warung_bukomang`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_menu`, `jumlah`, `subtotal`) VALUES
(36, 22, 5, 1, 13000),
(37, 23, 3, 1, 21000),
(38, 24, 6, 1, 21000),
(39, 24, 12, 1, 21000),
(40, 25, 5, 1, 13000);

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(11) NOT NULL,
  `nomor_meja` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `nomor_meja`) VALUES
(1, '01'),
(2, '02'),
(3, '03'),
(4, '04'),
(5, '05'),
(6, '06'),
(7, '07'),
(8, '08'),
(9, '09'),
(10, '10');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` enum('Makanan','Minuman') NOT NULL,
  `status` enum('Tersedia','Habis') NOT NULL DEFAULT 'Tersedia',
  `gambar` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `kategori`, `status`, `gambar`) VALUES
(3, 'Nasi Campur', 21000, 'Makanan', 'Tersedia', 'nasi-campur.jpg'),
(4, 'Nasi Goreng Bali', 13000, 'Makanan', 'Tersedia', 'menu-1750321224.jpg'),
(5, 'Mie Goreng Babi', 13000, 'Makanan', 'Tersedia', 'menu-1750321271.jpeg'),
(6, 'Babi Goreng Crispy', 21000, 'Makanan', 'Tersedia', 'menu-1750321403.jpg'),
(8, 'Babi Guling', 26500, 'Makanan', 'Tersedia', 'menu-1750321490.jpeg'),
(9, 'Babi Kecap', 26500, 'Makanan', 'Tersedia', 'menu-1750321563.jpeg'),
(10, 'Babi Panggang', 26500, 'Makanan', 'Tersedia', 'menu-1750321599.jpg'),
(11, 'Kulit Babi', 26500, 'Makanan', 'Tersedia', 'menu-1750321827.jpg'),
(12, 'Sate Babi per porsi', 21000, 'Makanan', 'Tersedia', 'menu-1750321865.jpeg'),
(13, 'Sate Babi per tusuk', 4500, 'Makanan', 'Tersedia', 'menu-1750321875.jpeg'),
(14, 'Sate Lilit per porsi', 21000, 'Makanan', 'Tersedia', 'menu-1750321945.jpeg'),
(15, 'Sate Lilit per tusuk', 4500, 'Makanan', 'Tersedia', 'menu-1750321960.jpeg'),
(16, 'Sop Babi', 12500, 'Makanan', 'Tersedia', 'menu-1750321987.jpg'),
(18, 'Nasi Ayam Betutu', 21000, 'Makanan', 'Tersedia', 'menu-1750322145.jpeg'),
(19, 'Nasi Jinggo', 10500, 'Makanan', 'Tersedia', 'menu-1750322228.jpg'),
(20, 'Sambal Matah', 5000, 'Makanan', 'Tersedia', 'menu-1750322264.jpg'),
(23, 'Nasi Putih', 4000, 'Makanan', 'Tersedia', 'menu-1750322312.jpeg'),
(24, 'Sam Cam Bali', 31000, 'Makanan', 'Tersedia', 'menu-1750322342.jpeg'),
(26, 'Plecing Kangkung', 7000, 'Makanan', 'Tersedia', 'menu-1750322383.jpg'),
(29, 'Es Buah', 11000, 'Minuman', 'Tersedia', 'menu-1750322437.jpg'),
(30, 'Es Teler', 11000, 'Minuman', 'Tersedia', 'menu-1750322481.jpg'),
(32, 'Es Jeruk', 4500, 'Minuman', 'Tersedia', 'menu-1750322552.jpg'),
(33, 'Es Teh', 3500, 'Minuman', 'Tersedia', 'menu-1750322621.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `nomor_va` varchar(100) DEFAULT NULL,
  `id_meja` int(11) NOT NULL,
  `waktu_pesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `status_pesanan` enum('Menunggu Pembayaran','Diproses','Siap Disajikan','Selesai') NOT NULL,
  `metode_pembayaran` enum('Tunai','QRIS') NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_pembayaran` enum('Belum Bayar','Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `order_id`, `nomor_va`, `id_meja`, `waktu_pesanan`, `status_pesanan`, `metode_pembayaran`, `total_harga`, `status_pembayaran`) VALUES
(22, 'WBK-VA-1751597429', '68783756048681406966933', 5, '2025-07-04 09:50:29', 'Menunggu Pembayaran', '', 13000, ''),
(23, 'WBK-VA-1751598000', '68783752556579967860757', 5, '2025-07-04 10:00:00', 'Siap Disajikan', '', 21000, 'Lunas'),
(24, 'WBK-VA-1751598961', '68783522570454246943005', 2, '2025-07-04 10:16:01', 'Siap Disajikan', '', 42000, 'Lunas'),
(25, 'WBK-VA-1751599220', '68783135333176357992891', 2, '2025-07-04 10:20:20', 'Menunggu Pembayaran', '', 13000, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Kasir','Dapur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `role`) VALUES
(1, 'Admin Utama', 'admin', '$2y$10$5EVcZbA5uZWlR3INZKtGt.Y485gwp4yNJXJ3GkkevvCA0C/3kzdq.', 'Admin'),
(2, 'Kasir Satu', 'kasir', '$2y$10$5EVcZbA5uZWlR3INZKtGt.Y485gwp4yNJXJ3GkkevvCA0C/3kzdq.', 'Kasir'),
(3, 'Tim Dapur', 'dapur', '$2y$10$5EVcZbA5uZWlR3INZKtGt.Y485gwp4yNJXJ3GkkevvCA0C/3kzdq.', 'Dapur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_meja` (`id_meja`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
