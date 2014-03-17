<?php
/**
 * FormDemoModel.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Model;


use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FormDemoModel
 *
 * @package Avanzu\AdminThemeBundle\Model
 */
class FormDemoModel {

    /**
     * @var string
     */
    protected $gender;
    /**
     * @var string
     */
    protected $someOption;
    /**
     * @var string
     */
    protected $someChoices;
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var bool
     */
    protected $termsAccepted;
    /**
     * @var string
     */
    protected $message;
    /**
     * @var float
     */
    protected $price;
    /**
     * @var \DateTime
     */
    protected $date;
    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $someChoices
     */
    public function setSomeChoices($someChoices)
    {
        $this->someChoices = $someChoices;
    }

    /**
     * @return mixed
     */
    public function getSomeChoices()
    {
        return $this->someChoices;
    }

    /**
     * @param mixed $someOption
     */
    public function setSomeOption($someOption)
    {
        $this->someOption = $someOption;
    }

    /**
     * @return mixed
     */
    public function getSomeOption()
    {
        return $this->someOption;
    }

    /**
     * @param mixed $termsAccepted
     */
    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = $termsAccepted;
    }

    /**
     * @return mixed
     */
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }




}