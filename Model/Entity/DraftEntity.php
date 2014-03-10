<?php
/**
 * This file is part of the RichModelBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Charles B.-Légaré <cblegare.atl@ntis.ca>
 */

namespace Abstrus\RichModelBundle\Model\Entity;

/**
 * Describes the expected behavior of a draft entity.  Use this to inject an entity's value
 * as a oft dependency.
 */
interface DraftEntity
{
    /**
     * Sets this entity's value.  Implementations may provide some lock mecanism so this
     * method can be at least idempotent.
     *
     * @param mixed $value A representation of that entity value.
     *
     * @return mixed The rich entity created.
     */
    public function setValue($value);
}
