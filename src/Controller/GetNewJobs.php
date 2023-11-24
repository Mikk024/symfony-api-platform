<?php

namespace App\Controller;

use App\Repository\JobApplicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetNewJobs extends AbstractController
{
    public function __construct(private JobApplicationRepository $jobApplicationRepository, private EntityManagerInterface $entityManager)
    {
        
    }

    public function __invoke()
    {
        $jobs = $this->jobApplicationRepository->findBy(['displayed' => false]);

        foreach ($jobs as $job) {
            $job->setDisplayed(true);
            $this->entityManager->persist($job);
        }

        $this->entityManager->flush();

        return $jobs;
    }
}




?>