<?php

/**
 * This is the model class for table "module_iklan".
 *
 * The followings are the available columns in table 'module_iklan':
 * @property integer $id
 * @property string $judul_iklan
 * @property string $keterangan_iklan
 * @property string $link_iklan
 * @property string $is_external
 */
class Iklan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_iklan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('judul_iklan', 'required'),
			array('keterangan_iklan, link_iklan, is_external, position', 'default'),
			array('judul_iklan, link_iklan', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, judul_iklan, keterangan_iklan, link_iklan, is_external', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'judul_iklan' => 'Judul Iklan',
			'keterangan_iklan' => 'Keterangan Iklan',
			'link_iklan' => 'Link Iklan',
			'is_external' => 'Eksternal Link',
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
		$criteria->compare('judul_iklan',$this->judul_iklan,true);
		$criteria->compare('keterangan_iklan',$this->keterangan_iklan,true);
		$criteria->compare('link_iklan',$this->link_iklan,true);
		$criteria->compare('is_external',$this->is_external);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Iklan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
