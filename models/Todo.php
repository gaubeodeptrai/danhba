<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todo".
 *
 * @property integer $id
 * @property string $todo_name
 * @property integer $status
 * @property string $create_date
 */
class Todo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['create_date'], 'safe'],
            [['todo_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'todo_name' => 'Todo Name',
            'status' => 'Status',
            'create_date' => 'Create Date',
        ];
    }
}
