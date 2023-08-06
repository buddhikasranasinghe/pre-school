<?php

namespace Domain\Registration\DTO;

class ApplicationDTO
{
    protected $uuid;
    protected $full_name;
    protected $gender;
    protected $birthday;
    protected $birth_weight;
    protected $current_weight;
    protected $mother_full_name;
    protected $farther_full_name;
    protected $guardiant_full_name;
    protected $permenent_address;
    protected $home_contact_number;
    protected $personal_contact_number;
    protected $email_address;
    protected $emergency_informer_name;
    protected $emergency_informer_contact_number;

    public function __construct(
        array $data
    )
    {
        $this->uuid = $data['uuid'];
        $this->full_name = $data['full_name'];
        $this->gender = $data['gender'];
        $this->birthday = $data['birthday'];
        $this->birth_weight = $data['birth_weight'];
        $this->current_weight = $data['current_weight'];
        $this->mother_full_name = $data['mother_full_name'];
        $this->farther_full_name = $data['farther_full_name'];
        $this->guardiant_full_name = $data['guardiant_full_name'];
        $this->permenent_address = $data['permenent_address'];
        $this->home_contact_number = $data['home_contact_number'];
        $this->personal_contact_number = $data['personal_contact_number'];
        $this->email_address = $data['email_address'];
        $this->emergency_informer_name = $data['emergency_informer_name'];
        $this->emergency_informer_contact_number = $data['emergency_informer_contact_number'];
    }

    public function data(): array
    {
        return [
            "uuid" => $this->uuid,
            "full_name" => $this->full_name,
            "gender" => $this->gender,
            "birthday" => $this->birthday,
            "birth_weight" => $this->birth_weight,
            "current_weight" => $this->current_weight,
            "mother_full_name" => $this->mother_full_name,
            "farther_full_name" => $this->farther_full_name,
            "guardiant_full_name" => $this->guardiant_full_name,
            "permenent_address" => $this->permenent_address,
            "home_contact_number" => $this->home_contact_number,
            "personal_contact_number" => $this->personal_contact_number,
            "email_address" => $this->email_address,
            "emergency_informer_name" => $this->emergency_informer_name,
            "emergency_informer_contact_number" => $this->emergency_informer_contact_number
        ];
    }
}
