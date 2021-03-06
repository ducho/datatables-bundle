<?php

/*
 * Symfony DataTables Bundle
 * (c) Omines Internetbureau B.V. - https://omines.nl/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Fixtures\AppBundle\Controller;

use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Controller\DataTablesTrait;
use Omines\DataTablesBundle\DataTable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Tests\Fixtures\AppBundle\Entity\Person;

/**
 * PlainController.
 *
 * @author Niels Keurentjes <niels.keurentjes@omines.com>
 */
class PlainController extends Controller
{
    use DataTablesTrait;

    public function tableAction(Request $request)
    {
        $datatable = $this->createDataTable()
            ->setName('persons')
            ->setDefaultSort('lastName', DataTable::SORT_ASCENDING)
            ->add('id', TextColumn::class, ['field' => 'person.id'])
            ->add('firstName', TextColumn::class)
            ->add('lastName', TextColumn::class, ['field' => 'person.lastName'])
            ->add('employedSince', DateTimeColumn::class, ['format' => 'd-m-Y'])
            ->add('fullName', TextColumn::class, [
                'data' => function (Person $person) {
                    return $person->getFirstName() . ' <img src="https://symfony.com/images/v5/logos/sf-positive.svg"> ' . $person->getLastName();
                },
            ])
            ->add('employer', TextColumn::class, ['field' => 'company.name'])
            ->add('buttons', TextColumn::class, [
                'raw' => true,
                'data' => '<button>Click me</button>',
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Person::class,
            ])
        ;

        return $datatable->handleRequest($request)->getResponse();
    }
}
