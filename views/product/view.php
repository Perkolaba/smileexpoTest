<?php

use app\models\Comment;
use app\models\Review;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $model_review app\models\Review */
$product_id = $model->id;
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_name',
            'description',
            [
                'attribute' => 'image',
                'format' => ['image', ['width' => '150', 'height' => '150']],
                'value' => function ($model) {
                    return $model->getImageUrl();
                },
            ],
            'price',
            'category.title',
        ],
    ]) ?>

    <?php if (!empty($model->reviews)): ?>
        <div class="container">
            <div class="row">
                <h2>Reviews:</h2>
            </div>
            <?php foreach ($model->reviews as $review): ?>
                <div class="row" style="padding-bottom: 15px">
                    <div class="col-xs-12 col-md-8"><b>Date:</b> <?= $review->date ?></div>
                    <div class="col-xs-12 col-md-8"><b>Username:</b> <?= $review->username ?></div>
                    <div class="col-xs-12 col-md-8"><b>Review:</b> <?= $review->comment_text ?></div>
                    <?php if ($review->user_id == Yii::$app->user->id) : ?>
                        <div class="col-xs-12 col-md-8"><?= Html::a('Update', ['/review/update', 'id' => $review->id], ['class' => 'btn btn-warning']) ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php  echo Yii::$app->user->isGuest ? '' : $this->render('_form_review', ['product_id' => $model->id, 'model' => $model_review]); ?>

</div>

