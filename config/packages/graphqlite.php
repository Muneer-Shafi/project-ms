<?php
declare(strict_types=1);

namespace App;

use Symfony\Config\GraphqliteConfig;

return static function (GraphqliteConfig $graphQlLite): void {
    $graphQlLite
        ->namespace()
        ->controllers([
            'App\GraphQl\Resolvers\Query\\',
            'App\GraphQl\Resolvers\Mutations\\',
            'App\Relation\UI\GraphQL\Resolvers\Query\\',
            'App\Relation\UI\GraphQL\Resolvers\Mutation\\'
        ])
        ->types([
            'App\GraphQl\Types\\',
            'App\Relation\UI\GraphQL\Types\\'
        ]);

    $graphQlLite
        ->security()
        ->enableLogin('off')
        ->introspection(true)
        ->enableMe('on')
        ->maximumQueryComplexity(1500)
        ->maximumQueryDepth(20);

    $graphQlLite->debug([
        'INCLUDE_DEBUG_MESSAGE' => false,
        'INCLUDE_TRACE' => 'dev' == false,
        'RETHROW_INTERNAL_EXCEPTIONS' => false,
        // Unsafe exception (not extending graphql exception) are rethrown in live env so that our default error handler works
        'RETHROW_UNSAFE_EXCEPTIONS' => false,
    ]);
};
