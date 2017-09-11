<?php

/**
 * 验证ids
 * 逗号间隔每个id,每个id必须均为数字,不验证是否重复
 *
 * @param $ids
 *
 * @return bool true 验证正确
 *
 */
function checkIds($ids) {
	$arr = explode(',', $ids);
	foreach ($arr as $e) {
		if (!checkIntString($e)) return false;
	}

	return true;
}

/**
 * 验证字符串是否是纯数字构成
 *
 */
function checkIntString($s) {
	$len = strlen($s);

	if ($len <1) return false;
	if (startsWith($s, ",") || endsWith($s, ",")) return false;

	for($i=0;$i<$len; $i++) {
		$snum = substr($s, $i,1);
		$num = (int)$snum;
		if ((string)$num !== $snum) {
			return false;
		}
	}

	return true;
}

/**
 * 判断字符是否开始于某字符串
 *
 * @param $haystack string 原字符串
 * @param $needle string 判断字符串
 * @return bool
 */
function startsWith($haystack, $needle)
{
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}

/**
 * 判断字符是否结束于某字符串
 *
 * @param $haystack string 原字符串
 * @param $needle string 判断字符串
 * @return bool
 */
function endsWith($haystack, $needle)
{
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}

	return (substr($haystack, -$length) === $needle);
}

/**
 * 检测数组元素是否存在重复项,
 * 元素仅仅保证int,string类型,且区分数据类型
 *
 * @param $arr
 *
 * @return bool true 数组存在重复元素
 *
 */
function checkArrayElementRepeat($arr) {
	foreach ($arr as $k=>$v) {
		if (is_string($v)) {
			$arr[$k] = 's' . $v;
		} else {
			$arr[$k] = 'i' . $v;
		}
	}

	$uniqueArr = array_unique($arr);

	if (count($uniqueArr) != count($arr)) {
		return true;
	} else {
		return false;
	}
}

/**
 * 返回字符串包含的特定字符的个数
 * 
 * @param $s
 * @return int
 */
function stringContainsCharsCount($string, $chars)
{
    $count = 0;

    if (!is_string($string)) return $count;

    for ($i=0;$i<strlen($string); $i++) {
        $l = substr($string, $i, 1);
        if (strpos($chars, $l)!==false) $count++;
    }

    return $count;
}

/**
 * 返回字符串包含的字母个数
 * 
 * @param $s
 * @return int
 */
function stringContainsNumbersCount($s) {
    return stringContainsCharsCount($s, "0123456789");
}

/**
 * 返回字符串包含的字母个数
 *
 * @param $s
 * @return int
 */
function stringContainsLetterCount($s)
{
    $chars = "abcdefghijklmnopqrstuvwxyz";
    $chars = $chars . strtoupper($chars);

    return stringContainsCharsCount($s, $chars);
}
