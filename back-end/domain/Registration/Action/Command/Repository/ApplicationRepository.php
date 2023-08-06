<?php

namespace Domain\Registration\Action\Command\Repository;

use Domain\Registration\Action\Command\Interface\ApplicationInterface;
use Domain\Registration\DTO\ApplicationDTO;
use Domain\Registration\Models\Application;
use Exception;

class ApplicationRepository implements ApplicationInterface
{
    public function submit(ApplicationDTO $application): void
    {
        Application::create($application->data());
    }
}
