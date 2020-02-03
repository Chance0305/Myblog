-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 20-01-30 19:58
-- 서버 버전: 10.1.37-MariaDB
-- PHP 버전: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `blog`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `categorys`
--

CREATE TABLE `categorys` (
  `idx` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `categorys`
--

INSERT INTO `categorys` (`idx`, `name`) VALUES
(1, '자유게시판');

-- --------------------------------------------------------

--
-- 테이블 구조 `comments`
--

CREATE TABLE `comments` (
  `idx` int(11) NOT NULL,
  `post_idx` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `write_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `likes`
--

CREATE TABLE `likes` (
  `idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `post_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `likes`
--

INSERT INTO `likes` (`idx`, `user_idx`, `post_idx`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `posts`
--

CREATE TABLE `posts` (
  `idx` int(11) NOT NULL,
  `category_idx` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `write_date` datetime NOT NULL,
  `viewed` int(11) NOT NULL,
  `liked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `posts`
--

INSERT INTO `posts` (`idx`, `category_idx`, `title`, `content`, `write_date`, `viewed`, `liked`) VALUES
(1, 1, 'Hello, World!', 'This is My First Post in My Blog', '2019-11-22 10:16:26', 5, 1),
(2, 1, '인사 합니다.', '블로그 테스트 글입니다. 안녕하세요 안녕하십니까 안녕 하이 반가워 방가방가', '2019-11-22 10:16:32', 5, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `uploads`
--

CREATE TABLE `uploads` (
  `idx` int(11) NOT NULL,
  `post_idx` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `directory` varchar(200) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `uploads`
--

INSERT INTO `uploads` (`idx`, `post_idx`, `name`, `directory`, `type`) VALUES
(1, 1, '', 'uploads/', 0),
(2, -1, '', 'uploads/1', 0),
(3, -1, '', 'uploads/2', 0),
(4, 2, '', 'uploads/3', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `idx` int(11) NOT NULL,
  `id` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`idx`, `id`, `password`) VALUES
(1, 'admin', '1234'),
(2, 'user', '1234');

-- --------------------------------------------------------

--
-- 테이블 구조 `visitors`
--

CREATE TABLE `visitors` (
  `idx` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `visitors`
--

INSERT INTO `visitors` (`idx`, `visit_date`, `name`) VALUES
(1, '2019-11-22', 'admin'),
(2, '2019-11-22', 'admin'),
(3, '2019-11-22', 'admin'),
(4, '2019-11-22', 'admin'),
(5, '2019-11-22', 'admin'),
(6, '2019-11-22', 'admin'),
(7, '2019-11-22', 'admin'),
(8, '2019-11-22', 'admin'),
(9, '2019-11-22', 'admin'),
(10, '2019-11-22', 'admin'),
(11, '2019-11-22', 'admin'),
(12, '2019-11-22', 'admin'),
(13, '2019-11-22', 'admin'),
(14, '2019-11-22', 'admin'),
(15, '2019-11-22', 'admin'),
(16, '2019-11-22', 'admin'),
(17, '2019-11-22', 'admin'),
(18, '2019-11-22', 'admin'),
(19, '2019-11-22', 'admin'),
(20, '2019-11-22', 'admin'),
(21, '2019-11-22', 'admin'),
(22, '2019-11-22', 'admin'),
(23, '2019-11-22', 'admin'),
(24, '2019-11-22', 'admin'),
(25, '2019-11-22', 'admin'),
(26, '2019-11-22', 'admin'),
(27, '2019-11-22', 'admin'),
(28, '2019-11-22', 'admin'),
(29, '2019-11-22', 'admin'),
(30, '2019-11-22', 'admin'),
(31, '2019-11-22', 'admin'),
(32, '2019-11-22', 'admin'),
(33, '2019-11-22', 'admin'),
(34, '2019-11-22', 'user'),
(35, '2019-11-22', 'user'),
(36, '2019-11-22', 'user'),
(37, '2019-11-22', 'user'),
(38, '2019-11-22', 'user');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `categorys`
--
ALTER TABLE `categorys`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `uploads`
--
ALTER TABLE `uploads`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `visitors`
--
ALTER TABLE `visitors`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
