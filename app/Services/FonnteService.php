<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public function isConfigured(): bool
    {
        return !empty(config('services.fonnte.token'));
    }

    public function sendMessage(string $phone, string $message): array
    {
        if (!$this->isConfigured()) {
            return [
                'success' => false,
                'message' => 'FONNTE_TOKEN belum diatur.',
            ];
        }

        $target = $this->normalizePhone($phone);

        /** @var \Illuminate\Http\Client\Response $response */
        $response = Http::withHeaders([
            'Authorization' => config('services.fonnte.token'),
        ])->asForm()->post(config('services.fonnte.endpoint', 'https://api.fonnte.com/send'), [
            'target' => $target,
            'message' => $message,
            'countryCode' => '62',
        ]);

        if (!$response->ok()) {
            return [
                'success' => false,
                'message' => 'HTTP ' . $response->status() . ': ' . $response->body(),
            ];
        }

        $payload = $response->json();

        return [
            'success' => (bool) ($payload['status'] ?? false),
            'message' => $payload['reason'] ?? 'Sent',
            'raw' => $payload,
        ];
    }

    private function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        if (str_starts_with($digits, '62')) {
            return $digits;
        }

        return '62' . $digits;
    }
}
