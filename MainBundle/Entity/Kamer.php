<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kamer
 *
 * @ORM\Table(name="kamer")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\KamerRepository")
 */
class Kamer
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
     * @var int
     *
     * @ORM\Column(name="kamernummer", type="integer")
     */
    private $kamernummer;

    /**
     * @var string
     *
     * @ORM\Column(name="kamerbeschrijving", type="string", length=255)
     */
    private $kamerbeschrijving;

    /**
     * @var string
     *
     * @ORM\Column(name="kamernaam", type="string", length=255)
     */
    private $kamernaam;

    /**
     * @var float
     *
     * @ORM\Column(name="kamerprijs", type="float")
     */
    private $kamerprijs;


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
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Set kamernummer
     *
     * @param integer $kamernummer
     *
     * @return Kamer
     */
    public function setKamernummer($kamernummer)
    {
        $this->kamernummer = $kamernummer;

        return $this;
    }

    /**
     * Get kamernummer
     *
     * @return int
     */
    public function getKamernummer()
    {
        return $this->kamernummer;
    }

    /**
     * Set kamerbeschrijving
     *
     * @param string $kamerbeschrijving
     *
     * @return Kamer
     */
    public function setKamerbeschrijving($kamerbeschrijving)
    {
        $this->kamerbeschrijving = $kamerbeschrijving;

        return $this;
    }

    /**
     * Get kamerbeschrijving
     *
     * @return string
     */
    public function getKamerbeschrijving()
    {
        return $this->kamerbeschrijving;
    }

    /**
     * Set kamerprijs
     *
     * @param float $kamerprijs
     *
     * @return Kamer
     */
    public function setKamerprijs($kamerprijs)
    {
        $this->kamerprijs = $kamerprijs;

        return $this;
    }

    /**
     * Get kamerprijs
     *
     * @return float
     */
    public function getKamerprijs()
    {
        return $this->kamerprijs;
    }
    /**
     * Set kamernaam
     *
     * @param string $kamernaam
     *
     * @return Kamer
     */
    public function setKamernaam($kamernaam)
    {
        $this->kamernaam = $kamernaam;

        return $this;
    }

    /**
     * Get kamernaam
     *
     * @return string
     */
    public function getKamernaam()
    {
        return $this->kamernaam;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product_regel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add productRegel
     *
     * @param \MainBundle\Entity\Regel $productRegel
     *
     * @return Kamer
     */
    public function addProductRegel(\MainBundle\Entity\Regel $productRegel)
    {
        $this->product_regel[] = $productRegel;

        return $this;
    }

    /**
     * Remove productRegel
     *
     * @param \MainBundle\Entity\Regel $productRegel
     */
    public function removeProductRegel(\MainBundle\Entity\Regel $productRegel)
    {
        $this->product_regel->removeElement($productRegel);
    }

    /**
     * Get productRegel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductRegel()
    {
        return $this->product_regel;
    }

    public function __toString()
    {
        return $this->getId().' '. $this->getKamerbeschrijving();
    }
}
