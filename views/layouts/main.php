<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$color = '#E8DCC4';
$text_color = '#4a4a4a';
if(getenv('environment') != 'prod') {
  $color = '#4CAF50';
  $text_color = 'white';
}

$left_menu = [];
$right_menu = [];

if(Yii::$app->user->isGuest) {
  $right_menu[] = ['label' => '<i class="bi bi-person"></i> Login', 'url' => ['/site/login']];
} else {
  $left_menu[] = ['label' => '<i class="bi bi-inboxes"></i> Lotes', 'url' => ['/batch/index']];
  $right_menu[] = ['label' => "<i class='bi bi-person'></i> Mi cuenta (".Yii::$app->user->identity->name.")", 'url' => ['/user/me']];
  $right_menu[] = '<li class="nav-item" style="color: ' . $text_color . ';">'
    . Html::beginForm(['/site/logout'])
    . Html::submitButton(
        '<i class="bi bi-door-closed"></i> Logout',
        ['class' => 'nav-link btn btn-link logout']
    )
    . Html::endForm()
    . '</li>';
}


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
<style>
      :root {
        --bs-primary:   #4CAF50;
        --bs-secondary: #A9B1B7;
        --bs-success:   #55C752;
        --bs-warning:   #F4C542;
        --bs-danger:    #D86A38;
        --bs-info:      #5AA7C8;
      }

      .my-navbar {
        background-color: <?= $color ?>;
        color: <?= $text_color ?>;
      }
    </style>
    <!-- DEBUG LAYOUT: main.php PROD -->
    <?php if (YII_DEBUG): ?>
      <title>DEBUG - <?= Html::encode($this->title) ?></title>
    <?php else: ?>
      <title><?= Html::encode($this->title) ?></title>
    <?php endif; ?>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => ['class' => 'navbar-brand'],
        'options' => [
            'class' => 'navbar-expand-md fixed-top my-navbar',
        ]
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto'],
        'encodeLabels' => false,
        'items' => 
          $left_menu
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'encodeLabels' => false,
        'items' => $right_menu
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::$app->poweredBy() ?></div>
        </div>
    </div>
</footer>

<?php
// DEBUG: pon esto justo antes de $this->endBody()
echo '<!-- enableJavaScript: ' . ((Yii::$app->view->enableJavaScript ?? false) ? 'true' : 'false') . " -->\n";
echo '<!-- jsFiles: ' . count($this->jsFiles) . ' | js[POS_END]: ' . count($this->js[\yii\web\View::POS_END] ?? []) . " -->\n";
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
