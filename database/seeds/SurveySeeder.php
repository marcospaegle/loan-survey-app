<?php

use App\Rule;
use App\Section;
use App\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $surveys = [
            [
                'name' => 'Consumer Loan Eligibility Survey',
                'description' => 'Rules that determine whether the consumer loan application should be accepted or rejected',
            ],
        ];

        $sections = [
            [
                'name' => 'Borrower Age',
                'description' => 'Borrower Age Section',
                'required' => false,
                'rules' => ['$borrower_age > 21', '$borrower_age < 75'],
            ],
            [
                'name' => 'Affordability',
                'description' => 'Affordability Section',
                'required' => true,
                'rules' => ['$annual_income > 40000', '$loan_amount < 3 * $annual_income'],
            ],
            [
                'name' => 'Finance',
                'description' => 'Finance Section',
                'required' => true,
                'rules' => ['$loan_length_in_months < 12', '$loan_amount < 500000'],
            ]
        ];

        $rules = [
            ['body' => '$borrower_age > 21'],
            ['body' => '$borrower_age < 75'],
            ['body' => '$annual_income > 40000'],
            ['body' => '$loan_amount < 3 * $annual_income'],
            ['body' => '$loan_length_in_months < 12'],
            ['body' => '$loan_amount < 500000'],
        ];

        foreach ($rules as $attributes) {
            $rule = new Rule($attributes);
            $rule->save();
        }

        foreach ($surveys as $attributes) {
            $survey = new Survey($attributes);
            $survey->save();

//            $sections = Section::all()->pluck('id');
//            $survey->sections($sections);
//
//            $survey->save();
        }

        foreach ($sections as $attributes) {
            $rules = Rule::whereIn('body', $attributes['rules'])->get()->pluck('id');
            $survey = Survey::first();

            unset($attributes['rules']);
            $attributes['survey_id'] = $survey->id;

            $section = new Section($attributes);
            $section->save();

            $section->rules()->attach($rules);
            $section->save();
        }
    }
}
