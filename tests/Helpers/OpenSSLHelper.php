<?php

namespace Tests\Helpers;

class OpenSSLHelper
{
    /**
     * @param string $certificate
     * @return string|null
     */
    public static function getCertificateHash(string $certificate): ?string
    {
        $cmd = 'openssl x509 -in ' . escapeshellarg($certificate) . ' -noout -modulus | openssl md5';
        $descriptorSpec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];
        $pipes = [];
        $process = proc_open($cmd, $descriptorSpec, $pipes);

        $output = null;
        $result = -1;

        if (is_resource($process)) {
            $output = stream_get_contents($pipes[1]);
            $result = proc_close($process);
        }

        return ($result === 0) ? $output : null;
    }

    /**
     * @param string $privateKey
     * @return string|null
     */
    public static function getPrivateKeyHash(string $privateKey): ?string
    {
        $cmd = 'openssl rsa -in ' . escapeshellarg($privateKey) . ' -noout -modulus | openssl md5';
        $descriptorSpec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];
        $pipes = [];
        $process = proc_open($cmd, $descriptorSpec, $pipes);

        $output = null;
        $result = -1;

        if (is_resource($process)) {
            $output = stream_get_contents($pipes[1]);
            $result = proc_close($process);
        }

        return ($result === 0) ? $output : null;
    }

    /**
     * @param string $privateKey
     * @param string $certificate
     * @return bool
     */
    public static function checkPrivateKeyAndCertificateMatching(string $privateKey, string $certificate): bool
    {
        $privateKeyHash = self::getPrivateKeyHash($privateKey);
        $certificateHash = self::getCertificateHash($certificate);

        return $privateKeyHash && $certificateHash && $privateKeyHash === $certificateHash;
    }
}
