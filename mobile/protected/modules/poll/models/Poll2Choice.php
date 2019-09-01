<?php

/**
 * This is the model class for table "{{poll2_choice}}".
 *
 * The followings are the available columns in table '{{poll2_choice}}':
 * @property string $id
 * @property string $poll_id
 * @property string $label
 * @property string $votes
 * @property integer $weight
 * @property integer $jumlah_rekayasa
 * @property string $image
 *
 * The followings are the available model relations:
 * @property Poll $poll
 * @property PollVote[] $pollVotes
 */
class Poll2Choice extends CActiveRecord
{
  
  /**
   * Returns the static model of the specified AR class.
   * @return PollChoice the static model class
   */
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName()
  {
    return 'poll2_choice';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    return array(
      array('poll_id, label', 'required'),
      array('weight', 'numerical', 'integerOnly'=>true),
      array('poll_id, votes', 'length', 'max'=>11),
      array('jumlah_rekayasa, image', 'safe'),
      array('label, image', 'length', 'max'=>255),

      // array('image', 'file', 'types'=>'jpg, gif, png, jpeg', 'allowEmpty'=>TRUE),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations()
  {
    return array(
      'poll' => array(self::BELONGS_TO, 'Poll2', 'poll_id'),
      'pollVotes' => array(self::HAS_MANY, 'Poll2Vote', 'choice_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'jumlah_rekayasa' => 'Jml Rekayasa',
      'image' => 'Foto Kandidat',
    );
  }

  /**
   * @return array default scope.
   */
  public function defaultScope()
  {
    return array(
      'order' => 'weight ASC, label ASC',
    );
  }

  /**
   * @return array of weights for sorting
   */
  public function getWeights()
  {
    $weights = range(-5, 5);

    return array_combine($weights, $weights);
  }

}
