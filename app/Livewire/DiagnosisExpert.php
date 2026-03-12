<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Services\DiagnosisKnowledgeBase;
use Livewire\Component;

class DiagnosisExpert extends Component
{
    // State management
    public $step = 'select_device'; // select_device, welcome, questions, result, booking, success
    public $currentCategory = 0;
    public $currentQuestionIndex = 0;

    // Device type
    public $selectedDeviceType = null;

    // Data
    public $categories = [];
    public $symptoms = [];
    public $selectedSymptoms = [];
    public $diagnosisResults = [];
    public $aiRecommendation = '';
    public $isLoadingAI = false;

    // Booking form
    public $bookingForm = [
        'name' => '',
        'phone' => '',
        'address' => '',
        'device_brand' => '',
        'device_name' => '',
        'serial_number' => '',
        'complaint' => '',
    ];
    public $bookingCode = '';

    public function mount()
    {
        // Don't load symptoms until device is selected
    }

    public function selectDevice(string $type): void
    {
        if (!array_key_exists($type, DiagnosisKnowledgeBase::DEVICE_TYPES)) return;

        $this->selectedDeviceType = $type;
        $this->loadSymptoms();
        $this->step = 'welcome';
    }

    protected function loadSymptoms()
    {
        $deviceType = $this->selectedDeviceType ?? 'laptop';
        $allSymptoms = DiagnosisKnowledgeBase::getSymptoms($deviceType);
        $categories = DiagnosisKnowledgeBase::getCategoriesForDevice($deviceType);

        // Group symptoms by category
        $this->categories = [];
        foreach ($categories as $key => $name) {
            $categorySymptoms = array_filter($allSymptoms, function ($s) use ($key) {
                return $s['category'] === $key;
            });

            if (!empty($categorySymptoms)) {
                $this->categories[] = [
                    'key' => $key,
                    'name' => $name,
                    'symptoms' => $categorySymptoms,
                ];
            }
        }

        $this->symptoms = $allSymptoms;
    }

    public function startDiagnosis()
    {
        $this->step = 'questions';
        $this->currentCategory = 0;
        $this->currentQuestionIndex = 0;
        $this->selectedSymptoms = [];
    }

    public function answerQuestion(string $symptomCode, bool $answer)
    {
        if ($answer) {
            $this->selectedSymptoms[] = $symptomCode;
        }

        $this->nextQuestion();
    }

    protected function nextQuestion()
    {
        $currentCat = $this->categories[$this->currentCategory] ?? null;

        if (!$currentCat) {
            $this->processDiagnosis();
            return;
        }

        $symptomCodes = array_keys($currentCat['symptoms']);

        if ($this->currentQuestionIndex < count($symptomCodes) - 1) {
            $this->currentQuestionIndex++;
        } else {
            // Move to next category
            if ($this->currentCategory < count($this->categories) - 1) {
                $this->currentCategory++;
                $this->currentQuestionIndex = 0;
            } else {
                // All questions answered
                $this->processDiagnosis();
            }
        }
    }

    public function skipCategory()
    {
        if ($this->currentCategory < count($this->categories) - 1) {
            $this->currentCategory++;
            $this->currentQuestionIndex = 0;
        } else {
            $this->processDiagnosis();
        }
    }

    public function processDiagnosis()
    {
        if (empty($this->selectedSymptoms)) {
            $this->diagnosisResults = [];
        } else {
            $this->diagnosisResults = DiagnosisKnowledgeBase::diagnose($this->selectedSymptoms, $this->selectedDeviceType ?? 'laptop');
        }

        $this->step = 'result';
    }

    public function showBookingForm()
    {
        // Pre-fill complaint from symptoms
        $symptomDetails = DiagnosisKnowledgeBase::getSymptomDetails($this->selectedSymptoms, $this->selectedDeviceType ?? 'laptop');
        $complaints = array_map(fn($s) => str_replace('Apakah ', '', str_replace('?', '', $s['question'])), $symptomDetails);
        $this->bookingForm['complaint'] = implode(', ', $complaints);

        $this->step = 'booking';
    }

    public function saveBooking()
    {
        $this->validate([
            'bookingForm.name' => 'required|min:3',
            'bookingForm.phone' => 'required|min:10',
            'bookingForm.device_brand' => 'required',
            'bookingForm.device_name' => 'required',
            'bookingForm.complaint' => 'required|min:10',
        ], [
            'bookingForm.name.required' => 'Nama lengkap wajib diisi',
            'bookingForm.name.min' => 'Nama minimal 3 karakter',
            'bookingForm.phone.required' => 'Nomor WhatsApp wajib diisi',
            'bookingForm.phone.min' => 'Nomor WhatsApp minimal 10 digit',
            'bookingForm.device_brand.required' => 'Merek laptop wajib diisi',
            'bookingForm.device_name.required' => 'Tipe laptop wajib diisi',
            'bookingForm.complaint.required' => 'Keluhan wajib diisi',
            'bookingForm.complaint.min' => 'Keluhan minimal 10 karakter',
        ]);

        $booking = Booking::create([
            'booking_code' => Booking::generateBookingCode(),
            'name' => $this->bookingForm['name'],
            'phone' => $this->bookingForm['phone'],
            'address' => $this->bookingForm['address'],
            'device_brand' => $this->bookingForm['device_brand'],
            'device_name' => $this->bookingForm['device_name'],
            'serial_number' => $this->bookingForm['serial_number'],
            'complaint' => $this->bookingForm['complaint'],
            'symptoms' => $this->selectedSymptoms,
            'diagnosis_result' => $this->diagnosisResults,
            'ai_recommendation' => $this->aiRecommendation,
            'status' => 'pending',
        ]);

        $this->bookingCode = $booking->booking_code;
        $this->step = 'success';
    }

    public function resetDiagnosis()
    {
        $this->step = 'select_device';
        $this->selectedDeviceType = null;
        $this->currentCategory = 0;
        $this->currentQuestionIndex = 0;
        $this->selectedSymptoms = [];
        $this->diagnosisResults = [];
        $this->aiRecommendation = '';
        $this->bookingForm = [
            'name' => '',
            'phone' => '',
            'address' => '',
            'device_brand' => '',
            'device_name' => '',
            'serial_number' => '',
            'complaint' => '',
        ];
        $this->bookingCode = '';
    }

    public function getCurrentQuestion()
    {
        if (!isset($this->categories[$this->currentCategory])) {
            return null;
        }

        $category = $this->categories[$this->currentCategory];
        $symptomCodes = array_keys($category['symptoms']);
        $currentCode = $symptomCodes[$this->currentQuestionIndex] ?? null;

        if (!$currentCode) {
            return null;
        }

        return [
            'code' => $currentCode,
            'category' => $category['name'],
            'question' => $category['symptoms'][$currentCode]['question'],
        ];
    }

    public function getProgress()
    {
        $totalQuestions = 0;
        $answeredQuestions = 0;

        foreach ($this->categories as $index => $category) {
            $categoryCount = count($category['symptoms']);
            $totalQuestions += $categoryCount;

            if ($index < $this->currentCategory) {
                $answeredQuestions += $categoryCount;
            } elseif ($index === $this->currentCategory) {
                $answeredQuestions += $this->currentQuestionIndex;
            }
        }

        return $totalQuestions > 0 ? round(($answeredQuestions / $totalQuestions) * 100) : 0;
    }

    public function render()
    {
        return view('livewire.diagnosis-expert', [
            'deviceTypes' => DiagnosisKnowledgeBase::DEVICE_TYPES,
            'selectedDeviceType' => $this->selectedDeviceType,
            'currentQuestion' => $this->getCurrentQuestion(),
            'progress' => $this->getProgress(),
        ])->layout('layouts.guest', ['title' => 'Diagnosis Perangkat - Cellcom']);
    }
}
