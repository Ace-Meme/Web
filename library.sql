-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 21, 2024 lúc 02:29 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `library`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_by_id` (IN `StudentId` INT(11))   SELECT
    members.student_id,
    members.student_name,
    members.email,
    members.join_date,
    members.state,
    CONCAT('[', GROUP_CONCAT('"', role.role, '"'), ']') AS permission
FROM
    members RIGHT OUTER JOIN role ON members.student_id = role.student_id
WHERE
	members.student_id = StudentId
GROUP BY
    members.student_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_user` (IN `user_input` TEXT)   SELECT
    members.student_id,
    members.student_name,
    members.state,
    CONCAT('[', GROUP_CONCAT('"', role.role, '"'), ']') AS permission
FROM
    members RIGHT OUTER JOIN role ON members.student_id = role.student_id
WHERE
    ((CAST(members.student_id AS CHAR) LIKE CONCAT('%', user_input, '%')) OR
    (user_input NOT REGEXP '^[0-9]+$' AND members.student_name LIKE CONCAT('%', user_input, '%')))
GROUP BY
    members.student_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_users_list` ()   SELECT
    members.student_id,
    members.student_name,
    members.state,
    CONCAT('[', GROUP_CONCAT('"', role.role, '"'), ']') AS permission
FROM
    members RIGHT OUTER JOIN role ON members.student_id = role.student_id
GROUP BY
    members.student_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `borrow`
--

CREATE TABLE `borrow` (
  `student_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `doc_name` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  `author` varchar(256) NOT NULL,
  `publisher` varchar(512) NOT NULL,
  `publish_year` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(4096) NOT NULL,
  `image_url` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `documents`
--

INSERT INTO `documents` (`document_id`, `doc_name`, `type`, `author`, `publisher`, `publish_year`, `quantity`, `description`, `image_url`) VALUES
(1, 'Kiến trúc máy tính', 'Sách cơ sở ngành', 'Phạm Quốc Cường', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Kiến trúc máy tính cũng là một trong các môn cơ sở ngành quan trọng, môn học đề cập tới cơ sở về kiến trúc tập lệnh và tổ chức của máy tính, các vấn đề cơ bản trong thiết kế máy tính. Ngoài ra các bạn còn được học cơ bản về ngôn ngữ lập trình gần gũi nhất với máy tính đó là Assembly (cụ thể là MIPS).', 'https://th.bing.com/th/id/R.6148bed16bbd11ac1a9fda2f8a324cd8?rik=6e%2bvwUG3bgHXOg&riu=http%3a%2f%2fwww.bgt.hcmut.edu.vn%2fimages%2fstories%2fvirtuemart%2fproduct%2fkien-truc-may-tinh.jpg&ehk=X%2bCyOmYr3%2fbV4AJwh7%2fEqhYABBdxGrYMhjYjC7t7dPI%3d&risl=&pid=ImgRaw&r=0'),
(2, 'Ngày cuối cùng của một tử tù', 'Sách văn học', 'Victor Hugo', 'NXB Văn học', 2000, 5, '\"Ngày Cuối Cùng Của Một Tử Tù\" là cuốn sách khá thành công đến từ ngòi bút của nhà văn Victor Hugo. Ông là người có sức ảnh hưởng to lớn đối với nền văn học Pháp nói riêng và văn học thế giới nói chung.', 'https://sach86.com/wp-content/uploads/2021/11/Ngay-Cuoi-Cung-Cua-Mot-Tu-Tu.jpg'),
(3, 'Cấu trúc dữ liệu và giải thuật', 'Sách cơ sở ngành', 'Nguyễn Trung Trực', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Quyển sách Cấu trúc dữ liệu và Giải thuật trình bày cấu trúc dữ liệu tuyến tính (mảng, danh sách liên kết) và cấu trúc dữ liệu phi tuyến (cây, đồ thị) và các giải thuật của các cấu trúc dữ liệu này. Các cấu trúc dữ liệu và giải thuật được trình bày theo kiểu lập trình có cấu trúc (structured programming) (minh họa bằng ngôn ngữ lập trình C++) và theo kiểu lập trình hướng đối tượng (object-oriented programming) (minh họa bằng ngôn ngữ lập trình C#). Các phần phụ lục là các chương trình được viết theo kiểu lập trình tổng quát (generic programming). Quyển sách này bao gồm 12 chương và 9 phụ lục.', 'https://lh3.googleusercontent.com/pw/ACtC-3fMzvqEVNMukfA8PA3KVxvfUWOBWImHMbiERBQcV3Io0HQvE4jxhlorn6udriwihN_ZbdXw-t8SCouZe_5aX-s_W9HiRQcidVf_aS1szGyvgGSkZMrMjaf4ZJ9v4Rl8YnTRU9YncgSqShlrjaIZowFnRg=w384-h576-no?authuser=0'),
(4, 'Kiến trúc máy tính', 'Sách cơ sở ngành', 'Phạm Quốc Cường', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Kiến trúc máy tính cũng là một trong các môn cơ sở ngành quan trọng, môn học đề cập tới cơ sở về kiến trúc tập lệnh và tổ chức của máy tính, các vấn đề cơ bản trong thiết kế máy tính. Ngoài ra các bạn còn được học cơ bản về ngôn ngữ lập trình gần gũi nhất với máy tính đó là Assembly (cụ thể là MIPS).', 'https://th.bing.com/th/id/R.6148bed16bbd11ac1a9fda2f8a324cd8?rik=6e%2bvwUG3bgHXOg&riu=http%3a%2f%2fwww.bgt.hcmut.edu.vn%2fimages%2fstories%2fvirtuemart%2fproduct%2fkien-truc-may-tinh.jpg&ehk=X%2bCyOmYr3%2fbV4AJwh7%2fEqhYABBdxGrYMhjYjC7t7dPI%3d&risl=&pid=ImgRaw&r=0'),
(5, 'Kiến trúc máy tính', 'Sách cơ sở ngành', 'Phạm Quốc Cường', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Kiến trúc máy tính cũng là một trong các môn cơ sở ngành quan trọng, môn học đề cập tới cơ sở về kiến trúc tập lệnh và tổ chức của máy tính, các vấn đề cơ bản trong thiết kế máy tính. Ngoài ra các bạn còn được học cơ bản về ngôn ngữ lập trình gần gũi nhất với máy tính đó là Assembly (cụ thể là MIPS).', 'https://th.bing.com/th/id/R.6148bed16bbd11ac1a9fda2f8a324cd8?rik=6e%2bvwUG3bgHXOg&riu=http%3a%2f%2fwww.bgt.hcmut.edu.vn%2fimages%2fstories%2fvirtuemart%2fproduct%2fkien-truc-may-tinh.jpg&ehk=X%2bCyOmYr3%2fbV4AJwh7%2fEqhYABBdxGrYMhjYjC7t7dPI%3d&risl=&pid=ImgRaw&r=0'),
(6, 'Kiến trúc máy tính', 'Sách cơ sở ngành', 'Phạm Quốc Cường', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Kiến trúc máy tính cũng là một trong các môn cơ sở ngành quan trọng, môn học đề cập tới cơ sở về kiến trúc tập lệnh và tổ chức của máy tính, các vấn đề cơ bản trong thiết kế máy tính. Ngoài ra các bạn còn được học cơ bản về ngôn ngữ lập trình gần gũi nhất với máy tính đó là Assembly (cụ thể là MIPS).', 'https://th.bing.com/th/id/R.6148bed16bbd11ac1a9fda2f8a324cd8?rik=6e%2bvwUG3bgHXOg&riu=http%3a%2f%2fwww.bgt.hcmut.edu.vn%2fimages%2fstories%2fvirtuemart%2fproduct%2fkien-truc-may-tinh.jpg&ehk=X%2bCyOmYr3%2fbV4AJwh7%2fEqhYABBdxGrYMhjYjC7t7dPI%3d&risl=&pid=ImgRaw&r=0'),
(7, 'Cấu trúc dữ liệu và giải thuật', 'Sách cơ sở ngành', 'Nguyễn Trung Trực', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Quyển sách Cấu trúc dữ liệu và Giải thuật trình bày cấu trúc dữ liệu tuyến tính (mảng, danh sách liên kết) và cấu trúc dữ liệu phi tuyến (cây, đồ thị) và các giải thuật của các cấu trúc dữ liệu này. Các cấu trúc dữ liệu và giải thuật được trình bày theo kiểu lập trình có cấu trúc (structured programming) (minh họa bằng ngôn ngữ lập trình C++) và theo kiểu lập trình hướng đối tượng (object-oriented programming) (minh họa bằng ngôn ngữ lập trình C#). Các phần phụ lục là các chương trình được viết theo kiểu lập trình tổng quát (generic programming). Quyển sách này bao gồm 12 chương và 9 phụ lục.', 'https://lh3.googleusercontent.com/pw/ACtC-3fMzvqEVNMukfA8PA3KVxvfUWOBWImHMbiERBQcV3Io0HQvE4jxhlorn6udriwihN_ZbdXw-t8SCouZe_5aX-s_W9HiRQcidVf_aS1szGyvgGSkZMrMjaf4ZJ9v4Rl8YnTRU9YncgSqShlrjaIZowFnRg=w384-h576-no?authuser=0'),
(8, 'Cấu trúc dữ liệu và giải thuật', 'Sách cơ sở ngành', 'Nguyễn Trung Trực', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Quyển sách Cấu trúc dữ liệu và Giải thuật trình bày cấu trúc dữ liệu tuyến tính (mảng, danh sách liên kết) và cấu trúc dữ liệu phi tuyến (cây, đồ thị) và các giải thuật của các cấu trúc dữ liệu này. Các cấu trúc dữ liệu và giải thuật được trình bày theo kiểu lập trình có cấu trúc (structured programming) (minh họa bằng ngôn ngữ lập trình C++) và theo kiểu lập trình hướng đối tượng (object-oriented programming) (minh họa bằng ngôn ngữ lập trình C#). Các phần phụ lục là các chương trình được viết theo kiểu lập trình tổng quát (generic programming). Quyển sách này bao gồm 12 chương và 9 phụ lục.', 'https://lh3.googleusercontent.com/pw/ACtC-3fMzvqEVNMukfA8PA3KVxvfUWOBWImHMbiERBQcV3Io0HQvE4jxhlorn6udriwihN_ZbdXw-t8SCouZe_5aX-s_W9HiRQcidVf_aS1szGyvgGSkZMrMjaf4ZJ9v4Rl8YnTRU9YncgSqShlrjaIZowFnRg=w384-h576-no?authuser=0'),
(9, 'Kiến trúc máy tính', 'Sách cơ sở ngành', 'Phạm Quốc Cường', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Kiến trúc máy tính cũng là một trong các môn cơ sở ngành quan trọng, môn học đề cập tới cơ sở về kiến trúc tập lệnh và tổ chức của máy tính, các vấn đề cơ bản trong thiết kế máy tính. Ngoài ra các bạn còn được học cơ bản về ngôn ngữ lập trình gần gũi nhất với máy tính đó là Assembly (cụ thể là MIPS).', 'https://th.bing.com/th/id/R.6148bed16bbd11ac1a9fda2f8a324cd8?rik=6e%2bvwUG3bgHXOg&riu=http%3a%2f%2fwww.bgt.hcmut.edu.vn%2fimages%2fstories%2fvirtuemart%2fproduct%2fkien-truc-may-tinh.jpg&ehk=X%2bCyOmYr3%2fbV4AJwh7%2fEqhYABBdxGrYMhjYjC7t7dPI%3d&risl=&pid=ImgRaw&r=0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `email` varchar(127) NOT NULL,
  `password` varchar(127) NOT NULL,
  `avatar_url` varchar(512) DEFAULT NULL,
  `state` varchar(127) NOT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`student_id`, `student_name`, `email`, `password`, `avatar_url`, `state`, `join_date`, `permission`) VALUES
(2000000, 'Admin 1', 'admin1@gmail.com', '$2b$10$UpVm2Pt389EY0anjTZAwIulqMNBSo3Wmqk8inN47l9ABQyk5XfWKK', 'https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60', 'Đang hoạt động', '2023-11-14', 'Quản trị viên'),
(2000001, 'Admin 2', 'admin2@gmail.com', '$2b$10$ExtohTHcom1BvBpujafeQet/o8rMJNppbF4xQ8J8MbLE9eE3oilJO', 'https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60', 'Đang hoạt động', '2023-11-14', 'Quản trị viên'),
(2000002, 'Member 1', 'member1@gmail.com', '$2b$10$E30b5YunGc0lJ1G7D/PrZenQXV.oeiHuNaCH2T/QLB6eX3J2DCLFe', 'https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60', 'Đang hoạt động', '2023-11-15', 'Thành viên'),
(2000006, 'Member 2', 'member2@gmail.com', '$2b$10$E30b5YunGc0lJ1G7D/PrZenQXV.oeiHuNaCH2T/QLB6eX3J2DCLFe', 'https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60', 'Đã bị khóa', '2023-11-15', 'Thành viên'),
(2000007, 'Member 3', 'member3@gmail.com', '$2b$10$E30b5YunGc0lJ1G7D/PrZenQXV.oeiHuNaCH2T/QLB6eX3J2DCLFe', 'https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60', 'Đã bị khóa', '2023-11-15', 'Thành viên');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `borrow`
--
ALTER TABLE `borrow`
  ADD KEY `student_id` (`student_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Chỉ mục cho bảng `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000008;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `members` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
