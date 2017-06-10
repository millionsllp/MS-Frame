<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Form::component('inputText', 'MS.Form.Input.text', ['data','index']);
        \Form::component('inputHidden', 'MS.Form.Input.hidden', ['data','index']);
        \Form::component('inputEmail', 'MS.Form.Input.email', ['data','index']);
        \Form::component('inputLockText', 'MS.Form.Input.LockText', ['data','index']);
        \Form::component('inputPassword', 'MS.Form.Input.password', ['data','index']);
        \Form::component('inputNumber', 'MS.Form.Input.number', ['data','index']);
        \Form::component('inputLockNumber', 'MS.Form.Input.LockNumber', ['data','index']);
        \Form::component('inputRadio', 'MS.Form.Input.radio', ['data','index']);
        \Form::component('inputLockRadio', 'MS.Form.Input.LockRadio', ['data','index']);
        \Form::component('inputCheck', 'MS.Form.Input.check', ['data','index']);
        \Form::component('inputLockCheck', 'MS.Form.Input.LockCheck', ['data','index']);
        \Form::component('inputOption', 'MS.Form.Input.option', ['data','index']);
        \Form::component('inputLockOption', 'MS.Form.Input.LockOption', ['data','index']);
        \Form::component('inputFile', 'MS.Form.Input.file', ['data','index']);
        \Form::component('inputTextArea', 'MS.Form.Input.textarea', ['data','index']);
        \Form::component('inputLockTextArea', 'MS.Form.Input.LockTextArea', ['data','index']);
        \Form::component('inputDate', 'MS.Form.Input.date', ['data','index']);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
