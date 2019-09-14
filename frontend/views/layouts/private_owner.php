<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */
?>
<div class="owner-session">
		<div class="alert alert-info" role="alert">
			<strong>Bạn đang làm việc với vai trò của: </strong>
			<?php
                if(Yii::$app->session->get('reg_chu_the_id')==-1) {
                    echo 'Người quản lý - '.Yii::$app->session->get('reg_chu_the_ten');
                } else {
                    if (Yii::$app->session->get('reg_loai_chu_the_id')==1){
                        echo 'Tổ chức - '.Yii::$app->session->get('reg_chu_the_ten');
                    }
                    if (Yii::$app->session->get('reg_loai_chu_the_id')==2){
                        echo 'Hộ gia đình - '.Yii::$app->session->get('reg_chu_the_ten');
                    }

                }
            ?>

		</div>
</div>
