<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MyLib</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        }
        .introduction {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 90%;
                height: 40vh;
                margin: auto;
                background-color: #FBAB7E;
                background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);
                border-radius: 10px;
                overflow: hidden;
            }
        .content-intro {
            flex: 1;
            text-align: left;
            padding-left: 3em;
        }
        .intro-image {
            flex: 0 0 50%; 
            height: 100%; 
            text-align: center;
            opacity: 0.7;   
        }
        .intro-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .rating {
          position: fixed;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px;
            border-radius: 5px;
            z-index: 999;
            }

        .product-image {
            width: 100%;
            height: 70%;
            object-fit: contain;
        }
        .crown-icon {
            color: gold;
        }
        .item-product{
            height: 600px;
            background-image: linear-gradient(to bottom, transparent 70%, #0093E9 100%);
        }
        .coming-soon-label {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            background-color: #ffcc00;
            color: #000;
            padding: 5px;
            border-radius: 0 0 5px 5px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .notification {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 10px;
            font-size: 2em ;
            font-weight: 700;
            font-family: 'Courier New', Courier, monospace;
        }
        .navigation:hover{
            background-color: #ccc;
        }
        .title-page{
            margin-bottom: 1em;
        }
    </style>
  </head>
<body>
    <nav class='navbar navbar-expand-lg border-bottom position-sticky top-0 shadow p-3 mb-5 bg-body-tertiary rounded'>
        <div class='container-fluid'>
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                    <li class='nav-item'>
                    <a class='nav-link active navigation' aria-current='page' href='#'>Trang chủ</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link navigation' href='book.php'>Sách</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link navigation' aria-disabled='true' href='profile.php'>Cá nhân</a>
                    </li>

                    <?php if(isset($_SESSION['permission']) && $_SESSION['permission'] == 1): ?>
                    <li class='nav-item'>
                        <a class='nav-link navigation' aria-disabled='true' href='member.php'>Thành viên</a>
                    </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
    <?php
    // echo $_SESSION['id'];
    // echo $_SESSION['permission'];
    $special_products = [
    [
        'name' => 'Những người khốn khổ',
        'image' => 'images/product1.png',
        'description' => 'Tiểu thuyết về cuộc đấu tranh giữa công lý và bất công trong xã hội Pháp, theo chân Jean Valjean, một cựu tù nhân tìm kiếm sự chuộc tội và lòng nhân ái.',
    ],
    [
        'name' => 'Những vụ án của Sherlock Holmes',
        'image' => 'images/product2.png',
        'description' => 'Loạt truyện kể về thám tử Sherlock Holmes, người sử dụng trí tuệ sắc bén và phương pháp suy luận độc đáo để giải quyết những vụ án phức tạp.',
    ],
    [
        'name' => 'Đắc nhân tâm',
        'image' => 'images/product3.png',
        'description' => 'Cuốn sách nổi tiếng của Dale Carnegie, cung cấp những nguyên tắc và kỹ thuật để tạo dựng mối quan hệ tốt đẹp và thành công trong giao tiếp với mọi người.',
    ],
    [
        'name' => 'Mùa hè không tên',
        'image' => 'images/product4.png',
        'description' => 'Những rung động đầu đời và hành trình trưởng thành trong bối cảnh một mùa hè đầy kỷ niệm và khám phá bản thân.',
    ],
    [
        'name' => 'Hai số phận',
        'image' => 'images/product5.png',
        'description' => 'Câu chuyện cuộc đời của hai người đàn ông có xuất thân khác biệt nhưng cuộc sống lại đan xen, đặt ra những câu hỏi về số phận, quyết định và sự kiên trì.',
    ],
    [
        'name' => '7 thói quen hiệu quả',
        'image' => 'images/product6.png',
        'description' => 'Các nguyên tắc cơ bản để phát triển bản thân, thành công trong công việc và cuộc sống thông qua việc áp dụng bảy thói quen tích cực và hiệu quả.',
    ],
    ];
    ?>
    <div class="introduction">
        <div class="content-intro">
            <h1>My Library <i class="fas fa-crown crown-icon"></i></h1>
            <p>Trang web kết nối bạn tới tri thức</p>
            <p>Liên tục được cập nhật các tài liệu mới nhất</p>
        </div>
        <div class="intro-image">
            <img src="images/library.png" alt="Library">
        </div>
    </div>
    <div class='container my-4'>
        <h2 class='text-left title-page'>Tài liệu sắp có mặt trên My Library</h2>
        <div class='row'>
            <?php foreach ($special_products as $product): ?>
                <div class='col-md-6 col-lg-4'>
                    <div class='card mb-4 item-product'>
                        <div class='coming-soon-label'>Coming Soon</div>
                        <img src='<?php echo $product["image"]; ?>' class='card-img-top product-image object-fit' alt='<?php echo $product["name"]; ?>'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $product["name"]; ?></h5>
                            <p class='card-text'><?php echo $product["description"]; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="notification">
            Cùng chờ đón những tác phẩm mới nhé!
        </div>
    <footer class='bg-light text-center py-3 mt-auto border border-4 rounded-3'>
        <div class='container'>
            <p class='m-0'>© 2024</p>
            <p class='m-0'>Liên hệ: contact@example.com</p>
            <div class='mt-3'>
                <a href='https://www.facebook.com/yourcompany' target='_blank' class='me-3 text-primary'> 
                    <i class='fab fa-facebook fa-2x'></i>
                </a>
                <a href='https://www.instagram.com/yourcompany' target='_blank' class='text-danger'>
                    <i class='fab fa-instagram fa-2x'></i>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
