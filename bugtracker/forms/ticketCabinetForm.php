<?php

namespace app\modules\bugtracker\forms;

use yii\base\Model;

/**
 * Description of messageCabinetForm
 *
 * @author DartVadius
 */
class ticketCabinetForm extends Model {

    public $title;
    public $text;
    public $type_id;
    public $priority_id;
    public $imageFile = [];

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['text', 'title'], 'string'],
            [['text', 'title', 'type_id', 'priority_id'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'png, jpg', 'maxFiles' => 3],
            [['type_id', 'priority_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'title' => 'Заголовок',
            'text' => 'Текст',
            'priority_id' => 'Приоритет',
            'type_id' => 'Тип',
        ];
    }

}
