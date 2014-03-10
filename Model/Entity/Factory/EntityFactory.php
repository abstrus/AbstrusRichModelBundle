<?php
/**
 * This file is part of the RichModelBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Charles B.-Légaré <cblegare.atl@ntis.ca>
 */

namespace Abstrus\RichModelBundle\Model\Entity\Factory;

/**
 * Describes the expected behavior of a rich entity factory
 */
interface EntityFactory
{
    /**
     * Builds an entity with all expected dependencies injected.
     *
     * @param mixed $value A representation of that entity value.
     *
     * @return mixed The rich entity created.
     */
    public function create($value);
}
