<?php

namespace App\Models;

class QuestionOption extends MyBaseModel
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @access public
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @access protected
     * @var array
     */
    protected $fillable = ['name', 'price'];

    /**
     * The question associated with the question option.
     *
     * @access public
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function anwsers()
    {
        return $this->belongsToMany(\App\Models\Anwsers::class);
    }

    public function showWithNameAndPrice($currency)
    {
        if ($this->price > 0) {
            return $this->name.' ('.money($this->price, $currency).')';
        } else {
            return $this->name;
        }
    }
}
