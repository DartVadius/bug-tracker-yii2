<?php

namespace app\modules\bugtracker\models\repositories;
use app\models\User;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $user_id
 * @property integer $type_id
 * @property integer $priority_id
 * @property integer $status
 * @property string $date_update
 * @property string $date_create
 *
 * @property TicketPriority $priority
 * @property TicketTypes $type
 * @property TicketFiles[] $ticketFiles
 * @property TicketMessages[] $ticketMessages
 */
class Ticket extends \yii\db\ActiveRecord implements \app\modules\bugtracker\interfaces\iTicket {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['text', 'user_id', 'type_id', 'priority_id'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['user_id', 'type_id', 'priority_id', 'status'], 'integer'],
            [['date_update', 'date_create'], 'safe'],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketPriority::className(), 'targetAttribute' => ['priority_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => '№ Тикета',
            'text' => 'Текст',
            'title' => 'Заголовок',
            'user_id' => 'Пользователь',
            'type_id' => 'Тип',
            'priority_id' => 'Приоритет',
            'status' => 'Закрыт',
            'date_update' => 'Дата редактирования',
            'date_create' => 'Дата создания'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority() {
        return $this->hasOne(TicketPriority::className(), ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(TicketTypes::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketFiles() {
        return $this->hasMany(TicketFiles::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketMessages() {
        return $this->hasMany(TicketMessages::className(), ['ticket_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TicketQuery the active query used by this AR class.
     */
    public static function find() {
        return new TicketQuery(get_called_class());
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
    
    public function getTypeName() {
        return $this->type->name;
    }
    
    public function getPriorityName() {
        return $this->priority->title;
    }
    
    public function getStatus() {
        return ($this->status == 1) ? 'Закрыт' : 'Открыт';
    }
    
    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getMessages() {
        return $this->ticketMessages;
    }
    
    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getFiles() {
        return $this->ticketFiles;
    }
    
    public function getTicketId() {
        return $this->id;
    }
    
    public function getAuthorId() {
        return $this->user_id;
    }
    
    public function getDate() {
        return $this->date_update;
    }
    
    public function getTitle() {
        return $this->title;
    }

}
