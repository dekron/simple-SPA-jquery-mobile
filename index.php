<?
require 'utils.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Тарифы</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="jquery.mobile.structure-1.0.1.css"/>
  <link rel="stylesheet" href="jquery.mobile-1.0.1.css"/>
  <link rel="stylesheet" href="custom.css"/>
  <script src="js/jquery-1.7.1.min.js"></script>
  <script src="js/jquery.mobile-1.0.1.min.js"></script>
</head>
<body>
<div data-role="page" id="home">
  <div data-role="content">
    <div class="choice-list">
        <?
        foreach ($data['tarifs'] as $key => $value) {

            $minPrice = null;
            $maxPrice = null;
            $maxMonth = null;
            foreach ($value['tarifs'] as $innerTarif) {
                if (!$minPrice || $minPrice > $innerTarif['price']) {
                    $minPrice = $innerTarif['price'];
                }
                if (!$maxPrice || $maxPrice < $innerTarif['price']) {
                    $maxPrice = $innerTarif['price'];
                    $maxMonth = $innerTarif['pay_period'];
                }
            }
            ?>
          <div class="choice-list__item">
            <div class="choice-list__item-header">
              <h3>Тариф "<?= $value['title'] ?>"</h3>
            </div>
            <a class="choice-list__item-body" href="choose_variant.php?title=<?= $value['title'] ?>"
               data-transition="slide">
              <div class="choice-list__item-body-speed <?= setStyleColor($value['speed']) ?>"><?= $value['speed'] ?>
                Мбит/с
              </div>
              <div class="choice-list__item-body-price"><?= $maxPrice / $maxMonth ?> - <?= $minPrice ?> ₽/мес</div>
                <?
                if (isset($value['free_options'])): ?>
                  <div class="choice-list__item-body-options">
                      <?
                      foreach ($value['free_options'] as $keyOp => $option) {
                          ?>
                        <div class="item-body-option">
                            <?= $option ?>
                        </div>
                          <?
                      }
                      ?>
                  </div>
                <? endif; ?>
              <div class="choice-list__item-arrow"><i class="arrow-right"></i></div>
            </a>
            <div class="choice-list__item-footer">
              <a href="<?= $value['link'] ?>">узнать подробнее на сайте www.sknt.ru</a>
            </div>
          </div>
            <?
        }
        ?>
    </div><!-- /choice-list -->
  </div><!-- /content -->
</div><!-- /page -->
</body>
</html>
