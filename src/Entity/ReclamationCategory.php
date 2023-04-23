<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReclamationCategory
 *
 * @ORM\Table(name="reclamation_category")
 * @ORM\Entity
 */
class ReclamationCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description_cat", type="string", length=50, nullable=false)
     */
    private $descriptionCat;


}
