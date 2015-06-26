<?php

namespace Van\ResourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Van\ResourceBundle\Model\Uploadable;

/**
 * Class Resource
 * @package Van\ResourceBundle\Entity
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class AbstractResource implements Uploadable
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
     * @ORM\Column(name="uploaded_at", type="datetime")
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    protected $path;

    /**
     * @var File $file
     */
    protected $file;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->uploadedAt = new \DateTime();
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getWebPath()
    {
        return null === $this->getFile() ? null : '/'.$this->getUploadDir() . '/' . $this->getFile();
    }

    public function getAbsolutePath()
    {
        return null === $this->getFile() ? null : $this->getUploadRootDir() . '/' . $this->getFile();
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

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/resources';
    }

    public function getFileExtension()
    {
        return pathinfo($this->getLocation(), PATHINFO_EXTENSION);
    }

}
