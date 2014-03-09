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

use Doctrine\ORM\Repository\RepositoryFactory,
    Doctrine\ORM\EntityManagerInterface,
    Doctrine\ORM\ObjectRepository;

/**
 * Implements a entity repository factory capable of retrieving custom repositories.
 * Inject in your entity manager to use transparently.
 */
class DIAwareRepositoryFactory
    implements RepositoryFactory
{
    protected $repositoryServices = [];
    
    protected $defaultFactory;
    
    /**
     * @param RepositoryFactory $default
     */
    public function __construct(RepositoryFactory $default)
    {
        $this->defaultFactory = $default;
    }
    
    /**
     * {@inheritDoc}
     *
     * Returns a custom tagged repository if exists, else it let the default factory do the job.
     */
    public function getRepository(EntityManagerInterface $entityManager, $entityName)
    {
        if (isset($this->repositoryServices[$entityName])) {
            return $this->repositoryServices[$entityName];
        }
        
        return $this->defaultFactory->getRepository($entityManager, $entityName);
    }
    
    /**
     * Handle to inject custom tagged repositories in a compiler pass.
     * 
     * @param string           $entityName EntityManaged by the injected repository.  This does not 
     *                                     need to be actually true.  It is only an identifier.
     * @param ObjectRepository $repository Custom tagged repository.
     */
    public function subscribeRepository($entityName, ObjectRepository $repository)
    {
        $this-repositoryServices[$entityName] = $repository;
    }
}   