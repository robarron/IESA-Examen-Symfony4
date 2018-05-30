<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $auteur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Single", mappedBy="album")
     */
    private $single;

    public function __construct()
    {
        $this->single = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection|Single[]
     */
    public function getSingle(): Collection
    {
        return $this->single;
    }

    public function addSingle(Single $single): self
    {
        if (!$this->single->contains($single)) {
            $this->single[] = $single;
            $single->setAlbum($this);
        }

        return $this;
    }

    public function removeSingle(Single $single): self
    {
        if ($this->single->contains($single)) {
            $this->single->removeElement($single);
            // set the owning side to null (unless already changed)
            if ($single->getAlbum() === $this) {
                $single->setAlbum(null);
            }
        }

        return $this;
    }
}
