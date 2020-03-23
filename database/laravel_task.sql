-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 23 2020 г., 09:31
-- Версия сервера: 10.4.6-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravel_task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_20_110418_create_properties_table', 1),
(5, '2020_03_20_110500_create_tenants_table', 1),
(6, '2020_03_20_110525_create_tenancies_table', 1),
(7, '2020_03_20_111728_add_foreign_key_tenant_id_table', 1),
(8, '2020_03_21_134209_add_foreign_key_user_id_into_properties_table', 2),
(9, '2020_03_22_175430_add_foreign_key_user_id_into_tenants_table', 3),
(10, '2020_03_23_074414_add_foreign_key_user_id_into_tenancies_table', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `properties`
--

INSERT INTO `properties` (`id`, `tenant_id`, `name`, `address`, `description`, `price`, `created_at`, `updated_at`, `user_id`) VALUES
(2, 3, 'Property 2', 'Address 2', 'Description 2', 1550.00, '2020-03-20 10:59:05', '2020-03-20 16:10:39', 1),
(3, NULL, 'Property 3', 'Address 3', 'Description 3', 1700.00, '2020-03-20 10:59:17', '2020-03-20 10:59:17', 1),
(4, 3, 'Property 4', 'Address 4', 'Description 4', 5000.00, '2020-03-20 10:59:29', '2020-03-20 15:07:02', 1),
(5, 2, 'Property 5', 'Address 5', 'Description 5', 2000.00, '2020-03-20 10:59:39', '2020-03-20 16:11:02', 1),
(8, NULL, 'Property 8', 'Address 8', 'Description 8', 12345.00, '2020-03-20 16:03:21', '2020-03-21 14:30:08', 1),
(9, NULL, 'Property 9', 'Address 9', 'Description 9', 8000.00, '2020-03-20 16:03:56', '2020-03-20 16:03:56', 1),
(11, 8, 'New Property', 'New Address', 'New Description', 15000.00, '2020-03-23 04:17:41', '2020-03-23 04:23:25', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tenancies`
--

CREATE TABLE `tenancies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `monthly_rent` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tenancies`
--

INSERT INTO `tenancies` (`id`, `property_id`, `tenant_id`, `start_date`, `end_date`, `monthly_rent`, `created_at`, `updated_at`, `user_id`) VALUES
(8, 2, 1, '2020-03-13 20:00:00', '2020-04-28 20:00:00', 2000, '2020-03-20 16:08:09', '2020-03-20 16:09:02', 1),
(9, 5, 1, '2020-03-18 20:00:00', '2020-04-25 20:00:00', 200, '2020-03-20 16:08:52', '2020-03-20 16:09:12', 1),
(10, 11, 8, '2020-03-22 20:00:00', '2020-04-22 20:00:00', 2000, '2020-03-23 04:23:25', '2020-03-23 04:23:25', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tenants`
--

INSERT INTO `tenants` (`id`, `name`, `phone`, `image`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Tenant 1', '0771234567', '1584908610.jpg', '2020-03-20 11:01:28', '2020-03-22 16:23:30', 1),
(2, 'Tenant 2', '0771234567552', '1584908781.gif', '2020-03-20 11:01:53', '2020-03-22 16:26:21', 1),
(3, 'Tenant 3', '077123477777', '1584716523.png', '2020-03-20 11:02:03', '2020-03-20 11:02:03', 1),
(8, 'New Tenant', '0123456789', '1584951752.jpg', '2020-03-23 04:21:16', '2020-03-23 04:22:32', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `is_admin`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 0, 'user@gmail.com', NULL, '$2y$10$4mYANCiSOmabIpExEPSlJu6SkhtM/cafyMY4UnI6Ek.3eG1Cj..Iu', NULL, '2020-03-20 10:54:45', '2020-03-20 10:54:45'),
(2, 'Admin', 1, 'admin@gmail.com', NULL, '$2y$10$t4AEdoHIJJpU3dr1fdY67OzYeLgKk6KDagFkV.dtz/pQ6vKAD0Z16', NULL, '2020-03-20 10:55:10', '2020-03-20 10:55:10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_tenant_id_foreign` (`tenant_id`),
  ADD KEY `properties_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `tenancies`
--
ALTER TABLE `tenancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenancies_property_id_foreign` (`property_id`),
  ADD KEY `tenancies_tenant_id_foreign` (`tenant_id`),
  ADD KEY `tenancies_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenants_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `tenancies`
--
ALTER TABLE `tenancies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tenancies`
--
ALTER TABLE `tenancies`
  ADD CONSTRAINT `tenancies_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tenancies_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tenancies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
