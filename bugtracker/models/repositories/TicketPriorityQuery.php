<?php

namespace app\modules\bugtracker\models\repositories;

/**
 * This is the ActiveQuery class for [[TicketPriority]].
 *
 * @see TicketPriority
 */
class TicketPriorityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TicketPriority[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TicketPriority|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
