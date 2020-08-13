<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "model".
 *
 * @property integer $id
 * @property string $name
 * @property integer $mark_id
 * @property integer $date_add
 */
class CarModel extends ActiveRecord
{
    public static function tableName(){
        return 'model';
    }

    public function rules(){
        return [
            [['name', 'mark_id'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['mark_id', 'date_add'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mark_id' => 'Mark ID',
            'date_add' => 'date add',
        ];
    }

    public static function getByNameAndMarkId($name, $mark_id)
    {
        return self::find()->where(['name' => $name])->andWhere(['mark_id' => $mark_id])->one();
    }

    public static function getById($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    public static function getByMarkId($mark_id)
    {
        return self::find()->where(['mark_id' => $mark_id])->all();
    }

    public static function getAll($mark_id = 0)
    {
        return self::getByMarkId($mark_id);
    }

    public static function addRecord($name, $mark_id)
    {
        $obj = self::getByNameAndMarkId($name, $mark_id);

        if (!$obj) {
            $obj = new self;
            $obj->name = $name;
            $obj->mark_id = $mark_id;
            $obj->date_add = time();
            $obj->save();
        }

        return $obj;
    }
}
