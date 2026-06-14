-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2026 at 03:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `Programming` varchar(100) DEFAULT NULL,
  `Design` varchar(100) DEFAULT NULL,
  `Writing` varchar(100) DEFAULT NULL,
  `Marketing` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `Programming`, `Design`, `Writing`, `Marketing`) VALUES
(1, 'Web Development', NULL, NULL, NULL, NULL),
(2, 'Graphic Design', NULL, NULL, NULL, NULL),
(3, 'Writing & Translation', NULL, NULL, NULL, NULL),
(4, 'Digital Marketing', NULL, NULL, NULL, NULL),
(5, 'Video & Animation', NULL, NULL, NULL, NULL),
(6, 'Data & Analytics', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_attachments`
--

CREATE TABLE `file_attachments` (
  `file_id` int(11) NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_type` enum('requirement','deliverable','revision') NOT NULL,
  `upload_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(10) NOT NULL,
  `client_id` varchar(10) NOT NULL,
  `freelancer_id` varchar(10) NOT NULL,
  `service_id` varchar(10) NOT NULL,
  `service_title` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `delivery_time` int(11) NOT NULL,
  `revisions_included` int(11) NOT NULL,
  `requirements` text NOT NULL,
  `deliverable_notes` text DEFAULT NULL,
  `status` enum('Pending','In Progress','Delivered','Completed','Revision Requested','Cancelled') DEFAULT 'Pending',
  `payment_method` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `expected_delivery` date NOT NULL,
  `completion_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revision_requests`
--

CREATE TABLE `revision_requests` (
  `revision_id` int(11) NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `revision_notes` text NOT NULL,
  `revision_file` varchar(255) DEFAULT NULL,
  `request_status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `response_date` timestamp NULL DEFAULT NULL,
  `freelancer_response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` varchar(10) NOT NULL,
  `freelancer_id` varchar(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `delivery_time` int(11) NOT NULL,
  `revisions_included` int(11) NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `featured_status` enum('Yes','No') DEFAULT 'No',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `freelancer_id`, `title`, `category`, `subcategory`, `description`, `price`, `delivery_time`, `revisions_included`, `image_1`, `image_2`, `image_3`, `status`, `featured_status`, `created_date`, `service_image`) VALUES
('2000000001', '1000000002', 'Business Card Design', 'Graphic Design', 'Branding', 'I will design a professional business card that matches your brand.', 600.00, 2, 2, 'images/Business_Card_Design_sara1.jpg', 'images/Business_Card_Design_sara2.jpg', 'images/Business_Card_Design_sara3.jpg', 'Active', 'No', '2025-12-22 16:26:49', 'images/business_card.jpg'),
('2000000002', '1000000002', 'Full Stack Web Application', 'Web Development', 'Full Stack Development', 'I will build a complete web application using PHP and MySQL.', 900.00, 15, 3, 'images/Full_Stack_Web_Application_omar1.jpg', 'images/Full_Stack_Web_Application_omar2.jpg', 'images/Full_Stack_Web_Application_omar3.jpg', 'Active', 'No', '2025-12-22 16:26:49', 'images/fullstack_web.jpg'),
('2000000003', '1000000002', 'Social Media Post Design', 'Graphic Design', 'Social Media Design', 'I will design eye-catching social media posts for Instagram and Facebook.', 80.00, 3, 2, 'images/SM_Post_Design_sara1.jpg', 'images/SM_Post_Design_sara2.jpg', 'images/SM_Post_Design_sara3.jpg', 'Active', 'No', '2025-12-25 15:35:17', 'images/social_media_design.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `role` enum('Client','Freelancer') NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `profile_photo` varchar(255) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `country`, `city`, `role`, `status`, `profile_photo`, `registration_date`) VALUES
('1000000002', 'Sara', 'Khaled', 'sara.freelancer@example.com', '123412341234', '0597654321', 'Palestine', 'Nablus', 'Freelancer', 'Active', NULL, '2025-12-22 16:26:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `file_attachments`
--
ALTER TABLE `file_attachments`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `revision_requests`
--
ALTER TABLE `revision_requests`
  ADD PRIMARY KEY (`revision_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `file_attachments`
--
ALTER TABLE `file_attachments`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revision_requests`
--
ALTER TABLE `revision_requests`
  MODIFY `revision_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_attachments`
--
ALTER TABLE `file_attachments`
  ADD CONSTRAINT `file_attachments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `revision_requests`
--
ALTER TABLE `revision_requests`
  ADD CONSTRAINT `revision_requests_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
