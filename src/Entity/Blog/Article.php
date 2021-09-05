<?php
namespace App\Entity\Blog;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Client;
use App\Entity\Blog\Comment;
use App\Entity\Interfaces\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article implements EntityInterface
{
    private $id;
    /**
     * @Assert\NotBlank(groups={"create"})
     * @Groups({"group1"})
     */
    private $title;
    /**
     * @Assert\Valid(groups={"create"})
     *
     */
    private $client;
    /**
     * @Assert\NotBlank(groups={"create"})
     * @Groups({"group1"})
     */
    private $description;

    /**
     * @Assert\Url(
     *    message = "The url '{{ value }}' is not a valid url",
     *     groups={"create"}
     * )
     */
    private $linkImage;
    /**
     * @Assert\Valid(groups={"create"})
     * @Groups({"group1"})
     */
    private $comments;

    /**
     * @var \DateTimeInterface|null
     */
    protected $createdAt;
    /**
     * @return mixed
     */
    public function __construct() {

        $this->comments = new ArrayCollection();
    }
    public function getId():int
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }
    /**
     * @return mixed
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {

        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLinkImage(): ?string
    {
        return $this->linkImage;
    }
    /**
     * @param mixed $linkImage
     */
    public function setLinkImage($linkImage): void
    {

        $this->linkImage = $linkImage;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }
    public function setClient(?Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return ArrayCollection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }
        return $this;
    }
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}
