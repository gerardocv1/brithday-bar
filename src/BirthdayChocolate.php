<?php

namespace src;

use stdClass;

class BirthdayChocolate
{
    protected $n;
    protected $c;
    protected $md;

    /**
     * Class Chocolate bar
     * @author gerardocarvajalvargas@gmail.com
     *
     * @param int $n Number of squares in the chocolate bar
     * @param string $c Numbers on the chocolate squares (space-separated integers)
     * @param string $md Ron's birth day and his birth month. (Two space-separated integers)
     */
    function __construct(int $n, string $c, string $md)
    {
        $this->n = $n;
        $this->c = $c;
        $this->md = $md;
    }

    /**
     * Calculate
     * @author gerardocarvajalvargas@gmail.com
     *
     * @return int
     */
    public function birthday(): stdClass
    {
        $count = 0;

        /** number on the chocolate squares */
        $resp = $this->convertStringToArrayInt($this->c);
        if ($resp->status == -1) {
            return $resp;
        }
        $a = $resp->data;

        /** validate month and day */
        if (empty($this->md) || count(preg_split("/ /", $this->md)) != 2) {
            return $this->response(-2, 'error validate month and day');
        }

        /** month and day */
        list($day, $month) = preg_split("/ /", $this->md);
        $m = (int) $month;
        $d = (int) $day;

        /** validate number of squares in the chocolate bar */
        if ($this->n != count($a)) {
            return $this->response(-3, 'error number of squares in the chocolate bar');
        }

        /** calculate */
        for ($i = 0; $i < $this->n; $i++) {
            $length = 0;
            $sum = 0;

            for ($f = $i; $f < $this->n; $f++) {
                $length++;
                $sum += $a[$f];

                if ($sum == $d && $length == $m) {
                    $count++;
                    break;
                }
                if ($sum > $d || $length > $m) {
                    break;
                }
            }
        }

        return $this->response(1, 'success', $count);
    }

    /**
     * Convert string to array of integers
     * @author gerardocarvajalvargas@gmail.com
     *
     * @return stdClass
     */
    protected function convertStringToArrayInt(string $string): stdClass
    {
        if (empty($string)) {
            return $this->response(-1, 'error string of numbers on the chocolate squares');
        }

        $strings = preg_split("/ /", $string);
        $a = [];
        for ($i = 0; $i < count($strings); $i++) {
            $a[] = (int) $strings[$i];
        }

        return $this->response(1, 'success', $a);
    }

    /**
     * Format return
     * @author gerardocarvajalvargas@gmail.com
     *
     * @return stdClass
     */
    protected function response(int $status, string $message = '', $data = null): stdClass
    {
        $resp = new stdClass();
        $resp->status = $status;
        $resp->message = $message;
        (is_null($data) || empty($data)) ? $resp->data = new stdClass() : $resp->data = $data;

        return $resp;
    }
}
