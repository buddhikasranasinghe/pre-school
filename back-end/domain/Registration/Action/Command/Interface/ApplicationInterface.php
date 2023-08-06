<?php

namespace Domain\Registration\Action\Command\Interface;

use Domain\Registration\DTO\ApplicationDTO;

interface ApplicationInterface
{
    public function submit(ApplicationDTO $application): void;
}
