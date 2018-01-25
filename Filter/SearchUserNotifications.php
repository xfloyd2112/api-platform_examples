<?php

namespace AppBundle\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\FilterInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class SearchUserNotifications extends AbstractFilter
{
    protected $tokenStorage;

    /**
     * CustomFilter constructor.
     * @param \Doctrine\Common\Persistence\ManagerRegistry $managerRegistry
     * @param RequestStack                                 $requestStack
     */
    public function __construct($managerRegistry, RequestStack $requestStack, TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
        parent::__construct($managerRegistry, $requestStack);
    }
    /**
     * @param QueryBuilder                $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string                      $resourceClass
     * @param string|null                 $operationName
     * @throws \Exception
     */
    public function apply(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $request = $this->requestStack->getCurrentRequest();
        if (null === $request) {
            return;
        }
        $notification_id = $request->query->get('notification_id');
        $user_id = $this->tokenStorage->getToken()->getUser()->getId();
        $rootAlias = $queryBuilder->getRootAliases()[0];
        #Modify the SQL query
        // print_r($queryBuilder->getDql());exit;
        $queryBuilder->andWhere($queryBuilder->expr()->andX(
            $queryBuilder->expr()->gt($rootAlias .'.id', '?1'),
            $queryBuilder->expr()->in($rootAlias .'.store_access', '?2')
            )
        );
        $queryBuilder->setParameters(array(
                1 => $notification_id,
                2 => 5
            )
        );
    }
    
    /**
     * @param string $resourceClass
     * @return array
     */
    public function getDescription(string $resourceClass): array
    {
        return [
            'notification_id' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
                'swagger' => ['description' => 'Example: notification_id=10'],
            ]
        ];
    }
    /**
     * Passes a property through the filter.
     *
     * @param string $property
     * @param mixed $value
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param string|null $operationName
     */
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
    }
}
