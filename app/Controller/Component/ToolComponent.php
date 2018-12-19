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
}