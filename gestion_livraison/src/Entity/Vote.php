<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\AbstractVote as BaseVote;

/**
 * @ORM\Table(name="oa_vote")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote extends BaseVote
{
    public const IP_TYPE = 'ip';
    public const COOKIE_TYPE = 'cookie';

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Vote constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @ORM\PreFlush()
     * @ORM\PostUpdate()
     * @ORM\PostPersist()
     */
    public function updatedVotes(): void
    {
        if (null !== ($rating = $this->getRating())) {
            $rating->recalculate();
        }
    }
}
