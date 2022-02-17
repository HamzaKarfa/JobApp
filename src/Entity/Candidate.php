<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
#[ORM\Entity(repositoryClass: CandidateRepository::class)]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"CUSTOM")]
    #[ORM\Column(type:'uuid', unique:true)]
    #[ORM\CustomIdGenerator(class:'Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator')]
    private $id;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $gender;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $country;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $nationality;

    #[ORM\Column(type: 'boolean')]
    private $passport = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $passport_file;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $curriculum_vitae;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $profil_picture;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $current_location;

    #[ORM\Column(type: 'date', nullable: true)]
    private $birthdate;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $birthplace;

    #[ORM\OneToOne(inversedBy: 'candidate', targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'boolean')]
    private $availability = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $short_description;

    #[ORM\ManyToOne(targetEntity: JobCategory::class, inversedBy: 'candidates')]
    private $job_category;

    #[ORM\ManyToOne(targetEntity: Experience::class, inversedBy: 'candidates')]
    private $experience;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updated_at;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getPassport(): ?bool
    {
        return $this->passport;
    }

    public function setPassport(bool $passport): self
    {
        $this->passport = $passport;

        return $this;
    }

    public function getPassportFile(): ?string
    {
        return $this->passport_file;
    }

    public function setPassportFile(?string $passport_file): self
    {
        $this->passport_file = $passport_file;

        return $this;
    }

    public function getCurriculumVitae(): ?string
    {
        return $this->curriculum_vitae;
    }

    public function setCurriculumVitae(?string $curriculum_vitae): self
    {
        $this->curriculum_vitae = $curriculum_vitae;

        return $this;
    }

    public function getProfilPicture(): ?string
    {
        return $this->profil_picture;
    }

    public function setProfilPicture(?string $profil_picture): self
    {
        $this->profil_picture = $profil_picture;

        return $this;
    }

    public function getCurrentLocation(): ?string
    {
        return $this->current_location;
    }

    public function setCurrentLocation(?string $current_location): self
    {
        $this->current_location = $current_location;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(?string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getJobCategory(): ?JobCategory
    {
        return $this->job_category;
    }

    public function setJobCategory(?JobCategory $job_category): self
    {
        $this->job_category = $job_category;

        return $this;
    }

    public function getExperience(): ?Experience
    {
        return $this->experience;
    }

    public function setExperience(?Experience $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
