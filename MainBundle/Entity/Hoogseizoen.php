<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hoogseizoen
 *
 * @ORM\Table(name="hoogseizoen")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\HoogseizoenRepository")
 */
class Hoogseizoen
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
     * @var \DateTime
     *
     * @ORM\Column(name="begin", type="datetime")
     */
    private $begin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eind", type="datetime")
     */
    private $eind;


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
     * Set begin
     *
     * @param \DateTime $begin
     *
     * @return Hoogseizoen
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;

        return $this;
    }

    /**
     * Get begin
     *
     * @return \DateTime
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set eind
     *
     * @param \DateTime $eind
     *
     * @return Hoogseizoen
     */
    public function setEind($eind)
    {
        $this->eind = $eind;

        return $this;
    }

    /**
     * Get eind
     *
     * @return \DateTime
     */
    public function getEind()
    {
        return $this->eind;
    }
}

