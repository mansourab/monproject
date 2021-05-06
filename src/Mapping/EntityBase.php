<?php

namespace App\Mapping;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;


/**
 * @ORM\HasLifecycleCallbacks
 */
abstract class EntityBase
{
    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;


    /**
     * @var DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;



    public function getCreatedAt() :?DateTime
    {
        return $this->createdAt;
    }



    public function getUpdatedAt() :?DateTime
    {
        return $this->updatedAt;
    }
    
    
}
