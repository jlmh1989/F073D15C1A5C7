<?php

class ClientsController extends Controller
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
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform
				'actions'=>array('index','view','create','update','admin','delete','crearPdf','clientesInactivos'),
                                'expression'=>'(Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR) '
                                             .'|| Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA',
				//'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Clients;
                $modelTECA =new ClassroomAddress();
                $modelTEBD = new BillingData();
                $modelUser = new Users();
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model, $modelTECA);
                
                if(isset($_POST['Clients']))
                {   
                    $model->attributes=$_POST['Clients'];
                    $modelTECA->attributes=$_POST['ClassroomAddress'];
                    $modelUser->attributes=$_POST['Users'];
                    $valUser = $modelUser->validate();
                    $valTECA = $modelTECA->validate();
                    $valM = $model->validate();
                    $validar = $valUser && $valTECA && $valM;
                    if($model->billing_data === "1"){
                        $modelTEBD->attributes=$_POST['BillingData'];
                        $validar = $modelTEBD->validate() && $validar;
                    }
                    
                    if($validar){
                        $modelUser->status=  constantes::ACTIVO;
                        $modelUser->fk_role=(int)constantes::ROL_CLIENTE;
                        $modelUser->password = crypt($modelUser->password, constantes::PATRON_PASS);
                        if($modelUser->save()){
                            $model->status=  constantes::ACTIVO;
                            $model->fk_user=$modelUser->pk_user;
                            $model->image = CUploadedFile::getInstance($model,'client_photo');
                            if($model->image !== null){
                                $rnd = rand(0,999999);
                                $extensionImg = explode(".", $model->image);
                                $filename = $rnd.'.'.$extensionImg[1];
                                $path = realpath(Yii::app()->basePath.'/../images/client_photo');
                                $model->image->saveAs($path . '/' .$filename);
                                $model->client_photo = $filename;
                            }
                            if($model->save()){
                                $modelTECA->fk_client=$model->pk_client;
                                $modelTECA->status=constantes::ACTIVO;
                                if($modelTECA->save()){
                                    if($model->billing_data === "1"){
                                        $modelTEBD->fk_client=$model->pk_client;
                                        $modelTEBD->status=constantes::ACTIVO;
                                        $modelTEBD->save();
                                    }
                                    $this->redirect(array('view','id'=>$model->pk_client));
                                }
                            }
                        }
                    }
                }

                $this->render('create',array(
                    'modelUser'=>$modelUser,
                    'model'=>$model,
                    'modelTECA'=>$modelTECA,
                    'modelTEBD'=>$modelTEBD,
                ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model= $this->loadModel($id);
                $modelTECA= $this->loadModelClassroomAddress($id);
                $modelTEBD= $this->loadModelBillingData($id);
                $modelUser= $this->loadModelUser($model->fk_user);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                if(isset($_POST['Clients']))
                {   
                    $model->attributes=$_POST['Clients'];
                    $modelTECA->attributes=$_POST['ClassroomAddress'];
                    $modelUser->attributes=$_POST['Users'];
                    $valUser = $modelUser->validate();
                    $valTECA = $modelTECA->validate();
                    $valM = $model->validate();
                    $validar = $valUser && $valTECA && $valM;
                    if($model->billing_data === "1"){
                        $modelTEBD->attributes=$_POST['BillingData'];
                        $validar = $modelTEBD->validate() && $validar;
                    }
                    
                    if($validar){
                        if(Users::cambiarPassword($modelUser->pk_user, $modelUser->password)){
                            $modelUser->password = crypt($modelUser->password, constantes::PATRON_PASS);
                        }
                        if($modelUser->save()){
                            $model->image = CUploadedFile::getInstance($model,'client_photo');
                            if($model->image !== null){
                                $rnd = rand(0,999999);
                                $extensionImg = explode(".", $model->image);
                                $filename = $rnd.'.'.$extensionImg[1];
                                $path = realpath(Yii::app()->basePath.'/../images/client_photo');
                                $model->image->saveAs($path . '/' .$filename);
                                $model->client_photo = $filename;
                            }
                            if($model->save()){
                                if($modelTECA->save()){
                                    if($model->billing_data === "1"){
                                        $modelTEBD->save();
                                    }
                                    $this->redirect(array('view','id'=>$model->pk_client));
                                }
                            }
                        }
                    }
                }

		$this->render('update',array(
			'model'=>$model,
                        'modelTECA'=>$modelTECA,
                        'modelTEBD'=>$modelTEBD,
                        'modelUser'=>$modelUser,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
                $model->status = 0;
                $model->save();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('clientesActivos'));
	}

	/**
	 * Lists all models.
         * Se cambio a que la pagina de inicio sea clientesActivos
	 */
	public function actionIndex()
	{
            $model=new Clients('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Clients'])){
                $model->attributes=$_GET['Clients'];
            }
            $this->render('clientesActivos',array(
                    'model'=>$model,
            ));
	}
        
        public function actionClientesInactivos(){
            $model=new Clients('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Clients'])){
                $model->attributes=$_GET['Clients'];
            }
            $this->render('clientesInactivos',array(
                    'model'=>$model,
            ));
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Clients('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Clients']))
			$model->attributes=$_GET['Clients'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionCrearPdf(){
            $dataProvider = $_SESSION['reporte_clientes'];
            $data = $dataProvider->getData();
            $mPDF = Yii::app()->ePdf->mpdf();
            $filas = $dataProvider->getTotalItemCount();
            $tabla = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />
                    <table align="center" class="zebra">
                    <tr>
                    <th colspan="3" align="center" class="zebra_th">LISTADO DE CLIENTES('.$_SESSION['reporte_clientes_tipo'].') '.Yii::app()->getRequest()->getParam("status").'</th>
                    </tr>
                    <tr>
                    <th>Nombre del Cliente</th>
                    <th>Tel&eacute;fono</th>
                    <th>Nombre del Contacto</th>
                    </tr>';
            for ($i = 0; $i < $filas; $i++) {
                $css = 'class="even_"';
                if(($i % 2) === 0){
                    $css = 'class="odd_"';
                }
                $tabla.='<tr '.$css.'>
                        <td>'.$data[$i]["client_name"].'</td>
                        <td>'.$data[$i]["contact_phone"].'</td>
                        <td>'.$data[$i]["contact_name"].'</td>
                        </tr>';
            }
            $tabla.='</table>';
            $mPDF->writeHTML($tabla);
            $mPDF->Output('Reporte Clientes.pdf','I'); //I: Abre en el navegador, D:Forza la descarga
            exit;
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Clients the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Clients::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function loadModelClassroomAddress($pkClient){
            $modelTECA = ClassroomAddress::model()->find('fk_client='.$pkClient);
            if($modelTECA===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $modelTECA;
        }
        
        public function loadModelBillingData($pkClient){
            $modelTEBD = BillingData::model()->find('fk_client='.$pkClient);
            if($modelTEBD===null)
                $modelTEBD = new BillingData ();
            return $modelTEBD;
        }
        
        public function loadModelUser($id){
            $modelUser = Users::model()->findByPk($id);
            if($modelUser===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $modelUser;
        }

	/**
	 * Performs the AJAX validation.
	 * @param Clients $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='clients-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
