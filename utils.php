<?php
function curl_get_contents($url,$array = false)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    if(isset($array) && $array){
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array));
    }

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$str = curl_get_contents('http://sknt.ru/job/frontend/data.json');
$data = json_decode($str, true);
function setStyleColor($speed)
{
    if ($speed === 100) {
        return 'blue-speed';
    } elseif ($speed === 200) {
        return 'red-speed';
    }
    return 'brown-speed';
}

$monthesPostfixes = array('месяц', 'месяца', 'месяцев');
function postfix($num, $postfixes)
{
    //Делим число без остатка на 100
    $num = $num % 100;

    //Если больше 19, делим его без остатка ещё раз, уже на 10
    if ($num > 19) {
        $num = $num % 10;
    }

    //В зависимости от того, какие числа остались, возвращаем значения
    switch ($num) {
        case 1:
            return $postfixes[0];

        case 2:
        case 3:
        case 4:
            return $postfixes[1];

        default:
            return $postfixes[2];
    }
}