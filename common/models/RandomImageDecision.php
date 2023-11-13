<?php

declare(strict_types=1);

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "random_image_decisions".
 *
 * @property int $id
 * @property int $image_id
 * @property bool $result
 * @property int $created_at
 */
final class RandomImageDecision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'random_image_decisions';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'result'], 'required'],
            [['image_id'], 'integer'],
            [['result'], 'boolean'],
            [['image_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Image ID',
            'result' => 'Result',
            'created_at' => 'Created At',
        ];
    }
}
