<?php

class CoursesController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete',
                                    'crearPdf','domicilioCliente','inactivos','mapa','datosMapa',
                                    'agregarHorario','eliminarHorario','getHorarioHtml',
                                    'createHorario','createDatos','asignarMaestro','asignarDireccion',
                                    'getDomicilioHtml','getDomicilioJson','guardarDireccion','getCursosHtml',
                                    'cancelarDireccion','guardarCursoBD','validarHorario','editarDireccion',
                                    'asignarMaterial','test'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR'
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
            unset($_SESSION['curso']);
            unset($_SESSION['horarioCurso']);
            $_SESSION['curso']['curso']['operacion'] = 'insert';
            $this->actionCreateDatos();
	}
        
        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                unset($_SESSION['curso']);
                unset($_SESSION['horarioCurso']);
		$modelC=$this->loadModel($id);
                $this->getHorarioBD($id);
                $model = new CursoDatos;
                $model->desc_curse = $modelC->desc_curse;
                $model->fk_client = $modelC->fk_client;
                $model->fk_group = $modelC->fk_group;
                $model->fk_level = $modelC->fk_level;
                $model->fk_type_course = $modelC->fk_type_course;
                $model->initial_date = $modelC->initial_date;
                $model->other_level = $modelC->other_level;
                $_SESSION['curso']['curso']['pk_course'] = $modelC->pk_course;
                $_SESSION['curso']['curso']['fk_client_orig'] = $modelC->fkClient;
                $_SESSION['curso']['curso']['fk_type_orig'] = $modelC->fk_type_course;
                $_SESSION['curso']['curso']['operacion'] = 'update';
                $_SESSION['curso']['datos'] = $model->attributes;
                $modelLM = LoanMaterial::model()->find("fk_course=?", array($id));
                if($modelLM != NULL){
                    $_SESSION['curso']['LoanMaterial'] = $modelLM->attributes;
                    $_SESSION['curso']['Material']['fk_material_detail_ant'] = $_SESSION['curso']['LoanMaterial']['fk_material_detail'];
                }
                $_SESSION['curso']['maestro']['fk_teacher'] = $modelC->fk_teacher;
                $_SESSION['curso']['direccion'] = ClassroomAddress::model()->findByPk($modelC->fk_classrom_address);
                $this->actionCreateDatos();
	}
        
        public function actionCreateDatos(){
            $model=new CursoDatos;
            if(isset($_SESSION['curso']['datos'])){
                $model->attributes=$_SESSION['curso']['datos'];
            }
            
            if(isset($_POST['CursoDatos']))
            {
                $model->attributes=$_POST['CursoDatos'];
                if($model->validate()){
                    $_SESSION['curso']['datos'] = $_POST['CursoDatos'];
                    $this->actionCreateHorario();
                }else{
                    $this->render('createDatos',array(
                    'model'=>$model,
                ));
                }
            }else{
                $this->render('createDatos',array(
                    'model'=>$model,
                ));
            }
        }
        
        public function actionCreateHorario(){                    
            if(isset($_POST['bssDay']))
            {
                $this->actionAsignarMaestro();
            }else{
                $this->render('createHorario');
            }
        }
        
        public function actionAsignarMaestro(){
            $model=new CursoMaestro;
            $horarioMsj = '';
            foreach ($_SESSION['horarioCurso'] as $key => $value) {
                if(!is_array($value)){
                    continue;
                }
                foreach ($value as $horas) {
                    $horarioMsj .= $key . '-' . $horas['inicio'] . '-' . $horas['fin'] . ',';
                }
            }
            $_SESSION['horarioCurso']['horarioMsjStp'] = substr($horarioMsj, 0, -1);
            if(isset($_SESSION['curso']['maestro'])){
                $model->attributes=$_SESSION['curso']['maestro'];
            }
            if(isset($_POST['CursoMaestro']))
            {
                $model->attributes=$_POST['CursoMaestro'];
                if($model->validate()){
                    $_SESSION['curso']['maestro'] = $_POST['CursoMaestro'];
                    $_SESSION['curso']['nuevo'] = 0;
                    if(!isset($_SESSION['curso']['direccion'])){
                        $_SESSION['curso']['direccion'] = ClassroomAddress::model()->getClassroomAddress($_SESSION['curso']['datos']['fk_client'], constantes::ACTIVO, false);
                    }
                    $this->actionAsignarMaterial();
                }else{
                    $this->render('createMaestro',array(
                    'model'=>$model,
                ));
                }    
            }else{
                $this->render('createMaestro',array(
                        'model'=>$model,
                ));
            }
        }
        
        public function actionAsignarMaterial(){
            $model = new LoanMaterial;
            $model->fk_teacher = $_SESSION['curso']['maestro']['fk_teacher'];
            if(isset($_SESSION['curso']['LoanMaterial'])){
                $model->attributes=$_SESSION['curso']['LoanMaterial'];
                if(isset($_SESSION['curso']['LoanMaterial']['pk_loan_material']) && $_SESSION['curso']['LoanMaterial']['pk_loan_material'] != ''){
                    $model->pk_loan_material = $_SESSION['curso']['LoanMaterial']['pk_loan_material'];
                }
            }
            if(isset($_POST['LoanMaterial'])){
                $model->attributes=$_POST['LoanMaterial'];
                if($model->validate()){
                    $_SESSION['curso']['LoanMaterial'] = $_POST['LoanMaterial'];
                    $_SESSION['curso']['Material']['fk_material_detail_ant'] = $model->fk_material_detail;
                    $this->actionAsignarDireccion();
                }else{
                    $this->render('createMaterial',array(
                    'model'=>$model,
                    ));
                }
            }else{
                $this->render('createMaterial', array('model'=>$model));
            }
        }
        
        public function actionTest(){
            echo '<pre>';
            print_r(CatMaterialDetail::model()->getListMaterialDetail(3, 1));
            echo '</pre>';
        }
        
        public function actionAsignarDireccion(){
            if($_SESSION['curso']['nuevo'] === 1){ //nuevo
                $model = new ClassroomAddress;
                $model->attributes = $_POST['ClassroomAddress'];
                if($model->validate()){
                    $model->save();
                    $_SESSION['curso']['nuevo'] = 0;
                    $model = $_SESSION['curso']['direccion'];
                    $this->render('createDireccion', array('model'=>$model));
                }else{
                    $this->render('createDireccion', array('model'=>$model));
                }
            } else if($_SESSION['curso']['nuevo'] === 2){ //update
                $model = ClassroomAddress::model()->findByPk($_POST['ClassroomAddress']['pk_classroom_direction']);
                $model->attributes = $_POST['ClassroomAddress'];
                if($model->validate()){
                    $model->update();
                    $_SESSION['curso']['nuevo'] = 0;
                    $_SESSION['curso']['direccion'] = $model;
                    $this->render('createDireccion', array('model'=>$model));
                }else{
                    $this->render('createDireccion', array('model'=>$model));
                }
            } else{
                $model = $_SESSION['curso']['direccion'];
                $this->render('createDireccion', array('model'=>$model));
            }
        }
        
        public function actionGuardarCursoBD(){
            if($_SESSION['curso']['curso']['operacion'] === 'insert'){
                $model = new Courses;
                $model->attributes = $_SESSION['curso']['datos'];
                $model->fk_teacher = $_SESSION['curso']['maestro']['fk_teacher'];
                $model->fk_classrom_address = $_SESSION['curso']['direccion']['pk_classroom_direction'];
                $model->status = constantes::ACTIVO;
                if($model->fk_group === ''){
                    $model->fk_group = new CDbExpression('NULL'); 
                }
                if($model->save()){
                    $this->guardarHorario($model->pk_course);
                    $this->guardarAsignacionMaterial($model->pk_course, $_SESSION['curso']['LoanMaterial']);
                    if($model->fk_type_course === constantes::CURSO_INDIVIDUAL){
                        //si el curso el indivudual, crear alumno con los datos del cliente
                        $this->guardarEstudiante($model->fk_client);
                    }
                }
            }elseif($_SESSION['curso']['curso']['operacion'] === 'update') {
                $model = $this->loadModel($_SESSION['curso']['curso']['pk_course']);
                $model->attributes = $_SESSION['curso']['datos'];
                $model->fk_teacher = $_SESSION['curso']['maestro']['fk_teacher'];
                $model->fk_classrom_address = $_SESSION['curso']['direccion']['pk_classroom_direction'];
                $model->status = constantes::ACTIVO;
                if($model->fk_group === ''){
                    $model->fk_group = new CDbExpression('NULL'); 
                }
                if($model->save()){
                        if($model->fk_type_course === constantes::CURSO_INDIVIDUAL){
                            //comprobar si el cliente se cambio
                            if($model->fk_client !== $_SESSION['curso']['curso']['fk_client_orig']['pk_client']){
                                //Buscamos el estudiante anterior para eliminar
                                $criteria = new CDbCriteria;
                                $criteria->select='pk_student';
                                $criteria->addCondition('fk_client='.$_SESSION['curso']['curso']['fk_client_orig']['pk_client']);
                                $criteria->addCondition('fk_user='.$_SESSION['curso']['curso']['fk_client_orig']['fk_user']);
                                Students::model()->deleteAll($criteria);

                                //si el curso el indivudual, crear alumno con los datos del cliente
                                $this->guardarEstudiante($model->fk_client);
                            }
                        }elseif (($model->fk_type_course === constantes::CURSO_GRUPAL) && 
                                ($_SESSION['curso']['curso']['fk_type_orig'] === constantes::CURSO_INDIVIDUAL)) {
                            //Buscamos el estudiante anterior para eliminar
                            $criteria = new CDbCriteria;
                            $criteria->select='pk_student';
                            $criteria->addCondition('fk_client='.$_SESSION['curso']['curso']['fk_client_orig']['pk_client']);
                            $criteria->addCondition('fk_user='.$_SESSION['curso']['curso']['fk_client_orig']['fk_user']);
                            Students::model()->deleteAll($criteria);
                        }
                        $this->guardarAsignacionMaterial($model->pk_course, $_SESSION['curso']['LoanMaterial']);
                        $this->deleteHorarioBD($model->pk_course);
                        $this->guardarHorario($model->pk_course);
                }
            }
            unset($_SESSION['curso']);
            unset($_SESSION['horarioCurso']);
        }
        
        private function guardarEstudiante($fkCliente){
            $modelCliente = Clients::model()->findByPk($fkCliente);
            $modelEstudiante = new Students();
            $modelEstudiante->fk_client = $modelCliente->pk_client;
            $modelEstudiante->fk_user = $modelCliente->fk_user;
            $modelEstudiante->name = $modelCliente->client_name;
            $modelEstudiante->email = $modelCliente->contact_mail;
            $modelEstudiante->neigborhod = 'No capturado';
            $modelEstudiante->county = 'No capturado';
            $modelEstudiante->phone = $modelCliente->contact_phone;
            $modelEstudiante->zipcode = '00000';
            $modelEstudiante->birthdate = '1980-01-01';
            $modelEstudiante->street = 'No capturado';
            $modelEstudiante->street_number = 0;
            $modelEstudiante->street_number_int = '0';
            $modelEstudiante->fk_state_dir = '31';
            $modelEstudiante->save();
        }
        
        private function guardarAsignacionMaterial($fkCurso, $loadMaterial){
            $model = NULL;
            if(isset($loadMaterial['pk_loan_material']) && $loadMaterial['pk_loan_material'] != ''){
                $model = LoanMaterial::model()->findByPk($loadMaterial['pk_loan_material']);
            }else{
                $model = new LoanMaterial();
                $model->fk_course = $fkCurso;
            }
            $model->comment = $loadMaterial['comment'];
            $model->fk_material_detail = $loadMaterial['fk_material_detail'];
            $model->fk_teacher = $loadMaterial['fk_teacher'];
            $model->pick_date = $loadMaterial['pick_date'];
            $model->save();
            
            //Se cambia a no disponible el material
            $modelCMD = CatMaterialDetail::model()->findByPk($model->fk_material_detail);
            $modelCMD->availability = constantes::INACTIVO;
            $modelCMD->save();
            
            //Se comprueba si se modifico el material para cambiar a disponible el anterior
            if($loadMaterial['fk_material_detail'] != $_SESSION['curso']['Material']['fk_material_detail_ant']){
                $modelCMD = CatMaterialDetail::model()->findByPk($_SESSION['curso']['Material']['fk_material_detail_ant']);
                $modelCMD->availability = constantes::ACTIVO;
                $modelCMD->save();
            }
        }

        public function actionGuardarDireccion(){
            $_SESSION['curso']['nuevo'] = 1;
        }
        
        public function actionEditarDireccion(){
            $_SESSION['curso']['nuevo'] = 2;
        }
        
        public function actionCancelarDireccion(){
            $_SESSION['curso']['nuevo'] = 0;
        }

        public function actionAgregarHorario(){
            $inicio = Yii::app()->getRequest()->getParam('inicio');
            $fin = Yii::app()->getRequest()->getParam("fin");
            $bssDay = Yii::app()->getRequest()->getParam("bssDay");
            if($this->validarHorario($bssDay, $inicio, $fin)){
                $_SESSION['horarioCurso'][$bssDay][$inicio.$fin]["inicio"] = $inicio;
                $_SESSION['horarioCurso'][$bssDay][$inicio.$fin]["fin"] = $fin;
                echo '{"estatus":true, "id": "'.$inicio.$fin.'", "mensaje":"Agregado correctamente."}';
            }else{
                echo '{"estatus":false, "id": "0", "mensaje":"Horario no v&aacute;lido."}';
            }         
        }
        
        public function actionEliminarHorario(){
            unset($_SESSION['horarioCurso'][Yii::app()->getRequest()->getParam("bssDay")][Yii::app()->getRequest()->getParam("id")]);
        }
        
        public function actionValidarHorario(){
            if(isset($_SESSION['horarioCurso']) && (count($_SESSION['horarioCurso']) > 0)){
                echo '{"existe":true}';
            }else{
                echo '{"existe":false}';
            }
        }
        
        private function validarHorario($bssDay, $inicio, $fin){
            if($inicio === "" || $fin === ""){
                return FALSE;
            }
            if($inicio === "00:00" || $fin === "00:00"){
                return FALSE;
            }
            
            $inicioEx = explode(":", $inicio);
            $finEx = explode(":", $fin);
            
            $horaI = $inicioEx[0];
            $minI = $inicioEx[1];
            $horaF = $finEx[0];
            $minF = $finEx[1];
            
            if(((int)$horaI > 23)){
                return FALSE;
            }
            
            if(((int)$horaF > 23)){
                return FALSE;
            }
            
            if(((int)$minI > 59)){
                return FALSE;
            }
            
            if(((int)$minF > 59)){
                return FALSE;
            }
            
            if(((int)$horaI > (int)$horaF)){
                return FALSE;
            }
            if(((int)$horaI === (int)$horaF)){
                if(((int)$minI >= (int)$minF)){
                    return FALSE;
                } 
            }
            
            return TRUE;
        }
        
        public function actionGetHorarioHtml(){
            $html = '';
            $dias = CatBssDay::model()->getCatBssDayListData(constantes::ACTIVO);
            $i = 0;
            $css = '';
            ksort($_SESSION['horarioCurso']);
            foreach ($_SESSION['horarioCurso'] as $keyBssDay => $arrayBssDay) {
                if(!is_array($arrayBssDay)){
                    continue;
                }
                foreach ($arrayBssDay as $keyHorario => $arrayHorario) {
                    if(($i % 2) === 0){
                        $css = 'odd_';
                    }else{
                        $css = 'even_';
                    }
                    $html .= '<tr class="'.$css.'">';
                    $html .= '<td align="center" >'.$dias[$keyBssDay].'</td>';
                    $html .= '<td align="center" >'.$arrayHorario['inicio'].'</td>';
                    $html .= '<td align="center" >'.$arrayHorario['fin'].'</td>';
                    $html .= '<td align="center" ><span id="'.$keyHorario.'" style="cursor: pointer" onclick="eliminarHorario('.$keyBssDay.','.'\''.$keyHorario.'\''.')"><img src="images/delete.png"/></span></td>';
                    $html .= '</tr>';
                    $i++;
                }
            }
            echo $html;
        }

        public function actionGetCursosHtml(){
            $pkMaestro = Yii::app()->getRequest()->getParam("pkMaestro");
            $modelT = Teachers::model()->findByPk($pkMaestro);
            $body = Teachers::model()->getCursosHtml($pkMaestro);
            $header = '<tr>
                       <td align="center" colspan="2" style="font-weight: bold; font-size: 14px">[Cursos Activos] [Tarifa: $'.$modelT->rate.']</td>
                       </tr>';
            $tabla = '<thead>'.$header.'</thead>
                    <tbody>'.$body.'</tbody>';
            echo $tabla;
        }
        
        public function actionGetDomicilioJson(){
            $pkDomicilio = Yii::app()->getRequest()->getParam("pk");
            $model = ClassroomAddress::model()->findByPk($pkDomicilio);
            $_SESSION['curso']['direccion'] = $model;
            echo '{"pk_classroom_direction":"'.$model->pk_classroom_direction.'",
                   "fk_client":"'.$model->fk_client.'",
                   "street":"'.$model->street.'",
                   "street_number":"'.$model->street_number.'",
                   "street_number_int":"'.$model->street_number_int.'",
                   "neighborhood":"'.$model->neighborhood.'",
                   "county":"'.$model->county.'",
                   "fk_state_dir":"'.$model->fk_state_dir.'",
                   "country":"'.$model->country.'",
                   "zipcode":"'.$model->zipcode.'",
                   "status":"'.$model->status.'",
                   "phone":"'.$model->phone.'",
                   "datos_mapa":"'.$model->datos_mapa.'"
                   }';
        }
        
        public function actionGetDomicilioHtml(){
            $modelAddress = ClassroomAddress::model()->getClassroomAddress($_SESSION['curso']['datos']['fk_client']);
            $html = '';
            $i = 0;
            foreach ($modelAddress as $value) {
                $html .= '<tr class="even_">';
                if(($i % 2) === 0){
                    $html .= '<tr class="odd_">';
                }
                if(isset($_SESSION['curso']['direccion'])){
                    if($_SESSION['curso']['direccion']['pk_classroom_direction'] === $value->pk_classroom_direction){
                        $html .= '<td><input name="RadioGroupDom" type="radio" value="'.$value->pk_classroom_direction.'" onchange="cargarDomicilio('.$value->pk_classroom_direction.')" checked="checked"></td>';
                    }else {
                        $html .= '<td><input name="RadioGroupDom" type="radio" value="'.$value->pk_classroom_direction.'" onchange="cargarDomicilio('.$value->pk_classroom_direction.')"></td>';
                    }
                }else{
                    if($i === 0){
                        $html .= '<td><input name="RadioGroupDom" type="radio" value="'.$value->pk_classroom_direction.'" onchange="cargarDomicilio('.$value->pk_classroom_direction.')" checked="checked"></td>';
                    }else{
                        $html .= '<td><input name="RadioGroupDom" type="radio" value="'.$value->pk_classroom_direction.'" onchange="cargarDomicilio('.$value->pk_classroom_direction.')"></td>';
                    }
                }
                $html .= '<td>'.$value->street.' '.$value->street_number.'</td>';
                $html .= '<td>'.$value->county.'</td>';
                $html .= '<td>'.$value->fkStateDir->desc_cat_detail_es.'</td>';
                $html .= '</tr>';
                $i++;
            }
            echo $html;
        }
        
        /**
         * Guardar horario del curso en base de datos
         * @param type $fkCourse
         */
        private function guardarHorario($fkCourse){
            foreach ($_SESSION['horarioCurso'] as $keyBssDay => $arrayBssDay) {
                if(!is_array($arrayBssDay)){
                    continue;
                }
                foreach ($arrayBssDay as $keyHorario => $arrayHorario) {
                    $modelCS = new CourseSchedule();
                    $modelCS->status = constantes::ACTIVO;
                    $modelCS->fk_course = (int)$fkCourse;
                    $modelCS->fk_bss_day = (int)$keyBssDay;
                    $modelCS->initial_hour = $arrayHorario['inicio'];
                    $modelCS->final_hour = $arrayHorario['fin'];
                    $modelCS->save();
                }
            }
        }
        
        /**
         * Leer horario desde la base de datos
         * @param type $fkCourse
         */
        private function getHorarioBD($fkCourse){
            $modelCS = CourseSchedule::model()->getCourseSchedule(constantes::ACTIVO, $fkCourse);
            $_SESSION['horarioCurso'] = array();
            foreach ($modelCS as $array) {
                $inicio = $array->initial_hour;
                $fin = $array->final_hour;
                $_SESSION['horarioCurso'][$array->fk_bss_day][$inicio.$fin]["inicio"] = $inicio;
                $_SESSION['horarioCurso'][$array->fk_bss_day][$inicio.$fin]["fin"] = $fin;
            }
        }
        
        /**
         * Eliminar horario del curso en base de datos
         * @param type $fkCourse
         */
        private function deleteHorarioBD($fkCourse){
            $criteria = new CDbCriteria;
            $criteria->addCondition('fk_course='.$fkCourse);
            $criteria->addCondition('status='.constantes::ACTIVO);
            CourseSchedule::model()->deleteAll($criteria);
        }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
                $model->status = constantes::INACTIVO;
                $model->save();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
        
        /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Courses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Courses']))
			$model->attributes=$_GET['Courses'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
        
        public function actionInactivos(){
            $model=new Courses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Courses']))
			$model->attributes=$_GET['Courses'];

		$this->render('inactivo',array(
			'model'=>$model,
		));
        }
        
        //eliminar metodo si la captura es por fase
        public function actionDomicilioCliente(){
            $fkCliente = Yii::app()->getRequest()->getParam("fkClient");
            $modelAddress = ClassroomAddress::model()->getClassroomAddress($fkCliente);
            if(count($modelAddress) > 0){
                echo '{"calle": "'.$modelAddress->street.
                    '", "numero": "'.$modelAddress->street_number.
                    '", "numeroInt": "'.$modelAddress->street_number_int.
                    '", "colonia": "'.$modelAddress->neighborhood.
                    '", "municipio": "'.$modelAddress->county.
                    '", "estado": "'.$modelAddress->fk_state_dir.
                    '", "pais": "'.$modelAddress->country.
                    '", "cp": "'.$modelAddress->zipcode.
                    '", "telefono": "'.$modelAddress->phone.
                    '", "existe" : true}';
            }else{
                echo '{"existe" : false}';
            }
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Courses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Courses']))
			$model->attributes=$_GET['Courses'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Courses the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Courses::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Courses $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='courses-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
