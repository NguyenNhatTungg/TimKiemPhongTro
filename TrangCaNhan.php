<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title id="title_room_page">Trang cá nhân</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <script type="text/javascript" src="vendor/bootstrap.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<link rel="stylesheet" href="vendor/bootstrap.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/CSS.css">
	<style type="text/css">
		button {
			margin: 0px 10px;
		}
	</style>

</head>
<body>
	<!-- Khung đăng ký, đăng nhập -->
	<?php 
		include('module/LogInAndSignIn.php');
	?>

	<!-- Menu hiển thị ra khi scroll màn hình -->
	<?php
		include('module/menuScroll.php');
	?>

	<!-- Header -->
	<?php
		include('module/header.php');
	?>

	<!-- Menu chính -->
	<?php
		include('module/menu.php');
	?>

	<!-- Phần hiển thị đường dẫn các trang -->
	<div class="container">
		<p id="path">
			<a href="index.php" class="link">Trang chủ / </a>
			<a href="TrangCaNhan.php" class="link">Trang cá nhân</a>
		</p>
	</div>

	<!-- Phần thân để hiển thị filter và chi tiết căn phòng -->
	<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" style="padding: 0px;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-5">
					<img src="images/avatar.jpg" class="img-thumbnail">
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-7" style="font-size: 23px; margin: 10px 0px; color: #9a9999;">
					<?php
						if(isset($_SESSION['user_name'])) {
							echo $_SESSION['user_name'];
						}
					?>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">

				<div class="col-xs-12" style="padding: 0px; font-size: 23px; color: green;">
					Các căn phòng đã đăng
				</div>

				<div class="col-xs-12" style="border: solid 1px #d4d0d0; padding: 10px 0px; margin: 10px 0px; border-radius: 4px; height: 145px;">
					<div class="row">
						<div class="col-md-3 col-xs-4">
							<img src="uploads/6.jpg" style="height: 125px; width: 100%; object-fit: scale-down; margin-left: 10px;">
						</div>
						<div class="col-md-9 col-xs-8">
							<div class="row">
								<div class="col-xs-12" style="font-size: 23px; overflow: hidden; height: 30px;">
									Cho thuê phòng trọ khu vực mỹ đình gfdg fgfgfg fg fgf gfg fg fgf
								</div>
								<div class="col-xs-12" style="overflow: hidden; height: 60px;">
									Phòng trọ kiể mới chung cư mini đầy đủ tiện nghi trang trí đẹp trang nhã có tủ đồ bàn ghế như nhà dân nhưng đéo muốn cho thuê fg fgfg fg fgfg f gfg fggfgfgrgrgjf gfdgo fdghjfdhg fhgjhfd gkhfdg fhgkjfd gjfdhgkfdkg fdhgk hfdjgh fdhgkjfd hgkhfdg hfdjg kfdhgkdfhgk
								</div>
								<div class="col-xs-12">
									<button class="btn btn-default btn-sm pull-right" type="button">Xóa</button>
									<button class="btn btn-default btn-sm pull-right" type="button">Sửa</button>
								</div>
							</div>
						</div>						
					</div>
				</div>

				<div class="col-xs-12" style="border: solid 1px #d4d0d0; padding: 10px 0px; margin: 10px 0px; border-radius: 4px; height: 145px;">
					<div class="row">
						<div class="col-md-3 col-xs-4">
							<img src="uploads/2.jpg" style="height: 125px; width: 100%; object-fit: scale-down; margin-left: 10px;">
						</div>
						<div class="col-md-9 col-xs-8">
							<div class="row">
								<div class="col-xs-12" style="font-size: 23px; overflow: hidden; height: 30px;">
									Cho thuê phòng trọ khu vực mỹ đình gfdg fgfgfg fg fgf gfg fg fgf
								</div>
								<div class="col-xs-12" style="overflow: hidden; height: 60px;">
									Phòng trọ kiể mới chung cư mini đầy đủ tiện nghi trang trí đẹp trang nhã có tủ đồ bàn ghế như nhà dân nhưng đéo muốn cho thuê fg fgfg fg fgfg f gfg fggfgfgrgrgjf gfdgo fdghjfdhg fhgjhfd gkhfdg fhgkjfd gjfdhgkfdkg fdhgk hfdjgh fdhgkjfd hgkhfdg hfdjg kfdhgkdfhgk
								</div>
								<div class="col-xs-12">
									<button class="btn btn-default btn-sm pull-right" type="button">Xóa</button>
									<button class="btn btn-default btn-sm pull-right" type="button">Sửa</button>
								</div>
							</div>
						</div>						
					</div>
				</div>


			</div>
		</div>
	</div>
</div>

<!-- Phần chân trang -->
	<?php
		include('module/footer.php');
	?>

<!-- Nhúng file javascript -->
<script type="text/javascript" src="scripts/JavaScript.js"></script> 

</body>
</html>
