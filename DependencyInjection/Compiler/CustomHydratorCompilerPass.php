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
 * Injects custom hydrator in the default entity manager
 */
class CustomHydratorPass implements CompilerPassInterface
{
    const TAG = 'abstrus_rich_model.custom_repository';
    const ENTITY_MANAGER_ID = 'doctrine.orm.entity_manager';

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(static::ENTITY_MANAGER_ID)) {
            return;
        }

        $entityManager = $container->getDefinition(static::ENTITY_MANAGER_ID);

        foreach ($container->findTaggedServiceIds(static::TAG) as $hydratorId => $tags) {
            foreach ($tags as $tag) {
                $hydrationMode = $tag['hydration_mode'];
                $entityManager->addMethodCall(
                    'subscribeHydrator',
                    array($hydrationMode, new Reference($hydratorId))
                );
            }
        }
    }
}