<?php

namespace Tests\Unit;

use App\Survey;
use App\Services\SurveyService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SurveyServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testIsLoanValid()
    {
        $this->seed();

        $surveyService = new SurveyService(Survey::first());
        $payload = collect([
            'annual_income' => 50000,
            'borrower_trustworthiness' => 'trustworthy',
            'borrower_age' => 35,
            'loan_length_in_months' => 11,
            'loan_amount' => 100000,
        ]);

        $this->assertTrue($surveyService->evaluate($payload));
    }

    public function testLoanAmountIsThreeTimesMoreAnnualIncome()
    {
        $this->seed();

        $surveyService = new SurveyService(Survey::first());
        $payload = collect([
            'annual_income' => 50000,
            'borrower_trustworthiness' => 'trustworthy',
            'borrower_age' => 35,
            'loan_length_in_months' => 11,
            'loan_amount' => 200000,
        ]);

        $this->assertFalse($surveyService->evaluate($payload));
    }

    public function testLoanLenghtIsMoreThenTwelveMonths()
    {
        $this->seed();

        $surveyService = new SurveyService(Survey::first());
        $payload = collect([
            'annual_income' => 50000,
            'borrower_trustworthiness' => 'trustworthy',
            'borrower_age' => 35,
            'loan_length_in_months' => 24,
            'loan_amount' => 100000,
        ]);

        $this->assertFalse($surveyService->evaluate($payload));
    }
}
