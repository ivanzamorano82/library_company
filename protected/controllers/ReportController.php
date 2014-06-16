<?php

class ReportController extends Controller
{
    public $layout='//layouts/column2';
    
	public function actionIndex()
	{
            
            
            $model=Book::model()->with('Authors')->findAll(array(
                    'condition' => 'reader_id is not null',
                    'group'=> 't.id',
                    'having'=>'COUNT(*)>=3'
                ));
            
		$this->render('index', array(
                    'model' => $model
                ));
	}
        
        public function actionIndex2()
	{
		$model = Author::model()->with('Readers')->findAll(
                            array(
                            'condition'=>'Books.reader_id is not null',
                            'group'=> 't.id',
                            'having'=>'COUNT(*)>3'
                        )
                );
    
		$this->render('index2', array(
                    'model' => $model,
                ));
	}
        
        public function actionIndex3()
	{
            $model = Book::model()->with('Reader')->findAll(
                            array(
                            'order'=>'RAND()',
                            'limit'=> '5'
                        )
                );
                
		$this->render('index3', array(
                    'model' => $model,
                ));
	}
}