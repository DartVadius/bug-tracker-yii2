<?php

namespace app\modules\bugtracker\models\repositories;
use app\models\User;

use Yii;

/**
 * This is the model class for table "ticket_messages".
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $user_id
 * @property string $text
 * @property string $date
 *
 * @property TicketFiles[] $ticketFiles 
 * @property Ticket $ticket
 */
class TicketMessages extends \yii\db\ActiveRecord implements \app\modules\bugtracker\interfaces\iMessage {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ticket_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ticket_id', 'text', 'user_id'], 'required'],
            [['ticket_id', 'user_id'], 'integer'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID сообщения',
            'ticket_id' => '№ тикета',
            'text' => 'Текст',
            'date' => 'Дата',
            'user_id' => 'Пользователь',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket() {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketFiles() {
        return $this->hasMany(TicketFiles::className(), ['message_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */

    /**
     * @inheritdoc
     * @return TicketMessagesQuery the active query used by this AR class.
     */
    public static function find() {
        return new TicketMessagesQuery(get_called_class());
    }
    
    public function getAuthorName() {
        $userModel = new User();
        $user = $userModel->findOne($this->user_id);
        if (!empty($user->username)) {
            return $user->username;
        }
        return $user->email;
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function getTicketId() {
        return $this->ticket_id;
    }
    
    public function getFiles() {
        return $this->ticketFiles;
    }
    
    public function getDate() {
        return $this->date;
    }

}
