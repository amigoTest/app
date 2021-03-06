<?php
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title = $this->title.' - '.Yii::$app->params['appName'];
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin(
        [
            'brandLabel' => Yii::$app->params['appName'],
            'brandUrl'   => Yii::$app->homeUrl,
            'options'    => [
                'class' => 'navbar navbar-default navbar-fixed-top',
            ],
        ]
    );
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->hasModule('user')) {
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
        } else {
            $menuItems[] = [
                'label'       => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url'         => ['/user/security/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
    }
    echo Nav::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items'   => $menuItems,
        ]
    );
    NavBar::end();
    ?>

    <div class="container">
        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Html::a('Powered by Phundament', 'http://phundament.com') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
