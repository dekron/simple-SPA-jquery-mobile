<?
require 'utils.php';
$title = $_GET['tarif'];
$id = $_GET['id'];
$keyTarifSearch = array_search($title, array_column($data['tarifs'], 'title'));
$keySearch = array_search($id, array_column($data['tarifs'][$keyTarifSearch]['tarifs'], 'ID'));
$tarif = $data['tarifs'][$keyTarifSearch]['tarifs'][$keySearch];

list($time, $zone) = explode('+', $tarif['new_payday']);
$date = new DateTime();
$timezone = new DateTimeZone('+' . $zone);
$date->setTimestamp($time);
$date->setTimezone($timezone);
print_r($date->format('d.m.y'));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>App tariff</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="jquery.mobile.structure-1.0.1.css"/>
  <link rel="stylesheet" href="jquery.mobile-1.0.1.css"/>
  <link rel="stylesheet" href="custom.css"/>
  <script src="js/jquery-1.7.1.min.js"></script>
  <script src="js/jquery.mobile-1.0.1.min.js"></script>
</head>
<body>
<div data-role="page" data-add-back-btn="true">
  <div data-role="header">
    <h1>Выбор тарифа</h1>
  </div>
  <div data-role="content" class="content-inner">
    <div class="choice-tariff">
      <div class="choice-tariff__item-header">
        <h3>Тариф "<?= $tarif['title'] ?>"</h3>
      </div>
      <div class="choice-tariff__item-body">
        <div class="choice-tariff__item-body-period">
          <div>Период оплаты - <?= $tarif['pay_period'] ?> <?= postfix($tarif['pay_period'], $monthesPostfixes) ?></div>
          <div><?= $tarif['price'] / $tarif['pay_period'] ?> ₽/мес</div>
        </div>
        <div class="choice-tariff__item-body-price">
          <div>разовый платеж - <?= $tarif['price'] ?> ₽</div>
          <div>со счета спишется - <?= $tarif['price'] ?> ₽</div>
        </div>
        <div class="choice-tariff__item-body-start">
          <div>вступит в силу - сегодня</div>
          <div>активно до - <?= $date->format('d.m.y') ?></div>
        </div>
      </div>
      <div class="choice-tariff__item-footer">
        <button>Выбрать</button>
      </div>
    </div><!-- /choice-list -->
  </div>
</div>
</div><!-- /page -->
</body>
</html>