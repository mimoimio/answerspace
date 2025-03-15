SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `answers` (`id`, `answer_text`, `user_id`, `time_created`) VALUES
(34, 'Hello\r\n', 32, '2025-02-26 15:33:54'),
(35, 'Um Hello, hello? The animatronics do get a bit quirky at night', 30, '2025-02-26 15:38:42'),
(36, '12312312312381u3971923210301238109238', 30, '2025-02-26 15:39:51'),
(37, 'looooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooolooooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooolooooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooolooooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooolooooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooolooooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooolooooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooo\r\n', 30, '2025-02-26 15:40:59'),
(38, 'wow', 30, '2025-02-26 15:42:26'),
(39, 'Hello', 30, '2025-02-26 15:55:16'),
(40, '', 30, '2025-02-26 16:06:08'),
(41, 'Yee Haw\r\n', 32, '2025-02-26 16:11:42'),
(42, 'Hello apa khabar', 33, '2025-02-27 10:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `background` VARCHAR(50) NOT NULL DEFAULT 'white',
  `time_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `background`, `time_created`) VALUES
(30, 'Mior', '$2y$10$Zyo5RBS.MuS2e2ZlBXXzjOPuL464FMViMLyPR/D8Clg2BUTCt41aW', 'white', '2025-02-26 08:10:42'),
(31, 'Adib', '$2y$10$hU3/NBBS8oVccvcI3nW2SOeCEzJO5BxKcaiHc3v0OQQQjs8HagDT6', 'white', '2025-02-26 08:10:58'),
(32, 'lol', '$2y$10$csqyshtx3wEA5FILizTi5uurNQJROQrKJ8vYr.0uy84JK3OAYNNOC', 'white', '2025-02-26 15:00:58'),
(33, 'MiorAdib', '$2y$10$EresARIRxQlAG/lXfTq1eOD194pRQsrDL7z0toNcDtN6SjMnhXoCG', 'white', '2025-02-27 10:47:28');

--
-- Indexes for dumped tablesa
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
