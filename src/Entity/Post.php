<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity
 */
class Post
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
     * @ORM\Column(name="sujet", type="string", length=255, nullable=false)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_jaime", type="integer", nullable=false)
     */
    private $nbrJaime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_user", type="string", length=255, nullable=false)
     */
    private $nomUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_p", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateP = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="communaute", type="string", length=255, nullable=false)
     */
    private $communaute;

    /**
     * @var string|null
     *
     * @ORM\Column(name="analyse_po", type="string", length=255, nullable=true)
     */
    private $analysePo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="liked", type="integer", nullable=true)
     */
    private $liked = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="badlevel", type="integer", nullable=true)
     */
    private $badlevel = '0';


}
