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
          height: 400px;
          object-fit: contain;
    }
    </style>
  </head>
<body>
<nav class='navbar navbar-expand-lg border-bottom position-sticky top-0 shadow p-3 mb-5 bg-body-tertiary rounded z-3'>
    <div class='container-fluid'>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                  <a class='nav-link active' aria-current='page' href='#'>Trang chủ</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='book.php'>Sách</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' aria-disabled='true' href='profile.php'>Cá nhân</a>
                </li>
                <?php if(isset($_SESSION['permission']) && $_SESSION['permission'] == 1): ?>
                  <li class='nav-item'>
                      <a class='nav-link' aria-disabled='true' href='member.php'>Thành viên</a>
                  </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php
echo $_SESSION['id'];
echo $_SESSION['permission'];
$special_products = [
  [
      'name' => 'Những người khốn khổ',
      'image' => 'images/product1.png',
      'description' => 'Những người khốn khổ" kể về cuộc đấu tranh của những người bị áp bức trong xã hội Pháp thế kỷ 19, tập trung vào chủ đề công lý, hy vọng và sự chuộc tội.',
      'price' => '150,000 VND',
  ],
  [
      'name' => 'Những vụ án của Sherlock Holmes',
      'image' => 'images/product2.png',
      'description' => 'Những vụ án ly kì hấp dẫn sẽ được giải mã.',
      'price' => '200,000 VND',
  ],
  [
    'name' => 'Đắc nhân tâm',
    'image' => 'images/product3.png',
    'description' => 'Đối nhân xử thế.',
    'price' => '150,000 VND',
  ]
];

$best_sellers = [
  [
      'name' => 'Mùa hè không tên',
      'image' => 'images/product4.png',
      'description' => 'Mô tả ngắn gọn về Sách Bán Chạy 1.',
      'price' => '120,000 VND',
  ],
  [
      'name' => 'Hai số phận',
      'image' => 'images/product5.png',
      'description' => 'Mô tả ngắn gọn.',
      'price' => '130,000 VND',
  ],
  [
      'name' => '7 thói quen hiệu quả',
      'image' => 'images/product6.png',
      'description' => 'Mô tả ngắn về Sách Bán Chạy 3.',
      'price' => '140,000 VND',
  ],
];
?>

<nav class='navbar navbar-expand-lg border-bottom position-sticky top-0 shadow p-3 mb-5 bg-body-tertiary rounded'>
    <div class='container-fluid'>
        <div class='rating'> 
            Đánh giá: 4.5/5
            <i class='fas fa-star text-warning'></i>
            <i class='fas fa-star text-warning'></i>
            <i class='fas fa-star text-warning'></i>
            <i class='fas fa-star text-warning'></i>
            <i class='fas fa-star-half-alt text-warning'></i>
        </div>
    </div>
</nav>
<div class='container my-4'>
    <h2 class='text-center'>Sản phẩm Đặc biệt</h2>
    <div class='row'>
        <?php foreach ($special_products as $product): ?>
            <div class='col-md-6 col-lg-4'>
                <div class='card mb-4'>
                    <img src='<?php echo $product["image"]; ?>' class='card-img-top product-image object-fit' alt='<?php echo $product["name"]; ?>'>
                    <div class='card-body'>
                        <h5 class='card-title'><?php echo $product["name"]; ?></h5>
                        <p class='card-text'><?php echo $product["description"]; ?></p>
                        <p class='text-primary'><?php echo $product["price"]; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class='container my-4'>
    <h2 class='text-center'>Mặt hàng Bán chạy</h2>
    <div class='row'>
        <?php foreach ($best_sellers as $product): ?>
            <div class='col-md-6 col-lg-4'>
                <div class='card mb-4'>
                    <img src='<?php echo $product["image"]; ?>' class='card-img-top product-image object-fit' alt='<?php echo $product["name"]; ?>'>
                    <div class='card-body'>
                        <h5 class='card-title'><?php echo $product["name"]; ?></h5>
                        <p class='card-text'><?php echo $product["description"]; ?></p>
                        <p class='text-primary'><?php echo $product["price"]; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
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
