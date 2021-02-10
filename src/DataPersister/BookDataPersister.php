<?php

namespace App\DataPersister;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class BookDataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;

    public function __construct( EntityManagerInterface $entityManger)
    {
        $this->_entityManager = $entityManger;                
    }

    /**
    * {@inheritdoc}
    */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Book;
    }

    /**
     * @param Customer $data
     */
    public function persist($data, array $context = [])
    {
        $data->setCreatedAt(new \DateTime("now", new \DateTimeZone('Europe/Paris')));

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();

    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}


?>