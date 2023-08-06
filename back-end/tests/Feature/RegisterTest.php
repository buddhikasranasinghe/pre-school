<?php

namespace Tests\Feature;

use Domain\Registration\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected $credentials;

    public function setUp(): void
    {
        parent::setUp();
        $this->credentials = [
            "uuid" => '550e8400-e29b-41d4-a716-446655440000',
            "full_name" => 'jayasinghe mudiyanselage buddhika sandamal ransinghe',
            "gender" => "MALE",
            "birthday" => '1996/05/31',
            "birth_weight" => "1.5",
            "current_weight" => "2.5",
            "mother_full_name" => "wicramasinghe arachchige ayrangani kumari manike",
            "farther_full_name" => "jayasinghe mudiyanselage ranasinghe banda",
            "guardiant_full_name" => "jayasinghe mudiyanselage ranasinghe banda",
            "permenent_address" => "no 9/1, dematagolla, naramapanawa",
            "home_contact_number" => "+94712447339",
            "personal_contact_number" => "1452364594",
            "email_address" => "buddhikasransinghe96@gmail.com",
            "emergency_informer_name" => " buddhika s. ranasinghe",
            "emergency_informer_contact_number" => "0712447339"
        ];

    }

    /** @test */
    public function userAbleToSubmitApplication()
    {
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(200);
        $this->assertCount(1, Application::all());
        $response->assertJsonFragment([
            'status' => 200,
            'message' => 'Application Submited Successfully'
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithoutEmptyStudentName()
    {
        $this->credentials['full_name'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Student name can\'t be empty',
            'errors' => [
                'full_name' => [
                    'Student name can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithNoneAlpheticChractorsAsStudentName()
    {
        $this->credentials['full_name'] = 'dgdkfgh dkfhg#$#$# 45654 kdfhgj $';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied charactors in student name',
            'errors' => [
                'full_name' => [
                    'Invalied charactors in student name'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithoutChoosingGender()
    {
        $this->credentials['gender'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Gender can\'t be empty',
            'errors' => [
                'gender' => [
                    'Gender can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithoutChoosingBirthday()
    {
        $this->credentials['birthday'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Birthday can\'t be empty',
            'errors' => [
                'birthday' => [
                    'Birthday can\'t be empty'
                ]
            ]
        ]);
    }
    
    /** @test */
    public function userNotAbleToSubmitApplicationWithWrongBirthdayDateFormat()
    {
        $this->credentials['birthday'] = '45.787878.79';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Birthday should be a date',
            'errors' => [
                'birthday' => [
                    'Birthday should be a date'
                ]
            ]
        ]);
    }
    
    /** @test */
    public function userNotAbleToSubmitApplicationWithEmptyBirthWeight()
    {
        $this->credentials['birth_weight'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Birth weight can\'t be empty',
            'errors' => [
                'birth_weight' => [
                    'Birth weight can\'t be empty'
                ]
            ]
        ]);
    }
    
    /** @test */
    public function userNotAbleToSubmitApplicationWithNoneNumericValueAsBirthWeight()
    {
        $this->credentials['birth_weight'] = 'sdfgdsgdf';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Birth weight shoud be numeric value',
            'errors' => [
                'birth_weight' => [
                    'Birth weight shoud be numeric value'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithEmptyCurrentWeight()
    {
        $this->credentials['current_weight'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Current weight can\'t be empty',
            'errors' => [
                'current_weight' => [
                    'Current weight can\'t be empty'
                ]
            ]
        ]);
    }
    
    /** @test */
    public function userNotAbleToSubmitApplicationWithNoneNumericValueAsCurrentWeight()
    {
        $this->credentials['current_weight'] = 'sdf';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Current weight shoud be numeric value',
            'errors' => [
                'current_weight' => [
                    'Current weight shoud be numeric value'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAllowedToSubmitApplicationWithEmptyMothersName()
    {
        $this->credentials['mother_full_name'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Mother\'s name can\'t be empty',
            'errors' => [
                'mother_full_name' => [
                    'Mother\'s name can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAllowedToSubmitApplicationWithNonAlpheticCharactorsAsMothersName()
    {
        $this->credentials['mother_full_name'] = 'dfkg hkdf %&%^& dfgd545 d545';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied charactors in mother\'s name',
            'errors' => [
                'mother_full_name' => [
                    'Invalied charactors in mother\'s name'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAllowedToSubmitApplicationWithEmptyFathersName()
    {
        $this->credentials['farther_full_name'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Farther\'s name can\'t be empty',
            'errors' => [
                'farther_full_name' => [
                    'Farther\'s name can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAllowedToSubmitApplicationWithNonAlpheticCharactorsAsFathersName()
    {
        $this->credentials['farther_full_name'] = 'dfkg hkdf %&%^& dfgd545 d545';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied charactors in farther\'s name',
            'errors' => [
                'farther_full_name' => [
                    'Invalied charactors in farther\'s name'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitWithEmptyGuardientName()
    {
        $this->credentials['guardiant_full_name'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Guardiant\'s name can\'t be empty',
            'errors' => [
                'guardiant_full_name' => [
                    'Guardiant\'s name can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function useruserNotAllowedToSubmitApplicationWithNonAlpheticCharactorsAsFathersName()
    {
        $this->credentials['guardiant_full_name'] = 'dfkg hkdf %&%^& dfgd545 d545';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied charactors in guardiant\'s name',
            'errors' => [
                'guardiant_full_name' => [
                    'Invalied charactors in guardiant\'s name'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithEmptyPermenentAddress()
    {
        $this->credentials['permenent_address'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Permenent address can\'t be empty',
            'errors' => [
                'permenent_address' => [
                    'Permenent address can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedPermenentAddress()
    {
        $this->credentials['permenent_address'] = 'sdkhfksd, $73647 jsdhf **&&*';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied charactors in permenent address',
            'errors' => [
                'permenent_address' => [
                    'Invalied charactors in permenent address'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithEmptyHomeContactNumber()
    {
        $this->credentials['home_contact_number'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Home contact number can\'t be empty',
            'errors' => [
                'home_contact_number' => [
                    'Home contact number can\'t be empty'
                ]
            ]
        ]);
    }
    
    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedHomeContactNumber()
    {
        $this->credentials['home_contact_number'] = '+%#hkdf ghhd';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'home_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedLowLengthOfHomeContactNumber()
    {
        $this->credentials['home_contact_number'] = '+182345678';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'home_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedHighLengthOfHomeContactNumber()
    {
        $this->credentials['home_contact_number'] = '+182345456678';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'home_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAllowedToSubmitApplicationWithEmptyPersonalContactNumber()
    {
        $this->credentials['personal_contact_number'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Personal contact number can\'t be empty',
            'errors' => [
                'personal_contact_number' => [
                    'Personal contact number can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedPersonalContactNumber()
    {
        $this->credentials['personal_contact_number'] = '+%#hkdf ghhd';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'personal_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedLowLengthOfPersonalContactNumber()
    {
        $this->credentials['personal_contact_number'] = '+182345678';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'personal_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedHighLengthOfPersonalContactNumber()
    {
        $this->credentials['personal_contact_number'] = '+182345456678';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'personal_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithEmptyEmailAddress()
    {
        $this->credentials['email_address'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Email can\'t be empty',
            'errors' => [
                'email_address' => [
                    'Email can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedEmailAddress()
    {
        $this->credentials['email_address'] = 'dgdfgfdg@fghfgh@';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied email address',
            'errors' => [
                'email_address' => [
                    'Invalied email address'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithEmptyEmergancyInfermerName()
    {
        $this->credentials['emergency_informer_name'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Emergency informar name can\'t be empty',
            'errors' => [
                'emergency_informer_name' => [
                    'Emergency informar name can\'t be empty'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedEmergancyInfermerName()
    {
        $this->credentials['emergency_informer_name'] = '#$dfgdfg ^$^$ 234234';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied emergency informer name',
            'errors' => [
                'emergency_informer_name' => [
                    'Invalied emergency informer name'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithEmptyEmergencyInformerContactNumber()
    {
        $this->credentials['emergency_informer_contact_number'] = '';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Emergency informer contact number can\'t be empty',
            'errors' => [
                'emergency_informer_contact_number' => [
                    'Emergency informer contact number can\'t be empty'
                ]
            ]
        ]);
    }

    
    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedEmergencyInformerContactNumber()
    {
        $this->credentials['emergency_informer_contact_number'] = '+%#hkdf ghhd';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'emergency_informer_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedLowLengthOfEmergencyInformerContactNumber()
    {
        $this->credentials['emergency_informer_contact_number'] = '+182345678';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'emergency_informer_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }

    /** @test */
    public function userNotAbleToSubmitApplicationWithInvaliedHighLengthOfEmergencyInformerContactNumber()
    {
        $this->credentials['emergency_informer_contact_number'] = '+182345456678';
        $response = $this->postJson('api/register', $this->credentials);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'Invalied contact number',
            'errors' => [
                'emergency_informer_contact_number' => [
                    'Invalied contact number'
                ]
            ]
        ]);
    }
}
