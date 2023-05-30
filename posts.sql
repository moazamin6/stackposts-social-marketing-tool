-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 30, 2023 at 07:00 PM
-- Server version: 10.11.3-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posts`
--

-- --------------------------------------------------------

--
-- Table structure for table `sp_accounts`
--

CREATE TABLE `sp_accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ids` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `social_network` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `login_type` int(11) DEFAULT NULL,
  `can_post` int(1) DEFAULT NULL,
  `pid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `tmp` text DEFAULT NULL,
  `data` mediumtext DEFAULT NULL,
  `proxy` longtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `changed` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_blogs`
--

CREATE TABLE `sp_blogs` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created` int(11) DEFAULT NULL,
  `changed` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_captions`
--

CREATE TABLE `sp_captions` (
  `id` int(11) NOT NULL,
  `ids` varchar(255) NOT NULL,
  `team_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `changed` int(11) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_coinpayments_history`
--

CREATE TABLE `sp_coinpayments_history` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `plan_by` int(11) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `coin_amount` float DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_faqs`
--

CREATE TABLE `sp_faqs` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `changed` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_files`
--

CREATE TABLE `sp_files` (
  `id` int(11) UNSIGNED NOT NULL,
  `ids` mediumtext DEFAULT NULL,
  `is_folder` int(1) NOT NULL DEFAULT 0,
  `pid` int(11) DEFAULT 0,
  `team_id` int(11) DEFAULT NULL,
  `name` mediumtext DEFAULT NULL,
  `file` mediumtext DEFAULT NULL,
  `type` mediumtext DEFAULT NULL,
  `extension` mediumtext DEFAULT NULL,
  `detect` text DEFAULT NULL,
  `size` float DEFAULT NULL,
  `is_image` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_groups`
--

CREATE TABLE `sp_groups` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `data` longtext DEFAULT NULL,
  `changed` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_language`
--

CREATE TABLE `sp_language` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `custom` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_language_category`
--

CREATE TABLE `sp_language_category` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `dir` varchar(3) NOT NULL,
  `is_default` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_options`
--

CREATE TABLE `sp_options` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sp_options`
--

INSERT INTO `sp_options` (`id`, `name`, `value`) VALUES
(157, 'sidebar_icon_color', '0'),
(158, 'facebook_client_id', ''),
(159, 'facebook_client_secret', ''),
(160, 'facebook_app_version', 'v16.0'),
(161, 'instagram_client_id', ''),
(162, 'instagram_client_secret', ''),
(163, 'instagram_app_version', 'v16.0'),
(164, 'instagram_official_status', '0'),
(165, 'twitter_consumer_key', ''),
(166, 'twitter_consumer_secret', ''),
(167, 'base_url', 'http://localhost/stackposts-social-marketing-tool'),
(168, 'frontend_template', 'Stackgo'),
(169, 'landing_page_status', '1'),
(170, 'website_keyword', 'social network, marketing, brands, businesses, agencies, individuals'),
(171, 'website_description', 'Let start to manage your social media so that you have more time for your business.'),
(172, 'website_title', '#1 Social Media Management & Analysis Platform'),
(173, 'website_favicon', 'http://localhost/stackposts-social-marketing-tool/assets/img/favicon.svg'),
(174, 'website_logo_light', 'http://localhost/stackposts-social-marketing-tool/assets/img/logo-light.svg'),
(175, 'signup_status', '1'),
(176, 'website_logo_color', 'http://localhost/stackposts-social-marketing-tool/assets/img/logo-color.svg'),
(177, 'social_page_facebook', ''),
(178, 'social_page_twitter', ''),
(179, 'social_page_pinterest', ''),
(180, 'social_page_youtube', ''),
(181, 'social_page_instagram', ''),
(182, 'gdpr_status', '1'),
(183, 'google_recaptcha_status', '0'),
(184, 'google_login_status', '0'),
(185, 'facebook_login_status', '0'),
(186, 'twitter_login_status', '0'),
(187, 'shortlink_bitly_status', ''),
(188, 'theme_color', 'light'),
(189, 'format_date', 'd/m/Y'),
(190, 'format_datetime', 'd/m/Y g:i A'),
(191, 'sidebar_type', 'sidebar-small'),
(192, 'website_logo_mark', 'http://localhost/stackposts-social-marketing-tool/assets/img/logo.svg'),
(193, 'embed_code_status', '1'),
(194, 'embed_code', ''),
(195, 'poupup_nofification_backend_status', '0'),
(196, 'fm_allow_extensions', 'jpeg,gif,png,jpg,mp4,csv,pdf,mp3'),
(197, 'fm_google_dropbox_status', '0'),
(198, 'fm_google_drive_status', '0'),
(199, 'fm_google_onedrive_status', '0'),
(200, 'fm_adobe_status', '0'),
(201, 'openai_status', '0'),
(202, 'site_icon_color', '#006dff'),
(203, 'activation_email_status', '0'),
(204, 'welcome_email_status', '0'),
(205, 'accept_change_email', '1'),
(206, 'accept_change_username', '1'),
(207, 'signup_phone_number', '0'),
(208, 'google_recaptcha_site_key', ''),
(209, 'google_recaptcha_secret_key', ''),
(210, 'facebook_login_app_id', ''),
(211, 'facebook_login_app_secret', ''),
(212, 'facebook_login_app_version', 'v16.0'),
(213, 'google_login_client_id', ''),
(214, 'google_login_client_secret', ''),
(215, 'twitter_login_client_id', ''),
(216, 'twitter_login_client_secret', ''),
(217, 'fm_medias_per_page', '36'),
(218, 'fm_allow_upload_via_url', '1'),
(219, 'fm_adobe_client_id', ''),
(220, 'fm_google_api_key', ''),
(221, 'fm_google_client_id', ''),
(222, 'fm_dropbox_api_key', ''),
(223, 'fm_onedrive_api_key', ''),
(224, 'openai_api_key', ''),
(225, 'http_to_https_status', '0'),
(226, 'terms_of_use', ''),
(227, 'privacy_policy', ''),
(228, 'website_logo_black', 'http://localhost/stackposts-social-marketing-tool/assets/img/logo-black.svg'),
(229, 'shortlink_bitly_client_id', ''),
(230, 'shortlink_bitly_client_secret', ''),
(231, 'social_page_tiktok', '');

-- --------------------------------------------------------

--
-- Table structure for table `sp_payment_history`
--

CREATE TABLE `sp_payment_history` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `plan` int(11) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `by` int(1) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_payment_subscriptions`
--

CREATE TABLE `sp_payment_subscriptions` (
  `id` int(11) NOT NULL,
  `ids` text DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `plan` int(11) DEFAULT NULL,
  `by` int(1) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `subscription_id` text DEFAULT NULL,
  `customer_id` text DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_plans`
--

CREATE TABLE `sp_plans` (
  `id` int(11) UNSIGNED NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `price_monthly` float DEFAULT NULL,
  `price_annually` float DEFAULT NULL,
  `plan_type` int(1) DEFAULT NULL,
  `number_accounts` int(11) DEFAULT NULL,
  `trial_day` float DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `permissions` mediumtext DEFAULT NULL,
  `data` mediumtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sp_plans`
--

INSERT INTO `sp_plans` (`id`, `ids`, `name`, `description`, `type`, `price_monthly`, `price_annually`, `plan_type`, `number_accounts`, `trial_day`, `featured`, `position`, `permissions`, `data`, `status`) VALUES
(1, 'de39a2bd850', 'Free & Trial', 'Try us out today', 1, 0, 0, 1, 100, -1, 0, 0, '{\"dashboard\":\"1\",\"post\":\"1\",\"facebook_post\":\"1\",\"google_business_profile_post\":\"1\",\"instagram_post\":\"1\",\"linkedin_post\":\"1\",\"ok_post\":\"1\",\"pinterest_post\":\"1\",\"reddit_post\":\"1\",\"telegram_post\":\"1\",\"tumblr_post\":\"1\",\"twitter_post\":\"1\",\"vk_post\":\"1\",\"youtube_post\":\"1\",\"bulk_post\":\"1\",\"rss_post\":\"1\",\"analytics\":\"1\",\"facebook_analytics\":\"1\",\"instagram_analytics\":\"1\",\"twitter_analytics\":\"1\",\"whatsapp\":\"1\",\"whatsapp_profile\":\"1\",\"whatsapp_bulk\":\"1\",\"whatsapp_autoresponder\":\"1\",\"whatsapp_chatbot\":\"1\",\"whatsapp_export_participants\":\"1\",\"whatsapp_contact\":\"1\",\"whatsapp_api\":\"1\",\"whatsapp_button_template\":\"1\",\"whatsapp_list_message_template\":\"1\",\"whatsapp_send_media\":\"1\",\"whatsapp_autoresponser_delay\":\"1\",\"whatsapp_chatbot_item_limit\":\"200\",\"whatsapp_bulk_schedule_by_times\":\"1\",\"whatsapp_bulk_max_run\":\"1000\",\"whatsapp_bulk_max_contact_group\":\"1000\",\"whatsapp_bulk_max_phone_numbers\":\"600000\",\"whatsapp_message_per_month\":\"1000000\",\"drafts\":\"1\",\"schedules\":\"1\",\"account_manager\":\"1\",\"whatsapp_profiles\":\"1\",\"facebook_profiles\":\"1\",\"facebook_groups\":\"1\",\"facebook_pages\":\"1\",\"instagram_profiles\":\"1\",\"twitter_profiles\":\"1\",\"youtube_profiles\":\"1\",\"google_business_profiles\":\"1\",\"linkedin_profiles\":\"1\",\"linkedin_pages\":\"1\",\"pinterest_boards\":\"1\",\"pinterest_profiles\":\"1\",\"reddit_profiles\":\"1\",\"tumblr_blogs\":\"1\",\"telegram_channels\":\"1\",\"telegram_groups\":\"1\",\"ok_groups\":\"1\",\"vk_profiles\":\"1\",\"vk_pages\":\"1\",\"vk_groups\":\"1\",\"file_manager\":\"1\",\"file_manager_google_drive\":\"1\",\"file_manager_dropbox\":\"1\",\"file_manager_onedrive\":\"1\",\"file_manager_photo\":\"1\",\"file_manager_video\":\"1\",\"file_manager_other_type\":\"1\",\"file_manager_image_editor\":\"1\",\"max_storage_size\":\"10000\",\"max_file_size\":\"100\",\"tools\":\"1\",\"watermark\":\"1\",\"group_manager\":\"1\",\"caption\":\"1\",\"teams\":\"1\",\"proxies\":\"1\",\"shortlink\":\"1\",\"openai\":\"1\",\"openai_content\":\"1\",\"openai_image\":\"1\",\"openai_limit_tokens\":\"1000000\",\"plan_type\":1,\"number_accounts\":\"100\"}', NULL, 1),
(2, 'de39a2bd851', 'Standard', 'Affordable and accessible', 2, 29, 19, 2, 3, 0, 0, 5, '{\"dashboard\":\"1\",\"post\":\"1\",\"facebook_post\":\"1\",\"instagram_post\":\"1\",\"linkedin_post\":\"1\",\"ok_post\":\"1\",\"pinterest_post\":\"1\",\"reddit_post\":\"1\",\"telegram_post\":\"1\",\"tumblr_post\":\"1\",\"twitter_post\":\"1\",\"vk_post\":\"1\",\"youtube_post\":\"1\",\"bulk_post\":\"1\",\"rss_post\":\"1\",\"analytics\":\"1\",\"facebook_analytics\":\"1\",\"instagram_analytics\":\"1\",\"twitter_analytics\":\"1\",\"whatsapp\":\"1\",\"whatsapp_profile\":\"1\",\"whatsapp_bulk\":\"1\",\"whatsapp_autoresponder\":\"1\",\"whatsapp_chatbot\":\"1\",\"whatsapp_export_participants\":\"1\",\"whatsapp_contact\":\"1\",\"whatsapp_api\":\"1\",\"whatsapp_button_template\":\"1\",\"whatsapp_list_message_template\":\"1\",\"whatsapp_send_media\":\"1\",\"whatsapp_autoresponser_delay\":\"1\",\"whatsapp_chatbot_item_limit\":\"50\",\"whatsapp_bulk_schedule_by_times\":\"1\",\"whatsapp_bulk_max_run\":\"10\",\"whatsapp_bulk_max_contact_group\":\"50\",\"whatsapp_bulk_max_phone_numbers\":\"5000\",\"whatsapp_message_per_month\":\"50000\",\"drafts\":\"1\",\"schedules\":\"1\",\"account_manager\":\"1\",\"whatsapp_profiles\":\"1\",\"facebook_profiles\":\"1\",\"facebook_groups\":\"1\",\"facebook_pages\":\"1\",\"instagram_profiles\":\"1\",\"twitter_profiles\":\"1\",\"youtube_profiles\":\"1\",\"google_business_profiles\":\"1\",\"linkedin_profiles\":\"1\",\"linkedin_pages\":\"1\",\"pinterest_boards\":\"1\",\"pinterest_profiles\":\"1\",\"reddit_profiles\":\"1\",\"tumblr_blogs\":\"1\",\"telegram_channels\":\"1\",\"telegram_groups\":\"1\",\"ok_groups\":\"1\",\"vk_profiles\":\"1\",\"vk_pages\":\"1\",\"vk_groups\":\"1\",\"file_manager\":\"1\",\"file_manager_google_drive\":\"1\",\"file_manager_dropbox\":\"1\",\"file_manager_onedrive\":\"1\",\"file_manager_photo\":\"1\",\"file_manager_video\":\"1\",\"file_manager_other_type\":\"1\",\"file_manager_image_editor\":\"1\",\"max_storage_size\":\"100\",\"max_file_size\":\"2\",\"tools\":\"1\",\"watermark\":\"1\",\"group_manager\":\"1\",\"caption\":\"1\",\"teams\":\"1\",\"proxies\":\"1\",\"shortlink\":\"1\",\"openai\":\"1\",\"openai_content\":\"1\",\"openai_image\":\"1\",\"openai_limit_tokens\":\"1000\",\"plan_type\":2,\"number_accounts\":\"3\"}', NULL, 1),
(3, 'de39a2bd852', 'Premium', 'Elevate your experience', 2, 39, 29, 1, 6, 0, 1, 10, '{\"dashboard\":\"1\",\"post\":\"1\",\"facebook_post\":\"1\",\"google_business_profile_post\":\"1\",\"instagram_post\":\"1\",\"linkedin_post\":\"1\",\"ok_post\":\"1\",\"pinterest_post\":\"1\",\"reddit_post\":\"1\",\"telegram_post\":\"1\",\"tumblr_post\":\"1\",\"twitter_post\":\"1\",\"vk_post\":\"1\",\"youtube_post\":\"1\",\"bulk_post\":\"1\",\"rss_post\":\"1\",\"analytics\":\"1\",\"facebook_analytics\":\"1\",\"instagram_analytics\":\"1\",\"twitter_analytics\":\"1\",\"whatsapp\":\"1\",\"whatsapp_profile\":\"1\",\"whatsapp_bulk\":\"1\",\"whatsapp_autoresponder\":\"1\",\"whatsapp_chatbot\":\"1\",\"whatsapp_export_participants\":\"1\",\"whatsapp_contact\":\"1\",\"whatsapp_api\":\"1\",\"whatsapp_button_template\":\"1\",\"whatsapp_list_message_template\":\"1\",\"whatsapp_send_media\":\"1\",\"whatsapp_autoresponser_delay\":\"1\",\"whatsapp_chatbot_item_limit\":\"20\",\"whatsapp_bulk_schedule_by_times\":\"1\",\"whatsapp_bulk_max_run\":\"5\",\"whatsapp_bulk_max_contact_group\":\"5\",\"whatsapp_bulk_max_phone_numbers\":\"5000\",\"whatsapp_message_per_month\":\"10000\",\"drafts\":\"1\",\"schedules\":\"1\",\"account_manager\":\"1\",\"whatsapp_profiles\":\"1\",\"facebook_profiles\":\"1\",\"facebook_groups\":\"1\",\"facebook_pages\":\"1\",\"instagram_profiles\":\"1\",\"twitter_profiles\":\"1\",\"youtube_profiles\":\"1\",\"google_business_profiles\":\"1\",\"linkedin_profiles\":\"1\",\"linkedin_pages\":\"1\",\"pinterest_boards\":\"1\",\"pinterest_profiles\":\"1\",\"reddit_profiles\":\"1\",\"tumblr_blogs\":\"1\",\"telegram_channels\":\"1\",\"telegram_groups\":\"1\",\"ok_groups\":\"1\",\"vk_profiles\":\"1\",\"vk_pages\":\"1\",\"vk_groups\":\"1\",\"file_manager\":\"1\",\"file_manager_google_drive\":\"1\",\"file_manager_dropbox\":\"1\",\"file_manager_onedrive\":\"1\",\"file_manager_photo\":\"1\",\"file_manager_video\":\"1\",\"file_manager_other_type\":\"1\",\"file_manager_image_editor\":\"1\",\"max_storage_size\":\"500\",\"max_file_size\":\"5\",\"tools\":\"1\",\"watermark\":\"1\",\"group_manager\":\"1\",\"caption\":\"1\",\"teams\":\"1\",\"proxies\":\"1\",\"shortlink\":\"1\",\"openai\":\"1\",\"openai_content\":\"1\",\"openai_image\":\"1\",\"openai_limit_tokens\":\"10000\",\"plan_type\":1,\"number_accounts\":\"6\"}', NULL, 1),
(4, 'de39a2bd853', 'Entrepreneur', 'Your path to success', 2, 69, 59, 1, 10, 0, 0, 15, '{\"dashboard\":\"1\",\"post\":\"1\",\"facebook_post\":\"1\",\"google_business_profile_post\":\"1\",\"instagram_post\":\"1\",\"linkedin_post\":\"1\",\"ok_post\":\"1\",\"pinterest_post\":\"1\",\"reddit_post\":\"1\",\"telegram_post\":\"1\",\"tumblr_post\":\"1\",\"twitter_post\":\"1\",\"vk_post\":\"1\",\"youtube_post\":\"1\",\"bulk_post\":\"1\",\"rss_post\":\"1\",\"analytics\":\"1\",\"facebook_analytics\":\"1\",\"instagram_analytics\":\"1\",\"twitter_analytics\":\"1\",\"whatsapp\":\"1\",\"whatsapp_profile\":\"1\",\"whatsapp_bulk\":\"1\",\"whatsapp_autoresponder\":\"1\",\"whatsapp_chatbot\":\"1\",\"whatsapp_export_participants\":\"1\",\"whatsapp_contact\":\"1\",\"whatsapp_api\":\"1\",\"whatsapp_button_template\":\"1\",\"whatsapp_list_message_template\":\"1\",\"whatsapp_send_media\":\"1\",\"whatsapp_autoresponser_delay\":\"1\",\"whatsapp_chatbot_item_limit\":\"50\",\"whatsapp_bulk_schedule_by_times\":\"1\",\"whatsapp_bulk_max_run\":\"100\",\"whatsapp_bulk_max_contact_group\":\"100\",\"whatsapp_bulk_max_phone_numbers\":\"50000\",\"whatsapp_message_per_month\":\"100000\",\"drafts\":\"1\",\"schedules\":\"1\",\"account_manager\":\"1\",\"whatsapp_profiles\":\"1\",\"facebook_profiles\":\"1\",\"facebook_groups\":\"1\",\"facebook_pages\":\"1\",\"instagram_profiles\":\"1\",\"twitter_profiles\":\"1\",\"youtube_profiles\":\"1\",\"google_business_profiles\":\"1\",\"linkedin_profiles\":\"1\",\"linkedin_pages\":\"1\",\"pinterest_boards\":\"1\",\"pinterest_profiles\":\"1\",\"reddit_profiles\":\"1\",\"tumblr_blogs\":\"1\",\"telegram_channels\":\"1\",\"telegram_groups\":\"1\",\"ok_groups\":\"1\",\"vk_profiles\":\"1\",\"vk_pages\":\"1\",\"vk_groups\":\"1\",\"file_manager\":\"1\",\"file_manager_google_drive\":\"1\",\"file_manager_dropbox\":\"1\",\"file_manager_onedrive\":\"1\",\"file_manager_photo\":\"1\",\"file_manager_video\":\"1\",\"file_manager_other_type\":\"1\",\"file_manager_image_editor\":\"1\",\"max_storage_size\":\"1000\",\"max_file_size\":\"10\",\"tools\":\"1\",\"watermark\":\"1\",\"group_manager\":\"1\",\"caption\":\"1\",\"teams\":\"1\",\"proxies\":\"1\",\"shortlink\":\"1\",\"openai\":\"1\",\"openai_content\":\"1\",\"openai_image\":\"1\",\"openai_limit_tokens\":\"50000\",\"plan_type\":1,\"number_accounts\":\"10\"}', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sp_posts`
--

CREATE TABLE `sp_posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `social_network` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `function` varchar(50) NOT NULL,
  `api_type` int(1) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `data` longtext DEFAULT NULL,
  `time_post` int(11) DEFAULT NULL,
  `delay` int(11) DEFAULT NULL,
  `repost_frequency` int(11) DEFAULT NULL,
  `repost_until` int(11) DEFAULT NULL,
  `result` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `changed` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_proxies`
--

CREATE TABLE `sp_proxies` (
  `id` int(11) UNSIGNED NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `team_id` int(11) DEFAULT 0,
  `is_system` int(11) DEFAULT NULL,
  `proxy` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `limit` float DEFAULT NULL,
  `plans` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `changed` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_purchases`
--

CREATE TABLE `sp_purchases` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `item_id` varchar(32) DEFAULT NULL,
  `is_main` int(11) DEFAULT NULL,
  `purchase_code` varchar(64) DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sp_purchases`
--

INSERT INTO `sp_purchases` (`id`, `ids`, `item_id`, `is_main`, `purchase_code`, `version`) VALUES
(3, '64744e1667a36', '21747459', 1, '5fb95de6-a3d4-491d-8c31-26d83c05dbc6', '8.0.3');

-- --------------------------------------------------------

--
-- Table structure for table `sp_smtp`
--

CREATE TABLE `sp_smtp` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) DEFAULT NULL,
  `server` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `encryption` varchar(32) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_team`
--

CREATE TABLE `sp_team` (
  `id` int(11) NOT NULL,
  `ids` mediumtext DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `permissions` longtext DEFAULT NULL,
  `data` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sp_team`
--

INSERT INTO `sp_team` (`id`, `ids`, `owner`, `pid`, `permissions`, `data`) VALUES
(1, '64744e11f3b73', 1, 1, '{\"dashboard\":\"1\",\"post\":\"1\",\"facebook_post\":\"1\",\"google_business_profile_post\":\"1\",\"instagram_post\":\"1\",\"linkedin_post\":\"1\",\"ok_post\":\"1\",\"pinterest_post\":\"1\",\"reddit_post\":\"1\",\"telegram_post\":\"1\",\"tumblr_post\":\"1\",\"twitter_post\":\"1\",\"vk_post\":\"1\",\"youtube_post\":\"1\",\"bulk_post\":\"1\",\"rss_post\":\"1\",\"analytics\":\"1\",\"facebook_analytics\":\"1\",\"instagram_analytics\":\"1\",\"twitter_analytics\":\"1\",\"whatsapp\":\"1\",\"whatsapp_profile\":\"1\",\"whatsapp_bulk\":\"1\",\"whatsapp_autoresponder\":\"1\",\"whatsapp_chatbot\":\"1\",\"whatsapp_export_participants\":\"1\",\"whatsapp_contact\":\"1\",\"whatsapp_api\":\"1\",\"whatsapp_button_template\":\"1\",\"whatsapp_list_message_template\":\"1\",\"whatsapp_send_media\":\"1\",\"whatsapp_autoresponser_delay\":\"1\",\"whatsapp_chatbot_item_limit\":\"200\",\"whatsapp_bulk_schedule_by_times\":\"1\",\"whatsapp_bulk_max_run\":\"1000\",\"whatsapp_bulk_max_contact_group\":\"1000\",\"whatsapp_bulk_max_phone_numbers\":\"600000\",\"whatsapp_message_per_month\":\"1000000\",\"drafts\":\"1\",\"schedules\":\"1\",\"account_manager\":\"1\",\"whatsapp_profiles\":\"1\",\"facebook_profiles\":\"1\",\"facebook_groups\":\"1\",\"facebook_pages\":\"1\",\"instagram_profiles\":\"1\",\"twitter_profiles\":\"1\",\"youtube_profiles\":\"1\",\"google_business_profiles\":\"1\",\"linkedin_profiles\":\"1\",\"linkedin_pages\":\"1\",\"pinterest_profiles\":\"1\",\"pinterest_boards\":\"1\",\"reddit_profiles\":\"1\",\"tumblr_blogs\":\"1\",\"telegram_channels\":\"1\",\"telegram_groups\":\"1\",\"ok_groups\":\"1\",\"vk_profiles\":\"1\",\"vk_pages\":\"1\",\"vk_groups\":\"1\",\"file_manager\":\"1\",\"file_manager_google_drive\":\"1\",\"file_manager_dropbox\":\"1\",\"file_manager_onedrive\":\"1\",\"file_manager_photo\":\"1\",\"file_manager_video\":\"1\",\"file_manager_other_type\":\"1\",\"file_manager_image_editor\":\"1\",\"max_storage_size\":\"10000\",\"max_file_size\":\"100\",\"tools\":\"1\",\"watermark\":\"1\",\"group_manager\":\"1\",\"caption\":\"1\",\"teams\":\"1\",\"proxies\":\"1\",\"shortlink\":\"1\",\"openai\":\"1\",\"openai_content\":\"1\",\"openai_image\":\"1\",\"openai_limit_tokens\":\"1000000\",\"number_accounts\":\"100\"}', '{\"facebook_post_success_count\":0,\"facebook_post_error_count\":0,\"facebook_post_media_count\":0,\"facebook_post_link_count\":0,\"facebook_post_text_count\":0,\"instagram_post_success_count\":0,\"instagram_post_error_count\":0,\"instagram_post_media_count\":0,\"instagram_post_link_count\":0,\"instagram_post_text_count\":0,\"twitter_post_success_count\":0,\"twitter_post_error_count\":0,\"twitter_post_media_count\":0,\"twitter_post_link_count\":0,\"twitter_post_text_count\":0,\"youtube_post_success_count\":0,\"youtube_post_error_count\":0,\"youtube_post_media_count\":0,\"youtube_post_link_count\":0,\"youtube_post_text_count\":0,\"google_business_profile_post_success_count\":0,\"google_business_profile_post_error_count\":0,\"google_business_profile_post_media_count\":0,\"google_business_profile_post_link_count\":0,\"google_business_profile_post_text_count\":0,\"linkedin_post_success_count\":0,\"linkedin_post_error_count\":0,\"linkedin_post_media_count\":0,\"linkedin_post_link_count\":0,\"linkedin_post_text_count\":0,\"pinterest_post_success_count\":0,\"pinterest_post_error_count\":0,\"pinterest_post_media_count\":0,\"pinterest_post_link_count\":0,\"pinterest_post_text_count\":0,\"reddit_post_success_count\":0,\"reddit_post_error_count\":0,\"reddit_post_media_count\":0,\"reddit_post_link_count\":0,\"reddit_post_text_count\":0,\"tumblr_post_success_count\":0,\"tumblr_post_error_count\":0,\"tumblr_post_media_count\":0,\"tumblr_post_link_count\":0,\"tumblr_post_text_count\":0,\"telegram_post_success_count\":0,\"telegram_post_error_count\":0,\"telegram_post_media_count\":0,\"telegram_post_link_count\":0,\"telegram_post_text_count\":0,\"vk_post_success_count\":0,\"vk_post_error_count\":0,\"vk_post_media_count\":0,\"vk_post_link_count\":0,\"vk_post_text_count\":0,\"ok_post_success_count\":0,\"ok_post_error_count\":0,\"ok_post_media_count\":0,\"ok_post_link_count\":0,\"ok_post_text_count\":0,\"shortlink_status\":0,\"bulk_delay\":60,\"bitly_access_token\":\"\",\"openai_usage_tokens\":258,\"watermark_mask\":\"\",\"watermark_size\":30,\"watermark_opacity\":70,\"watermark_position\":\"lb\",\"telegram_post_count\":0,\"twitter_consumer_key\":\"\",\"twitter_consumer_secret\":\"\",\"twitter_status\":0,\"watermark_status\":1}');

-- --------------------------------------------------------

--
-- Table structure for table `sp_team_member`
--

CREATE TABLE `sp_team_member` (
  `id` int(11) NOT NULL,
  `ids` mediumtext DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `permissions` longtext DEFAULT NULL,
  `pending` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_users`
--

CREATE TABLE `sp_users` (
  `id` int(11) NOT NULL,
  `ids` mediumtext DEFAULT NULL,
  `pid` text DEFAULT NULL,
  `is_admin` int(1) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `plan` int(11) DEFAULT NULL,
  `expiration_date` int(11) DEFAULT NULL,
  `timezone` mediumtext DEFAULT NULL,
  `language` varchar(30) DEFAULT NULL,
  `login_type` mediumtext DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `data` mediumtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `recovery_key` varchar(32) DEFAULT NULL,
  `changed` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sp_users`
--

INSERT INTO `sp_users` (`id`, `ids`, `pid`, `is_admin`, `role`, `fullname`, `username`, `email`, `password`, `plan`, `expiration_date`, `timezone`, `language`, `login_type`, `avatar`, `data`, `status`, `last_login`, `recovery_key`, `changed`, `created`) VALUES
(1, '64744e11f3b5c', NULL, 1, 0, 'moaz amin', 'moazamin6', 'moazamin6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 2145916800, 'Asia/Karachi', 'en', 'direct', 'https://ui-avatars.com/api/?name=Hi&background=0674ec&color=fff', NULL, 2, 1685389945, NULL, 1681286037, 1681286037);

-- --------------------------------------------------------

--
-- Table structure for table `sp_user_roles`
--

CREATE TABLE `sp_user_roles` (
  `id` int(11) NOT NULL,
  `ids` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sp_accounts`
--
ALTER TABLE `sp_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_blogs`
--
ALTER TABLE `sp_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_captions`
--
ALTER TABLE `sp_captions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_coinpayments_history`
--
ALTER TABLE `sp_coinpayments_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_faqs`
--
ALTER TABLE `sp_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_files`
--
ALTER TABLE `sp_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_groups`
--
ALTER TABLE `sp_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_language`
--
ALTER TABLE `sp_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_language_category`
--
ALTER TABLE `sp_language_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_options`
--
ALTER TABLE `sp_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_payment_history`
--
ALTER TABLE `sp_payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_payment_subscriptions`
--
ALTER TABLE `sp_payment_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_plans`
--
ALTER TABLE `sp_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_posts`
--
ALTER TABLE `sp_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_proxies`
--
ALTER TABLE `sp_proxies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_purchases`
--
ALTER TABLE `sp_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_smtp`
--
ALTER TABLE `sp_smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_team`
--
ALTER TABLE `sp_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_team_member`
--
ALTER TABLE `sp_team_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_users`
--
ALTER TABLE `sp_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_user_roles`
--
ALTER TABLE `sp_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sp_accounts`
--
ALTER TABLE `sp_accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sp_blogs`
--
ALTER TABLE `sp_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_captions`
--
ALTER TABLE `sp_captions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_coinpayments_history`
--
ALTER TABLE `sp_coinpayments_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_faqs`
--
ALTER TABLE `sp_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_files`
--
ALTER TABLE `sp_files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sp_groups`
--
ALTER TABLE `sp_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_language`
--
ALTER TABLE `sp_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12377;

--
-- AUTO_INCREMENT for table `sp_language_category`
--
ALTER TABLE `sp_language_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sp_options`
--
ALTER TABLE `sp_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `sp_payment_history`
--
ALTER TABLE `sp_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sp_payment_subscriptions`
--
ALTER TABLE `sp_payment_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sp_plans`
--
ALTER TABLE `sp_plans`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sp_posts`
--
ALTER TABLE `sp_posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sp_proxies`
--
ALTER TABLE `sp_proxies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sp_purchases`
--
ALTER TABLE `sp_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sp_smtp`
--
ALTER TABLE `sp_smtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_team`
--
ALTER TABLE `sp_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_team_member`
--
ALTER TABLE `sp_team_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_users`
--
ALTER TABLE `sp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_user_roles`
--
ALTER TABLE `sp_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
