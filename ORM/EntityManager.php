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

use Doctrine\ORM\EntityManager as DoctrineEntityManager;
    Doctrine\ORM\Internal\Hydration\AbstractHydrator;

/**
 * Extends the doctrine entity manager to provide more dependency injection features.
 */
class EntityManager 
    extends 
        DoctrineEntityManager
{
    protected $hydratorServices = array();

    /**
     * {@inheritDoc}
     *
     * Try to fetch a subscribed hydrator.  If not found, defaults to parent behavior.
     */
    public function newHydrator($hydrationMode)
    {
        if (isset($this->hydratorServices[$hydrationMode])) {
            return $this->hydratorServices[$hydrationMode];
        }
        
        return parent::newHydrator($hydrationMode);
    }
    
    /**
     * Add supported hydrator service.
     * 
     * @param string           $hydrationMode
     * @param AbstractHydrator $hydrator
     */
    public function subscribeHydrator($hydrationMode, AbstractHydrator $hydrator)
    {
        $this->hydratorServices[$hydrationMode] = $hydrator;
    }
}
