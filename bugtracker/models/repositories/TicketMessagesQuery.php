<?php

namespace app\modules\bugtracker\models\repositories;

/**
 * This is the ActiveQuery class for [[TicketMessages]].
 *
 * @see TicketMessages
 */
class TicketMessagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TicketMessages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TicketMessages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
