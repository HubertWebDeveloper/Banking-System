-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 02:48 PM
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
-- Database: `blueriver`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `usePIN` varchar(20) NOT NULL,
  `transcation_type` varchar(255) NOT NULL,
  `amount` int(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `asset_type` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `usePIN`, `transcation_type`, `amount`, `description`, `asset_type`, `date`) VALUES
(3, 'BR-218715179-N', 'Overdraft Interest Charge', 26000, 'n', 'credit', '2025-01-22'),
(4, 'BR-218715179-N', 'Fund Transfer (Internal)', 14500, 'quaty', 'credit', '2025-02-01'),
(5, 'BR-218715179-N', 'Cheque Deposit', 12000, 'nnwnw', 'debit', '2025-02-01'),
(6, 'BR-384854321-N', 'Cash Deposit', 10000, 'none', 'debit', '2025-02-03'),
(7, 'BR-384854321-N', 'Direct Debit', 250000, 'nnoe', 'debit', '2025-02-03'),
(8, 'BR-384854321-N', 'Cash Withdrawal', 5000, 'none', 'credit', '2025-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `usePIN` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` date NOT NULL,
  `executed_at` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `usePIN`, `name`, `create_at`, `executed_at`, `status`) VALUES
(2, 'BR-218715179-N', 'Hp refurbished proDesk 600g', '2025-01-31', '0000-00-00', 'executed'),
(3, 'BR-218715179-N', 'Test budget one and two', '2025-02-01', '0000-00-00', 'Wait to be execute'),
(5, 'BR-384854321-N', 'trying new budgets', '2025-02-03', '0000-00-00', 'Wait to be execute');

-- --------------------------------------------------------

--
-- Table structure for table `budget_list`
--

CREATE TABLE `budget_list` (
  `id` int(11) NOT NULL,
  `budget_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budget_list`
--

INSERT INTO `budget_list` (`id`, `budget_id`, `title`, `unit`, `price`, `total_amount`) VALUES
(4, 2, 'item 1', 10, 210, 2100),
(5, 5, 'cup', 6, 1000, 6000),
(6, 5, 'second list', 2, 240, 480);

-- --------------------------------------------------------

--
-- Table structure for table `like_table`
--

CREATE TABLE `like_table` (
  `id` int(11) NOT NULL,
  `framework` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like_table`
--

INSERT INTO `like_table` (`id`, `framework`) VALUES
(2, 'Laravel'),
(3, 'Symfony'),
(4, 'Yii'),
(5, 'CakePHP'),
(6, 'Codeigniter'),
(7, 'Codeigniter'),
(8, 'Laravel'),
(9, 'Yii'),
(10, 'Codeigniter'),
(11, 'Laravel'),
(12, 'Symfony'),
(13, 'Codeigniter'),
(14, 'Yii'),
(15, 'Codeigniter'),
(16, 'CakePHP'),
(17, 'Yii'),
(18, 'Codeigniter'),
(19, 'Laravel'),
(20, 'Laravel'),
(21, 'Laravel'),
(22, 'Laravel'),
(23, 'Codeigniter'),
(24, 'Codeigniter'),
(25, 'Codeigniter'),
(26, 'CakePHP'),
(27, 'CakePHP'),
(28, 'Codeigniter'),
(29, 'Laravel'),
(30, 'Symfony'),
(31, 'Yii'),
(32, 'Codeigniter'),
(33, 'Codeigniter'),
(34, 'Laravel'),
(35, 'Symfony'),
(36, 'Yii'),
(37, 'CakePHP'),
(38, 'Codeigniter'),
(39, 'Codeigniter'),
(40, 'Codeigniter'),
(41, 'Codeigniter'),
(42, 'CakePHP'),
(43, 'Laravel'),
(44, 'Symfony');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `property_name`, `description`) VALUES
(1, 'Residential Properties', 'Includes houses, apartments, condominiums, townhouses, and vacation homes.'),
(2, 'Commercial Properties', 'Includes office buildings, retail stores, shopping malls, and warehouses.'),
(3, 'Industrial Properties', 'Includes factories, manufacturing plants, and storage facilities.'),
(4, 'Land', 'Includes agricultural land, vacant land, and development land.'),
(5, 'Bank Savings & Deposits', 'Includes savings accounts, checking accounts, and fixed deposits in banks.'),
(6, 'Stocks & Bonds', 'Includes shares in publicly traded companies and bonds issued by corporations or governments.'),
(7, 'Mutual Funds & ETFs', 'Includes pooled investment funds, such as mutual funds and exchange-traded funds.'),
(8, 'Retirement Accounts', 'Includes retirement accounts such as 401(k), IRA, and pension funds.'),
(9, 'Insurance Policies', 'Includes life, health, and property insurance policies.'),
(10, 'Cryptocurrencies', 'Includes digital currencies such as Bitcoin, Ethereum, and others.'),
(11, 'Vehicles', 'Includes cars, motorcycles, boats, planes, and other personal vehicles.'),
(12, 'Jewelry & Precious Metals', 'Includes gold, silver, diamonds, and other valuable items.'),
(13, 'Artwork & Collectibles', 'Includes paintings, sculptures, antiques, and other collectible items.'),
(14, 'Electronics', 'Includes computers, phones, cameras, and other electronic devices.'),
(15, 'Furniture & Appliances', 'Includes home furniture and household appliances.'),
(16, 'Patents', 'Legal rights granted for inventions or processes, protecting their use or sale.'),
(17, 'Trademarks', 'Legal protections for brand names, logos, and other distinctive identifiers.'),
(18, 'Copyrights', 'Legal protections for original works of authorship, such as books, music, and software.'),
(19, 'Trade Secrets', 'Confidential business information or practices that provide a competitive edge.'),
(20, 'Business & Corporate Assets', 'Includes ownership stakes, machinery, and goodwill in businesses or companies.');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `usePIN` varchar(100) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `amount` int(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `issued_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `usePIN`, `property_name`, `amount`, `description`, `issued_date`) VALUES
(4, 'BR-218715179-N', 'Bank Savings & Deposits', 30000, 'nno', '2025-02-02'),
(5, 'BR-384854321-N', 'Vehicles', 2000000, 'none', '2024-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_type`, `description`) VALUES
(1, 'Cash Deposit', 'Customer deposits cash into their account'),
(2, 'Cash Withdrawal', 'Customer withdraws cash from their account'),
(3, 'Cheque Deposit', 'Customer deposits a cheque for clearing'),
(4, 'Cheque Issuance', 'Customer issues a cheque for payment'),
(5, 'Fund Transfer (Internal)', 'Transfer between customer’s own accounts within the same bank'),
(6, 'Fund Transfer (External)', 'Transfer to another bank via RTGS, NEFT, or SWIFT'),
(7, 'Standing Order Payment', 'Automated recurring payments (e.g., rent, utilities)'),
(8, 'Direct Debit', 'Bank-initiated withdrawal for payments (e.g., subscriptions, loans)'),
(9, 'Mobile Banking Transfer', 'Transactions via mobile banking apps'),
(10, 'Online Banking Transfer', 'Transactions through internet banking'),
(11, 'ATM Withdrawal', 'Customer withdraws cash from an ATM'),
(12, 'Card Payment', 'Payments made using debit/credit cards'),
(13, 'Bill Payment', 'Payment for utilities, telecom, and other services'),
(14, 'Loan Repayment', 'Customer pays back loan principal or interest'),
(15, 'Overdraft Utilization', 'Customer withdraws beyond available balance'),
(16, 'Overdraft Repayment', 'Customer repays used overdraft'),
(17, 'Interbank Fund Transfer', 'Transfers between different banks'),
(18, 'Intra-bank Transfer', 'Transfers between branches of the same bank'),
(19, 'SWIFT Payment', 'International money transfer'),
(20, 'RTGS (Real Time Gross Settlement)', 'Large-value, real-time transfer'),
(21, 'NEFT (National Electronic Funds Transfer)', 'Batch-based, domestic transfer'),
(22, 'ACH (Automated Clearing House)', 'Bulk transactions like salaries and dividends'),
(23, 'Forex Transaction', 'Currency exchange transactions'),
(24, 'Loan Disbursement', 'Bank provides loan amount to borrower'),
(25, 'Loan Repayment', 'Customer repays loan principal or interest'),
(26, 'Interest Accrual', 'Interest is added to outstanding loan balance'),
(27, 'Loan Write-Off', 'Unrecoverable loan amount is written off'),
(28, 'Credit Card Charge', 'Purchase made using a credit card'),
(29, 'Credit Card Payment', 'Repayment of credit card dues'),
(30, 'Overdraft Issuance', 'Bank allows overdraft facility'),
(31, 'Overdraft Interest Charge', 'Interest on overdraft balance'),
(32, 'Interest Income', 'Revenue earned from loans and deposits'),
(33, 'Interest Expense', 'Interest paid on customer deposits'),
(34, 'Service Charges', 'Fees charged for account maintenance, fund transfers, etc.'),
(35, 'Commission Income', 'Earnings from foreign exchange, investment services, etc.'),
(36, 'Penalty Charges', 'Fees for overdraft, late payments, or failed transactions'),
(37, 'Operating Expenses', 'Bank expenses like salaries, rent, and utilities'),
(38, 'Treasury Operations', 'Management of liquidity, bonds, and securities'),
(39, 'Foreign Exchange Trade', 'Buying and selling foreign currencies'),
(40, 'Investment Transactions', 'Bank’s investment in stocks, bonds, or other securities'),
(41, 'Asset Purchase', 'Purchase of physical or financial assets'),
(42, 'Asset Disposal', 'Selling of bank-owned assets'),
(43, 'Tax Payment', 'Bank’s tax payments to the government'),
(44, 'AML (Anti-Money Laundering) Reporting', 'Transactions flagged for compliance review'),
(45, 'Regulatory Fees Payment', 'Fees paid to regulatory authorities');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pin`, `firstname`, `lastname`, `email`, `phone`, `nationality`, `gender`, `profile`, `currency`, `password`) VALUES
(13, 'BR-218715179-N', 'HUBERT', 'HIRWA', 'hhirwa1390@stu.kemu.ac.ke', '+250781794795', 'Rwanda', 'Male', 'avatar/avatar3.png', 'RWF', '$2y$10$3p/ZAmL/mRDJ3RGTX9sTa.bHIn60A4d4ZFpt0w.bQc7BGDJaKSJoG'),
(14, 'BR-384854321-N', 'text', 'user', 'dont123.miss@gmail.com', '+250753354433', 'Rwanda', 'Male', 'avatar/avatar6.png', 'RWF', '$2y$10$3XKFVEbS6Ad.1VJjqMIsguyQ2sNpyAVF8s5qSNtAXvQOI2L5ng2LS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_list`
--
ALTER TABLE `budget_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_table`
--
ALTER TABLE `like_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `budget_list`
--
ALTER TABLE `budget_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `like_table`
--
ALTER TABLE `like_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
