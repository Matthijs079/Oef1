<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Regel
 *
 * @ORM\Table(name="regel")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\RegelRepository")
 */
class Regel
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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Kamer")
     * @ORM\JoinColumn(name="kamer_id", referencedColumnName="id")
     */
    private $kamer;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Factuur")
     * @ORM\JoinColumn(name="factuur_id", referencedColumnName="id")
     */
    private $factuur;

    /**
     * @var int
     *
     * @ORM\Column(name="aantal", type="integer")
     */
    private $aantal;


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
     * Set aantal
     *
     * @param integer $aantal
     *
     * @return Regel
     */
    public function setAantal($aantal)
    {
        $this->aantal = $aantal;

        return $this;
    }

    /**
     * Get aantal
     *
     * @return int
     */
    public function getAantal()
    {
        return $this->aantal;
    }

    /**
     * Set kamer
     *
     * @param \MainBundle\Entity\Kamer $kamer
     *
     * @return Regel
     */
    public function setKamer(\MainBundle\Entity\Kamer $kamer = null)
    {
        $this->kamer = $kamer;

        return $this;
    }

    /**
     * Get kamer
     *
     * @return \MainBundle\Entity\Kamer
     */
    public function getKamer()
    {
        return $this->kamer;
    }

    /**
     * Set factuur
     *
     * @param \MainBundle\Entity\Factuur $factuur
     *
     * @return Regel
     */
    public function setFactuur(\MainBundle\Entity\Factuur $factuur = null)
    {
        $this->factuur = $factuur;

        return $this;
    }

    /**
     * Get factuur
     *
     * @return \MainBundle\Entity\Factuur
     */
    public function getFactuur()
    {
        return $this->factuur;
    }
}
