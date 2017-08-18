<?php

namespace App\Admin\Form\Field;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\Field;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;


class DisplayValue extends Field
{

    /**
     * {@inheritdoc}
     */
   // protected $view = 'admin.form.displayvalue';
//
    protected $callback;

    /**
     * @deprecated
     *
     * @param Closure $callback
     */
    public function format(Closure $callback)
    {
        $this->with($callback);
    }

    public function with(Closure $callback)
    {
        $this->callback = $callback;
    }

    public function render()
    {
        /*
        if ($this->callback instanceof Closure) {
            $callback = $this->callback->bindTo($this->form->model());

            $this->value = call_user_func($callback, $this->value);
        }
        */
        $this->value = $this->column;

        return parent::render();
    }
}
