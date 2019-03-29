<?php

/* @var $this yii\web\View */
use yii\bootstrap\Button;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
$this->title = '图书管理系统';
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <?php
                    Modal::begin([
                        'header' => '<h4>新增</h4>',
                        'toggleButton' => [
                            'label' => Html::icon('plus') . Html::encode('新增'),
                            'encodeLabel' => false,
                            'class' => 'btn btn-primary',
                            'data-pajax'=>0
                        ],
                    ]);
                ?>
                    <?php $form = ActiveForm::begin([
                        'action' => Url::to(['library/index']),
                        'method'=>'post'
                        ])
                    ?>
                        <?= $form->field($model,'name')->label("书名")?>
                        <?= $form->field($model,'author')->label("作者")?>
                        <?= $form->field($model,'description')->label("描述")?>
                        <div class="form-group">
                            <?= Html::submitButton('Submit',['class' => 'btn btn-primary'])?>
                        </div>
                    <?php ActiveForm::end();?>
                <?php Modal::end();  ?>
            </div>
         
        </div>
        <div class="row">
            <?php
                Pjax::begin(); 
                echo GridView::widget([
                    'dataProvider' => $dataProvieder,
                    'columns'=>[
                        ['attribute' => 'id','label'=>'ID'],
                        ['attribute' => 'name','label'=>'名字'],
                        ['attribute' => 'author','label'=>'作者'],
                        ['attribute' => 'description','label'=>'描述'],
                        ['attribute' => 'create_time','label'=>'创建日期'],
                        [
                            'class' => ActionColumn::className(),
                            'header'=>'操作',
                            'template' => '{update} {delete}',
                            'buttons'=>[
                                'updates' => function ($url,$model,$key){
                                    
                                    return Html::a('', $url, [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#update-modal',
                                        'class' => 'data-update glyphicon glyphicon-edit',
                                        'data-id' => $key,
                                    ]);
                                },
                                'del' => function ($url,$model,$key){

                                }
                            ]
                        ],
                    ]
                ]);
                Pjax::end();
            ?>
        </div>
    </div>

    <!-- 更新添加modal -->
    <?php
        Modal::begin([
            'id' => 'update-modal',
            'header' => '<h4 class="modal-title">更新</h4>',
        ]); ?>

     <?php Modal::end(); ?>   
    
</div>
