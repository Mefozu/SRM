-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 25 2024 г., 03:18
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kryto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `absences`
--

CREATE TABLE `absences` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `absences`
--

INSERT INTO `absences` (`id`, `user_id`, `start_date`, `end_date`, `type`, `created_at`, `updated_at`) VALUES
(2, 8, '2024-06-06', '2024-06-21', 'sick', '2024-06-24 12:44:26', '2024-06-24 12:44:26'),
(3, 8, '2024-06-12', '2024-06-26', 'sick', '2024-06-24 15:03:44', '2024-06-24 15:03:44'),
(4, 8, '2024-06-24', '2024-06-27', 'sick', '2024-06-24 21:01:39', '2024-06-24 21:01:39');

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `manager_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `manager_id`, `name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'test', '2024-06-22 06:41:50', '2024-06-22 06:41:50'),
(2, NULL, 'аваыв', '2024-06-22 06:51:06', '2024-06-24 13:06:39'),
(3, NULL, 'aboba', '2024-06-22 06:54:02', '2024-06-24 14:14:23'),
(4, 6, 'It', '2024-06-24 16:41:09', '2024-06-24 19:44:38');

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_duties` text COLLATE utf8mb4_unicode_ci,
  `passport_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `hookies`
--

CREATE TABLE `hookies` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_03_144726_users_info', 1),
(6, '2024_06_07_131032_add_profile_fields_to_users_table', 1),
(7, '2024_06_17_100516_add_is_admin_to_users_table', 1),
(8, '2024_06_17_104431_create_departments_table', 1),
(9, '2024_06_22_093013_add_role_to_users_table', 2),
(10, '2024_06_22_095241_add_department_id_to_users_table', 3),
(12, '2024_06_22_111957_create_tasks_table', 4),
(13, '2024_06_22_133605_update_users_table_columns', 5),
(14, '2024_06_22_134033_add_missing_fields_to_users_table', 6),
(16, '2024_06_22_162859_add_created_by_to_tasks_table', 7),
(20, '2024_06_23_153625_create_absences_table', 8),
(22, '2024_06_24_153246_create_hookies_table', 9),
(23, '2024_06_24_154902_add_manager_id_to_departments_table', 10),
(24, '2024_06_24_185244_add_status_to_tasks_table', 11),
(25, '2024_06_24_191708_add_reviewer_id_to_tasks_table', 12),
(26, '2024_06_24_192319_add_rejection_reason_to_tasks_table', 13),
(27, '2024_06_24_193614_add_completed_at_to_tasks_table', 14),
(28, '2024_06_24_213802_add_is_additional_to_tasks_table', 15);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `assigned_to` bigint UNSIGNED DEFAULT NULL,
  `reviewer_id` bigint UNSIGNED DEFAULT NULL,
  `rejection_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `due_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `completed_at` timestamp NULL DEFAULT NULL,
  `is_additional` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `reviewer_id`, `rejection_reason`, `created_by`, `department_id`, `due_date`, `created_at`, `updated_at`, `status`, `completed_at`, `is_additional`) VALUES
(5, 'hghg', 'hghghg', 6, NULL, NULL, 1, NULL, '2024-06-28 11:22:00', '2024-06-23 08:22:30', '2024-06-24 16:30:30', 'in_review', NULL, 0),
(7, 'gfgf', 'gfgfg', 6, NULL, NULL, 1, NULL, '2024-06-18 11:41:00', '2024-06-23 08:41:46', '2024-06-24 16:38:02', 'completed', '2024-06-24 16:38:02', 0),
(9, 'fgfgf', 'gfgf', 6, NULL, NULL, 2, NULL, '2024-06-18 18:19:00', '2024-06-23 15:19:27', '2024-06-24 17:40:03', 'in_review', NULL, 0),
(11, 'Первая', 'тестовая', 6, NULL, NULL, 2, NULL, '2024-06-26 19:18:00', '2024-06-24 16:18:58', '2024-06-24 16:38:01', 'completed', '2024-06-24 16:38:01', 0),
(12, 'Вторая', 'аввфвфы', 6, NULL, NULL, 2, NULL, '2024-06-25 19:29:00', '2024-06-24 16:29:25', '2024-06-24 16:38:00', 'completed', '2024-06-24 16:38:00', 0),
(13, 'dsds', 'dsds', 6, NULL, NULL, 6, NULL, '2024-06-19 19:30:00', '2024-06-24 16:30:12', '2024-06-24 16:37:57', 'completed', '2024-06-24 16:37:57', 0),
(14, 'da', 'da', NULL, NULL, NULL, 2, 2, '2024-06-27 19:47:00', '2024-06-24 16:47:31', '2024-06-24 16:47:31', 'pending', NULL, 0),
(16, 'вывы', 'вывы', NULL, NULL, NULL, 2, 2, '2024-06-27 19:49:00', '2024-06-24 16:49:59', '2024-06-24 16:49:59', 'pending', NULL, 0),
(17, 'Da', 'da', NULL, NULL, NULL, 2, 2, '2024-06-25 19:52:00', '2024-06-24 16:52:53', '2024-06-24 16:52:53', 'pending', NULL, 0),
(18, 'пвапва', 'павпва', NULL, NULL, NULL, 1, 4, '2024-06-27 20:10:00', '2024-06-24 17:10:15', '2024-06-24 17:10:15', 'pending', NULL, 0),
(19, 'Параша', 'параша', NULL, NULL, NULL, 1, 4, '2024-06-27 20:10:00', '2024-06-24 17:10:40', '2024-06-24 17:10:40', 'pending', NULL, 0),
(20, 'тестовая', 'тестовая', NULL, NULL, NULL, 1, 4, '2024-06-28 20:19:00', '2024-06-24 17:19:14', '2024-06-24 17:19:14', 'pending', NULL, 0),
(22, 'да', 'нет', NULL, NULL, NULL, 1, 1, '2024-06-26 20:39:00', '2024-06-24 17:39:11', '2024-06-24 17:39:11', 'pending', NULL, 0),
(23, 'dsds', 'dsdsd', 6, NULL, NULL, 1, NULL, '2024-06-26 22:37:00', '2024-06-24 19:38:02', '2024-06-24 19:56:47', 'in_review', NULL, 1),
(24, 'dsdsd', 'dsdsd', 6, NULL, NULL, 1, NULL, '2024-06-27 22:38:00', '2024-06-24 19:38:12', '2024-06-24 19:53:47', 'in_review', NULL, 0),
(25, 'dsds', 'dsds', NULL, NULL, NULL, 1, 3, '2024-06-28 22:38:00', '2024-06-24 19:38:19', '2024-06-24 19:38:19', 'pending', NULL, 0),
(26, 'dsdsds', 'dsdsds', 8, NULL, NULL, 1, NULL, '2024-06-29 22:38:00', '2024-06-24 19:38:38', '2024-06-24 19:38:38', 'pending', NULL, 1),
(27, 'авав', 'ававав', 6, NULL, NULL, 1, NULL, '2024-06-27 22:45:00', '2024-06-24 19:45:38', '2024-06-24 19:56:44', 'in_review', NULL, 1),
(28, 'авыа', 'аываыва', 6, NULL, NULL, 1, NULL, '2024-06-28 22:50:00', '2024-06-24 19:50:50', '2024-06-24 19:56:45', 'in_review', NULL, 1),
(29, 'пвапв', 'апвапвап', 6, NULL, NULL, 1, NULL, '2024-06-28 22:52:00', '2024-06-24 19:52:10', '2024-06-24 19:56:41', 'in_review', NULL, 1),
(30, 'папа', 'папап', 6, NULL, NULL, 6, NULL, '2024-06-26 23:04:00', '2024-06-24 20:04:52', '2024-06-24 20:59:34', 'in_review', NULL, 0),
(31, 'авав', 'ававав', 8, NULL, NULL, 6, NULL, '2024-07-01 23:11:00', '2024-06-24 20:11:37', '2024-06-24 21:00:06', 'in_review', NULL, 0),
(32, 'DSDSD', 'dsdsdsd', 8, NULL, NULL, 6, NULL, '2024-07-17 23:11:00', '2024-06-24 20:11:55', '2024-06-24 21:00:05', 'in_review', NULL, 0),
(34, 'вфвфв', 'фывфывфы', 8, NULL, NULL, 6, NULL, '2024-06-28 23:15:00', '2024-06-24 20:15:11', '2024-06-24 21:00:07', 'in_review', NULL, 0),
(35, 'вфвф', 'ввфыв', 8, NULL, NULL, 6, NULL, '2024-06-26 23:15:00', '2024-06-24 20:15:27', '2024-06-24 21:00:01', 'in_review', NULL, 1),
(36, 'вфвфыв', 'фывыв', 8, NULL, NULL, 6, NULL, '2024-06-29 23:18:00', '2024-06-24 20:18:05', '2024-06-24 21:00:03', 'in_review', NULL, 0),
(37, 'аыаыаы', 'ваываыв', 8, NULL, NULL, 6, NULL, '2024-06-27 23:19:00', '2024-06-24 20:19:34', '2024-06-24 20:59:59', 'in_review', NULL, 0),
(39, 'dadas', 'dasd', 6, NULL, NULL, 6, NULL, '2024-06-26 23:58:00', '2024-06-24 20:58:46', '2024-06-24 20:59:29', 'in_review', NULL, 0),
(40, 'dadas', 'dasd', NULL, NULL, NULL, 6, 1, '2024-06-27 23:58:00', '2024-06-24 20:58:55', '2024-06-24 20:58:55', 'pending', NULL, 1),
(41, 'dadas', 'dd', NULL, NULL, NULL, 6, 1, '2024-06-27 23:59:00', '2024-06-24 20:59:05', '2024-06-24 20:59:05', 'pending', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duties` text COLLATE utf8mb4_unicode_ci,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `passport_number`, `department`, `position`, `duties`, `is_admin`, `department_id`, `role`, `phone_number`, `age`, `gender`, `status`) VALUES
(1, 'Admin', 'admin@test.ru', NULL, '$2y$10$dWOaioPsaeOtv/td7.pmTOMKr5M82TqtTKVQaGVnHt3qqCXFjDYHC', 'NAlpuwrBmmnQzk92gsL7ZJ3m1yG9nkQmATK1gvXAyDwsq3qlb9SXId7XD0Wf', '2024-06-22 05:56:24', '2024-06-22 06:01:09', NULL, '', NULL, NULL, 1, NULL, 'admin', NULL, NULL, NULL, NULL),
(6, 'Pupa', 'pupa@lupa.com', NULL, '$2y$10$LCrX93Adm7hQjMBXYTQ5mO5QouGFjFuBjhKKDpBVC5ec40xgg8Yqe', NULL, '2024-06-23 07:53:19', '2024-06-24 19:44:38', NULL, '', NULL, NULL, 0, 4, 'manager', NULL, NULL, NULL, NULL),
(8, 'fdf', 'dddd@ddd.ru', NULL, '$2y$10$KgDAhkCHiAEXs.zKsLiifuOCd0qSoTDX5JHWTs3ViQa2M4ncw.wNC', NULL, '2024-06-24 12:16:54', '2024-06-24 17:02:53', '434343443', '', NULL, NULL, 0, 4, '', '4343433', 32, 'male', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absences_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_manager_id_foreign` (`manager_id`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `hookies`
--
ALTER TABLE `hookies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hookies_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_assigned_to_foreign` (`assigned_to`),
  ADD KEY `tasks_department_id_foreign` (`department_id`),
  ADD KEY `tasks_reviewer_id_foreign` (`reviewer_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `absences`
--
ALTER TABLE `absences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hookies`
--
ALTER TABLE `hookies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `hookies`
--
ALTER TABLE `hookies`
  ADD CONSTRAINT `hookies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
