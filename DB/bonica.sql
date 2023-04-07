-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2023 at 09:53 AM
-- Server version: 8.0.32
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bonica`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-Yes, 0-No',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `profile_image`, `email_verified_at`, `is_super`, `status`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$szWg1UC4cUxnuPQXCNiC8eQKxoy9HIh299CVmaL6FPAntMhxQof9u', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-Active, 0-Inactive',
  `created_by` bigint UNSIGNED NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'General Inspiration', 'general-inspiration', 1, '2022-12-27 13:38:08', NULL),
(2, 'General Lifestyle', 'general-lifestyle', 1, '2022-12-27 13:38:08', NULL),
(3, 'Jewelry Knowledge', 'jewelry-knowledge', 1, '2022-12-27 13:38:08', NULL),
(4, 'Latest Post', 'latest-post', 1, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bonica5bs3s`
--

CREATE TABLE `bonica5bs3s` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_1` text COLLATE utf8mb4_unicode_ci,
  `image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_2` text COLLATE utf8mb4_unicode_ci,
  `image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_3` text COLLATE utf8mb4_unicode_ci,
  `image_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_4` text COLLATE utf8mb4_unicode_ci,
  `image_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_5` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonica5bs3s`
--

INSERT INTO `bonica5bs3s` (`id`, `name`, `slug`, `banner_image`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `title`, `big_image`, `image_1`, `title_1`, `content_1`, `image_2`, `title_2`, `content_2`, `image_3`, `title_3`, `content_3`, `image_4`, `title_4`, `content_4`, `image_5`, `title_5`, `content_5`, `created_at`, `updated_at`) VALUES
(1, 'Bonica5bs3', 'bonica5bs3', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `shape_id` bigint UNSIGNED DEFAULT NULL,
  `metal_id` bigint UNSIGNED DEFAULT NULL,
  `material_id` bigint UNSIGNED DEFAULT NULL,
  `size_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `ip_address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `shape_id`, `metal_id`, `material_id`, `size_id`, `quantity`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL, NULL, NULL, 1, '::1', '2023-02-02 12:34:49', '2023-02-02 12:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT '0',
  `image` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discover_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `shopthelook_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopthelook_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_show_size_chart` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-Yes, 0-No',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `image`, `icon`, `banner_image`, `discover_image`, `discover_status`, `shopthelook_image`, `shopthelook_status`, `description`, `is_show_size_chart`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Sale', 'sale', 0, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 1, NULL, NULL),
(2, 'Rings', 'rings', 0, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 2, NULL, NULL),
(3, 'Earrings', 'earrings', 0, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 3, NULL, NULL),
(4, 'Bracelets', 'bracelets', 0, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 4, NULL, NULL),
(5, 'Bangles', 'bangles', 0, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 5, NULL, NULL),
(6, 'Pendants', 'pendants', 0, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 6, NULL, NULL),
(7, 'Necklace', 'necklace', 0, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 7, NULL, NULL),
(8, 'Bands', 'bands', 2, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 1, NULL, NULL),
(9, 'Solitaire', 'solitaire', 2, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 2, NULL, NULL),
(10, 'Cocktail', 'cocktail', 2, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 3, NULL, NULL),
(11, 'Charm rings', 'charm-rings', 2, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 4, NULL, NULL),
(12, 'Studs', 'studs', 3, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 1, NULL, NULL),
(13, 'Drops', 'drops', 3, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 2, NULL, NULL),
(14, 'Bali', 'bali', 3, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 3, NULL, NULL),
(15, 'Hoops', 'hoops', 3, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 4, NULL, NULL),
(16, 'Solitaire', 'solitaire-4', 3, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 5, NULL, NULL),
(17, 'Tennis', 'tennis', 4, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 1, NULL, NULL),
(18, 'Stiff', 'stiff', 4, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 2, NULL, NULL),
(19, 'Flexible', 'flexible', 4, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 3, NULL, NULL),
(20, 'Charm', 'charm', 4, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 4, NULL, NULL),
(21, 'Solitaire', 'solitaire-2', 4, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 5, NULL, NULL),
(22, 'Round Bangless', 'round-bangles', 5, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 1, NULL, NULL),
(23, 'Oval Bangles', 'oval-bangles', 5, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 2, NULL, NULL),
(24, 'Cuffs', 'cuffs', 5, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 3, NULL, NULL),
(25, 'Workwear', 'workwear', 6, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 1, NULL, NULL),
(26, 'Partywear', 'partywear', 6, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 2, NULL, NULL),
(27, 'Casual', 'casual', 6, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 3, NULL, NULL),
(28, 'Solitaire', 'solitaire-3', 6, NULL, NULL, NULL, NULL, 1, NULL, 1, '', 0, NULL, NULL, NULL, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_faqs`
--

CREATE TABLE `category_faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `topic` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_faqs`
--

INSERT INTO `category_faqs` (`id`, `topic`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Popular Questions', 'popular-questions', 'popular-questions.svg', 1, '2022-12-27 13:38:08', NULL),
(2, 'Shipping Questions', 'shipping-questions', 'shipping-questions.svg', 1, '2022-12-27 13:38:08', NULL),
(3, 'Warranty', 'warranty', 'warranty.svg', 1, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clarities`
--

CREATE TABLE `clarities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `name`, `slug`, `banner_image`, `image`, `content`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'About', 'about-us', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL),
(2, 'Privacy Policy', 'privacy-policy', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL),
(3, 'Delivery & Returns', 'delivery-returns', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL),
(4, 'Warranty', 'warranty', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL),
(5, 'Terms Of Use', 'terms-of-use', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `shipping_charge` decimal(10,2) DEFAULT '0.00',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `slug`, `code`, `flag`, `currency`, `currency_code`, `symbol`, `rate`, `shipping_charge`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'India', 'india', 'IN', 'india-flag.svg', 'indian_rupee', 'INR', '&#8377;', '1.00', '0.00', 1, NULL, NULL),
(2, 'United States', 'united-states', 'US', 'united-states-flag.svg', 'us_dollar', 'USD', '&#36;', '81.58', '0.00', 2, NULL, NULL),
(3, 'United Kingdom', 'united-kingdom', 'GB', 'united-kingdom-flag.svg', 'british_pound', 'GBP', '&#163;', '88.29', '0.00', 3, NULL, NULL),
(4, 'Europe', 'europe', 'EU', 'europe-flag.svg', 'euro', 'EUR', '&#8364;', '78.58', '0.00', 4, NULL, NULL),
(5, 'Australia', 'australia', 'AU', 'australia-flag.svg', 'australian_dollar', 'USD', '&#36;', '81.58', '0.00', 5, NULL, NULL),
(6, 'Canada', 'canada', 'CA', 'canada-flag.svg', 'canadian_dollar', 'USD', '&#36;', '81.58', '0.00', 6, NULL, NULL),
(7, 'South Africa', 'south-africa', 'ZAR', 'south-africa-flag.svg', 'rand', 'ZAR', '&#82;', '4.65', '0.00', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `expired` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discover_products`
--

CREATE TABLE `discover_products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `cate_id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_pages`
--

CREATE TABLE `home_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_type` int NOT NULL DEFAULT '0' COMMENT '0 = Image , 1 = Video',
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `top_section_image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_section_image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_section_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_section_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_section_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image1_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image1_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image2_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image2_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image3_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image3_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image4_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image4_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image5_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image5_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image6_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shringaar_image6_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catalog_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catalog_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catalog_category_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon1_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon1_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon2_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon2_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon3_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon3_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon4_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonica_jewels_icon4_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommended_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommended_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_bonica_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_bonica_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_bonica_bg_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_bonica_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_pages`
--

INSERT INTO `home_pages` (`id`, `name`, `slug`, `banner_type`, `video`, `video_title`, `video_content`, `video_link`, `video_path`, `status`, `top_section_image1`, `top_section_image2`, `top_section_title`, `top_section_content`, `top_section_link`, `shringaar_title`, `shringaar_sub_title`, `shringaar_image1_title`, `shringaar_image1`, `shringaar_image1_link`, `shringaar_image2_title`, `shringaar_image2`, `shringaar_image2_link`, `shringaar_image3_title`, `shringaar_image3`, `shringaar_image3_link`, `shringaar_image4_title`, `shringaar_image4`, `shringaar_image4_link`, `shringaar_image5_title`, `shringaar_image5`, `shringaar_image5_link`, `shringaar_image6_title`, `shringaar_image6`, `shringaar_image6_link`, `catalog_title`, `catalog_sub_title`, `catalog_category_ids`, `bonica_jewels_title`, `bonica_jewels_sub_title`, `bonica_jewels_icon1`, `bonica_jewels_icon1_title`, `bonica_jewels_icon1_content`, `bonica_jewels_icon2`, `bonica_jewels_icon2_title`, `bonica_jewels_icon2_content`, `bonica_jewels_icon3`, `bonica_jewels_icon3_title`, `bonica_jewels_icon3_content`, `bonica_jewels_icon4`, `bonica_jewels_icon4_title`, `bonica_jewels_icon4_content`, `recommended_title`, `recommended_sub_title`, `about_bonica_title`, `about_bonica_content`, `about_bonica_bg_image`, `about_bonica_link`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', 'home-page', 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_page_sliders`
--

CREATE TABLE `home_page_sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `slider_type` int NOT NULL DEFAULT '0' COMMENT '0 = Image , 1 = Video',
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_sliders`
--

INSERT INTO `home_page_sliders` (`id`, `slider_type`, `video`, `video_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, NULL, 0, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_page_slider_images`
--

CREATE TABLE `home_page_slider_images` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labours`
--

CREATE TABLE `labours` (
  `id` bigint UNSIGNED NOT NULL,
  `metal_id` bigint UNSIGNED NOT NULL,
  `material_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL COMMENT 'per gram price',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labours`
--

INSERT INTO `labours` (`id`, `metal_id`, `material_id`, `price`, `created_at`, `updated_at`) VALUES
(76, 1, 1, '155.00', '2023-03-04 22:15:20', '2023-03-04 22:15:20'),
(77, 2, 1, '155.00', '2023-03-04 22:15:20', '2023-03-04 22:15:20'),
(78, 3, 1, '155.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(79, 4, 1, '400.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(80, 5, 1, '700.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(81, 1, 2, '200.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(82, 2, 2, '200.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(83, 3, 2, '200.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(84, 4, 2, '500.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(85, 5, 2, '800.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(86, 1, 3, '300.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(87, 2, 3, '300.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(88, 3, 3, '300.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(89, 4, 3, '600.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21'),
(90, 5, 3, '900.00', '2023-03-04 22:15:21', '2023-03-04 22:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, '10K', 1, 1, '2022-12-27 13:38:08', NULL),
(2, '14K', 2, 1, '2022-12-27 13:38:08', NULL),
(3, '18K', 3, 1, '2022-12-27 13:38:08', NULL),
(4, '22K', 0, 1, '2023-03-10 22:34:13', '2023-03-10 22:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `material_metals`
--

CREATE TABLE `material_metals` (
  `id` bigint UNSIGNED NOT NULL,
  `metal_id` bigint UNSIGNED NOT NULL,
  `material_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL COMMENT 'per gram price',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_metals`
--

INSERT INTO `material_metals` (`id`, `metal_id`, `material_id`, `price`, `created_at`, `updated_at`) VALUES
(16, 1, 1, '100.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(17, 2, 1, '100.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(18, 3, 1, '100.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(19, 4, 1, '10.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(20, 5, 1, '40.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(21, 1, 2, '200.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(22, 2, 2, '200.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(23, 3, 2, '200.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(24, 4, 2, '20.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(25, 5, 2, '50.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(26, 1, 3, '300.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(27, 2, 3, '300.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(28, 3, 3, '300.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(29, 4, 3, '30.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56'),
(30, 5, 3, '70.00', '2023-03-04 23:59:56', '2023-03-04 23:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `metals`
--

CREATE TABLE `metals` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bgcolor` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metals`
--

INSERT INTO `metals` (`id`, `name`, `bgcolor`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Yellow Gold', '#D4AF37', 1, 1, '2022-12-27 13:38:08', '2023-03-04 22:38:38'),
(2, 'White Gold', '#CECECE', 2, 1, '2022-12-27 13:38:08', NULL),
(3, 'Rose Gold', '#FFC1C1', 3, 1, '2022-12-27 13:38:08', NULL),
(4, 'Silver', '#E2E5E6', 4, 1, '2022-12-27 13:38:08', NULL),
(5, 'Platinum', '#C8C8C8', 5, 1, '2022-12-27 13:38:08', '2023-03-04 22:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_000000_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_12_01_094230_create_admins_table', 1),
(7, '2022_02_01_085904_create_jobs_table', 1),
(8, '2022_02_03_103704_create_contacts_table', 1),
(9, '2022_03_09_110121_create_categories_table', 1),
(10, '2022_07_05_110951_create_metals_table', 1),
(11, '2022_07_05_111044_create_sizes_table', 1),
(12, '2022_07_05_121847_create_products_table', 1),
(13, '2022_07_07_110538_create_product_sizes_table', 1),
(14, '2022_08_01_124329_create_cms_pages_table', 1),
(15, '2022_08_08_043246_create_home_page_sliders_table', 1),
(16, '2022_08_08_043257_create_home_page_slider_images_table', 1),
(17, '2022_08_10_064120_create_blog_categories_table', 1),
(18, '2022_08_10_064332_create_blogs_table', 1),
(19, '2022_08_19_051110_create_countries_table', 1),
(20, '2022_08_19_064357_create_size_countries_table', 1),
(21, '2022_08_19_064413_create_discover_products_table', 1),
(22, '2022_08_19_064448_create_shopthelook_products_table', 1),
(23, '2022_08_19_125248_create_shapes_table', 1),
(24, '2022_08_19_125259_create_product_shapes_table', 1),
(25, '2022_08_22_124513_create_category_faqs_table', 1),
(26, '2022_08_22_124530_create_faqs_table', 1),
(27, '2022_08_26_083315_create_appointments_table', 1),
(28, '2022_08_31_061602_create_materials_table', 1),
(29, '2022_09_01_100015_create_product_images_table', 1),
(30, '2022_09_05_055957_create_product_metal_materials_table', 1),
(31, '2022_09_30_121727_create_carts_table', 1),
(32, '2022_10_04_101555_create_coupons_table', 1),
(33, '2022_10_10_044038_create_order_statuses_table', 1),
(34, '2022_10_10_054038_create_orders_table', 1),
(35, '2022_10_10_054103_create_order_details_table', 1),
(36, '2022_10_10_054110_create_payments_table', 1),
(37, '2022_11_07_105355_create_our_stories_table', 1),
(38, '2022_11_15_045138_create_testimonials_table', 1),
(39, '2022_11_21_122055_create_sustainablities_table', 1),
(40, '2022_11_22_085220_create_bonica5bs3s_table', 1),
(41, '2022_11_24_103202_create_our_teams_table', 1),
(42, '2022_11_24_103222_create_milestones_table', 1),
(43, '2022_11_24_103228_create_teams_table', 1),
(44, '2022_12_07_060948_create_size_guides_table', 1),
(45, '2022_12_07_061000_create_size_guide_images_table', 1),
(46, '2022_12_09_112900_create_home_pages_table', 1),
(47, '2022_12_15_050755_create_newsletters_table', 1),
(48, '2022_12_15_062313_add_social_login_field', 1),
(49, '2023_02_23_122809_create_colors_table', 2),
(50, '2023_03_04_092958_create_clarities_table', 3),
(51, '2023_03_04_145117_create_labours_table', 4),
(52, '2023_03_05_052004_create_material_metals_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` year DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `shipping_charges` decimal(10,2) DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` int NOT NULL DEFAULT '0',
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int NOT NULL DEFAULT '0',
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory_id` int NOT NULL DEFAULT '0',
  `subcategory_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shape` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `order_status_id` bigint UNSIGNED NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Packing', 1, 0, '2022-12-27 13:38:09', NULL),
(2, 'Shipped', 1, 0, '2022-12-27 13:38:09', NULL),
(3, 'Delivered', 1, 0, '2022-12-27 13:38:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `our_stories`
--

CREATE TABLE `our_stories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `our_vision_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `our_vision_content` text COLLATE utf8mb4_unicode_ci,
  `our_mission_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `our_mission_content` text COLLATE utf8mb4_unicode_ci,
  `big_diamond_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_diamond_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_bonica_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_bonica_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_bonica_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_bonica_authentic_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_bonica_authentic_description` text COLLATE utf8mb4_unicode_ci,
  `why_bonica_economical_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_bonica_economical_description` text COLLATE utf8mb4_unicode_ci,
  `why_bonica_protector_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_bonica_protector_description` text COLLATE utf8mb4_unicode_ci,
  `why_bonica_maestros_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_bonica_maestros_description` text COLLATE utf8mb4_unicode_ci,
  `our_commitment_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `our_commitment_first_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `our_commitment_first_description` text COLLATE utf8mb4_unicode_ci,
  `our_commitment_second_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `our_commitment_second_description` text COLLATE utf8mb4_unicode_ci,
  `our_commitment_third_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `our_commitment_third_description` text COLLATE utf8mb4_unicode_ci,
  `making_bonica_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_diamond_seed_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_diamond_seed_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_diamond_seed_description` text COLLATE utf8mb4_unicode_ci,
  `making_bonica_heating_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_heating_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_heating_description` text COLLATE utf8mb4_unicode_ci,
  `making_bonica_plasma_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_plasma_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_plasma_description` text COLLATE utf8mb4_unicode_ci,
  `making_bonica_all_diamonds_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_all_diamonds_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `making_bonica_all_diamonds_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_stories`
--

INSERT INTO `our_stories` (`id`, `name`, `slug`, `banner_image`, `content`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `our_vision_image`, `our_vision_content`, `our_mission_image`, `our_mission_content`, `big_diamond_image`, `big_diamond_video`, `why_bonica_title`, `why_bonica_sub_title`, `why_bonica_image`, `why_bonica_authentic_title`, `why_bonica_authentic_description`, `why_bonica_economical_title`, `why_bonica_economical_description`, `why_bonica_protector_title`, `why_bonica_protector_description`, `why_bonica_maestros_title`, `why_bonica_maestros_description`, `our_commitment_title`, `our_commitment_first_icon`, `our_commitment_first_description`, `our_commitment_second_icon`, `our_commitment_second_description`, `our_commitment_third_icon`, `our_commitment_third_description`, `making_bonica_title`, `making_bonica_sub_title`, `making_bonica_diamond_seed_icon`, `making_bonica_diamond_seed_title`, `making_bonica_diamond_seed_description`, `making_bonica_heating_icon`, `making_bonica_heating_title`, `making_bonica_heating_description`, `making_bonica_plasma_icon`, `making_bonica_plasma_title`, `making_bonica_plasma_description`, `making_bonica_all_diamonds_icon`, `making_bonica_all_diamonds_title`, `making_bonica_all_diamonds_description`, `created_at`, `updated_at`) VALUES
(1, 'Our Story', 'our-story', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'https://bonicajewels.s3.amazonaws.com/images/file_example_MP4_480_1_5MG072728.png', 'https://bonicajewels.s3.amazonaws.com/images/file_example_MP4_480_1_5MG072728.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 13:38:08', '2022-12-27 13:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `our_teams`
--

CREATE TABLE `our_teams` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member1_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member1_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member1_info` text COLLATE utf8mb4_unicode_ci,
  `member2_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member2_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member2_info` text COLLATE utf8mb4_unicode_ci,
  `team_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `milestone_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_teams`
--

INSERT INTO `our_teams` (`id`, `name`, `slug`, `status`, `title`, `member1_name`, `member1_image`, `member1_info`, `member2_name`, `member2_image`, `member2_info`, `team_title`, `milestone_title`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Our Team', 'our-team', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Payment Id',
  `generated_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Razorpay Order Id',
  `amount` double NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_in_INR` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_refunded` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_Date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `cat_id` bigint UNSIGNED DEFAULT NULL,
  `sub_cat_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sales` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-it''s Sales Category',
  `sales_price` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `is_all_include_price` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-Yes, 0-No',
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL DEFAULT '0',
  `sku` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-Men, 2-Women',
  `made_in` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metal` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_size` double(8,2) DEFAULT NULL,
  `resizable` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diamonds` double(8,2) DEFAULT NULL COMMENT ' Diamonds (Carats)',
  `stone` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clarity` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `igi_certified` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `igi_certified_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_delivery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gold_weight` double(8,2) DEFAULT NULL,
  `diamond_weight` double(8,2) DEFAULT NULL,
  `net_weight` double(8,2) DEFAULT NULL,
  `diamond_pcs` int NOT NULL DEFAULT '0',
  `recommended` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-Yes, 0-No',
  `recommended_hover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `sub_cat_id`, `name`, `slug`, `is_sales`, `sales_price`, `price`, `is_all_include_price`, `short_description`, `description`, `quantity`, `sku`, `gender`, `made_in`, `metal`, `product_size`, `resizable`, `diamonds`, `stone`, `color`, `clarity`, `igi_certified`, `igi_certified_text`, `free_delivery`, `gold_weight`, `diamond_weight`, `net_weight`, `diamond_pcs`, `recommended`, `recommended_hover_image`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(4, 6, NULL, 'Priscilla Shaw', 'priscilla-shaw', 0, NULL, '335.00', 0, NULL, '<p>dfgdfg</p>\n', 362, 'Eum ut non placeat', 0, 'In nesciunt iure Na', 'Nobis quos et velit', 73.00, NULL, NULL, 'Incidunt enim aperi', 'Sequi rem eius offic', 'Exercitation ad dele', NULL, NULL, 'Odit omnis optio ne', NULL, 19.00, NULL, 0, 0, NULL, 1, 'Omnis consequatur vo', 'Voluptas voluptate e', 'Doloribus fugiat ist', '2023-02-02 12:34:33', '2023-02-02 12:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `shape_id` bigint UNSIGNED DEFAULT NULL,
  `metal_id` bigint UNSIGNED DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int NOT NULL DEFAULT '0' COMMENT '0-image, 1-Video, 2-Video',
  `video_type` int NOT NULL DEFAULT '0' COMMENT '1- 360 Degree',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_metal_materials`
--

CREATE TABLE `product_metal_materials` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `metal_id` bigint UNSIGNED NOT NULL,
  `material_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_shapes`
--

CREATE TABLE `product_shapes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `shape_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'User', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shapes`
--

CREATE TABLE `shapes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shapes`
--

INSERT INTO `shapes` (`id`, `name`, `image`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Round', 'round.svg', 1, 1, '2022-12-27 13:38:08', NULL),
(2, 'Emerald', 'emerald.svg', 2, 1, '2022-12-27 13:38:08', NULL),
(3, 'Pear', 'pear.svg', 3, 1, '2022-12-27 13:38:08', NULL),
(4, 'Oval', 'oval.svg', 4, 1, '2022-12-27 13:38:08', NULL),
(5, 'Princess', 'princess.svg', 5, 1, '2022-12-27 13:38:08', NULL),
(6, 'Ascher', 'ascher.svg', 6, 1, '2022-12-27 13:38:08', NULL),
(7, 'Cushion', 'cushion.svg', 7, 1, '2022-12-27 13:38:08', NULL),
(8, 'Marquise', 'marquise.svg', 8, 1, '2022-12-27 13:38:08', NULL),
(9, 'Radiant', 'radiant.svg', 9, 1, '2022-12-27 13:38:08', NULL),
(10, 'Trillion', 'trillion.svg', 10, 1, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopthelook_products`
--

CREATE TABLE `shopthelook_products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, '4.5', 1, 1, '2022-12-27 13:38:09', NULL),
(2, '4.75', 2, 1, '2022-12-27 13:38:09', NULL),
(3, '5', 3, 1, '2022-12-27 13:38:09', NULL),
(4, '5.25', 4, 1, '2022-12-27 13:38:09', NULL),
(5, '5.5', 5, 1, '2022-12-27 13:38:09', NULL),
(6, '6', 6, 1, '2022-12-27 13:38:09', NULL),
(7, '6.25', 7, 1, '2022-12-27 13:38:09', NULL),
(8, '6.5', 8, 1, '2022-12-27 13:38:09', NULL),
(9, '6.75', 8, 1, '2022-12-27 13:38:09', NULL),
(10, '7', 9, 1, '2022-12-27 13:38:09', NULL),
(11, '7.25', 10, 1, '2022-12-27 13:38:09', NULL),
(12, '7.5', 11, 1, '2022-12-27 13:38:09', NULL),
(13, '7.75', 12, 1, '2022-12-27 13:38:09', NULL),
(14, '8', 13, 1, '2022-12-27 13:38:09', NULL),
(15, '8.25', 14, 1, '2022-12-27 13:38:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size_countries`
--

CREATE TABLE `size_countries` (
  `id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size_guides`
--

CREATE TABLE `size_guides` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rings_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rings_content1` text COLLATE utf8mb4_unicode_ci,
  `measurement_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diamond_skeleton_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step1_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step2_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rings_content2` text COLLATE utf8mb4_unicode_ci,
  `bracelets_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bracelets_content1` text COLLATE utf8mb4_unicode_ci,
  `diameter_skeleton_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bracelets_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bracelets_content2` text COLLATE utf8mb4_unicode_ci,
  `necklaces_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `necklaces_content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size_guides`
--

INSERT INTO `size_guides` (`id`, `name`, `slug`, `banner_image`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `page_title`, `rings_title`, `rings_content1`, `measurement_image`, `diamond_skeleton_image`, `step1_image`, `step2_image`, `rings_content2`, `bracelets_title`, `bracelets_content1`, `diameter_skeleton_image`, `bracelets_image`, `bracelets_content2`, `necklaces_image`, `necklaces_content`, `created_at`, `updated_at`) VALUES
(1, 'Size Guide', 'size-guide', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size_guide_images`
--

CREATE TABLE `size_guide_images` (
  `id` bigint UNSIGNED NOT NULL,
  `category_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sustainablities`
--

CREATE TABLE `sustainablities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `sustainability_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sustainability_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sustainability_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sustainability_content` text COLLATE utf8mb4_unicode_ci,
  `mining_free_process_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mining_free_process_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mining_free_process_content` text COLLATE utf8mb4_unicode_ci,
  `mining_free_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mining_free_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mining_free_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mining_free_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mining_free_image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sustainablities`
--

INSERT INTO `sustainablities` (`id`, `name`, `slug`, `banner_image`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `sustainability_title`, `sustainability_sub_title`, `sustainability_image`, `sustainability_content`, `mining_free_process_title`, `mining_free_process_image`, `mining_free_process_content`, `mining_free_title`, `mining_free_sub_title`, `mining_free_image_1`, `mining_free_image_2`, `mining_free_image_3`, `created_at`, `updated_at`) VALUES
(1, 'Sustainablity', 'sustainablity', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` int NOT NULL DEFAULT '0',
  `email_verified` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `slug`, `email`, `password`, `status`, `phone_number`, `street_address`, `street_address2`, `city`, `pincode`, `state`, `country`, `email_verified_at`, `remember_token`, `confirmation_code`, `confirmed`, `email_verified`, `created_at`, `updated_at`, `social_id`, `social_type`) VALUES
(1, 'hitesh', 'khandar', 'hitesh', 'hiteshwvelabs@gmail.com', '$2y$10$tj1NA87DTicHmNqbUYe4R.pAyyTzLlnms7Nqr7Lw151kOplGPkX4m', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'c07378fa34f578d7658bdc44e228d11a18ce85cdb0bca71346c039f882623292', 1, 1, '2023-02-02 12:35:32', '2023-02-02 12:35:32', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`),
  ADD KEY `blogs_category_id_foreign` (`category_id`),
  ADD KEY `blogs_created_by_foreign` (`created_by`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_slug_unique` (`slug`);

--
-- Indexes for table `bonica5bs3s`
--
ALTER TABLE `bonica5bs3s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bonica5bs3s_slug_unique` (`slug`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_shape_id_foreign` (`shape_id`),
  ADD KEY `carts_metal_id_foreign` (`metal_id`),
  ADD KEY `carts_material_id_foreign` (`material_id`),
  ADD KEY `carts_size_id_foreign` (`size_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `category_faqs`
--
ALTER TABLE `category_faqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_faqs_slug_unique` (`slug`);

--
-- Indexes for table `clarities`
--
ALTER TABLE `clarities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clarities_slug_unique` (`slug`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_pages_slug_unique` (`slug`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_slug_unique` (`slug`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discover_products`
--
ALTER TABLE `discover_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discover_products_category_id_foreign` (`category_id`),
  ADD KEY `discover_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faqs_slug_unique` (`slug`),
  ADD KEY `faqs_cate_id_foreign` (`cate_id`);

--
-- Indexes for table `home_pages`
--
ALTER TABLE `home_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `home_pages_slug_unique` (`slug`);

--
-- Indexes for table `home_page_sliders`
--
ALTER TABLE `home_page_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_slider_images`
--
ALTER TABLE `home_page_slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `labours`
--
ALTER TABLE `labours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labours_metal_id_foreign` (`metal_id`),
  ADD KEY `labours_material_id_foreign` (`material_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_metals`
--
ALTER TABLE `material_metals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_metals_metal_id_foreign` (`metal_id`),
  ADD KEY `material_metals_material_id_foreign` (`material_id`);

--
-- Indexes for table `metals`
--
ALTER TABLE `metals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_order_status_id_foreign` (`order_status_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_stories`
--
ALTER TABLE `our_stories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `our_stories_slug_unique` (`slug`);

--
-- Indexes for table `our_teams`
--
ALTER TABLE `our_teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `our_teams_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_cat_id_foreign` (`cat_id`),
  ADD KEY `products_sub_cat_id_foreign` (`sub_cat_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`),
  ADD KEY `product_images_shape_id_foreign` (`shape_id`),
  ADD KEY `product_images_metal_id_foreign` (`metal_id`);

--
-- Indexes for table `product_metal_materials`
--
ALTER TABLE `product_metal_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_metal_materials_product_id_foreign` (`product_id`),
  ADD KEY `product_metal_materials_metal_id_foreign` (`metal_id`),
  ADD KEY `product_metal_materials_material_id_foreign` (`material_id`);

--
-- Indexes for table `product_shapes`
--
ALTER TABLE `product_shapes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_shapes_product_id_foreign` (`product_id`),
  ADD KEY `product_shapes_shape_id_foreign` (`shape_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`),
  ADD KEY `product_sizes_size_id_foreign` (`size_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shapes`
--
ALTER TABLE `shapes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopthelook_products`
--
ALTER TABLE `shopthelook_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopthelook_products_category_id_foreign` (`category_id`),
  ADD KEY `shopthelook_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_countries`
--
ALTER TABLE `size_countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `size_countries_size_id_foreign` (`size_id`),
  ADD KEY `size_countries_country_id_foreign` (`country_id`);

--
-- Indexes for table `size_guides`
--
ALTER TABLE `size_guides`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `size_guides_slug_unique` (`slug`);

--
-- Indexes for table `size_guide_images`
--
ALTER TABLE `size_guide_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sustainablities`
--
ALTER TABLE `sustainablities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sustainablities_slug_unique` (`slug`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bonica5bs3s`
--
ALTER TABLE `bonica5bs3s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `category_faqs`
--
ALTER TABLE `category_faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clarities`
--
ALTER TABLE `clarities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discover_products`
--
ALTER TABLE `discover_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_pages`
--
ALTER TABLE `home_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_page_sliders`
--
ALTER TABLE `home_page_sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_page_slider_images`
--
ALTER TABLE `home_page_slider_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labours`
--
ALTER TABLE `labours`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `material_metals`
--
ALTER TABLE `material_metals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `metals`
--
ALTER TABLE `metals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `our_stories`
--
ALTER TABLE `our_stories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `our_teams`
--
ALTER TABLE `our_teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_metal_materials`
--
ALTER TABLE `product_metal_materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_shapes`
--
ALTER TABLE `product_shapes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shapes`
--
ALTER TABLE `shapes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shopthelook_products`
--
ALTER TABLE `shopthelook_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `size_countries`
--
ALTER TABLE `size_countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size_guides`
--
ALTER TABLE `size_guides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `size_guide_images`
--
ALTER TABLE `size_guide_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sustainablities`
--
ALTER TABLE `sustainablities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_metal_id_foreign` FOREIGN KEY (`metal_id`) REFERENCES `metals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_shape_id_foreign` FOREIGN KEY (`shape_id`) REFERENCES `shapes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discover_products`
--
ALTER TABLE `discover_products`
  ADD CONSTRAINT `discover_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discover_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `category_faqs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `labours`
--
ALTER TABLE `labours`
  ADD CONSTRAINT `labours_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `labours_metal_id_foreign` FOREIGN KEY (`metal_id`) REFERENCES `metals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material_metals`
--
ALTER TABLE `material_metals`
  ADD CONSTRAINT `material_metals_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material_metals_metal_id_foreign` FOREIGN KEY (`metal_id`) REFERENCES `metals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_sub_cat_id_foreign` FOREIGN KEY (`sub_cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_metal_id_foreign` FOREIGN KEY (`metal_id`) REFERENCES `metals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_images_shape_id_foreign` FOREIGN KEY (`shape_id`) REFERENCES `shapes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_metal_materials`
--
ALTER TABLE `product_metal_materials`
  ADD CONSTRAINT `product_metal_materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_metal_materials_metal_id_foreign` FOREIGN KEY (`metal_id`) REFERENCES `metals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_metal_materials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_shapes`
--
ALTER TABLE `product_shapes`
  ADD CONSTRAINT `product_shapes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_shapes_shape_id_foreign` FOREIGN KEY (`shape_id`) REFERENCES `shapes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_sizes_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopthelook_products`
--
ALTER TABLE `shopthelook_products`
  ADD CONSTRAINT `shopthelook_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shopthelook_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `size_countries`
--
ALTER TABLE `size_countries`
  ADD CONSTRAINT `size_countries_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `size_countries_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
