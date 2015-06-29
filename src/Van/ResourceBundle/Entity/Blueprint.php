<?php

namespace Van\ResourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Van\ResourceBundle\Model\Uploadable;

/**
 * Blueprint
 *
 * @ORM\Table(name="blueprints")
 * @ORM\Entity(repositoryClass="Van\ResourceBundle\Entity\BlueprintRepository")
 */
class Blueprint implements Uploadable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uploaded_at", type="datetime", nullable=true)
     */
    protected $uploadedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @var \Van\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Van\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="uploaded_by", nullable=true)
     */
    protected $uploadedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    protected $path;

    /**
     * @var int
     *
     * @ORM\Column(name="downloaded", type="integer")
     */
    protected $downloaded = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="smallint")
     */
    protected $enabled = true;

    /**
     * @var File $file
     */
    protected $file;

    /**
     * Set file
     *
     * @param string $file
     * @return Blueprint
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getWebPath()
    {
        return null === $this->getPath() ? null : '/'.$this->getUploadDir() . '/' . $this->getPath();
    }

    public function getAbsolutePath()
    {
        return null === $this->getPath() ? null : $this->getUploadRootDir() . '/' . $this->getPath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->getAbsolutePath())) {
            if ($file = $this->getAbsolutePath()) {
                unlink($file);
            }
        }
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../www/' . $this->getUploadDir();
    }

    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/resources/blueprints';
    }

    public function getFileExtension()
    {
        return pathinfo($this->getPath(), PATHINFO_EXTENSION);
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uploadedAt
     *
     * @param \DateTime $uploadedAt
     * @return Blueprint
     */
    public function setUploadedAt($uploadedAt)
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }

    /**
     * Get uploadedAt
     *
     * @return \DateTime 
     */
    public function getUploadedAt()
    {
        return $this->uploadedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Blueprint
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Blueprint
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Blueprint
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set uploadedBy
     *
     * @param \Van\UserBundle\Entity\User $uploadedBy
     * @return Blueprint
     */
    public function setUploadedBy(\Van\UserBundle\Entity\User $uploadedBy = null)
    {
        $this->uploadedBy = $uploadedBy;

        return $this;
    }

    /**
     * Get uploadedBy
     *
     * @return \Van\UserBundle\Entity\User 
     */
    public function getUploadedBy()
    {
        return $this->uploadedBy;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Blueprint
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set downloaded
     *
     * @param string $downloaded
     * @return Blueprint
     */
    public function setDownloaded($downloaded)
    {
        $this->downloaded = $downloaded;

        return $this;
    }

    /**
     * Get downloaded
     *
     * @return string
     */
    public function getDownloaded()
    {
        return $this->downloaded;
    }

    /**
     * Set enabled
     *
     * @param string $enabled
     * @return Blueprint
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return string
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
