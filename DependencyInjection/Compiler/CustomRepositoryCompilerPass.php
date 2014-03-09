<?php
/**
 * This file is part of the RichModelBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Charles B.-Légaré <cblegare.atl@ntis.ca>
 */

namespace Abstrus\RichModelBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\Reference;

/**
 * Find tagged custom repositories and inject them in the factory.
 */
class CustomRepositoryPass implements CompilerPassInterface
{
    const TAG = 'abstrus_rich_model.custom_repository';
    const FACTORY_ID = 'abstrus_rich_model.repository_factory';

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(static::FACTORY_ID)) {
            return;
        }

        $repositoryFactory = $container->getDefinition(static::FACTORY_ID);

        foreach ($container->findTaggedServiceIds(static::TAG) as $repositoryId => $tags) {
            foreach ($tags as $tag) {
                $entityName = $tag['entity_name'];
                $repositoryFactory->addMethodCall(
                    'subscribeRepository',
                    array($entityName, new Reference($repositoryId))
                );
            }
        }
    }
}