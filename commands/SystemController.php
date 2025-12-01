<?php

namespace app\commands;

use yii\console\ExitCode;
use yii\console\Controller;

class SystemController extends Controller {

  /**
   * An action to run at the end of each deployment
   */
  public function actionInit() {
    return ExitCode::OK;
  }
}
