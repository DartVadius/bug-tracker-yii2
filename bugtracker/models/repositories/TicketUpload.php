<?php

namespace app\modules\bugtracker\models\repositories;

use app\modules\bugtracker\models\TicketBase;

/**
 * Description of TicketUpload
 *
 * @author DartVadius
 */
class TicketUpload extends TicketBase {

    public $imageFile = [];
    public $count;

    public function rules() {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'png, jpg', 'maxFiles' => $this->module['max_files']],
            ['count', function($attribute, $params){
                if ($this->$attribute > $this->module['max_files']) {
                     $this->addError($attribute, 'Слишком много файлов');
                }
            }]
        ];
    }

    public function upload(TicketFiles $model) {
        $this->count = count($this->imageFile) + $model->getCountByMessageId($model->message_id) + $model->getCountByTicketId($model->ticket_id);
        if ($this->validate() && !(empty($this->imageFile))) {
            foreach ($this->imageFile as $file) {
                $newModel = clone $model;
                $newModel->setFileName($file->baseName . '.' . $file->extension)->save();
                $file->saveAs($this->module['path_to_files'] . '/' . $file->baseName . '.' . $file->extension);
            }
            return TRUE;
        }
        if (isset($this->errors['count'][0])) {
            return $this->errors['count'][0];
        }
        return FALSE;
    }

}
