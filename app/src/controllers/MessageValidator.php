<?php

class MessageValidator {
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    private function getValue($key)
    {
        return $this->message[$key];
    }

    /**
     * Validates the 'sourcemsisdn' field.
     * @return int The validated MSISDN.
     * @throws Exception If sanitation or validation fails
     */
    public function validateMSISDN(){
        $key = 'sourcemsisdn';

        $msisdn = $this->getValue($key);
        $msisdn = filter_var($msisdn, FILTER_SANITIZE_NUMBER_INT); //removes illegal characters but allows +
        $msisdn = filter_var($msisdn, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 999999999999999))); //checks variable is an integer that has between 1 and 15 digits

        if ($msisdn === false) {
            throw new FilterException($key); //throws exception if MSISDN is invalid
        }

        return(int)$msisdn; //returns $msisdn as type int
    }


    /**
     * Validates the received date value.
     * @return DateTime Validated date object
     * @throws Exception If sanitation or validation fails.
     */
    public function validateDate(){
        $key = 'receivedtime';

        $timeReceived = $this->getValue($key);
        $timeReceived = filter_var($timeReceived, FILTER_SANITIZE_STRING);

        if ($timeReceived === false) {
            throw new FilterException($key);
        }

        $date = DateTime::createFromFormat('d/m/Y H:i:s', $timeReceived);

        if ($date === false) {
            throw new InvalidDateException($key);
        }

        return $date;
    }

    /**
     * Validates that the bearer is SMS.
     * @return string The bearer field.
     * @throws Exception If sanitation fails or if bearer is not 'SMS'
     */
    public function validateBearer() {
        $key = 'bearer';

        $bearer = $this->getValue($key);
        $bearer = filter_var($bearer, FILTER_SANITIZE_STRING);

        if ($bearer === false) {
            throw new FilterException($key);
        }

        if ($bearer !== 'SMS') {
            throw new IncorrectBearerException($key);
        }

        return $bearer;
    }


    /**
     * Validates the SMS ID.
     * @return string SMS ID.
     * @throws Exception If SMS ID does not match our SMS_ID constant (therefore message is not sent by us)
     */
    public function validateSMSId(){
        $key = 'id';

        $smsId = $this->getValue($key);
        $smsId = filter_var($smsId, FILTER_SANITIZE_STRING);

        if($smsId === false){
            throw new FilterException($key);
        }

        if ($smsId !== SMS_ID) {
            throw new IncorrectIDException($key);
        }

        return $smsId;
    }

    /**
     * Validates a Switch number and its status
     * @param $switchNum int The switch number to validate.
     * @return string Status of the switch.
     * @throws Exception If switch doesn't exist, if switch state is not 0 or 1 or if validation otherwise fails.
     */
    public function validateSwitch($switchNum){
        $key = 'S' . $switchNum;

        if ($switchNum < 1 || $switchNum > 4) {
            throw new IncorrectSwitchException($key); //switch doesn't exist
        }

        $switch = $this->getValue($key);
        $switch = filter_var($switch, FILTER_SANITIZE_NUMBER_INT);

        // switch can only be 0 or 1 (makes sure that the switch is in either an on or off position)
        $switch = filter_var($switch, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 1)));

        if ($switch === false) {
            throw new FilterException($key);
        }

        if ($switch === 0) {
            return 'OFF';
        } else if ($switch === 1) {
            return 'ON';
        }

        throw new IncorrectSwitchStateException($key);
    }


    /**
     * Validates the fan status.
     * @return string The fan status.
     * @throws Exception If fan state is invalid.
     */
    public function validateFan(){
        $key = 'F';

        $fan = $this->getValue($key);
        $fan = filter_var($fan, FILTER_SANITIZE_NUMBER_INT);
        $fan = filter_var($fan, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 1)));

        if ($fan === false) {
            throw new FilterException($key);
        }

        if ($fan === 0) {
            return 'FORWARD';
        } else if ($fan === 1) {
            return 'REVERSE';
        }

        throw new IncorrectFanStateException($key);
    }

    /**
     * Validates a temperature amount.
     * @return int Validated temperature.
     * @throws Exception If the temperature is not an int, is not between the given range or if sanitation / validation otherwise fails.
     */
    public function validateTemp(){
        $key = 'T';

        $temp = $this->getValue($key);
        $temp = filter_var($temp, FILTER_SANITIZE_NUMBER_INT);
        $temp = filter_var($temp, FILTER_VALIDATE_INT, array('options' => array('min_range' => -99, 'max_range' => 999))); // temperature is 3 digits maximum

        if ($temp === false) {
            throw new FilterException($key);
        }

        return (int)$temp;
    }


    /**
     * Validates a keypad input.
     * @return int Validated keypad input.
     * @throws Exception If the keypad input is not an int, is not between the given range or if sanitation / validation otherwise fails.
     */
    public function validateKeypad() {
        $key = 'K';

        $keypad = $this->getValue($key);
        $keypad = filter_var($keypad, FILTER_SANITIZE_NUMBER_INT);
        $keypad = filter_var($keypad, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 9))); // can only be 1 digit

        if ($keypad === false) {
            throw new FilterException($key);
        }

        return (int)$keypad;
    }

    /**
     * Sanitizes and validates the SMS message and creates a CircuitStatus object.
     * @return CircuitStatus The validated circuit board status.
     * @throws Exception
     */
    public function validateStatus(){
        $this->validateBearer();
        $date = $this->validateDate();
        $switch1 = $this->validateSwitch(1);
        $switch2 = $this->validateSwitch(2);
        $switch3 = $this->validateSwitch(3);
        $switch4 = $this->validateSwitch(4);
        $fan = $this->validateFan();
        $temp = $this->validateTemp();
        $keypad = $this->validateKeypad();

        $status = new CircuitStatus($date, $switch1, $switch2, $switch3, $switch4, $fan, $temp, $keypad); //creates new CircuitStatus object from validated inputs

        return $status; //returns CircuitStatus object
    }
}