-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2025 pada 21.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barbershop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail_pembelian` varchar(36) NOT NULL,
  `id_pembelian` varchar(36) DEFAULT NULL,
  `id_produk` varchar(36) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` varchar(36) NOT NULL,
  `id_pesanan` varchar(36) DEFAULT NULL,
  `id_layanan` varchar(36) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` varchar(36) NOT NULL,
  `nama_layanan` varchar(50) DEFAULT NULL,
  `kategori` varchar(30) DEFAULT NULL,
  `harga_layanan` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `kategori`, `harga_layanan`, `deskripsi`, `gambar`) VALUES
('L001', 'Hair Tatto', 'Layanan Tambahan', 10000, 'Seni menggambar membuat pola gambar di media rambut ', 'img_683c43e5d71cc2.42788664.jpeg'),
('L002', 'Hair Mask', 'Layanan Tambahan', 15000, 'Perawatan kesehatan rambut ', 'img_683c47a63f6448.46137112.jpeg'),
('L003', 'Potong Jenggot', 'Layanan Tambahan', 10000, 'Membersihkan jenggot dan kumis', 'img_683c48cc7f48e8.54234965.jpeg'),
('L004', 'Men\'s Hair Smoothing', 'Smoothing', 275000, 'Hair treatment yang berjuan membuat rambut ikal/ kriting menjadi lurus, lembut dan mudah di atur', 'img_683c4ac1076443.00491409.jpeg'),
('L005', 'Design Perm & Down Perm', 'Hair Perm', 250000, 'memperbaiki pola rambut seperti: merapikan rambut yang jingkrak, membuat volome di rambut atas, sehingga tampak seperti Korean hairstyle.', 'img_683c4d42cecf76.11609387.jpeg'),
('L006', 'Curly Perm', 'Hair Perm', 185000, 'Hair treatment yang bertujuan untuk meubah jenis rambut menjadi ikal atau kriting.', 'img_683c4e13bc08b8.81879660.jpeg'),
('L007', 'Men\'s Fasion Hair Color', 'Hair Color', 125000, 'Mewarnai rambut dengan warna yang menyala', 'img_683c4f6ee99b34.07845370.jpeg'),
('L008', 'Men\'s Basic Hair Color', 'Hair Color', 90000, 'Hair color dengan warna basic, atau hairlight', 'img_683c503a2f4f55.44579446.jpeg'),
('L010', 'Hair Cut Reguler', 'Haircut', 20000, 'Cukur rambut dengan model standar', 'img_683c52034050e7.37852784.jpeg'),
('L011', 'Long Trim Hair Cut', 'Haircut', 25000, 'Cukur rambut dengan model rambut panjang atau gondrong.', 'img_683c5282105758.65226202.jpeg'),
('L012', 'Fade Haircut', 'Haircut', 25000, 'Cukur rambut yang di mulai dari sangat tipis atau 0 dengan di satukan dengan rambut bagian atas sehingga menciptakan gradasi yang blur.', 'img_683c53465571f0.38960358.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` varchar(36) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status_pembelian` enum('Belum dibayar','Menunggu Konfirmasi','Dikonfirmasi','Diproses','Dikirim','Selesai') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(36) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status_pesanan` enum('Belum dibayar','Menunggu Konfirmasi','Dikonfirmasi','Diproses','Selesai','Dibatalkan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(36) NOT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `kategori` varchar(30) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori`, `harga`, `stok`, `deskripsi`, `gambar`) VALUES
('P001', 'Makaziro 100ml', 'Hair spray', 26000, 12, 'Membuat rambut anti lepek\r\n', 'img_683c54d7338550.07679824.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` varchar(36) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `role` enum('Admin','Customer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `telp`, `role`) VALUES
('U001', 'admin', 'admin123', 'Almas Atmin', 'Jumantono,Karanganyar', '0811111111', 'Admin'),
('U002', 'bagas', 'cus123', 'Bagas Prabowo', 'Pasar Kliwon', '0895620469494', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail_pembelian`),
  ADD KEY `fk_detail_pembelian_pembelian` (`id_pembelian`),
  ADD KEY `fk_detail_pembelian_produk` (`id_produk`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `fk_detail_pesanan_pesanan` (`id_pesanan`),
  ADD KEY `fk_detail_pesanan_layanan` (`id_layanan`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `fk_pembelian_user` (`id_user`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_pesanan_user` (`id_user`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `fk_ulasan_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `fk_detail_pembelian_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_pembelian_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `fk_detail_pesanan_layanan` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_pesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `fk_pembelian_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `fk_ulasan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
