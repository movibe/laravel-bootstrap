<?php namespace Davzie\LaravelBootstrap\Accounts;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;
use Illuminate\Auth\UserInterface as LaravelUserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends EloquentBaseModel implements LaravelUserInterface, RemindableInterface
{
    protected $table    = 'users';

    // Never actually delete shit, just 'soft delete' that bad-boy
    protected $softDelete = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('first_name', 'last_name', 'email');

    protected $validationRules = [
        'first_name'    => 'required',
        'last_name'   => 'required',
        'email' => 'required|email'
    ];

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the full name of the user
     * @return string
     */
    public function getFullName(){
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

}