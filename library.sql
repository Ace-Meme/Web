-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 25, 2024 lúc 09:54 AM
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

--
-- Đang đổ dữ liệu cho bảng `borrow`
--

INSERT INTO `borrow` (`student_id`, `document_id`) VALUES
(2000002, 1),
(2000002, 2),
(2000006, 1);

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
(1, 'Kiến trúc máy tính', 'Sách cơ sở ngành', 'Phạm Quốc Cường', 'NXB Đại học Quốc gia TPHCM', 2019, 2, 'Kiến trúc máy tính cũng là một trong các môn cơ sở ngành quan trọng, môn học đề cập tới cơ sở về kiến trúc tập lệnh và tổ chức của máy tính, các vấn đề cơ bản trong thiết kế máy tính. Ngoài ra các bạn còn được học cơ bản về ngôn ngữ lập trình gần gũi nhất với máy tính đó là Assembly (cụ thể là MIPS).', 'https://lib.hcmut.edu.vn/uploads/noidung/kien-truc-may-tinh-0-824.jpg'),
(2, 'Ngày cuối cùng của một tử tù', 'Sách văn học', 'Victor Hugo', 'NXB Văn học', 2000, 5, '\"Ngày Cuối Cùng Của Một Tử Tù\" là cuốn sách khá thành công đến từ ngòi bút của nhà văn Victor Hugo. Ông là người có sức ảnh hưởng to lớn đối với nền văn học Pháp nói riêng và văn học thế giới nói chung.', 'https://salt.tikicdn.com/cache/750x750/ts/product/e1/05/2e/5e7ee42357dcd602c4a41d08af57416c.jpg.webp'),
(3, 'Cấu trúc dữ liệu và giải thuật', 'Sách cơ sở ngành', 'Nguyễn Trung Trực', 'NXB Đại học Quốc gia TPHCM', 2019, 1, 'Quyển sách Cấu trúc dữ liệu và Giải thuật trình bày cấu trúc dữ liệu tuyến tính (mảng, danh sách liên kết) và cấu trúc dữ liệu phi tuyến (cây, đồ thị) và các giải thuật của các cấu trúc dữ liệu này. Các cấu trúc dữ liệu và giải thuật được trình bày theo kiểu lập trình có cấu trúc (structured programming) (minh họa bằng ngôn ngữ lập trình C++) và theo kiểu lập trình hướng đối tượng (object-oriented programming) (minh họa bằng ngôn ngữ lập trình C#). Các phần phụ lục là các chương trình được viết theo kiểu lập trình tổng quát (generic programming). Quyển sách này bao gồm 12 chương và 9 phụ lục.', 'https://www.lib.hcmut.edu.vn/uploads/noidung/cau-truc-du-lieu-va-giai-thuat-0-297.jpg'),
(4, 'Ngôn ngữ lập trình - Các nguyên lý và mô hình', 'Sách cơ sở ngành', 'Cao Hoàng Trụ', 'NXB Đại học Quốc gia TPHCM', 2011, 3, 'Nguyên lý Ngôn ngữ Lập trình (PPL) là một trong những môn khó nhất trong toàn bộ chương trình đào tạo ngành Khoa học máy tính của Bách Khoa. Mục đích của các bài tập lớn ở môn này chính là xây dựng một trình biên dịch (compiler) cho một ngôn ngữ được đặc tả riêng biệt bởi các giảng viên trong trường và luôn được thay thế sau mỗi kỳ học.', 'https://www.lib.hcmut.edu.vn/uploads/noidung/giao-trinh-ngon-ngu-lap-trinh-cac-nguyen-ly-va-mo-hinh-0-400.jpg'),
(5, 'Nghìn lẻ một đêm', 'Sách văn học', 'Antoine Galland', 'NXB Văn học', 2021, 1, 'Nghìn lẻ một đêm là bộ sưu tập các truyện dân gian Trung Đông và Nam Á được biên soạn bằng tiếng Ả Rập trong thời đại hoàng kim Hồi giáo. Tác phẩm này được sưu tập qua nhiều thế kỷ bởi nhiều tác giả, dịch giả và học giả khắp Tây Á, Trung Á, Nam Á và Bắc Phi.', 'https://cdn0.fahasa.com/media/catalog/product/n/g/nghinle1dem_1.jpg'),
(6, 'Ba người lính ngự lâm', 'Sách văn học', 'Alexandre Dumas', 'NXB Văn học', 2017, 1, '“Ba người lính ngự lâm” kể về câu chuyện của ba người lính. D’Artagnan là hậu duệ một dòng dõi quý tộc đã sa sút. Năm 18 tuổi, chàng rời nhà trên một con ngựa còm để đến Paris với mong ước trở thành một lính ngự lâm của vua Louis XIII.', 'https://cdn0.fahasa.com/media/catalog/product/i/m/image_188547.jpg'),
(7, 'Hệ cơ sở dữ liệu', 'Sách cơ sở ngành', 'Dương Tuấn Anh - Nguyễn Trung Trực', 'NXB Đại học Quốc gia TPHCM', 2020, 3, 'Môn học này giới thiệu các kiến thức cơ bản về hệ cơ sở dữ liệu (CSDL) bao gồm: lịch sử và động cơ phát triển của hệ cơ sở dữ liệu, kiến trúc và các thành phần của hệ cơ sở dữ liệu, các mô  hình dữ liệu luận lý và ý niệm như mô hình dữ liệu quan hệ và mô hình thực thể mối liên kết. Ngoài ra, môn học này cũng thảo luận về đại số quan hệ, ngôn ngữ SQL, và nguyên lý và phương pháp thiết kế CSDL cũng như các vấn đề lưu trữ, quản lý, và bảo mật CSDL với các hệ quản trị cơ sở dữ liệu để phát triển ứng dụng CSDL hiệu quả cho các hệ thống thông tin.', 'https://www.lib.hcmut.edu.vn/uploads/noidung/he-co-so-du-lieu-0-804.jpg'),
(8, 'Xử lý ngôn ngữ tự nhiên', 'Sách chuyên ngành', 'Phan Thị Tươi', 'NXB Đại học Quốc gia TPHCM', 2012, 2, 'Quyển sách Cấu trúc dữ liệu và Giải thuật trình bày cấu trúc dữ liệu tuyến tính (mảng, danh sách liên kết) và cấu trúc dữ liệu phi tuyến (cây, đồ thị) và các giải thuật của các cấu trúc dữ liệu này. Các cấu trúc dữ liệu và giải thuật được trình bày theo kiểu lập trình có cấu trúc (structured programming) (minh họa bằng ngôn ngữ lập trình C++) và theo kiểu lập trình hướng đối tượng (object-oriented programming) (minh họa bằng ngôn ngữ lập trình C#). Các phần phụ lục là các chương trình được viết theo kiểu lập trình tổng quát (generic programming). Quyển sách này bao gồm 12 chương và 9 phụ lục.Ngôn ngữ có hai dạng: viết và nói. Hầu hết các tri thức của con người đều được ghi nhớ ở dạng ngôn ngữ. Nếu máy tính có thể hiểu được các thông tin này thì nó có thể truy xuất được tất cả các thông tin. Hơn nữa, khi ngôn ngữ tự nhiên có thể giao tiếp với máy tính, nó cho phép các hệ thống phức tạp sẽ được tất cả mọi người truy xuất. Hệ thống như vậy sẽ mềm dẻo và thông minh hơn hệ thống máy tính hiện nay. Với mục đích công nghệ thì không có vấn đề gì phức tạp nếu các mô hình ngôn ngữ phản ánh được cách con người xử lý ngôn ngữ như thế nào, tuy nhiên vấn đề khó ở chỗ là làm như thế nào để xây dựng các mô hình đó. Xử lý ngôn ngữ tự nhiên được ứng dụng trong hai lĩnh vực chính: ứng dụng trên cơ sở văn bản (text based application) và ứng dụng trên cơ sở đối thoại (dialogue - based application).', 'https://lib.hcmut.edu.vn/ajax.phpuploads/files/015.png'),
(9, 'Kỹ thuật lập trình', 'Sách cơ sở ngành', 'Nguyễn Trung Trực', 'NXB Đại học Quốc gia TPHCM', 2018, 1, 'Quyển sách Kỹ thuật lập trình trình bày các kiểu lập trình: lập trình goto (goto programming), lập trình có cấu trúc (structured programming) và lập trình hướng đối tượng (object-oriented programming).', 'https://lib.hcmut.edu.vn/uploads/noidung/ky-thuat-lap-trinh-0-749.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `email` varchar(127) NOT NULL,
  `password` varchar(127) NOT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `permission` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`student_id`, `student_name`, `email`, `password`, `join_date`, `permission`) VALUES
(2000000, 'Admin 1', 'admin1@gmail.com', '87654321', '2023-11-14', 1),
(2000001, 'Admin 2', 'admin2@gmail.com', '87654321', '2023-11-14', 1),
(2000002, 'Member 1', 'member1@gmail.com', '12345678', '2023-11-15', 2),
(2000006, 'Member 2', 'member2@gmail.com', '12345678', '2023-11-15', 2),
(2000007, 'Member 3', 'member3@gmail.com', '12345678', '2023-11-15', 2);

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
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `members` (`student_id`),
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
