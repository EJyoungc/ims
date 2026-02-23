<?php

namespace App\Helpers;

class Machine
{
    public static function id(): string
    {
        $cpu = php_uname('m'); // machine type
        $os = php_uname('s') . php_uname('r'); // OS + version
        $mac = self::getMacAddress(); // network MAC
        $disk = self::getDiskSerial(); // disk serial fallback
        // dd($cpu, $os, $mac, $disk,php_uname());

        return hash('sha256', $cpu . $os . $mac . $disk);
    }

    protected static function getMacAddress(): string
    {
        // Works on Windows/Linux/macOS
        $mac = '';

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            exec('getmac', $output);
            if (!empty($output[0])) {
                $mac = strtok($output[0], ' ');
            }
        } else {
            exec('ifconfig | grep ether', $output);
            if (!empty($output[0])) {
                $mac = trim(preg_replace('/ether\s+/', '', $output[0]));
            }
        }

        return $mac ?: 'nomac';
    }

    protected static function getDiskSerial(): string
    {
        // Simple fallback, not critical
        $disk = '';
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            exec('wmic diskdrive get serialnumber', $output);
            $disk = $output[1] ?? 'nodisk';
        } else {
            $disk = trim(shell_exec('lsblk -no SERIAL $(df / | tail -1 | awk \'{print $1}\')')) ?: 'nodisk';
        }

        return $disk;
    }
}
