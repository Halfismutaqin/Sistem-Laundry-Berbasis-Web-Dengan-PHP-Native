-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2023 pada 03.24
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_service` varchar(15) NOT NULL,
  `qty` double NOT NULL,
  `ket_pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id`, `id_transaksi`, `id_service`, `qty`, `ket_pesan`) VALUES
(28, 2202091, '7', 10, 'kilat'),
(30, 2202101, '4', 2, 'tes'),
(31, 2202101, '6', 3, 'kilat'),
(32, 2202102, '2', 3, 'kilat'),
(33, 2202102, '4', 3, 'tes'),
(34, 2202103, '7', 2, 'Kilat'),
(35, 2204114, '1', 2, 'tes'),
(36, 2204114, '6', 10, 'qwerty'),
(43, 2301094, 'P49408', 5, 'cek ya'),
(44, 2301094, 'P8819', 9, 'oi'),
(45, 2301094, '4', 2, '...'),
(67, 2301114, 'P8819', 1, '-'),
(76, 2301114, '2', 2, '-'),
(77, 2301114, 'L3087', 1, ''),
(78, 2301115, '6', 1, '-\r\n'),
(79, 2301115, 'L3979', 1, ''),
(80, 2301116, '2', 2, '-'),
(81, 2301116, 'L3698', 1, ''),
(82, 2301117, '6', 1, '-'),
(83, 2301117, 'P49408', 3, '-'),
(84, 2301117, 'L3979', 1, ''),
(85, 2301138, '7', 2, ''),
(86, 2301138, 'L3087', 1, ''),
(87, 2301139, '6', 2, '-'),
(88, 2301139, 'P8819', 10, '-'),
(89, 2301139, 'L3698', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`id`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(1, 'Hadi', 'Karanganyar', 'L', '0856927379'),
(3, 'Andi Saputro', 'Karangpandan', 'L', '08512312311'),
(5, 'Aldo', 'Solo', 'L', '07843232'),
(7, 'Cek Nama', 'Cek Alamat', 'L', '08123123'),
(9, 'Hadi Mutaqin', 'wonorejo\r\nbejen', 'L', '085894464249'),
(11, 'Beni', 'Mojosongo', 'L', '0983904892'),
(12, 'Dilla', 'Sukoharjo', 'P', '0832931'),
(13, 'Jisoo', 'Karangasem', 'P', '08302932121'),
(14, 'Lulu', 'Karangpandan', 'P', '096327628711'),
(16, 'Kukuh', 'Jumantono', 'L', '0324784637124'),
(18, 'Mina', 'Johor', 'P', '0921786321');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id_outlet` int(11) NOT NULL,
  `nama_outlet` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_outlet`
--

INSERT INTO `tb_outlet` (`id_outlet`, `nama_outlet`, `alamat`, `tlp`) VALUES
(1, 'Laundry Half Solo', 'Karanganyar Kota', '085894464000'),
(2, 'Laundry Half Jaten', 'Jaten, Mojolaban Sukoharjo', '097553726');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_service`
--

CREATE TABLE `tb_service` (
  `id_service` varchar(15) NOT NULL,
  `kategori` enum('layanan','paket') NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `nama_service` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_service`
--

INSERT INTO `tb_service` (`id_service`, `kategori`, `jenis`, `nama_service`, `harga`, `keterangan`) VALUES
('2', 'paket', 'kiloan', 'Paket Hemat 30 Kg', 100000, ''),
('4', 'paket', 'lain', 'Paket Bulanan Murmer', 90000, ''),
('6', 'paket', 'lain', 'Paket Jas Atasan', 12000, ''),
('7', 'paket', 'kaos', 'Paket Super Hemat 10Kg', 30000, ''),
('L3087', 'layanan', 'reguler', 'Layanan Reguler', 0, 'Layanan Reguler atau laundry biasa sesuai paket yang dipilih'),
('L3698', 'layanan', 'kilat', 'Layanan Kilat', 10000, 'Laundry kilat 1 hari jadi, harga per item paket laundry'),
('L3979', 'layanan', 'express', 'Layanan Express', 20000, 'Laundry super kilat (4 jam Jadi), PLUS+ free pengiriman maks 1KM'),
('P49408', 'paket', 'gorden', 'Gorden', 10000, 'Untuk ukuran 2mx2m'),
('P8819', 'paket', 'karpet', 'Karpet Masjid (per meter)', 4000, 'Paket cucian karpet masjid per meter persegi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `kode_invoice` varchar(100) NOT NULL,
  `id_member` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `tgl_bayar` date NOT NULL,
  `biaya_tambahan` int(11) NOT NULL,
  `diskon` double NOT NULL,
  `status` enum('baru','proses','selesai','diambil') NOT NULL,
  `pembayaran` enum('lunas','belum dibayar') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `kode_invoice`, `id_member`, `tgl`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `status`, `pembayaran`, `id_user`) VALUES
(2202101, 'INV-23P8A5RKYU', 2, '2022-02-10 00:00:00', '2022-02-10', 10000, 0, 'baru', 'belum dibayar', 1),
(2202102, 'INV-6OTKS9IZQW', 1, '2022-02-10 00:00:00', '2022-02-10', 10000, 85500, 'baru', 'belum dibayar', 1),
(2202103, 'INV-GTVJSW5ZD1', 3, '2022-02-10 00:00:00', '2022-02-10', 0, 0, 'selesai', 'lunas', 1),
(2301114, 'INV-462NK', 11, '2023-01-11 00:00:00', '0000-00-00', 0, 15000, 'diambil', 'lunas', 4),
(2301115, 'INV-T8ADI', 5, '2023-01-11 00:00:00', '2023-01-11', 20000, 0, 'baru', 'lunas', 4),
(2301116, 'INV-K174E', 9, '2023-01-11 00:00:00', '0000-00-00', 10000, 15000, 'baru', 'belum dibayar', 4),
(2301117, 'INV-LUAZP', 12, '2023-01-11 00:00:00', '0000-00-00', 40000, 0, 'baru', 'belum dibayar', 2),
(2301138, 'INV-RL3HT', 14, '2023-01-13 09:01:38', '2023-01-13', 0, 0, 'baru', 'lunas', 2),
(2301139, 'INV-1MCET', 13, '2023-01-13 14:20:20', '0000-00-00', 20000, 0, 'baru', 'belum dibayar', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `role` enum('Admin','Kasir') NOT NULL,
  `id_outlet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `username`, `password`, `role`, `id_outlet`) VALUES
(1, 'Admin', '331', 'admin', 'admin', 'Admin', 0),
(2, 'Kasir', '155', 'kasir', 'kasir', 'Kasir', 0),
(3, 'aku', 'qq@g.v', 'owner', 'owner', 'Admin', 2),
(4, 'Hadi', 'hhh@gmail.com', 'kasir1', 'kasir', 'Kasir', 1),
(7, 'Hadi', 'a@a.a', 'hehe', 'hehe', 'Admin', 1),
(9, 'coba1', 'coba@g.cm', 'coba', 'coba', 'Kasir', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indeks untuk tabel `tb_service`
--
ALTER TABLE `tb_service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2301140;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
