<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="ezadaz", columns={"reclamation_category_id"}), @ORM\Index(name="zadzad", columns={"id_user"})})
 * @ORM\Entity
 */
class Reclamation
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
     * @var string|null
     *
     * @ORM\Column(name="reclamation_type", type="string", length=30, nullable=true)
     */
    private $reclamationType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reclamation_Date", type="date", nullable=false)
     */
    private $reclamationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=50, nullable=false)
     */
    private $contenu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="objet", type="string", length=20, nullable=true)
     */
    private $objet;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \ReclamationCategory
     *
     * @ORM\ManyToOne(targetEntity="ReclamationCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reclamation_category_id", referencedColumnName="category_id")
     * })
     */
    private $reclamationCategory;


}
