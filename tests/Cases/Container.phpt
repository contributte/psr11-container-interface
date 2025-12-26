<?php declare(strict_types = 1);

use Contributte\Psr11\Container as Psr11Container;
use Contributte\Psr11\DI\Psr11ContainerExtension;
use Contributte\Tester\Environment;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

// Test: Container
$loader = new ContainerLoader(Environment::getTestDir(), true);
$class = $loader->load(function (Compiler $compiler): void {
	$compiler->addExtension('psr11', new Psr11ContainerExtension());
}, time());

/** @var Container $container */
$container = new $class();

Assert::count(1, $container->findByType(Psr11Container::class));

/** @var Psr11Container $psr11Container */
$psr11Container = $container->getByType(Psr11Container::class);

Assert::true($psr11Container->has('container'));
Assert::false($psr11Container->has('missing'));

Assert::same($container, $psr11Container->get('container'));
Assert::exception(function () use ($psr11Container): void {
	$psr11Container->get('missing');
}, NotFoundExceptionInterface::class);

Assert::true($psr11Container->has(Container::class));
Assert::true($psr11Container->has(ContainerInterface::class));
Assert::false($psr11Container->has(Foo::class));

Assert::same($container, $psr11Container->get(Container::class));
Assert::same($psr11Container, $psr11Container->get(ContainerInterface::class));
Assert::exception(function () use ($psr11Container): void {
	$psr11Container->get(Foo::class);
}, NotFoundExceptionInterface::class);
