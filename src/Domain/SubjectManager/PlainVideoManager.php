<?php


namespace App\Domain\SubjectManager;


use App\Domain\InflatorInterface;
use App\Entity\Video;
use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class PlainVideoManager extends AbstractSubjectManager implements InflatorInterface
{
    private const ID = 'id';
    private const LIMIT = 3;
    private const FIRST_OFFSET = 0;
    private const FIRST_LIMIT = 1;
    private const ITEM_OFFSET = 1;
    /**
     * @var Video
     */
    private $firstItem;

    public function __construct(VideoRepository $repository)
    {
        parent::__construct($repository);
    }

    public function inflate(): self
    {
        $items = new ArrayCollection($this->repository->findBy([
        ], [
            self::ID => Criteria::DESC
        ], self::LIMIT
        ));
        $firstItem = $items->slice(self::FIRST_OFFSET, self::FIRST_LIMIT);
        /**
         * @var Video $firstItem
         */
        $firstItem = array_shift($firstItem);
        $this->firstItem = $firstItem;
        $this->items = new ArrayCollection($items->slice(self::ITEM_OFFSET, self::LIMIT));
        return $this;
    }

    /**
     * @return Video
     */
    public function getFirstItem(): Video
    {
        return $this->firstItem;
    }
}