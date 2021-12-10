<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\AbstractRating as BaseRating;

/**
 * @ORM\Table(name="oa_rating")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="RatingBundle\Repository\RatingRepository")
 */
class Rating extends BaseRating
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Rating constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}
