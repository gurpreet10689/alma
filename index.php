<?php $host = 'localhost'; $user = 'root'; $pass = ''; $dbname = 'alumni_data'; 
$conn = new mysqli($host, $user, $pass, $dbname); 
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error); 
// Get search inputs 
$course = $_POST['course'] ?? ''; 
$batch = $_POST['batch'] ?? ''; 
// Build SQL 
$courseList = $conn->query("SELECT DISTINCT course FROM alumni ORDER BY course"); 
$batchList = $conn->query("SELECT DISTINCT batch FROM alumni ORDER BY batch"); 
$sql = "SELECT name, course, batch, role, company, image FROM alumni WHERE 1=1"; 
if (!empty($course)) 
{ $course = $conn->real_escape_string($course); 
$sql .= " AND course LIKE '%$course%'"; } 
if (!empty($batch)) 
{ $batch = $conn->real_escape_string($batch); 
$sql .= " AND batch LIKE '%$batch%'"; } 
$result = $conn->query($sql); ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link  rel="stylesheet" href="mycss.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<style>
.top-header {
    background-color: #e53935; /* red */
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 20px;
    font-size: 14px;
    height: 40px;
}

.left-section span {
    margin-right: 20px;
}

.right-section a {
    background-color: white;
    color: black;
    width: 30px;
    height: 30px;
    margin-left: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    text-decoration: none;
    font-size: 14px;
}
.rgb-glitter-text {
  font-size: 3rem;
  font-weight: bold;
  font-family: 'Orbitron', sans-serif;
  background: linear-gradient(
    90deg,
    red,
    green,
    blue,
    red
  );
  background-size: 300% auto;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: rgbGlitter 3s linear infinite;
  text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
}

@keyframes rgbGlitter {
  0% {
    background-position: 0% center;
  }
  50% {
    background-position: 100% center;
  }
  100% {
    background-position: 0% center;
  }
}


</style>
<body>
<div class="top-header">
    <div class="left-section">
        <span><i class="fas fa-phone"></i> +91-172-226-4566</span>
        <span><i class="fas fa-envelope"></i> gjimt@gjimt.com</span>
    </div>
    <div class="right-section">
        <a target="_blank" href="https://www.facebook.com/GJIMTMOHALICAMPUS/"><i class="fab fa-facebook-f"></i></a>
        <a target="_blank" href="https://x.com/i/flow/login?redirect_after_login=%2FGJIMTMohali"><i class="fab fa-twitter"></i></a>
        <a target="_blank" href="https://www.instagram.com/gjimt_mohali/"><i class="fab fa-instagram"></i></a>
        <a target="_blank" href="https://www.youtube.com/channel/UCjFQ5RFhOF3MdM8e5nc_OdA/videos?view_as=subscriber"><i class="fab fa-youtube"></i></a>
        <a target="_blank" href="https://www.linkedin.com/in/gjimt-mohali/"><i class="fab fa-linkedin-in"></i></a>
    </div>
</div>
<div class="main-header">
    <div class="logo">
        <img src="logo.png" alt="Gian Jyoti Logo" height="60">
    </div>
    <nav class="navigation">
        <!-- Search Form --> 
<form method="POST" action="" style="text-align:center; margin: 20px;"> 
<select name="course" class="styled-select"> <option value="">-- Select Course --</option> 
<?php while($row = $courseList->fetch_assoc()): ?> <option value="<?= (@$row['course']) ?>" > <?= $row['course'] ?> </option> 
<?php endwhile; ?> </select> 
<select name="batch" class="styled-select" >
    <option value="">-- Select Batch --</option>
    <?php while($row = $batchList->fetch_assoc()): ?>
        <option value="<?= (@$row['batch']) ?>" >
            <?= $row['batch'] ?>
        </option>
    <?php endwhile; ?>
</select>

<button type="submit" class="search-button" name="search">Search</button>
</form>
        
    </nav>
    
</div>

 

<h1 class="rgb-glitter-text">Alumni Wall of Fame</h1>

<!-- Swiper Slider (Only Rendered Once) --> 
<?php if ($result && $result->num_rows > 0): ?> 
<div class="swiper alumni-slider"> 
<div class="swiper-wrapper"> 
<?php while($row = $result->fetch_assoc()): ?> 
<div class="swiper-slide"> 
<img class="img_sty" src="images/<?= $row['image']; ?>" alt=""> 
<h3><?= $row['name']; ?></h3> 
<h4><?= $row['course']; ?> </h4>
<p><?= $row['batch']; ?></p> 
<p><?= $row['role']; ?></p> 
<p><?= $row['company']; ?></p> </div> 
<?php endwhile; ?> 
</div> 

<div class="swiper-button-prev"></div> 
<div class="swiper-button-next"></div> 

</div> 
<?php else: ?> <p style="text-align:center;">No results found.</p> 
<?php endif; ?> 
<script> var swiper = new Swiper(".alumni-slider", { slidesPerView: 3, spaceBetween: 30, loop: true, autoplay: { delay: 2000, disableOnInteraction: false, }, navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev", }, }); </script>

</body>
</html>