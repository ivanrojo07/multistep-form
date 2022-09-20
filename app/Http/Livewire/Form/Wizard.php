<?php

namespace App\Http\Livewire\Form;

use App\Models\Product;
use Livewire\Component;

class Wizard extends Component
{
    public $currentStep = 1;
    public $name, $price, $detail = "";
    public $successMsg = "";

    public function render()
    {
        return view('livewire.form.wizard');
    }

    public function firstStepSubmit(){
        $validatedData = $this->validate([
            "name" => "required",
            "price" => "required|numeric"
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit() {
        $validatedData = $this->validate([
            "detail" => "required"
        ]);
        $this->currentStep = 3;
    }

    public function submitForm(){
        Product::create([
            "name" => $this->name,
            "price" => $this->price,
            "detail" => $this->detail
        ]);

        $this->successMsg = "Product successfully created";

        $this->clearForm();

        $this->currentStep = 1;
    }

    public function back ($step){
        $this->currentStep = $step;
    }

    public function clearForm(){
        $this->name = "";
        $this->price = "";
        $this->detail = "";
    }
    
}
