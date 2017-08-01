<?php

namespace app\modules\bugtracker\forms;

use yii\base\Model;

/**
 * Description of messageCabinetForm
 *
 * @author DartVadius
 */
class messageCabinetForm extends Model {

    
    public $text;
    public $imageFile = [];

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['text'], 'string'],
            [['text'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'png, jpg', 'maxFiles' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'text' => 'Комментарий',
            'date' => 'Дата',
        ];
    }

}
