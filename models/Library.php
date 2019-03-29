<?php
    namespace app\models;

    use yii\db\ActiveRecord;
    class Library  extends ActiveRecord 
    {
        public function attributeLabels()
        {
           return [
               'name'=>'书名',
               'author'=>'作者',
               'description'=>'描述'
           ];
        }
        public function rules()
        {
            return [
                [['name','author'],'required'],
                ['description','safe'],
            ];
        }
    }
    
?>