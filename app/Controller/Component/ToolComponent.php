<?php
/**
 * 
 */
class ToolComponent extends Component{
/**
 * Tính tổng mảng $cart, giá trị của từng item trong cart = $quantity_col * $price_col
 */
	public function array_sum($cart, $quantity_col='quantity', $price_col='price'){
		$total = 0;
		foreach ($cart as $item) {
			$total += $item[$quantity_col]*$item[$price_col];
		}
		return $total;
	}

/**
 * So sánh ngày giờ $date có nằm trong một khoảng thời gian từ $start đến $end hay không
 */
	public function between($date, $start, $end, $timezone = 'Asia/Ho_Chi_Minh'){
		date_default_timezone_set($timezone);
		$date = strtotime($date);
		$start = strtotime($start);
		$end = strtotime($end);
		if($date >= $start && $date <= $end){
			return true;
		}else{
			return false;
		}
	}

/**
 * generate code dùng cho forgot password
 * code sinh ra là 1 chuỗi ngẫu nhiên generate ra ngay lúc đó
 */
	public function generate_code(){
		$random_number = rand(1000000,9999999);
	    $code = md5($random_number);
	    return $code;
	}
}