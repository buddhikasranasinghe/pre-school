<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PreSchoolApplicationRequest;
use Domain\Registration\Action\Command\Interface\ApplicationInterface;
use Domain\Registration\DTO\ApplicationDTO;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    protected ApplicationInterface $applicationInterface;
    protected ApplicationDTO $applicationDTO;
    protected $uuid;

    public function __construct(
        ApplicationInterface $applicationInterface
    )
    {
        $this->applicationInterface = $applicationInterface;
        $this->uuid = Uuid::uuid4()->toString();
    }

    public function register(PreSchoolApplicationRequest $request): JsonResponse
    {
        $input_data = [
            "uuid" => $this->uuid,
            "full_name" => $request->input('full_name'),
            "gender" => $request->input('gender'),
            "birthday" => $request->input('birthday'),
            "birth_weight" => $request->input('birth_weight'),
            "current_weight" => $request->input('current_weight'),
            "mother_full_name" => $request->input('mother_full_name'),
            "farther_full_name" => $request->input('farther_full_name'),
            "guardiant_full_name" => $request->input('guardiant_full_name'),
            "permenent_address" => $request->input('permenent_address'),
            "home_contact_number" => $request->input('home_contact_number'),
            "personal_contact_number" => $request->input('personal_contact_number'),
            "email_address" => $request->input('email_address'),
            "emergency_informer_name" => $request->input('emergency_informer_name'),
            "emergency_informer_contact_number" => $request->input('emergency_informer_contact_number')
        ];
        $this->applicationDTO = new ApplicationDTO($input_data);
        $this->applicationInterface->submit($this->applicationDTO);
        return response()->json([
            'status' => 200,
            'message' => 'Application Submited Successfully'
        ]);
    }
}
