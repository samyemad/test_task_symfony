<?php
namespace App\Entity\Blog;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Client;
use App\Entity\Blog\Article;
use App\Entity\Interfaces\EntityInterface;
/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment implements EntityInterface
{
    private $id;
    /**
     * @Assert\NotBlank(groups={"details"})
     * @Groups({"group1"})
     */
    private $name;
    /**
     * @Assert\Valid(groups={"details"})
     *
     */
    private $client;

    /**
     * @Assert\Valid(groups={"details"})
     *
     */
    private $article;
    /**
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @Assert\Url(groups={"details"})
     */
    private $urlLink;

    /**
     * @Assert\Email(groups={"details"})
     */
    private $email;
    /**
     * @return mixed
     */
    public function getId(): int
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
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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
    public function getUrlLink(): ?string
    {
        return $this->urlLink;
    }
    /**
     * @param mixed $urlLink
     */
    public function setUrlLink($urlLink): void
    {

        $this->urlLink = $urlLink;
    }

    /**
     * @return mixed
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {

        $this->email = $email;
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


    public function getArticle(): ?Article
    {
        return $this->article;
    }
    public function setArticle(?Article $article): self
    {
        $this->article = $article;
        return $this;
    }

}
