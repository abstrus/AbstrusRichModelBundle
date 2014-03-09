<?php
/**
 * This file is part of the RichModelBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Charles B.-Légaré <cblegare.atl@ntis.ca>
 */

namespace Abstrus\RichModelBundle\ORM;

use Doctrine\ORM\Internal\Hydration\ObjectHydrator;

use PDO;

use Abstrus\RichDomainBundle\Model\Entity\Factory\EntityFactory;

/**
 * Implements an object hydrator for rich domain objects.
 */
class DomainObjectHydrator 
    extends 
        ObjectHydrator
{
    /**
     * @var EntityFactory $factory
     */
    protected $factory;
    
    public function __construct(EntityManager $entityManager, EntityFactory $factory)
    {
        parent::__construct($entitymanager);

        $this-factory = $factory;
    }
    
    public function hydrateAll($stmt, $resultSetMapping, array $hints = array())
    {
        $result = array();
        foreach (parent::hydrateAll($stmt, $resultSetMapping, $hints) as $valueObject) {
            $result[] = $this->factory->create($valueObject);
        }
        
        return $result;
    }
    
    public function hydrateRow() 
    {
        return $this->factory->create(parent::hydrateRow());
    }
}