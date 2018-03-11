<?php

namespace MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Factuur
 *
 * @ORM\Table(name="factuur")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\FactuurRepository")
 */
class Factuur
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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="factuurdatum", type="date")
     */
    private $factuurdatum;

    protected $regels;

    public function __construct()
    {
        $this->regels = new ArrayCollection();
    }

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
     * Set factuurdatum
     *
     * @param \DateTime $factuurdatum
     *
     * @return Factuur
     */
    public function setFactuurdatum($factuurdatum)
    {
        $this->factuurdatum = $factuurdatum;

        return $this;
    }

    /**
     * Get factuurdatum
     *
     * @return \DateTime
     */
    public function getFactuurdatum()
    {
        return $this->factuurdatum;
    }

    /**
     * Set user
     *
     * @param \MainBundle\Entity\User $user
     *
     * @return Factuur
     */
    public function setUser(\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MainBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return ArrayCollection
     */
    public function getRegels()
    {
        return $this->regels;
    }

    /**
     * @param ArrayCollection $regels
     */
    public function setRegels($regels)
    {
        $this->regels = $regels;
    }

    public function __toString()
    {
        return $this->getId().' '.$this->getUser();
    }
}
