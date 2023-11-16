<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass=TopicRepository::class)
 */
class Topic
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtopic", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtopic;

    /**
     * @var string
     *
     * @ORM\Column(name="topicName", type="string", length=255, nullable=false)
     */
    private $topicname;

    public function getIdtopic(): ?int
    {
        return $this->idtopic;
    }

    public function getTopicname(): ?string
    {
        return $this->topicname;
    }

    public function setTopicname(string $topicname): static
    {
        $this->topicname = $topicname;

        return $this;
    }


}
