<?php
    namespace app\controllers;
    use Yii;
    use yii\web\Controller;
    use app\models\Library;
    use yii\data\ActiveDataProvider;
    class LibraryController extends Controller 
    {  
        public function actionIndex()
        {   
            $request = Yii::$app->request;
            if ($request->isPost) {
                $model = new Library;
                $model->load($request->post());
                $result = $model->validate();
                if($result){
                    $model->create_time = date("Y-m-d");
                    $model->save();
                    Yii::$app->getSession()->setFlash('success', '添加成功');
                }else{
                    //var_dump($model->getErrors());
                };
            }
            $model = new Library;
            $dataProvider = new ActiveDataProvider([
                'query' => Library::find(),
                'pagination' => [
                    'pageSize' => 5,
                ],
                'sort'=>[
                    'defaultOrder'=>[
                        'create_time'=>SORT_DESC,
                        'id'=>SORT_DESC
                    ]
                ]
            ]);
            return $this->render('index',[
                'dataProvieder'=>$dataProvider,
                'model'=>$model,
            ]);
        }
        public function actionDelete()
        {
            $request = Yii::$app->request;
            $id =  $request->getQueryParam('id');
            if($id){
                $result = Library::findOne($id);
                $result->delete();
                return $this->redirect(['library/index']);
            }
        }
        public function actionUpdate($id)
        {   
            $request = Yii::$app->request;
            // $id = $request->get('id');
            $model = Library::findOne(['id'=>$id]);

            if($request->isPost){
                $model->load($request->post());
                $result = $model->validate();
                if($result){
                    $model->create_time = date("Y-m-d");
                    $model->save();
                    Yii::$app->getSession()->setFlash('success', '修改成功');
                    return $this->redirect(['library/index']);
                }else{
                    var_dump($model->getErrors());
                };
            }

            //显示修改表单
            return $this->render('edit',['model'=>$model]);
                
        }
    }

?>