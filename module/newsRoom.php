<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$action = $_GET['action'];

	//kết nối đến CSDL
	include('./controller/connectToDatabase.php');

	//Câu lệnh sql lấy tất cả các phòng thỏa mãn điều kiện của action
	$sql_select_all_action = 'SELECT gia_phong_tro.IDPhongTro, gia_phong_tro.KieuVeSinh, gia_phong_tro.TieuDe, gia_phong_tro.DienTich, gia_phong_tro.GiaChoThue, gia_phong_tro.ThoiGianDang AS ThoiGian, dia_chi_phong_tro.DiaChi, dia_chi_phong_tro.TenChuTro, dia_chi_phong_tro.Sdt FROM gia_phong_tro, dia_chi_phong_tro WHERE gia_phong_tro.IDPhongTro=dia_chi_phong_tro.IDPhongTro AND gia_phong_tro.KieuPhong="' .$action. '"';

	if(!isset($_GET['sorting_time']) && !isset($_GET['sorting_price'])) {
		$sql_select_all_action = $sql_select_all_action. 'ORDER BY gia_phong_tro.ThoiGianDang DESC';
	}

	if(isset($_GET['sorting_time'])) { //lấy giá trị (nếu có) của phần sắp xếp phòng trọ theo thời gian và thêm vào câu lệnh sql
		if($_GET['sorting_time'] == "Mới nhất") {
			$sql_select_all_action = $sql_select_all_action. 'ORDER BY gia_phong_tro.ThoiGianDang DESC';
		} else if($_GET['sorting_time'] == "Cũ nhất") {
			$sql_select_all_action = $sql_select_all_action. 'ORDER BY gia_phong_tro.ThoiGianDang ASC';
		}
	}
	if(isset($_GET['sorting_price'])) { //Lấy giá trị (nếu có) của phần sắp xếp phòng trọ theo giá và thêm vào câu lệnh sql
		if($_GET['sorting_price'] == "Rẻ nhất") {
			$sql_select_all_action = $sql_select_all_action. 'ORDER BY gia_phong_tro.GiaChoThue ASC';
		} else if($_GET['sorting_price'] == "Đắt nhất") {
			$sql_select_all_action = $sql_select_all_action. 'ORDER BY gia_phong_tro.GiaChoThue DESC';
		}
	}
	$row_of_results = 0;
	if($result_all = mysqli_query($conn, $sql_select_all_action)) {
		$row_of_results = mysqli_num_rows($result_all); //Số lượng căn phòng đã đăng
	}


	$result_per_page = 9; //Số lượng bài đăng của một trang

	$number_of_pages = ceil($row_of_results/$result_per_page); //Số trang hiển thị

	//Kiểm tra nếu trang không có biến page thì là trang số 1
	if(!isset($_GET['page'])) {
		$page = 1;
	} else {
		$page = $_GET['page'];
	}

	//Kết quả đầu tiên trả về của trang
	$this_page_first_result = ($page-1)*$result_per_page;

	//Câu lệnh sql để hiển thị các phòng của mỗi trang
	$sql_select_each_page = $sql_select_all_action. ' LIMIT ' .$this_page_first_result. ',' .$result_per_page;
	$result_each_page = mysqli_query($conn, $sql_select_each_page);

	//Hiển thị các phòng tương ứng
	while($row = mysqli_fetch_assoc($result_each_page)) {
		?>
		<div class="col-xs-12">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
					<a href="ChiTietCanPhong.php?id=<?php echo $row['IDPhongTro']; ?>&type=<?php echo $action; ?>" class="thumbnail">
						<?php
							$sql_select_image = 'SELECT DuongDan FROM hinh_anh_phong_tro WHERE IDPhongTro=' .$row['IDPhongTro']. ' LIMIT 1';
							$result_img = mysqli_query($conn, $sql_select_image);
							if(mysqli_num_rows($result_img) > 0) {
								while ($row_img = mysqli_fetch_assoc($result_img)) {
									echo '<img src="' .$row_img['DuongDan']. '" style="width: 100%; height: 180px;">';
								}
							}
							//nếu phòng không có ảnh thì dùng logo (thêm vào lúc 17h20 ngày 01/05/2019)
							else echo '<img src="uploads/25.jpg" style="width: 100%; height: 100%;">';
						?>
					</a>
				</div>
				<div class="col-lg-9col-md-8 col-sm-8 col-xs-12">
					<div class="row">
						<a href="ChiTietCanPhong.php?id=<?php echo $row['IDPhongTro']; ?>&type=<?php echo $action; ?>" class="col-xs-12 link simple_room_info_line">
							<h3 style="margin-top: 10px;"><?php echo $row['TieuDe']; ?></h3>
						</a>
						<b class="col-xs-12 simple_room_info_line"> 
							<span style="color: green;">Địa chỉ: </span> 
							<span><?php echo $row['DiaChi']; ?></span>
						</b>
						<b class="col-sm-6 col-xs-12 simple_room_info_line">
							<span style="color: green">Diện tích: </span>
							<span><?php echo $row['DienTich']; ?> m<sup>2</sup></span>
						</b>
						<b class="col-sm-6 col-xs-12 simple_room_info_line">
							<span style="color: green;">Vệ sinh: </span>
							<span><?php echo $row['KieuVeSinh']; ?></span>
						</b>
						<b class="col-sm-6 col-xs-12 simple_room_info_line">
							<span style="color: green;">Tên chủ trọ: </span>
							<span><?php echo $row['TenChuTro']; ?></span>
						</b>
						<b class="col-sm-6 col-xs-12 simple_room_info_line">
							<span style="color: green;">Sđt liên hệ: </span>
							<span><?php echo $row['Sdt']; ?></span>
						</b>
						<b class="col-xs-12 simple_room_info_line">
							<span style="color: green;">Giá: </span>
							<span><?php echo $row['GiaChoThue']; ?> đồng/tháng</span>
						</b>
						
					</div>
				</div>
			</div>
		</div> <!-- Hết 1 bài đăng -->
		<?php
	}
	//Phần pagination hiển thị số lượng trang
	$pre_page = $page;//biến kiểm tra xem nút previous có thể click được không, nếu click được thì chuyển trang

	$next_page = $page; //biến kiểm tra xem nút next có thể click được k nếu click được thì chuyển trang

	echo '<div class="col-xs-12">
	<ul class="pagination pull-right">';
	if($page>1) {
		$pre_page = $page - 1;
		echo '<li><a style="margin: 0px 3px;" type="button" class="btn btn-default" href="LoaiPhong.php?action=' .$action;
		if(isset($_GET['sorting_time'])) {
			echo '&sorting_time=' .$_GET['sorting_time'];
		} else if(isset($_GET['sorting_price'])) {
			echo '&sorting_price=' .$_GET['sorting_price'];
		}
		echo '&page=' .$pre_page. '"><</a></li>';
	} else {
		echo '<li class="disabled"> <span><</span> </li>';
	}

	for($pos_page=1; $pos_page<=$number_of_pages; $pos_page++) {
		if($pos_page == $page) {
			echo '<li class="active"><span>' .$pos_page. '</span></li>';
		} else {
			echo '<li><a style="margin: 0px 3px;" type="button" class="btn btn-default" href="LoaiPhong.php?action=' .$action;
			if(isset($_GET['sorting_time'])) {
				echo '&sorting_time=' .$_GET['sorting_time'];
			} else if(isset($_GET['sorting_price'])) {
				echo '&sorting_price=' .$_GET['sorting_price'];
			}
			echo '&page=' .$pos_page. '">' .$pos_page. '</a></li>';
		}

	}

	if($page<$number_of_pages) {
		$next_page = $page + 1;
		echo '<li><a style="margin: 0px 3px;" type="button" class="btn btn-default" href="LoaiPhong.php?action=' .$action;
		if(isset($_GET['sorting_time'])) {
			echo '&sorting_time=' .$_GET['sorting_time'];
		} else if(isset($_GET['sorting_price'])) {
			echo '&sorting_price=' .$_GET['sorting_price'];
		}
		echo '&page=' .$next_page. '">></a></li>';
	} else {
		echo '<li class="disabled"> <span>></span> </li>';
	}
	echo '</ul>
	</div>';

?>
