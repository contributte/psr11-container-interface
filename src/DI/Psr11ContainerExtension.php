<?php declare(strict_types = 1);

namespace Contributte\Psr11\DI;

use Contributte\Psr11\Container;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;

class Psr11ContainerExtension extends CompilerExtension
{

	public function afterCompile(ClassType $class): void
	{
		$class->setExtends(Container::class);
	}

}
