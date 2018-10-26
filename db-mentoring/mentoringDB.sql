-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Out-2018 às 14:40
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id7197263_mentoring`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_limit_knowledge` int(11) NOT NULL DEFAULT '5',
  `admin_limit_user` int(11) NOT NULL DEFAULT '10',
  `admin_user_active` tinyint(1) NOT NULL DEFAULT '1',
  `admin_user_fk` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrers`
--

CREATE TABLE `carrers` (
  `carrer_id` int(10) UNSIGNED NOT NULL,
  `carrer_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrer_active` tinyint(1) NOT NULL DEFAULT '0',
  `fk_carrer_profession` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `connections`
--

CREATE TABLE `connections` (
  `connection_id` int(10) UNSIGNED NOT NULL,
  `connection_start` date DEFAULT NULL,
  `connection_end` date DEFAULT NULL,
  `connection_status` tinyint(4) NOT NULL DEFAULT '0',
  `fk_connection_user` int(10) UNSIGNED NOT NULL,
  `fk_connection_knowledge` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(10) UNSIGNED NOT NULL,
  `contact_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_contact_user` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contents`
--

CREATE TABLE `contents` (
  `content_id` int(10) UNSIGNED NOT NULL,
  `content_content` text COLLATE utf8mb4_unicode_ci,
  `content_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_type` tinyint(4) NOT NULL DEFAULT '1',
  `content_active` tinyint(1) NOT NULL DEFAULT '1',
  `fk_content_knowledge` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `knowledges`
--

CREATE TABLE `knowledges` (
  `knowledge_id` int(10) UNSIGNED NOT NULL,
  `knowledge_rank` double DEFAULT NULL,
  `knowledge_nivel` tinyint(4) NOT NULL DEFAULT '1',
  `knowledge_active` tinyint(1) NOT NULL DEFAULT '0',
  `fk_knowledge_user` int(10) UNSIGNED NOT NULL,
  `fk_knowledge_subject` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_09_25_115645_create_users_table', 1),
(2, '2018_09_25_115800_create_professions_table', 1),
(3, '2018_09_25_115842_create_carrers_table', 1),
(4, '2018_09_25_115852_create_subjects_table', 1),
(5, '2018_09_25_120234_create_knowledge_table', 1),
(6, '2018_09_25_120236_create_contents_table', 1),
(7, '2018_09_25_120244_create_connections_table', 1),
(8, '2018_09_28_220818_create_contacts_table', 1),
(9, '2018_09_28_221211_create_user_subjects_table', 1),
(10, '2018_10_06_215347_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professions`
--

CREATE TABLE `professions` (
  `profession_id` int(10) UNSIGNED NOT NULL,
  `profession_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(10) UNSIGNED NOT NULL,
  `subject_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_active` tinyint(1) NOT NULL DEFAULT '0',
  `fk_subject_carrer` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_login` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_hash` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_cpf` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_nome` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_rg` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_telefone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_celular` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_knowledge` tinyint(1) NOT NULL DEFAULT '0',
  `user_role` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `usersubjects`
--

CREATE TABLE `usersubjects` (
  `fk_user_subject` int(10) UNSIGNED NOT NULL,
  `fk_subject_user` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admins_admin_user_fk_foreign` (`admin_user_fk`);

--
-- Indexes for table `carrers`
--
ALTER TABLE `carrers`
  ADD PRIMARY KEY (`carrer_id`),
  ADD UNIQUE KEY `carrers_carrer_name_unique` (`carrer_name`),
  ADD KEY `carrers_fk_carrer_profession_foreign` (`fk_carrer_profession`);

--
-- Indexes for table `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`connection_id`),
  ADD KEY `connections_fk_connection_user_foreign` (`fk_connection_user`),
  ADD KEY `connections_fk_connection_knowledge_foreign` (`fk_connection_knowledge`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `contacts_fk_contact_user_foreign` (`fk_contact_user`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `contents_fk_content_knowledge_foreign` (`fk_content_knowledge`);

--
-- Indexes for table `knowledges`
--
ALTER TABLE `knowledges`
  ADD PRIMARY KEY (`knowledge_id`),
  ADD KEY `knowledges_fk_knowledge_user_foreign` (`fk_knowledge_user`),
  ADD KEY `knowledges_fk_knowledge_subject_foreign` (`fk_knowledge_subject`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`profession_id`),
  ADD UNIQUE KEY `professions_profession_name_unique` (`profession_name`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subjects_subject_name_unique` (`subject_name`),
  ADD KEY `subjects_fk_subject_carrer_foreign` (`fk_subject_carrer`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_user_login_unique` (`user_login`),
  ADD UNIQUE KEY `users_user_email_unique` (`user_email`),
  ADD UNIQUE KEY `users_user_cpf_unique` (`user_cpf`);

--
-- Indexes for table `usersubjects`
--
ALTER TABLE `usersubjects`
  ADD KEY `usersubjects_fk_subject_user_foreign` (`fk_subject_user`),
  ADD KEY `usersubjects_fk_user_subject_foreign` (`fk_user_subject`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carrers`
--
ALTER TABLE `carrers`
  MODIFY `carrer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `connections`
--
ALTER TABLE `connections`
  MODIFY `connection_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `content_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `knowledges`
--
ALTER TABLE `knowledges`
  MODIFY `knowledge_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `profession_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_admin_user_fk_foreign` FOREIGN KEY (`admin_user_fk`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `carrers`
--
ALTER TABLE `carrers`
  ADD CONSTRAINT `carrers_fk_carrer_profession_foreign` FOREIGN KEY (`fk_carrer_profession`) REFERENCES `professions` (`profession_id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `connections`
--
ALTER TABLE `connections`
  ADD CONSTRAINT `connections_fk_connection_knowledge_foreign` FOREIGN KEY (`fk_connection_knowledge`) REFERENCES `knowledges` (`knowledge_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `connections_fk_connection_user_foreign` FOREIGN KEY (`fk_connection_user`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_fk_contact_user_foreign` FOREIGN KEY (`fk_contact_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_fk_content_knowledge_foreign` FOREIGN KEY (`fk_content_knowledge`) REFERENCES `knowledges` (`knowledge_id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `knowledges`
--
ALTER TABLE `knowledges`
  ADD CONSTRAINT `knowledges_fk_knowledge_subject_foreign` FOREIGN KEY (`fk_knowledge_subject`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `knowledges_fk_knowledge_user_foreign` FOREIGN KEY (`fk_knowledge_user`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_fk_subject_carrer_foreign` FOREIGN KEY (`fk_subject_carrer`) REFERENCES `carrers` (`carrer_id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usersubjects`
--
ALTER TABLE `usersubjects`
  ADD CONSTRAINT `usersubjects_fk_subject_user_foreign` FOREIGN KEY (`fk_subject_user`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usersubjects_fk_user_subject_foreign` FOREIGN KEY (`fk_user_subject`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
