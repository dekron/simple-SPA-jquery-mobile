<?
require 'utils.php';
$title = $_GET['title'];
$keySearch = array_search($title, array_column($data['tarifs'], 'title'));
$minPrice = null;
foreach ($data['tarifs'][$keySearch]['tarifs'] as $key => $value) {
    if (!$minPrice || $minPrice > $value['price']) {
        $minPrice = $value['price'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Тариф "<?= $data['tarifs'][$keySearch]['title'] ?>"</title>
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
    <h1>Тариф "<?= $data['tarifs'][$keySearch]['title'] ?>"</h1>
  </div>
  <div data-role="content" class="content-inner">
    <div class="choice-list">
        <?
        foreach ($data['tarifs'][$keySearch]['tarifs'] as $key => $value) {
            ?>
          <div class="choice-list__item">
            <div class="choice-list__item-header">
              <h3><?= $value['pay_period'] ?> <?= postfix($value['pay_period'], $monthesPostfixes) ?></h3>
            </div>
            <a class="choice-list__item-body" href="tarif.php?tarif=<?= $data['tarifs'][$keySearch]['title'] ?>&id=<?= $value['ID'] ?>" data-transition="slide">
              <div class="choice-list__item-body-price"><?= $value['price'] / $value['pay_period'] ?> ₽/мес</div>
              <div class="choice-list__item-body-options">
                <div class="item-body-option">
                  Разовый платеж - <?= $value['price'] ?> ₽
                </div>
                  <?
                  if ($minPrice !== $value['price']): ?>
                    <div class="item-body-option">
                      Скидка - <?= $minPrice - $value['price'] / $value['pay_period'] ?> ₽
                    </div>
                  <?endif; ?>
              </div>
              <div class="choice-list__item-arrow"><i class="arrow-right"></i></div>
            </a>
          </div>
            <?
        }
        ?>
    </div><!-- /choice-list -->
  </div>
</div>
</div><!-- /page -->
</body>
</html>