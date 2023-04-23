<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Echange
 *
 * @ORM\Table(name="echange", indexes={@ORM\Index(name="fk_Id", columns={"ID_user", "ID_produit"})})
 * @ORM\Entity
 */
class Echange
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_echange", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEchange;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_produit", type="integer", nullable=false)
     */
    private $idProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="Statut", type="string", length=255, nullable=false)
     */
    private $statut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_echange", type="date", nullable=false)
     */
    private $dateEchange;


}
