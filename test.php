<?php
require 'MIME_Base64_URLSafe.php';

class MIME_Base64_URLSafe_Test extends PHPUnit_Framework_TestCase {
    public function testEncodeAndDecode() {
        $o = "\0\0\0\0";
        $e = 'AAAAAA';
        $this->assertEquals(MIME_Base64_URLSafe::encode($o), $e);
        $this->assertEquals(MIME_Base64_URLSafe::decode($e), $o);

        $o = "\xff";
        $e = '_w';
        $this->assertEquals(MIME_Base64_URLSafe::encode($o), $e);
        $this->assertEquals(MIME_Base64_URLSafe::decode($e), $o);

        $o = "\xff\xff";
        $e = '__8';
        $this->assertEquals(MIME_Base64_URLSafe::encode($o), $e);
        $this->assertEquals(MIME_Base64_URLSafe::decode($e), $o);

        $o = "\xff\xff\xff";
        $e = '____';
        $this->assertEquals(MIME_Base64_URLSafe::encode($o), $e);
        $this->assertEquals(MIME_Base64_URLSafe::decode($e), $o);

        $o = "\xff\xff\xff\xff";
        $e = '_____w';
        $this->assertEquals(MIME_Base64_URLSafe::encode($o), $e);
        $this->assertEquals(MIME_Base64_URLSafe::decode($e), $o);

        $o = "\xfb";
        $e = '-w';
        $this->assertEquals(MIME_Base64_URLSafe::encode($o), $e);
        $this->assertEquals(MIME_Base64_URLSafe::decode($e), $o);

        // decoder padding test with spaces
        $this->assertEquals(MIME_Base64_URLSafe::decode(" AA"), "\0");
        $this->assertEquals(MIME_Base64_URLSafe::decode("\tAA"), "\0");
        $this->assertEquals(MIME_Base64_URLSafe::decode("\rAA"), "\0");
        $this->assertEquals(MIME_Base64_URLSafe::decode("\nAA"), "\0");
    }
}
