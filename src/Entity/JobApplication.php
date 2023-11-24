<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\GetDisplayedJobs;
use App\Controller\GetNewJobs;
use App\Repository\JobApplicationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JobApplicationRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[
    ApiResource(
        denormalizationContext: ['groups' => ['write']],
        operations: [
        new GetCollection(),
        new GetCollection(
            uriTemplate: '/job_applications/displayed',
            controller: GetDisplayedJobs::class,
        ),
        new GetCollection(
            uriTemplate: '/job_applications/new',
            controller: GetNewJobs::class,
        ),
        new Get(),
        new Post()
        ],
        filters: ['job_application.order_filter']
    ),
]
class JobApplication
{
    const ROLE_JUNIOR = 'Junior';
    const ROLE_REGULAR = 'Regular';
    const ROLE_SENIOR = 'Senior';


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('write')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups('write')]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups('write')]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups('write')]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Groups('write')]
    private ?int $phoneNumber = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Groups('write')]
    private ?int $expectedSalary = null;

    #[ORM\Column(length: 255)]
    #[Groups('write')]
    private ?string $level = null;

    #[ORM\Column]
    private ?bool $displayed = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getExpectedSalary(): ?int
    {
        return $this->expectedSalary;
    }

    public function setExpectedSalary(int $expectedSalary): static
    {
        $this->expectedSalary = $expectedSalary;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    #[ORM\PrePersist]
    public function setLevel(): static
    {
        switch (true) {
            case $this->expectedSalary < 5000:
                $this->level = self::ROLE_JUNIOR;
                break;
            case $this->expectedSalary < 10000:
                $this->level = self::ROLE_REGULAR;
                break;
            case $this->expectedSalary >= 10000:
                $this->level = self::ROLE_SENIOR;
                break;
            default:
                break;
        }

        return $this;
    }

    public function isDisplayed(): ?bool
    {
        return $this->displayed;
    }

    public function setDisplayed(bool $displayed): static
    {
        $this->displayed = $displayed;

        return $this;
    }
}
