<?php

namespace app\modules\bugtracker\models\repositories;

use Yii;

/**
 * This is the model class for table "ticket_types".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Ticket[] $tickets
 */
class TicketTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TicketTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketTypesQuery(get_called_class());
    }
}
