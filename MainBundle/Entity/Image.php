<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ImageRepository")
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     *
     * @Assert\NotBlank(message="Please, upload the image.")
     * @Assert\File(mimeTypes={ "application/pdf", "image/jpg", "image/png", "image/jpeg" })
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Kamer")
     * @ORM\JoinColumn(name="_id", referencedColumnName="id")
     */
    private $kamer_ID;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set kamerID
     *
     * @param \MainBundle\Entity\Kamer $kamerID
     *
     * @return Image
     */
    public function setKamerID(\MainBundle\Entity\Kamer $kamerID = null)
    {
        $this->kamer_ID = $kamerID;

        return $this;
    }

    /**
     * Get kamerID
     *
     * @return \MainBundle\Entity\Kamer
     */
    public function getKamerID()
    {
        return $this->kamer_ID;
    }
}
