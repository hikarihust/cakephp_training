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

	public function stripUnicode($string){
	   if(!$string) return false;
	   $unicode = array(
		  'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		  'd'=>'đ|Đ',
		  'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		  'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
		  'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		  'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		  'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	   );
	   foreach($unicode as $nonUnicode=>$uni){
	   	$string = preg_replace("/($uni)/",$nonUnicode,$string);
	   } 
	   return $string;
	}

    public function slug($string, $character = '-') {
        $string = $this->stripUnicode($string);
        App::uses('Inflector','Utility');
        $string = Inflector::slug($string,$character);
		return strtolower($string);
    }
}