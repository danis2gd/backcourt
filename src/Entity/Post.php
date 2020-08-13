<?php
declare(strict_types=1);

namespace App\Entity;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Classes\AnnotationGroups;

/**
 * @ORM\Table(
 *     name="tblPost"
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intPostId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({AnnotationGroups::POST_DATA})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strTitle", type="string", length=40)
     *
     * @Groups({AnnotationGroups::POST_DATA})
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="strImagePath", type="string", nullable=true)
     *
     * @Groups({AnnotationGroups::POST_DATA})
     */
    private $imagePath = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="strStrapLine", type="string", length=40, nullable=true)
     *
     * @Groups({AnnotationGroups::POST_DATA})
     */
    private $strapLine;

    /**
     * @var string
     *
     * @ORM\Column(name="strText", type="string")
     *
     * @Groups({AnnotationGroups::POST_DATA})
     */
    private $text;

    /**
     * @var CarbonInterface
     *
     * @ORM\Column(name="dtmPublishDate", type="carbondatetime", nullable=true)
     *
     * @Groups({AnnotationGroups::POST_DATA})
     */
    private $publishDate = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bolCarousel", type="boolean")
     *
     * @Groups({AnnotationGroups::POST_DATA})
     */
    private $carousel = false;

    /**
     * @var int
     *
     * @ORM\Column(name="intCarouselDisplayOrder", type="integer", nullable=true)
     *
     * @Groups({AnnotationGroups::POST_DATA})
     */
    private $carouselDisplayOrder = null;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User", mappedBy="uuid")
     * @ORM\JoinColumn(name="strAuthorUuid", referencedColumnName="strUuid")
     */
    private $author;

    /**
     * @param string $title
     * @param string $description
     * @param string $imagePath
     * @param Carbon|null $publishDate
     * @param string|null $strapLine
     * @param bool $carousel
     * @param bool|null $carouselDisplayOrder
     */
    private function __construct(
        string $title,
        string $description,
        ?string $imagePath = null,
        ?Carbon $publishDate = null,
        ?string $strapLine = null,
        bool $carousel = false,
        bool $carouselDisplayOrder = null
    )
    {
        $this->title = $title;
        $this->text = $description;
        $this->imagePath = $imagePath;
        $this->publishDate = $publishDate;
        $this->strapLine = $strapLine;
        $this->carousel = $carousel;
        $this->carouselDisplayOrder = $carouselDisplayOrder;

        $this->guardEntity();
    }

    /**
     * @return void
     */
    private function guardEntity(): void
    {
        if ($this->carousel === true && $this->carouselDisplayOrder === null) {
            throw new \InvalidArgumentException('Both Carousel and Carousel Order must be set.');
        }
    }

    /**
     * @param string $title
     * @param string $description
     * @param string|null $imagePath
     * @param Carbon|null $publishDate
     * @param string|null $strapLine
     * @param bool $carousel
     * @param bool|null $carouselDisplayOrder
     *
     * @return Post
     */
    public static function create(
        string $title,
        string $description,
        ?string $imagePath = null,
        Carbon $publishDate = null,
        ?string $strapLine = null,
        bool $carousel = false,
        bool $carouselDisplayOrder = null
    )
    {
        return new self(
            $title,
            $description,
            $imagePath,
            $publishDate,
            $strapLine,
            $carousel,
            $carouselDisplayOrder
        );
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    /**
     * @return string|null
     */
    public function getStrapLine(): ?string
    {
        return $this->strapLine;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return CarbonInterface|null
     */
    public function getPublishDate(): ?CarbonInterface
    {
        return $this->publishDate;
    }

    /**
     * @return bool
     */
    public function isCarousel(): bool
    {
        return $this->carousel;
    }

    /**
     * @return int|null
     */
    public function getCarouselDisplayOrder(): ?int
    {
        return $this->carouselDisplayOrder;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }
}