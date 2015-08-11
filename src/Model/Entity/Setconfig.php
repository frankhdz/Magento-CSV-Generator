<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setconfig Entity.
 */
class Setconfig extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'attribute' => true,
        'value' => true,
    ];
}
