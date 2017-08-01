<?php

namespace app\modules\bugtracker\models\repositories;

use Yii;

/**
 * This is the model class for table "ticket_priority".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Ticket[] $tickets
 */
class TicketPriority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_priority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['priority_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TicketPriorityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketPriorityQuery(get_called_class());
    }
}
