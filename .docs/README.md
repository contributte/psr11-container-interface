# PSR-11 Container Interface

:sparkles: Wraps [`nette/di container`](https://github.com/nette/di) into [PSR-11](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md) implementation.

## Content

- [Configuration](#configuration)
- [Usage](#usage)

## Configuration

Register extension:

```neon
extensions:
	psr11: Contributte\Psr11\DI\Psr11ContainerExtension
```
## Usage

```php
use Psr\Container\ContainerInterface;

class YourService
{

	/** @var ContainerInterface $container */
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	private function workWithService(): void
	{
		if($this->container->has('serviceName')) {
			/** @var YourAnotherService $service */
			$service = $this->container->get('serviceName');
		}
	}

	private function workWithServiceOfType(): void
	{
		if($this->container->has(YourAnotherService::class)) {
			/** @var YourAnotherService $service */
			$service = $this->container->get(YourAnotherService::class);
		}
	}

}

```
