<?php

namespace frontend\modules\Daskboard\controllers;

use frontend\controllers\base\PController;
use yii\web\Controller;

/**
 * Default controller for the `Modules` module
 */
class DefaultController extends PController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
