<?php

namespace App\Http\Controllers;

use App\Business\TestBus;
use App\Business\GradeBus;
use Illuminate\Http\Request;
use App\Business\QuestionBus;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    private $testBus;
    private $questionBus;
    private $gradeBus;
    private function getTestBus ()
    {
        if ($this->testBus == null)
        {
            $this->testBus = new TestBus();
        }
        return $this->testBus;
    }
    private function getQuestionBus ()
    {
        if ($this->questionBus == null)
        {
            $this->questionBus = new QuestionBus();
        }
        return $this->questionBus;
    }
    private function getGradeBus ()
    {
        if ($this->gradeBus == null)
        {
            $this->gradeBus = new GradeBus();
        }
        return $this->gradeBus;
    }

    public function index ()
    {
        $apiResult = $this->getTestBus()->getAll();
        $viewData = [
            'tests' => $apiResult->tests,
        ];

        return view('test.index', $viewData);
    }

    public function create ()
    {
        $apiResult = $this->getGradeBus()->getAllId();
        $viewData = [
            'durations' => [5, 10, 15, 20, 25, 30, 45, 60, 90],
            'quantity' => [5, 10, 12, 15, 20, 30, 35, 40, 45, 50, 60],
            'grades' => $apiResult->grades
        ];

        return view('test.create', $viewData);
    }

    public function store (TestRequest $testRequest)
    {

    }

    public function edit ($testId)
    {
    
    }

    public function update (TestRequest $testRequest)
    {
        
    }
}
