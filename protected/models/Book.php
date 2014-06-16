<?php

/**
 * This is the model class for table "{{book}}".
 *
 * The followings are the available columns in table '{{book}}':
 * @property integer $id
 * @property string $title
 * @property string $date_create
 * @property string $date_change
 * @property integer $reader_id
 *
 * The followings are the available model relations:
 * @property Reader $Reader
 * @property Author[] $Authors
 */
class Book extends CActiveRecord
{
        public $authors;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{book}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>255),
                        array('reader_id','safe'),
                        array('authors','type','type'=>'array','allowEmpty'=>false,'message'=>'Необходимо выбрать хотябы одного автора'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, date_create, date_change', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Authors' => array(self::MANY_MANY, 'Author', '{{book_author}}(book_id, author_id)'),
			'Reader' => array(self::BELONGS_TO, 'Reader', 'reader_id'),
                        'AuthorsCount'=>array(self::STAT, 'Author', '{{book_author}}(book_id, author_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название книги',
			'date_create' => 'Date Create',
			'date_change' => 'Date Change',
                        'reader_id' => 'Читатель'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_change',$this->date_change,true);
                $criteria->compare('reader_id',$this->reader_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        protected function beforeSave()
        {
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                {
                    $this->date_create = $this->date_change = date('Y-m-d');
                }
                else{
                    $this->date_change = date('Y-m-d');
                }
                    
                return true;
            }
            else
                return false;
        }
        
        protected function afterSave() {
            parent::afterSave();
            
            if(!$this->isNewRecord){
                BookAuthor::model()->deleteAll('book_id = :book_id', array('book_id'=>  $this->id));
            }
            
            if(isset($_POST['Book']['authors'])){
                foreach ($_POST['Book']['authors'] as $key => $author_id) {
                    $BookAuthor = new BookAuthor();
                    $BookAuthor->book_id = $this->id;
                    $BookAuthor->author_id = $author_id;
                    $BookAuthor->save();
                }
            }
        }
}
