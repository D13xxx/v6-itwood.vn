<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2/28/2019
 * Time: 5:31 PM
 */

namespace frontend\modules\CheBien\controllers;

use common\models\RegHoSoGoChiTiet;
use common\models\RegHoSoGoGhepTemp;
use frontend\controllers\base\PController;
use Yii;
use yii\web\NotFoundHttpException;

class GhepHoSoGoController extends PController
{

    public function actionIndex()
    {
        $modelHoSoGo = RegHoSoGoChiTiet::find()->leftJoin('reg_ho_so_go_ghep_temp','reg_ho_so_go_ghep_temp.reg_ho_so_go_chi_tiet_id=reg_ho_so_go_chi_tiet.id')->where([
            'and',
            ['reg_ho_so_go_chi_tiet.reg_chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')],
            ['reg_ho_so_go_chi_tiet.loai_chu_the_id'=>Yii::$app->session->get('reg_loai_chu_the_id')],
            ['>','(reg_ho_so_go_chi_tiet.khoi_luong-reg_ho_so_go_chi_tiet.khoi_luong_da_dung)',0],
            ['is','reg_ho_so_go_ghep_temp.reg_ho_so_go_chi_tiet_id',null]
        ])->all();

//        $modelHoSoGhepTemp = RegHoSoGoGhepTemp::find()->where([])

        $modelGoDaGhep = RegHoSoGoGhepTemp::find()->where([
            'and',
            ['reg_chu_the_id'=>Yii::$app->session->get('reg_chu_the_id')],
            ['loai_chu_the_id'=>Yii::$app->session->get('reg_loai_chu_the_id')]
        ])->all();

        return $this->render('index',[
            'model'=>$modelHoSoGo,
            'modelTemp'=>$modelGoDaGhep,
        ]);
    }

    public function actionChonLoGo()
    {
        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();

            if($data['chon']==1){
                $hoSoGoChon = RegHoSoGoChiTiet::find()->where(['id'=>$data['id']])->one();
                $dataHoSoGo = $hoSoGoChon->attributes;
                $hoSoGoTemp = new RegHoSoGoGhepTemp();
                $hoSoGoTemp->setAttributes($dataHoSoGo);
                $hoSoGoTemp->khoi_luong = $hoSoGoChon->khoi_luong-$hoSoGoChon->khoi_luong_da_dung;
                $hoSoGoTemp->khoi_luong_da_dung=0;
                $hoSoGoTemp->reg_ho_so_go_chi_tiet_id = $hoSoGoChon->id;
                $hoSoGoTemp->save();
            }
        }
    }

    public function actionBoLoGo()
    {
        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();

            if($data['chon']==0){
                $model = $this->findHoSoGoGhepTemp($data['id']);
                $model->delete();
            }
        }
    }

    protected function findHoSoGoGhepTemp($id)
    {
        if(($model=RegHoSoGoGhepTemp::findOne($id))!==null){
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend','Không tìm thấy lô gỗ này'));
    }
}