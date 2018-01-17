<?php
namespace Ob_Ivan\NethackNames;

interface GenderAwareInterface {
    /**
     * Store gender for future usage.
     *
     * @param string $gender One of 'male' or 'female'
     */
    public function setGender(string $gender);
}
