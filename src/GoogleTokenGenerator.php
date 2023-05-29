<?php

declare(strict_types=1);

namespace Datlechin\GoogleTranslate;

class GoogleTokenGenerator
{
    public function generate(string $text): string
    {
        $tkk = ['406398', 2087938574];

        for ($d = [], $e = 0, $f = 0; $f < $this->length($text); $f++) {
            $g = $this->charCodeAt($text, $f);
            if ($g < 128) {
                $d[$e++] = $g;
            } else {
                if ($g < 2048) {
                    $d[$e++] = $g >> 6 | 192;
                } else {
                    if ($g & 64512 === 55296 && $f + 1 < $this->length($text) && ($this->charCodeAt($text, $f + 1) & 64512) === 56320) {
                        $g = 65536 + (($g & 1023) << 10) + ($this->charCodeAt($text, ++$f) & 1023);
                        $d[$e++] = $g >> 18 | 240;
                        $d[$e++] = $g >> 12 & 63 | 128;
                    } else {
                        $d[$e++] = $g >> 12 | 224;
                    }
                    $d[$e++] = $g >> 6 & 63 | 128;
                }
                $d[$e++] = $g & 63 | 128;
            }
        }

        $a = $tkk[0];
        foreach ($d as $value) {
            $a += $value;
            $a = $this->rl($a, '+-a^+6');
        }
        $a = $this->rl($a, '+-3^+b+-f');
        $a ^= $tkk[1];
        if ($a < 0) {
            $a = ($a & 2147483647) + 2147483648;
        }
        $a = fmod($a, 1000000);

        return $a.'.'.($a ^ $tkk[0]);
    }

    protected function rl(int $a, string $b): int
    {
        for ($c = 0; $c < strlen($b) - 2; $c += 3) {
            $d = $b[$c + 2];
            $d = $d >= 'a' ? ord($d[0]) - 87 : (int) $d;
            $d = $b[$c + 1] === '+' ? $this->unsignedRightShift($a, $d) : $a << $d;
            $a = $b[$c] === '+' ? ($a + $d & 4294967295) : $a ^ $d;
        }

        return $a;
    }

    protected function unsignedRightShift(int $a, int $b): int
    {
        if ($b >= 32 || $b < -32) {
            $m = (int) ($b / 32);
            $b -= ($m * 32);
        }

        if ($b < 0) {
            $b += 32;
        }

        if ($b === 0) {
            return (($a >> 1) & 0x7FFFFFFF) * 2 + (($a >> $b) & 1);
        }

        if ($a < 0) {
            $a >>= 1;
            $a &= 2147483647;
            $a |= 0x40000000;
            $a >>= ($b - 1);
        } else {
            $a >>= $b;
        }

        return $a;
    }

    protected function charCodeAt(string $string, int $index): int
    {
        return mb_ord(mb_substr($string, $index, 1));
    }

    protected function length(string $string): int
    {
        return mb_strlen($string);
    }
}
