<?php

namespace App\Services;

use App\Survey;
use Illuminate\Support\Collection;

class SurveyService
{
    protected $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function evaluate(Collection $payload): bool {
        $evaluating = true;

        // spread the keys into local vars
        foreach ($payload as $key => $value) {
            $$key = $value;
        }

        // evaluate each section rule
        foreach ($this->survey->sections as $section) {
            if ($section->required) {
                foreach ($section->rules as $rule) {
                    $evaluate = null;
                    eval('$evaluate = ' . $rule->body . ";");
                    if (!$evaluate) {
                        return false;
                    }
                }
            }
        }

        return $evaluating;
    }
}
