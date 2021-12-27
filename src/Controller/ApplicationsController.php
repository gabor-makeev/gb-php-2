<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Company;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Данный контроллер отвечает на запросы вывода информации о всех приложениях
 * либо на запросы вывода информации об определенном приложении
*/

class ApplicationsController extends AbstractController
{
    // Route для вывода информации о всех приложениях
    #[Route('/applications', name: 'applications')]
    public function getApplications(ManagerRegistry $managerRegistry): Response
    {
        $applicationsManager = $managerRegistry->getRepository(Application::class);
        $companiesManager = $managerRegistry->getRepository(Company::class);
        $applications = $applicationsManager->findAll();
        // Ниже, для каждого приложения находится его компания-разработчик
        foreach ($applications as $application) {
            $company = $companiesManager->find($application->getCompanyId());
            $application->{"developedBy"} = $company->getName();
            $application->{"programmingLangs"} = [];
            /**
             * Ниже, в конечный объект (тот который будет передан в шаблон),
             * добавляется свойство хранящее массив из языков программирования,
             * на которых данное приложение было написано.
             * Я реализовал это перебором коллекции, которую возвращает метод
             * getProgrammingLanguages(). Между сущностями Application и ProgrammingLang
             * связь ManyToMany.
            */
            foreach ($application->getProgrammingLanguages() as $programmingLanguage) {
                $application->{"programmingLangs"}[] = $programmingLanguage->getName();
            }
        }
        return $this->render('applications/index.html.twig', [
            'applications' => $applications,
        ]);
    }
    // Route для вывода информации об определенном приложении
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
