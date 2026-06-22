![](https://heatbadger.now.sh/github/readme/contributte/psr11-container-interface/)

<p align=center>
  <a href="https://github.com/contributte/psr11-container-interface/actions"><img src="https://badgen.net/github/checks/contributte/psr11-container-interface/master"></a>
  <a href="https://coveralls.io/r/contributte/psr11-container-interface"><img src="https://badgen.net/coveralls/c/github/contributte/psr11-container-interface"></a>
  <a href="https://packagist.org/packages/contributte/psr11-container-interface"><img src="https://badgen.net/packagist/dm/contributte/psr11-container-interface"></a>
  <a href="https://packagist.org/packages/contributte/psr11-container-interface"><img src="https://badgen.net/packagist/v/contributte/psr11-container-interface"></a>
</p>
<p align=center>
  <a href="https://packagist.org/packages/contributte/psr11-container-interface"><img src="https://badgen.net/packagist/php/contributte/psr11-container-interface"></a>
  <a href="https://github.com/contributte/psr11-container-interface"><img src="https://badgen.net/github/license/contributte/psr11-container-interface"></a>
  <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
  <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
  <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

PSR-11 Container Interface wraps [`nette/di`](https://github.com/nette/di) containers into a [PSR-11](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md) compatible container implementation.

## Versions

| State       | Version | Branch   | PHP     |
|-------------|---------|----------|---------|
| dev         | `^0.7`  | `master` | `>=7.2` |
| stable      | `^0.6`  | `master` | `>=7.2` |

## Installation

To install the latest version of `contributte/psr11-container-interface` use [Composer](https://getcomposer.org).

```bash
composer require contributte/psr11-container-interface
```

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
		if ($this->container->has('serviceName')) {
			/** @var YourAnotherService $service */
			$service = $this->container->get('serviceName');
		}
	}

	private function workWithServiceOfType(): void
	{
		if ($this->container->has(YourAnotherService::class)) {
			/** @var YourAnotherService $service */
			$service = $this->container->get(YourAnotherService::class);
		}
	}

}
```

## Development

See [how to contribute](https://contributte.org/contributing.html) to this package.

This package is currently maintained by these authors.

<a href="https://github.com/f3l1x">
    <img width="80" height="80" src="https://avatars.githubusercontent.com/f3l1x">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this package.
