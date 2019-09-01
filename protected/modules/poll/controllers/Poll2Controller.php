<?php

class Poll2Controller extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights'
			/*'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request*/
		);
	}

  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id)
  {
    $model = $this->loadModel($id);

    if (Yii::app()->getModule('poll')->forceVote && $model->userCanVote()) {
      $this->redirect(array('vote', 'id' => $model->id)); 
    }
    else {
      $userVote = $this->loadVote($model);
      $userChoice = $this->loadChoice($model, $userVote->choice_id);

      $this->render('view', array(
        'model' => $model,
        'userVote' => $userVote,
        'userChoice' => $userChoice,
        'userCanCancel' => $model->userCanCancelVote($userVote),
      ));
    }
  }

  /**
   * Vote on a poll.
   * If vote is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to vote on
   */
  public function actionVote($id)
  {
    $model = $this->loadModel($id);
    $vote = new Poll2Vote;

    if (!$model->userCanVote())
      $this->redirect(array('view', 'id' => $model->id));

    if (isset($_POST['Poll2Vote'])) {
      $vote->attributes = $_POST['Poll2Vote'];
      $vote->poll_id = $model->id;
      if ($vote->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    // Convert choices to form options list
    $choices = array();
    foreach ($model->choices as $choice) {
      $choices[$choice->id] = CHtml::encode($choice->label);
    }

    $this->render('vote', array(
      'model' => $model,
      'vote' => $vote,
      'choices' => $choices,
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
    $model = new Poll2;
    $choices = array();
    //$this->performAjaxValidation($model);

    if (isset($_POST['Poll2'])) {
      $model->attributes = $_POST['Poll2'];

      $texts_choice2 = array();
      if (isset($_POST['Poll2Choice'])) {
        foreach ($_POST['Poll2Choice'] as $id => $choice) {
          $texts_choice2[] = array(
            'weight'=> $choice['weight'],
            'label'=> $choice['label'],
            'jumlah_rekayasa'=> $choice['jumlah_rekayasa'],
            );
        }
      }

      // Setup poll choices
      $choices = array();
      if (isset($_POST['Poll2Choice']) AND count($_FILES['Poll2Choice']['name']) > 0) {
        foreach ($_FILES['Poll2Choice']['name'] as $key => $choice) {
          $pollChoice = new Poll2Choice;
          $image = CUploadedFile::getInstance($pollChoice,'['.$key.']image');
          if ($image->name != '') {
            $pollChoice->label = $texts_choice2[$key]['label'];
            $pollChoice->weight = $texts_choice2[$key]['weight'];
            $pollChoice->jumlah_rekayasa = $texts_choice2[$key]['jumlah_rekayasa'];
            $pollChoice->image = substr(md5(time()),0,5).'-'.rand(100, 2500).'-'.$image->name;
            $image->saveAs(Yii::getPathOfAlias('webroot').'/images/uploads/polling/'.$pollChoice->image);
            $choices[] = $pollChoice;
          }
        }
      }

      if ($model->save()) {
        // Save any poll choices too
        foreach ($choices as $choice) {
          $choice->poll_id = $model->id;
          $choice->save();
        }

        $this->redirect(array('index'));
      }
    }

    $this->render('create', array(
      'model' => $model,
      'choices' => $choices,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id)
  {
    $model = $this->loadModel($id);
    $choices = $model->choices;
    //$this->performAjaxValidation($model);

    if (isset($_POST['Poll2'])) {
      $model->attributes = $_POST['Poll2'];

      $texts_choice2 = array();
      $texts_choice3 = array();

      if (isset($_POST['Poll2Choice'])) {
        if (isset($_FILES['Poll2Choice']['name']) != '' AND count($_FILES['Poll2Choice']['name']) > 0) {
          foreach ($_POST['Poll2Choice'] as $id => $choice) {
                $texts_choice2[] = array(
                  'weight'=> $choice['weight'],
                  'label'=> $choice['label'],
                  'jumlah_rekayasa'=> $choice['jumlah_rekayasa'],
                  );
          }
        }

        if (count($_POST['Poll2Choiceimg2']) > 0) {
          foreach ($_POST['Poll2Choice'] as $id => $choice) {
           $texts_choice3[$id] = array(
              'weight'=> $choice['weight'],
              'label'=> $choice['label'],
              'jumlah_rekayasa'=> $choice['jumlah_rekayasa'],
              );
          }
        }
      }


      // jika find ada data, maka update, jika find tidak ada data maka insert data baru
      if ( count($texts_choice3) > 0 OR count($texts_choice2) > 0) {

          // change key array to number
          $arrays_tn = array();
          foreach ($_POST['Poll2Choice'] as $ids => $choice) {
            $modelImage = Poll2Choice::model()->find('id = :id', array(':id'=> $ids ));
            if ( $modelImage){ 
              // update data lama
                $modelImage->poll_id = $model->id;
                $modelImage->label = $choice['label'];
                $modelImage->weight = $choice['weight'];
                $modelImage->jumlah_rekayasa = $choice['jumlah_rekayasa'];
                $modelImage->save(false);
            }else{
              $arrays_tn[] = array(
                  'label'=> $choice['label'],
                  'weight'=> $choice['weight'],
                  'jumlah_rekayasa'=> $choice['jumlah_rekayasa'],
                );
            }
          } 

          // input data baru 
          if ( isset($_FILES['Poll2Choice']) AND count($_FILES['Poll2Choice']['name']) > 0) { 
            // echo "<pre>"; print_r($_FILES['Poll2Choice']['name']); exit;
            foreach ($_FILES['Poll2Choice']['name'] as $key => $choicess):
                $pollChoice = new Poll2Choice;
                $image = CUploadedFile::getInstance($pollChoice,'['.$key.']image');
                if ($image->name != '') {
                  $pollChoice->poll_id = $model->id;   
                  $pollChoice->label = $arrays_tn[$key]['label'];
                  $pollChoice->weight = $arrays_tn[$key]['weight'];
                  $pollChoice->jumlah_rekayasa = $arrays_tn[$key]['jumlah_rekayasa'];
                  $pollChoice->image = substr(md5(time()),0,5).'-'.rand(100, 2500).'-'.$image->name;
                  $image->saveAs(Yii::getPathOfAlias('webroot').'/images/uploads/polling/'.$pollChoice->image);
                  $pollChoice->save(false);
                }
              endforeach;
          }
          // end input baru
      }

      if ($model->save(false)) {
        $this->redirect(array('index'));
      }
    }
    
    $this->render('update',array(
      'model'=>$model,
      'choices'=>$choices,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id)
  {
    if(Yii::app()->request->isPostRequest)
    {
      // we only allow deletion via POST request
      $mParent = $this->loadModel($id);
      Poll2Choice::model()->deleteAll('poll_id = :id', array(':id'=>$mParent->id));
      $mParent->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if(!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }
    else
		throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
  }

  /**
   * Lists all models.
   */
  public function actionIndex()
  {
    // echo "asdfjdsfklsdjf"; exit;
    $model=new Poll2('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Poll2']))
      $model->attributes=$_GET['Poll2'];
    
    $this->render('index',array(
      'model'=>$model,
    ));
  }

  /**
   * Export the results of a Poll.
   *
  public function actionExport($id)
  {
    $model = $this->loadModel($id);
    $exportForm = new PollExportForm($model);
    $cform = $exportForm->cform();

    if ($cform->submitted('submit') && $cform->validate()) {
      $exportForm->export(); 
    }

    $this->render('export', array(
      'model' => $model,
      'exportForm' => $exportForm, 
      'cform' => $cform,
    ));
  }*/

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id)
  {
    $model=Poll2::model()->with('choices','votes')->findByPk($id);
    if($model===null)
		throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
    return $model;
  }

  /**
   * Returns the PollChoice model based on primary key or a new PollChoice instance.
   * @param Poll the Poll model 
   * @param integer the ID of the PollChoice to be loaded
   */
  public function loadChoice($poll, $choice_id)
  {
    if ($choice_id) {
      foreach ($poll->choices as $choice) {
        if ($choice->id == $choice_id) return $choice;
      }
    }

    return new Poll2Choice;
  }

  /**
   * Returns the PollVote model based on primary key or a new PollVote instance.
   * @param object the Poll model 
   */
  public function loadVote($model)
  {
    $userId = (int) Yii::app()->user->id;
    $isGuest = Yii::app()->user->isGuest;

    foreach ($model->votes as $vote) {
      if ($vote->user_id == $userId) {
        if (Yii::app()->getModule('poll')->ipRestrict && $isGuest && $vote->ip_address != $_SERVER['REMOTE_ADDR'])
          continue;
        else
          return $vote;
      }
    }

    return new Poll2Vote;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model)
  {
    if(isset($_POST['ajax']) && $_POST['ajax']==='poll-form')
    {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}
