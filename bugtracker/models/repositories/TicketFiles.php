<?php

namespace app\modules\bugtracker\models\repositories;

use Yii;

/**
 * This is the model class for table "ticket_files".
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $message_id
 * @property string $file_name
 *
 * @property Ticket $ticket
 * @property TicketMessages $message 
 */
class TicketFiles extends \yii\db\ActiveRecord implements \app\modules\bugtracker\interfaces\iFiles {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ticket_files';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['file_name'], 'required'],
            [['ticket_id', 'message_id'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
            [['message_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketMessages::className(), 'targetAttribute' => ['message_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'ticket_id' => 'Тикет',
            'message_id' => 'Сообщение',
            'file_name' => 'Имя файла',
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
    public function getMessage() {
        return $this->hasOne(TicketMessages::className(), ['id' => 'message_id']);
    }

    /**
     * @inheritdoc
     * @return TicketFilesQuery the active query used by this AR class.
     */
    public static function find() {
        return new TicketFilesQuery(get_called_class());
    }

    public function setFileName($name) {
        $this->file_name = $name;
        return $this;
    }

    /**
     * get count of uploaded files for current ticket
     * 
     * @param integer $id
     * @return integer
     */
    public function getCountByTicketId($id) {
        if ($id == NULL) {
            return 0;
        }
        $result = $this->findAll(['ticket_id' => $id]);
        return count($result);
    }

    /**
     * get count of uploaded files for current message
     * 
     * @param integer $id
     * @return integer
     */
    public function getCountByMessageId($id) {
        if ($id == NULL) {
            return 0;
        }
        $result = $this->findAll(['message_id' => $id]);
        return count($result);
    }
    
    public function getPath() {
        return '/uploads/' . $this->file_name;
    }
    
    public function getFileName() {
        return $this->file_name;
    }

}
