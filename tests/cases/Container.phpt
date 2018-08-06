<?php declare(strict_types = 1);

/**
 * Test: Container
 */

use Contributte\Psr11\Container as Psr11Container;
use Contributte\Psr11\DI\Psr11ContainerExtension;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Psr\Container\NotFoundExceptionInterface;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
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
});
