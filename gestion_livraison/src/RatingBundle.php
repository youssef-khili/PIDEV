<?php declare(strict_types=1);

namespace App;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use App\DependencyInjection\RatingExtension;

/**
 * Class RatingBundle
 * @package App
 */
class RatingBundle extends Bundle
{
    /**
     * @return RatingExtension|\Symfony\Component\DependencyInjection\Extension\ExtensionInterface|null
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new RatingExtension();
        }

        return $this->extension;
    }
}
