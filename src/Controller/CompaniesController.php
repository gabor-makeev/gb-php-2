<?php

namespace App\Controller;

use App\Entity\Company;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompaniesController extends AbstractController
{
    #[Route('/companies', name: 'companies')]
    public function getCompanies(ManagerRegistry $managerRegistry): Response
    {
        $manager = $managerRegistry->getRepository(Company::class);
        $companies = $manager->findAll();
        return $this->render('companies/index.html.twig', [
            'companies' => $companies,
        ]);
    }
    #[Route('/companies/{company_id}', name: 'company')]
    public function getCompany($company_id, ManagerRegistry $managerRegistry): Response
    {
        $manager = $managerRegistry->getRepository(Company::class);
        $company = $manager->find($company_id);
        return $this->render('companies/index.html.twig', [
            'company' => $company,
        ]);
    }
}
