<?php


namespace common\models;;
use yii\db\Query;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use Yii;
//use yii\web\HttpException;

class Dungchung extends \yii\base\Model
{

    const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';

    const Active = 1;
    const NoActive =0;

    public static function convert_number_to_words($number) {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
        0                   => 'không',
        1                   => 'một',
        2                   => 'hai',
        3                   => 'ba',
        4                   => 'bốn',
        5                   => 'năm',
        6                   => 'sáu',
        7                   => 'bảy',
        8                   => 'tám',
        9                   => 'chín',
        10                  => 'mười',
        11                  => 'mười một',
        12                  => 'mười hai',
        13                  => 'mười ba',
        14                  => 'mười bốn',
        15                  => 'mười năm',
        16                  => 'mười sáu',
        17                  => 'mười bảy',
        18                  => 'mười tám',
        19                  => 'mười chín',
        20                  => 'hai mươi',
        30                  => 'ba mươi',
        40                  => 'bốn mươi',
        50                  => 'năm mươi',
        60                  => 'sáu mươi',
        70                  => 'bảy mươi',
        80                  => 'tám mươi',
        90                  => 'chín mươi',
        100                 => 'trăm',
        1000                => 'nghìn',
        1000000             => 'triệu',
        1000000000          => 'tỷ',
        1000000000000       => 'nghìn tỷ',
        1000000000000000    => 'nghìn triệu triệu',
        1000000000000000000 => 'tỷ tỷ'
        );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
        'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
        E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . Dungchung::convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
        if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
    case $number < 21:
        $string = $dictionary[$number];
    break;
    case $number < 100:
        $tens   = ((int) ($number / 10)) * 10;
        $units  = $number % 10;
        $string = $dictionary[$tens];
        if ($units) {
            $string .= $hyphen . $dictionary[$units];
        }
    break;
    case $number < 1000:
        $hundreds  = $number / 100;
        $remainder = $number % 100;
        $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
        if ($remainder) {
            $string .= $conjunction . Dungchung::convert_number_to_words($remainder);
        }
    break;
    default:
        $baseUnit = pow(1000, floor(log($number, 1000)));
        $numBaseUnits = (int) ($number / $baseUnit);
        $remainder = $number % $baseUnit;
        $string = Dungchung::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
        if ($remainder) {
            $string .= $remainder < 100 ? $conjunction : $separator;
            $string .= Dungchung::convert_number_to_words($remainder);
        }
        break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
        return $string;
}


    public static function convert_to_date($dateStr, $type='date', $format = null)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $dateStr)==false;
        $errors = \DateTime::getLastErrors();
//        print_r($errors['warning_count']); print_r($errors);exit();
        if ($errors['warning_count']>0 || $errors['error_count']>0 ) {
            return false;
        } else {
            $dateStr= str_replace('/','-',$dateStr);

            if ($type === 'datetime') {
                $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
            }
            elseif ($type === 'time') {
                $fmt = ($format == null) ? self::TIME_FORMAT : $format;
            }
            else {
                $fmt = ($format == null) ? self::DATE_FORMAT : $format;
            }
            return Yii::$app->formatter->asDate($dateStr, $fmt);
        }

    }
    
    public static function SinhMa($tiento,$bangdulieu)
    {
        if(($tiento!==''||$tiento!==NULL)&&($bangdulieu!==''||$bangdulieu!==NULL))
        {
            $connection = \Yii::$app->db;
            $sql="SELECT max(id)+1 as ids FROM ".$bangdulieu;
            $command=$connection->createCommand($sql);
            $mangdulieu=$command->queryScalar();
            if($mangdulieu==''||$mangdulieu==NULL)
            {
                return $tiento.'00001';
            }
            return $tiento.str_pad($mangdulieu, 5, '0', STR_PAD_LEFT);
        }
    }


    public static function TaoMaSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

}