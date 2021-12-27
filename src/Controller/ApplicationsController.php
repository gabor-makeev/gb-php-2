<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Company;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationsController extends AbstractController
{
    #[Route('/applications', name: 'applications')]
    public function getApplications(ManagerRegistry $managerRegistry): Response
    {
        $applicationsManager = $managerRegistry->getRepository(Application::class);
        $companiesManager = $managerRegistry->getRepository(Company::class);
        $applications = $applicationsManager->findAll();
        foreach ($applications as $application) {
            $company = $companiesManager->find($application->getCompanyId());
            $application->{"developedBy"} = $company->getName();
            $application->{"programmingLangs"} = [];
            foreach ($application->getProgrammingLanguages() as $programmingLanguage) {
                $application->{"programmingLangs"}[] = $programmingLanguage->getName();
            }
        }
        return $this->render('applications/index.html.twig', [
            'applications' => $applications,
        ]);
    }
    #[Route('/applications/{application_id}', name: 'application')]
    public function getApplication($application_id, ManagerRegistry $managerRegistry): Response
    {
        $applicationsManager = $managerRegistry->getRepository(Application::class);
        $companiesManager = $managerRegistry->getRepository(Company::class);
        $application = $applicationsManager->find($application_id);
        $company = $companiesManager->find($application->getCompanyId());
        $application->{"developedBy"} = $company->getName();
        foreach ($application->getProgrammingLanguages() as $programmingLanguage) {
            $application->{"programmingLangs"}[] = $programmingLanguage->getName();
        }

        return $this->render('applications/index.html.twig', [
            'application' => $application,
        ]);
    }
}
