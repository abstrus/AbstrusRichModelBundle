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

use Abstrus\RichModelBundle\Model\Entity\Factory\EntityFactory,
    Abstrus\RichModelBundle\Model\Entity\DraftEntity;

/**
 * This class provides an example factory implementation that clones a draft object
 * and then inject the correct value;
 */
class FromDraftFactory
    implements EntityFactory
{
    /**
     * @var DraftEntity
     */
    protected $draft;

    /**
     * @param DraftEntity $draft An entity already injected with services but without value.
     */
    public function __construct(DraftEntity $draft)
    {
        $this->draft = $draft;
    }

    /**
     * {@inheritDoc}
     */
    public function create($value)
    {
        $newEntity = clone $this->draft;

        $newEntity->setValue($value);

        return $newEntity;
    }
}
