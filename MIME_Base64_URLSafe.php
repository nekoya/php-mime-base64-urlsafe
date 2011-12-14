<?php
/**
 * PHP version of Perl's MIME::Base64::URLSafe
 *
 * This module is URL-safe base64 encoder / decoder.
 *
 * Original specification is Python URL−safe base64 codec.
 *
 * @version 0.01
 * @author  Ryo Miyake <ryo.studiom at gmail.com>
 * @see     http://search.cpan.org/~kazuho/MIME-Base64-URLSafe-0.01/lib/MIME/Base64/URLSafe.pm
 */

class MIME_Base64_URLSafe {
    /**
     * base64 encode url safe
     *
     * @param  string  $data
     * @return string  encoded data
     */
    public static function encode($data) {
        $from = array('+', '/', '=');
        $to   = array('-', '_');
        return str_replace($from, $to, base64_encode($data));
    }

    /**
     * base64 decode url safe
     *
     * @param  string  $data
     * @return string  decoded data
     *
     * @see base64_encode_uflsafe()
     */
    public static function decode($data) {
        $from = array('-', '_', ' ', "\x09", "\x0a", "\x0b", "\x0c", "\x0d");
        $to   = array('+', '/');
        $replaced = str_replace($from, $to, $data);

        // perhaps PHP's base64_decode handles '=' padding automatically.
        // I keep this sentence out of respect for original implementation.
        $mod4 = strlen($replaced) % 4;
        if ($mod4) {
            $replaced .= substr('====', $mod4);
        }

        return base64_decode($replaced);
    }
}
