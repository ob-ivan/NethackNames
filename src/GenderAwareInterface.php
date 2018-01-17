<?php
namespace Ob_Ivan\NethackNames;

interface GenderAwareInterface {
    const GENDER_MALE   = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * Store gender for future usage.
     *
     * @param string $gender One of 'male' or 'female'
     */
    public function setGender(string $gender);
}
