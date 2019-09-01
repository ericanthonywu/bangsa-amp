<?php

/**
 * This is the model class for table "setting_polling".
 *
 * The followings are the available columns in table 'setting_polling':
 * @property integer $id
 * @property string $nama
 * @property string $tipe
 * @property string $value
 * @property string $gambar
 */
class SettingPolling extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, tipe, value', 'length', 'max'=>225),
			// The following rule is used by search().
			array('gambar', 'file', 'types'=>'jpg, gif, png', 'maxSize'=>1024 * 1024 * 2, 'tooLarge'=>'File has to be smaller than 2MB', 'allowEmpty'=>FALSE, 'on'=>'insert'),
			array('gambar', 'file', 'types'=>'jpg, gif, png', 'maxSize'=>1024 * 1024 * 2, 'tooLarge'=>'File has to be smaller than 2MB', 'allowEmpty'=>TRUE, 'on'=>'update'),
			array('url, subtitle', 'safe'),
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, tipe, value', 'safe', 'on'=>'search'),
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
			'nama' => 'Nama',
			'tipe' => 'Tipe',
			'value' => 'Value',
			'gambar' => 'Banner Polling',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tipe',$this->tipe,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('gambar',$this->gambar);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SettingPolling the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public static function LabelPoling($val='')
	{
		$str = '';
		if ($val == 1) {
			$str = 'Kiri Tengah';
		}elseif ($val == 2) {
			$str = 'Sidebar Top';
		} else {
			$str = 'Sidebar Bottom';
		}
		
		return $str;
	}
}
