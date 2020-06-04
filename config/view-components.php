<?php
return [
    /*
     * The root namespace where components reside. Components can be referenced
     * with camelCase & dot notation.
     *
     * Example: 'root_namespace' => App\Http\ViewComponents::class
     *
     * `@render('myComponent')
     *     => `App\Http\ViewComponents\MyComponent`
     */
    'root_namespace' => 'App\Http\ViewComponents',
    /*
     * Register alternative namespaces here, similar to custom view paths.
     *
     * Example: 'navigation' => App\Services\Navigation::class,
     *
     * `@render('navigation::mainMenu')`
     *     => `App\Services\Navigation\MainMenu`
     */
    'namespaces' => [
        'seller' => App\Http\ViewComponents\SellerComponent::class,
        'product' => App\Http\ViewComponents\ProductComponent::class,
    ],
];