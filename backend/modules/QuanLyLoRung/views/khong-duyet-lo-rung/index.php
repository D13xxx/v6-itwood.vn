<?php
/* @var $this yii\web\View */
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

$plugin=[
    "advlist autolink lists charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime table contextmenu paste"
];
$toolbar="undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ";
?>

<?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'],
]); ?>

<?= $form->field($model, 'ly_do')->widget(\dosamigos\tinymce\TinyMce::className(),[
    'options' => ['rows' => 12],
    'language' => 'vi',
    'clientOptions' => [
        //'width'=>'82.90598290598291%',
        'branding'=> false,
        'plugins' => $plugin,
        'toolbar' => $toolbar,
        'file_picker_callback' => alexantr\elfinder\TinyMCE::getFilePickerCallback(['elfinder/tinymce']),
    ]
]) ?>
    <p>
        <?= Html::submitButton(Yii::t('backend','Lưu'), ['class' => 'btn btn-success btn-block']) ?>
    </p>
<?php ActiveForm::end(); ?>