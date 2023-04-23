<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conv
 *
 * @ORM\Table(name="conv", indexes={@ORM\Index(name="fk_iduser1", columns={"idconv_user"}), @ORM\Index(name="fk_iduser2", columns={"idconv_user2"})})
 * @ORM\Entity
 */
class Conv
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
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idconv_user2", referencedColumnName="id")
     * })
     */
    private $idconvUser2;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idconv_user", referencedColumnName="id")
     * })
     */
    private $idconvUser;


}
