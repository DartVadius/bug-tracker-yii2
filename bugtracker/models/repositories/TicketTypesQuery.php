<?php

namespace app\modules\bugtracker\models\repositories;

/**
 * This is the ActiveQuery class for [[TicketTypes]].
 *
 * @see TicketTypes
 */
class TicketTypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TicketTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TicketTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
