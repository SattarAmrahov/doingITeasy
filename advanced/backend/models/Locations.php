<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $location_id
 * @property string $zip_code
 * @property string $city
 * @property string $district
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip_code', 'city', 'district'], 'required'],
            [['zip_code'], 'string', 'max' => 20],
            [['city', 'district'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'district' => 'District',
        ];
    }
}
