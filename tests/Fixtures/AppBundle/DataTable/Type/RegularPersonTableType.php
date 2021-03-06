<?php

/*
 * Symfony DataTables Bundle
 * (c) Omines Internetbureau B.V. - https://omines.nl/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Fixtures\AppBundle\DataTable\Type;

use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\DataTableTypeInterface;

/**
 * RegularPersonTableType.
 *
 * @author Niels Keurentjes <niels.keurentjes@omines.com>
 */
class RegularPersonTableType implements DataTableTypeInterface
{
    /**
     * {@inheritdoc}
     */
    public function configure(DataTable $dataTable)
    {
        $dataTable
            ->add('firstName', TextColumn::class)
            ->add('lastName', TextColumn::class)
            ->createAdapter(ArrayAdapter::class, [
                ['firstName' => 'Donald', 'lastName' => 'Trump'],
                ['firstName' => 'Barack', 'lastName' => 'Obama'],
                ['firstName' => 'George W.', 'lastName' => 'Bush'],
                ['firstName' => 'Bill', 'lastName' => 'Clinton'],
                ['firstName' => 'George H.W.', 'lastName' => 'Bush'],
                ['firstName' => 'Ronald', 'lastName' => 'Reagan'],
            ])
        ;
    }
}
