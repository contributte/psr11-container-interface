<?php declare(strict_types = 1);

/**
 * Test: Container
 */

use Contributte\Psr11\Container as Psr11Container;
use Contributte\Psr11\DI\Psr11ContainerExtension;
use Nette\DI\Compiler;
use Nette\DI\ContainerLoader;
use Psr\Container\NotFoundExceptionInterface;
use Tester\Assert;
use Tests\Fixtures\TestService;

require_once __DIR__ . '/../bootstrap.php';

test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = $loader->load(function (Compiler $compiler): void {
		$compiler->addExtension('psr11', new Psr11ContainerExtension());
		$compiler->addConfig([
			'services' => [
				'test' => TestService::class,
			],
		]);
	}, time());

	/** @var Psr11Container $container */
	$container = new $class();

	Assert::true($container instanceof Psr11Container);

	Assert::true($container->has('test'));
	Assert::true($container->has(TestService::class));
	Assert::true($container->get('test') instanceof TestService);
	Assert::same($container->get('test'), $container->get(TestService::class));

	Assert::same($container->get('test'), $container->getByType(TestService::class));
	Assert::same($container->get('test'), $container->getService('test'));

	Assert::false($container->has('missing'));
	Assert::exception(function () use ($container): void {
		$container->get('missing');
	}, NotFoundExceptionInterface::class);
});
