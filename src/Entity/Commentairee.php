<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentairee
 *
 * @ORM\Table(name="commentairee", indexes={@ORM\Index(name="fk_c_poste", columns={"id_poste"}), @ORM\Index(name="fk_c_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Commentairee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @var \Poste
     *
     * @ORM\ManyToOne(targetEntity="Poste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_poste", referencedColumnName="id")
     * })
     */
    private $idPoste;


}
