<?php
// MODEL USER
/////////////

// BUAT CLASS
class User_model
{
    // BUAT PROPERTY 
    private $nama = 'Naufal Fadhil';

    // BUAT METHOD GET USER
    public function getUser()
    {
        // KEMBALIKAN NILAI PROP
        return $this->nama;
    }
}
