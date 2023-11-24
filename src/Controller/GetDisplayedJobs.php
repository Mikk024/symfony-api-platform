<?php

namespace App\Controller;

use App\Repository\JobApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GetDisplayedJobs extends AbstractController
{
    public function __construct(private JobApplicationRepository $jobApplicationRepository)
    {
    }

    public function __invoke()
    {
        return $this->jobApplicationRepository->findBy(['displayed' => true]);
    }
}
