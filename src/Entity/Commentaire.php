<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="IDX_67F068BC4B89032C", columns={"post_id"})})
 * @ORM\Entity
 */
class Commentaire
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
     * @ORM\Column(name="nomuser", type="string", length=255, nullable=false)
     */
    private $nomuser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagec", type="string", length=255, nullable=true)
     */
    private $imagec;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionc", type="string", length=255, nullable=false)
     */
    private $descriptionc;

    /**
     * @var string
     *
     * @ORM\Column(name="datec", type="string", length=50, nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datec = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     *
     * @ORM\Column(name="analyse_co", type="string", length=255, nullable=true)
     */
    private $analyseCo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datec_ts", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datecTs = 'CURRENT_TIMESTAMP';

    /**
     * @var \Post
     *
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;


}
